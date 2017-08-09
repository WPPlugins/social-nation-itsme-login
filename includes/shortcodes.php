<?php
	class SocialNationItsMeLoginShortcodes{
		public function init(){
			add_shortcode( 
				'socialnation_itsme_login', 
				array( 
					$this,
					'socialNationItsmeLogin'
				) 
			);
		}

		public function socialNationItsmeLogin($atts){
			global $social_nation_itsme_login;
			global $wp; 

			if(get_current_user_id())
				return "";
			$text = $atts["text"];
			$text_after = $atts["text_after"];
			$client_id = $social_nation_itsme_login->client_id;
			
			$redirect_uri = urlencode(
				$social_nation_itsme_login->addParamsToUri(array(
					"uri" => home_url(add_query_arg(array(),$wp->request)),
					"params" =>"action=".WPSN_IML_ACTION_AUTHENTICATE."&param="
				))
			);
			$href = 
				$social_nation_itsme_login->itsme_login_url.
				"&client_id=$client_id&redirect_uri=$redirect_uri";
			$social_nation_itsme_login->printItsmeLoginButton(
				array(
					"text" => $text,
					"href" => $href,
					"text_after" => $text_after,
				)
			);
		}
	}

	(new SocialNationItsMeLoginShortcodes())->init();
?>