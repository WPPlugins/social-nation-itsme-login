<?php
/*
	User functions class
*/
class SocialNationItsMeLoginUser{
	/*
		Attempt to login user.
		- If user already exixts update some info.
		- If user don't exists create new user.
		- After create or update login user (wp_set_auth_cookie)
	*/
	public static function login($params=array()){
		$userId = $params["userId"]?$params["userId"]:false;
		$firstName = $params["firstName"]?$params["firstName"]:"";
		$lastName = $params["lastName"]?$params["lastName"]:"";
		$email = $params["email"]?$params["email"]:"";
		$uuid = $params["uuid"]?$params["uuid"]:"";
		$accessToken = $params["accessToken"]?$params["accessToken"]:"";
		$refreshToken = $params["refreshToken"]?$params["refreshToken"]:"";
		$dataArray = $params["dataArray"]?$params["dataArray"]:array();
		$tokenExpiresIn = $params["tokenExpiresIn"]?$params["tokenExpiresIn"]:"";
		$autoLogin = isset($params["autoLogin"])?$params["autoLogin"]:true;	
		$deleteUserData = isset($params["deleteUserData"])?$params["deleteUserData"]:false;	
		$shouldRefreshToken = isset($params["shouldRefreshToken"])?$params["shouldRefreshToken"]:true;	

		global $social_nation_itsme_login;
		//validate data before insert or update
		$userId = $social_nation_itsme_login->validate_integer($userId);
		$firstName = $social_nation_itsme_login->check_input_text($firstName);
		$lastName = $social_nation_itsme_login->check_input_text($lastName);
		$email = $social_nation_itsme_login->check_input_email($email);
		$uuid = $social_nation_itsme_login->check_input_text($uuid);
		$accessToken = $social_nation_itsme_login->check_input_text($accessToken);
		$refreshToken = $social_nation_itsme_login->check_input_text($refreshToken);
		$tokenExpiresIn = $social_nation_itsme_login->check_input_text($tokenExpiresIn);


		if($firstName || $lastName)
			$displayName = $firstName." ".$lastName;
		
		$userData = array();
		
		if($userId){
			$userData["ID"] = $userId;
			//update only if valid data
			if($displayName)
				$userData["display_name"] = $displayName;
			if($firstName)
				$userData["first_name"] = $firstName;
			if($lastName)
				$userData["last_name"] = $lastName;
			if($email)
				$userData["user_email"] = $email;
			$newUserId = wp_update_user($userData);
		}
		else{
			$password = wp_generate_password();
			//check if already exists
			$username = self::generateUsername(array(
				"firstName"=>$firstName,
				"lastName"=>$lastName,
				"uuid"=>$uuid
			));
			
			if(!$displayName)
				$displayName = $username;
			//A string that contains a URL-friendly name for the user.
			$nicename = $username;
			$userData["display_name"] = $displayName;
			$userData["first_name"] = $firstName;
			$userData["last_name"] = $lastName;
			//insert only when user is created
			$userData["user_pass"] = $password;
			$userData["user_login"] = $username;
			$userData["user_email"] = $email;
			//$userData["user_nicename"] = $nicename;
			//$userData["nickname"] = $nickname;
			$newUserId = wp_insert_user($userData);
		}

		if(is_wp_error($newUserId)){
			if($social_nation_itsme_login->enable_log){
				file_put_contents(
					WPSN_IML_LOG_FILE_PATH, 
					"SocialNationItsMeLoginUser::login() errore nella creazione o aggiornamento dell'utente: ".
					$newUserId->get_error_message()."\n",
					FILE_APPEND
				);
			}
			return $newUserId->get_error_message();

		}

		if($social_nation_itsme_login->enable_log){
			file_put_contents(
				WPSN_IML_LOG_FILE_PATH, 
				"SocialNationItsMeLoginUser::login() deleteUserData=$deleteUserData - ".
				"count(dataArray)=".count($dataArray)." - autoLogin=$autoLogin - ".
				"shouldRefreshToken=".$shouldRefreshToken."\n",
				FILE_APPEND
			);
		}

		if($deleteUserData){
			$userMetaArray = get_user_meta($newUserId);
			foreach($userMetaArray as $key => $val){
				if(	
					$key=="sn_iml_identifier" || 
					($key=="sn_iml_token_last_date" && !$shouldRefreshToken)
				)continue;
				if(strpos($key, "sn_iml") === 0){
					delete_user_meta($newUserId, $key);
				}
			}
		}

		foreach($dataArray as $item){
			//data is validated/escaped in update_user_meta 
			update_user_meta(
				$newUserId, 
				"sn_iml_".$item["name"],
				$item["value"]
			);
		}

		//data is validated/escaped in update_user_meta 
		update_user_meta(
			$newUserId, 
			"sn_iml_at",
			$accessToken
		);
		update_user_meta(
			$newUserId, 
			"sn_iml_rt",
			$refreshToken
		);
		update_user_meta(
			$newUserId, 
			"sn_iml_token_expires_in",
			$tokenExpiresIn
		);

		if($shouldRefreshToken){
			update_user_meta(
				$newUserId, 
				"sn_iml_token_last_date",
				time()
			);
		}

		/*
		update_user_meta(
			$newUserId, 
			"sn_iml_token_type",
			$tokenType
		);
		*/
		if(!$userId){
			//insert only when user is created
			update_user_meta(
				$newUserId, 
				"sn_iml_identifier",
				$uuid
			);
		}
		if($autoLogin){
			$wpUser = get_userdata( $newUserId );
			// Set WP auth cookie
			wp_set_auth_cookie( $newUserId, true );

			// let keep it std
			do_action( 'wp_login', $wpUser->user_login, $wpUser );
		}
		

		return true;
	}

	public static function generateUsername($params=array()){
		$firstName = $params["firstName"]?$params["firstName"]:false;
		$lastName = $params["lastName"]?$params["lastName"]:false;
		$uuid = $params["uuid"]?$params["uuid"]:false;
		$username="";
		if($firstName || $lastName){
			$username=$firstName.$lastName;
		}
		else{
			$username=$uuid;
		}
		$username = sanitize_user( $username, true );
		$username = trim( str_replace( array( ' ', '.' ), '_', $username ) );
		$username = trim( str_replace( '__', '_', $username ) );
		// user name should be unique
		if( username_exists( $username ) ){
			$i = 1;
			$user_login_tmp = $username;

			do{
				$user_login_tmp = $username . "_" . ($i++);
			}while( username_exists ($user_login_tmp));

			$username = $user_login_tmp;
		}
		return $username;
	}
}

?>