<?php
class SocialNationItsMeLoginAjax{
	public function init(){
		add_action (
			'wp_ajax_sn_iml_login_user', 
			array($this, 'loginUser')
		);
		add_action (
			'wp_ajax_nopriv_sn_iml_login_user', 
			array($this, 'loginUser')
		);

		add_action (
			'wp_ajax_iml_user_report', 
			array($this, 'userReport')
		);
		add_action (
			'wp_ajax_nopriv_iml_user_report', 
			array($this, 'userReport')
		);

		add_action (
			'wp_ajax_iml_user_report_update_pending', 
			array($this, 'userReportUpdatePending')
		);
		add_action (
			'wp_ajax_nopriv_iml_user_report_update_pending', 
			array($this, 'userReportUpdatePending')
		);

		add_action (
			'wp_ajax_iml_user_report_save_log', 
			array($this, 'userReportSaveLog')
		);
		add_action (
			'wp_ajax_nopriv_iml_user_report_save_log', 
			array($this, 'userReportSaveLog')
		);
	}

	public function userReportSaveLog($options=array()){
		global $social_nation_itsme_login;
		$text = $social_nation_itsme_login->check_input_textarea($_POST['text']);
		update_option("sn_iml_user_report_log", $_POST['text']);
		$out = array("success"=>true);

		if($social_nation_itsme_login->enable_log){
			file_put_contents(
				WPSN_IML_LOG_FILE_PATH, 
				"USER REPORT: userReportSaveLog() - log javascript salvato\n",
				FILE_APPEND
			);
		}

		echo json_encode($out);
		die();
	}

	/*
		Procedure to update user pending
	*/
	public function userReportUpdatePending($options=array()){
		global $social_nation_itsme_login;
		$data = $_POST["data"];
		$uuid = $data["uuid"];

		$users = get_users(array(
			"meta_key" => "sn_iml_identifier",
			"meta_value" => $uuid,
			"fields" => "all_with_meta"
		));

		$out = array("success"=>true);

		if(!is_array($users) || count($users) != 1){
			$out["success"] = false;
			$out["errorCode"] = "1";
			if($social_nation_itsme_login->enable_log){
				file_put_contents(
					WPSN_IML_LOG_FILE_PATH, 
					"USER REPORT: userReportUpdatePending() - EERROR user NOT found uuid=".$uuid." \n",
					FILE_APPEND
				);
			}
		}
		else{
			reset($users);
			$wpuser = current($users);
			$userMeta = get_user_meta($wpuser->ID, null, true);
			$additionalData = array();
			$additionalData["authorization"] = "Basic ".base64_encode(
				$social_nation_itsme_login->client_id.":".$social_nation_itsme_login->client_secret
			);
			$additionalData["redirectUri"] = $social_nation_itsme_login->getRedirectUri();
			$wpuser = array(
				"userData" => $wpuser,
				"userMeta" => $userMeta,
				"additionalData" => $additionalData
			);
			$out["data"] = $wpuser;
			if($social_nation_itsme_login->enable_log){
				file_put_contents(
					WPSN_IML_LOG_FILE_PATH, 
					"USER REPORT: userReportUpdatePending() - user found -> id=".$wpuser["userData"]->ID." \n",
					FILE_APPEND
				);
			}
		}
		

		//$out["debug"] = $wpuser;
		echo json_encode($out);
		die();
	}

	/*
		Procedure to update user Report
	*/
	public function userReport($options=array()){
		global $social_nation_itsme_login;
		$data = $_POST["data"];
		
		$total_subscriber = $social_nation_itsme_login->validate_integer($data["totalSubscriber"]);
		update_option('sn_iml_total_subscriber', $total_subscriber);
		$social_nation_itsme_login->total_subscriber = $total_subscriber;

		$uuid_to_update = $data["uuidToUpdate"];
		update_option('sn_iml_uuid_to_update', $uuid_to_update);
		$social_nation_itsme_login->uuid_to_update = $uuid_to_update;

		if($uuid_to_update && is_array($uuid_to_update) && count($uuid_to_update)>0){
		}
		else{
			$uuid_to_update = false;
		}

		//update last report date
		$curr = new DateTime();
		update_option('sn_iml_last_report_date', $curr);
		$social_nation_itsme_login->last_report_date = get_option('sn_iml_last_report_date');
		$social_nation_itsme_login->last_report_date_strong_with_timezone = SocialNationItsMeLoginUtils::convertDateToLocale(array(
			"dateTime" => $social_nation_itsme_login->last_report_date,
			"useLocalTimeZone" => true,
			"printTimezone" => true
		));

		$out = array(
			"success" => true, 
			"message" => "report updated", 
			"data" => array(
					"totalSubscriber" => $total_subscriber, 
					"lastReportDate" => $social_nation_itsme_login->last_report_date_strong_with_timezone,
					"uuidToUpdate" => $uuid_to_update
			)
		);

		if($social_nation_itsme_login->enable_log){
			file_put_contents(
				WPSN_IML_LOG_FILE_PATH, 
				date("d-m-Y H:i:s")." USER REPORT: START - totalSubscriber=$total_subscriber \n",
				FILE_APPEND
			);
		}
		echo json_encode($out);
		die();
	}

	/*
		Procedure to create/update user
		1 - check if user exits in db
			* check for usermeta sn_iml_identifier
		2 - if user already exists update info then login user
		3 - if user do not exists, create it then login user  
	*/
	public function loginUser(){
		global $social_nation_itsme_login;
		$user = $_POST["userData"];
		$userUuid = $user["uuid"];
		$userEmail = $user["email"];
		$userFirstName = $user["firstName"];
		$userLastName = $user["lastName"];
		$accessToken = $user["accessToken"];
		$refreshToken = $user["refreshToken"];
		$tokenExpiresIn = $user["tokenExpiresIn"];
		$dataArray = $user["dataArray"];
		$autoLogin = isset($_POST["autoLoginUser"])?$_POST["autoLoginUser"]:true;
		$deleteUserData = isset($_POST["deleteUserData"])?$_POST["deleteUserData"]:false;	
		$shouldRefreshToken = isset($_POST["shouldRefreshToken"])?$_POST["shouldRefreshToken"]:true;	

		$users = get_users(
			array(
				'meta_key' => 'sn_iml_identifier', 
				'meta_value' => $userUuid
			)
		);
		$createUserFlag = true;
		$userId = false;
		if(count($users)==0){
			//create user

		}
		else if(count($users)==1){
			//update user
			$userId = $users[0]->id;
			$createUserFlag = false;
		}
		else{
			//lol
			//this is not possible
		}

		$out = array();

		if($createUserFlag){
			$result = SocialNationItsMeLoginUser::login(array(
				"firstName" => $userFirstName,
				"lastName" => $userLastName,
				"email" => $userEmail,
				"uuid" => $userUuid,
				"accessToken" => $accessToken,
				"refreshToken" => $refreshToken,
				"tokenExpiresIn" => $tokenExpiresIn,
				"dataArray" => $dataArray,
				"autoLogin" => $autoLogin,
				"deleteUserData" => $deleteUserData,
				"shouldRefreshToken" => $shouldRefreshToken

			));
			if($result===true){
				$out["success"] = true;
				$out["message"] = "Utente creato";
				if($social_nation_itsme_login->enable_log)
					file_put_contents(
						WPSN_IML_LOG_FILE_PATH, 
						date("d-m-Y H:i:s").
						" User created\n",
						FILE_APPEND
					);
			}
			else{
				$out["success"] = false;
				$out["message"] = $result;
				if($social_nation_itsme_login->enable_log)
					file_put_contents(
						WPSN_IML_LOG_FILE_PATH, 
						date("d-m-Y H:i:s").
						" : User not created: $result\n",
						FILE_APPEND
					);
			}
			
		}
		else{
			$result = SocialNationItsMeLoginUser::login(array(
				"firstName" => $userFirstName,
				"lastName" => $userLastName,
				"email" => $userEmail,
				"userId" => $userId,
				"accessToken" => $accessToken,
				"refreshToken" => $refreshToken,
				"tokenExpiresIn" => $tokenExpiresIn,
				"dataArray" => $dataArray,
				"autoLogin" => $autoLogin,
				"deleteUserData" => $deleteUserData,
				"shouldRefreshToken" => $shouldRefreshToken
			));
			if($result===true){
				$out["success"] = true;
				$out["message"] = "Utente aggiornato (".$userId.")";
				if($social_nation_itsme_login->enable_log)
					file_put_contents(
						WPSN_IML_LOG_FILE_PATH, 
						date("d-m-Y H:i:s")." ".
						$out["message"]."\n",
						FILE_APPEND
					);
			}
			else{
				$out["success"] = false;
				$out["message"] = $result;
				if($social_nation_itsme_login->enable_log)
					file_put_contents(
						WPSN_IML_LOG_FILE_PATH, 
						date("d-m-Y H:i:s").
						" ERROR: User not updated (".$userId."):  $result\n",
						FILE_APPEND
					);
			}
		}
		
		echo json_encode($out);

		wp_die();
	}
}

(new SocialNationItsMeLoginAjax())->init();
?>