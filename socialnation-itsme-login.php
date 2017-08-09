<?php
	/* 
		Plugin Name: Social Nation It'sMe Login
		Description: A plugin by Social Nation to login with It'sME account 
		Version: 1.0.7
		Author: Social Nation S.R.L.
		Author URI: http://www.socialnation.it
		License: GPL2

		Social Nation It'sMe Login is free software: you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation, either version 2 of the License, or
		any later version.
		 
		Social Nation It'sMe Login is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
		GNU General Public License for more details.
		 
		You should have received a copy of the GNU General Public License
		along with Social Nation It'sMe Login. If not, see http://www.gnu.org/licenses/gpl.txt.
	*/

	//change version in above comment, readme.txt and define( 'WPSN_IML_VERSION')
	define( 'WPSN_IML_VERSION', '1.0.7' );

	define( 'WPSN_IML_REQUIRED_WP_VERSION', '4.4' );

	define( 'WPSN_IML_PLUGIN', __FILE__ );

	define( 'WPSN_IML_PLUGIN_BASENAME', plugin_basename( WPSN_IML_PLUGIN ) );

	define( 'WPSN_IML_PLUGIN_NAME', trim( dirname( WPSN_IML_PLUGIN_BASENAME ), '/' ) );

	define( 'WPSN_IML_PLUGIN_DIR', untrailingslashit( dirname( WPSN_IML_PLUGIN ) ) );

	define( 'WPSN_IML_PLUGIN_URL', site_url()."/wp-content/plugins/social-nation-itsme-login" );
	define( 'WPSN_IML_PLUGIN_JS_URL', WPSN_IML_PLUGIN_URL."/assets/js" );
	define( 'WPSN_IML_PLUGIN_CSS_URL', WPSN_IML_PLUGIN_URL."/assets/css" );
	define( 'WPSN_IML_PLUGIN_IMAGES_URL', WPSN_IML_PLUGIN_URL."/assets/images" );

	//define( 'WPSN_IML_ITSME_URL', "https://www.itsme.it/app/?mode=oauth2login&response_type=code&redirect_uri=https://www.socialnation.it/&scope=basic");
	define( 'WPSN_IML_ITSME_URL', "https://www.itsme.it/app");
	define( 'WPSN_IML_ITSME_URL_TEST', "https://test.itsme.it/app");
	define( 'WPSN_IML_ITSME_API', "APIGateway/partnerSDK/prod/apiGateway-js-sdk");
	define( 'WPSN_IML_ITSME_API_TEST', "APIGateway/partnerSDK/test/apiGateway-js-sdk");
	define( 'WPSN_IML_ITSME_REQUEST_CODE_URL', WPSN_IML_ITSME_URL."/?mode=oauth2login&response_type=code&scope=basic");
	define( 'WPSN_IML_ITSME_REQUEST_CODE_URL_TEST', WPSN_IML_ITSME_URL_TEST."/?mode=oauth2login&response_type=code&scope=basic");
	define( 'WPSN_IML_ITSME_API_URL', WPSN_IML_ITSME_URL."/".WPSN_IML_ITSME_API);
	define( 'WPSN_IML_ITSME_API_URL_TEST', WPSN_IML_ITSME_URL_TEST."/".WPSN_IML_ITSME_API_TEST);

	define( 'WPSN_IML_LOG_FILE_NAME', "social-nation-itsme-login.log");
	define( 'WPSN_IML_USER_REPORT_LOG_FILE_NAME', "social-nation-itsme-login-user-report.log");
	define( 'WPSN_IML_LOG_FOLDER_NAME', "social-nation-itsme-login");
	
	//this is to avoid php 5.x compile error (direct access to array function result)
	$WPSN_IML_WP_UPLOAD_DIR_ARRAY = wp_upload_dir();
	define( 'WPSN_IML_LOG_DIR_PATH', $WPSN_IML_WP_UPLOAD_DIR_ARRAY["basedir"]."/".WPSN_IML_LOG_FOLDER_NAME);
	define( 'WPSN_IML_LOG_FILE_PATH', WPSN_IML_LOG_DIR_PATH."/".WPSN_IML_LOG_FILE_NAME);
	define( 'WPSN_IML_USER_REPORT_LOG_FILE_PATH', WPSN_IML_LOG_DIR_PATH."/".WPSN_IML_USER_REPORT_LOG_FILE_NAME);

	define( 'WPSN_IML_ACTION_AUTHENTICATED', "social_nation_login_authenticated");
	define( 'WPSN_IML_REDIRECT_URI_ACTION_AUTHENTICATED', "action=".WPSN_IML_ACTION_AUTHENTICATED);
	define( 'WPSN_IML_ACTION_AUTHENTICATE', "social_nation_login_authenticate");
	define( 'WPSN_IML_REDIRECT_URI_ACTION_AUTHENTICATE', "action=".WPSN_IML_ACTION_AUTHENTICATE);
	
	define( 'WPSN_IML_LOGIN_BUTTONS_IMAGE_URL', WPSN_IML_PLUGIN_IMAGES_URL."/button");
	define( 'WPSN_IML_LOGIN_BUTTONS_IMAGE_DIR', WPSN_IML_PLUGIN_DIR."/assets/images/button");

	//define( 'WPSN_IML_BUTTON_LAYOUT_BUTTON_ICON', "button_icon");
	//define( 'WPSN_IML_BUTTON_LAYOUT_BUTTON_WITH_TEXT', "button_with_text");
	//define( 'WPSN_IML_BUTTON_LAYOUT_BUTTON_ICON_LIGHT', "button_icon_light");
	//define( 'WPSN_IML_BUTTON_LAYOUT_BUTTON_WITH_TEXT_LIGHT', "button_with_text_light");

	//ADMIN UI
	define( 'WPSN_IML_ADMIN_PAGE_TITLE', "Social Nation It'sMe Login");
	define( 'WPSN_IML_ADMIN_MENU_TITLE', "Social Nation It'sMe Login");
	define( 'WPSN_IML_ADMIN_MENU_SLUG', 'socialnation_itsme_login_options');
	//tab 
	define( 'WPSN_IML_ADMIN_TAB_GENERAL', "general");
	define( 'WPSN_IML_ADMIN_TAB_REPORT', "report");

	define( 'WPSN_IML_REPORT_CRON_INTERVAL_DAILY', "Giornaliero");
	define( 'WPSN_IML_REPORT_CRON_INTERVAL_DAILY_VALUE', 86400);
	define( 'WPSN_IML_REPORT_CRON_INTERVAL_WEEKLY', "Settimanale");
	define( 'WPSN_IML_REPORT_CRON_INTERVAL_WEEKLY_VALUE', 604800);
	define( 'WPSN_IML_REPORT_CRON_INTERVAL_MONTHLY', "Mensile");
	define( 'WPSN_IML_REPORT_CRON_INTERVAL_MONTHLY_VALUE', 2635200);
	//not used - debug only
	define( 'WPSN_IML_REPORT_CRON_INTERVAL_10_SECONDS', "10 secondi");
	define( 'WPSN_IML_REPORT_CRON_INTERVAL_10_SECONDS_VALUE', 10);
	define( 'WPSN_IML_REPORT_CRON_INTERVAL_30_SECONDS', "30 secondi");
	define( 'WPSN_IML_REPORT_CRON_INTERVAL_30_SECONDS_VALUE', 30);
	define( 'WPSN_IML_REPORT_CRON_INTERVAL_60_SECONDS', "60 secondi");
	define( 'WPSN_IML_REPORT_CRON_INTERVAL_60_SECONDS_VALUE', 60);
	define( 'WPSN_IML_REPORT_CRON_INTERVAL_5_MINUTES', "5 minuti");
	define( 'WPSN_IML_REPORT_CRON_INTERVAL_5_MINUTES_VALUE', 300);

	require_once WPSN_IML_PLUGIN_DIR . '/includes/shortcodes.php';
	require_once WPSN_IML_PLUGIN_DIR . '/includes/ajax.php';
	//static classes
	require_once WPSN_IML_PLUGIN_DIR . '/includes/user.php';
	//widgets
	require_once WPSN_IML_PLUGIN_DIR . '/includes/widgets/user_data_loading.php';
	//utils
	require_once WPSN_IML_PLUGIN_DIR . '/includes/utils.php';

	class SocialNationItsMeLogin {
		function __construct() {
			$this->getAllOptions();
		}

		function getAllOptions(){
			$this->plugin_version = get_option("sn_iml_plugin_version");
			$this->enable_log = get_option("sn_iml_enable_log");
			$this->report_interval = get_option("sn_iml_report_interval");
			if(!$this->report_interval){
				$this->report_interval = WPSN_IML_REPORT_CRON_INTERVAL_MONTHLY_VALUE;
			}
			$this->last_report_date = get_option("sn_iml_last_report_date");
			if($this->last_report_date){
				$this->last_report_date_strong_with_timezone = SocialNationItsMeLoginUtils::convertDateToLocale(array(
					"dateTime" => $this->last_report_date,
					"useLocalTimeZone" => true,
					"printTimezone" => true
				));
			}
			$this->redirect_uri = get_option("sn_iml_redirect_uri");
			$this->client_secret = get_option("sn_iml_client_secret");
			$this->client_id = get_option("sn_iml_client_id");
			$this->test_mode = get_option("sn_iml_test_mode");
			//$this->button_layout = get_option("sn_iml_button_layout");
			$this->button_file_name = get_option("sn_iml_button_file_name");
			$this->total_subscriber = get_option("sn_iml_total_subscriber");
			//last list of uuid returned by userreport 
			$this->uuid_to_update = get_option("sn_iml_uuid_to_update");
			//last list of readable wp_users returned by userreport - a sort of cache
			$this->users_to_update = get_option("sn_iml_users_to_update");
			if($this->test_mode){
				$this->api_url = WPSN_IML_ITSME_API_URL_TEST;
			}
			else{
				$this->api_url = WPSN_IML_ITSME_API_URL;
			}

			if($this->test_mode){
				$this->itsme_login_url = WPSN_IML_ITSME_REQUEST_CODE_URL_TEST;
			}
			else{
				$this->itsme_login_url = WPSN_IML_ITSME_REQUEST_CODE_URL;
			}
		}

		function getRedirectUri(){
			return $this->redirect_uri."?".WPSN_IML_REDIRECT_URI_ACTION_AUTHENTICATED;
		}

		/**
			Check technical requirements before activating the plugin 
			
		*/
		function activate (){
			//here we can check if we have update the version
			//if(WPSN_IML_VERSION>$this->plugin_version)
			update_option (
				'sn_iml_plugin_version', 
				WPSN_IML_VERSION
			);
			if($this->redirect_uri===false){
				update_option (
					'sn_iml_redirect_uri', 
					site_url()."/"
				);	
			}
			if($this->report_interval===false){
				update_option (
					'sn_iml_report_interval', 
					WPSN_IML_REPORT_CRON_INTERVAL_MONTHLY_VALUE
				);
			}
			//if($this->button_layout===false){
			//	update_option (
			//		'sn_iml_button_layout', 
			//		WPSN_IML_BUTTON_LAYOUT_BUTTON_WITH_TEXT
			//	);
			//}
			if($this->button_file_name===false){
				$files = scandir(WPSN_IML_LOGIN_BUTTONS_IMAGE_DIR);
				$defaultButtonImageFile = "";
				foreach($files as $buttonImageFile){
					if($buttonImageFile=="."||$buttonImageFile=="..")
						continue;
					$defaultButtonImageFile = $buttonImageFile;
					break;
				}
				update_option (
					'sn_iml_button_file_name', 
					$defaultButtonImageFile
				);
				//$this->button_file_name = get_option("sn_iml_button_file_name");
			}

			if($this->last_report_date===false){
				//if last_report_date not setted we set it to now
				$lastReportDate = new DateTime();
				//$lastReportDate->modify("-2 month");
				update_option (
					'sn_iml_last_report_date', 
					$lastReportDate
				);
			}
			if ( ! file_exists( WPSN_IML_LOG_DIR_PATH ) ) {
			    wp_mkdir_p( WPSN_IML_LOG_DIR_PATH );
			}
		}

		/**
		 * Add Setup Link
		 **/
		function add_setup_link ($links){
			$settings_link = 
				'<a href="admin.php?page='.WPSN_IML_ADMIN_MENU_SLUG.'">' . 
					__('Settings') . 
				'</a>';
			array_unshift($links, $settings_link);

			return $links;
		}

		function sn_iml_process_login(){
			//first check for refresh user data
			$this->sn_iml_refresh_user_data();
			//oauth return with code
			$action = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : null;
			if( ! in_array( 
				$action, 
				array( 
					WPSN_IML_ACTION_AUTHENTICATE,
					WPSN_IML_ACTION_AUTHENTICATED
				) 
			) ){
				return false;
			}
			
			if($action==WPSN_IML_ACTION_AUTHENTICATE){
				$auth_code = $_GET["param"];
				$client_id = $this->client_id;
				$client_secret = $this->client_secret;
				$redirect_uri = (
					$this->addParamsToUri(array(
						"uri" => $this->redirect_uri,
						"params" =>WPSN_IML_REDIRECT_URI_ACTION_AUTHENTICATED
					))
				);

				if($this->enable_log)
					file_put_contents(
						WPSN_IML_LOG_FILE_PATH, 
						"\n".date("d-m-Y H:i:s")." ".
						WPSN_IML_REDIRECT_URI_ACTION_AUTHENTICATE." ".
						"mode=".($this->test_mode?"test":"prod")." ".
						"code=$auth_code name=$client_id "./*pwd=$client_secret ".*/
						"redirect_uri=$redirect_uri\n",
						FILE_APPEND
					);

				sn_iml_render_user_data_loading(array(
					"code" => $auth_code,
					"client_secret" => $client_secret,
					"client_id" => $client_id,
					"redirect_uri" => $redirect_uri,
				));
			}
			elseif($action==WPSN_IML_ACTION_AUTHENTICATED){
				$this->authenticated();
			}
			
		}

		/*
			Check if user data have to be refreshed
		*/
		function sn_iml_refresh_user_data(){
		}

		/*
			Just propagate the oauth response
		*/
		function authenticated(){
			/*
			$data = json_decode(
				file_get_contents('php://input'),
				true
			);
			*/
			$data = file_get_contents('php://input');
			if($this->enable_log)
				file_put_contents(
					WPSN_IML_LOG_FILE_PATH, 
					date("d-m-Y H:i:s").
					" ".WPSN_IML_REDIRECT_URI_ACTION_AUTHENTICATED." Access token received\n"
					//.var_export($data,true)."\n"
					,
					FILE_APPEND
				);
			echo $data;
			exit();
		}

		/**
		* create_menu function
		* generate the link to the options page under settings
		* @access public
		* @return void
		*/
		function create_menu() {
			add_options_page(
				WPSN_IML_ADMIN_PAGE_TITLE, 
				"<span class='socialNationItsmeLoginItsmeLogoSmall'>M</span>".WPSN_IML_ADMIN_MENU_TITLE, 
				'manage_options', 
				WPSN_IML_ADMIN_MENU_SLUG, 
				array($this,'options_page')
			);
		}

		/*
		* options_page function
		* generate the options page in the wordpress admin
		* @access public
		* @return void
		*/
		function options_page() { 
			$this->options_page_create_form();
		} // end of function options_page

		function options_page_create_form(){
			$imltab_uri_param="";
			$imltab="";
			if( isset( $_REQUEST["imltab"] ) ){
				$imltab = trim( strtolower( strip_tags( $_REQUEST["imltab"] ) ) );
				$imltab_uri_param = "&imltab=$imltab";
			}
			?>
			<div class="wrap social_nation_itsme_login">
				<?php 
					if (isset($_GET['savedata'])) {
						if($_GET['savedata']=="true"){
							echo '<div id="message" class="updated"><p>Settings saved</p></div>';
						}
						else {
							echo '<div id="message" class="error"><p>Error on saving</p></div>';
						}
					}
				?>
				<h1><span class="socialNationItsmeLoginItsmeLogo">M</span>Social Nation It'sMe Login</h1>
				<form 
					method="post" 
					id="social_nation_itsme_login_form" 
					action="options-general.php?page=<?php echo WPSN_IML_ADMIN_MENU_SLUG; ?>&savedata=true<?php echo $imltab_uri_param; ?>"
				>
					<input type="hidden" name="social_nation_itsme_login_form_hidden" value="1"/>
					<?php 
						wp_nonce_field( 
							'save_socialnationitsmelogin', 
							'_socialnationitsmelogin_nonce' 
						); 
					?>
					<h2 class="nav-tab-wrapper">
						<a 
							class="nav-tab <?php if( !$imltab || $imltab == WPSN_IML_ADMIN_TAB_GENERAL ) echo "nav-tab-active"; ?>" 
							style="" 
							href="options-general.php?page=<?php echo WPSN_IML_ADMIN_MENU_SLUG; ?>&imltab=<?php echo WPSN_IML_ADMIN_TAB_GENERAL; ?>"
						>
							General
						</a>
						<a 
							class="nav-tab <?php if( $imltab == WPSN_IML_ADMIN_TAB_REPORT ) echo "nav-tab-active"; ?>" 
							style="" 
							href="options-general.php?page=<?php echo WPSN_IML_ADMIN_MENU_SLUG; ?>&imltab=<?php echo WPSN_IML_ADMIN_TAB_REPORT; ?>"
						>
							Report
						</a>
					</h2>
					<?php
					if($imltab == WPSN_IML_ADMIN_TAB_REPORT){
						$this->options_page_report_tab();
					}
					else{
						$this->options_page_general_tab();
					}
					?>
					
					<p class="submit">
						<input 
							type="submit" 
							name="submit_sn_iml" 
							class="button-primary" 
							value="<?php _e('Save Changes') ?>" 
						/>
					</p>
				</form>
			</div>
			<?php
		}

		function options_page_general_tab(){
			wp_enqueue_script( 
				"social-nation-itsme-login-admin-general-settings", 
				WPSN_IML_PLUGIN_JS_URL."/SocialNationItsmeLoginAdminGeneralSettings.js", 
				array(), 
				WPSN_IML_VERSION,
				true
			);
			wp_localize_script( 
				'social-nation-itsme-login-admin-general-settings', 
				'SocialNationItsmeLoginAdminGeneralSettings', 
				array( 
					'action' => WPSN_IML_ACTION_AUTHENTICATED,
					'src' => WPSN_IML_LOGIN_BUTTONS_IMAGE_URL."/"
				) 
			);
			?>
			<table class="widefat">
				<thead>
					<tr>
						<th colspan="2">Impostazioni Generali</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="width:20%;">
							<small>
								OAuth Name
							</small>
						</td>
						<td style="width:80%;">
							<input 
								type="text" 
								name="sn_iml_client_id" 
								value="<?php echo $this->client_id; ?>" 
								style="width:99%;" 
							/>
						</td>
					</tr>
					<tr>
						<td style="width:20%;">
							<small>
								OAuth Key 
							</small>
						</td>
						<td style="width:80%;">
							<input 
								type="text" 
								name="sn_iml_client_secret" 
								value="<?php echo $this->client_secret; ?>" 
								style="width:99%;" 
							/>
						</td>
					</tr>
					<tr>
						<td style="padding-bottom:0" style="width:20%;">
							<small>
								Redirect URI (Token Url Notification)
							</small>
						</td>
						<td style="padding-bottom:0" style="width:80%;">
							<input 
								type="text" 
								name="sn_iml_redirect_uri" 
								value="<?php echo $this->check_output_file_name($this->redirect_uri, array("mode"=>"attr")); ?>" 
								style="width:99%;" 
								id="sn_iml_redirect_uri"
							/>
						</td>
					</tr>
					<tr>
						<td style="padding-top:0; background-color: #ddffdd" colspan="2" style="width:20%;">
							<small>
								Usa il seguente url come Redirect URI (Token Url Notification)
								del tuo Customer Service Account:
							</small>
							<div style="display: inline-block;" id="redirect_uri_text" >
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:20%;">
							<small>
								Test mode
							</small>
						</td>
						<td style="width:80%;">
							<input 
								type="checkbox" 
								name="sn_iml_test_mode" 
								<?php echo $this->test_mode?"checked":""; ?>
							/>
						</td>
					</tr>
					<tr>
						<td style="width:20%;">
							<small>
								Enable Log
							</small>
						</td>
						<td style="width:80%;">
							<input 
								type="checkbox" 
								name="sn_iml_enable_log" 
								<?php echo $this->enable_log?"checked":""; ?>
							/>
						</td>
					</tr>
					<tr>
						<td style="width:20%;">
							<small>
								Layout Bottone Login
							</small>
						</td>
						<td style="width:80%;">
							<div style="display:inline-block;">
								<select id="sn_iml_button_file_name" name="sn_iml_button_file_name">
									<?php
									$files = scandir(WPSN_IML_LOGIN_BUTTONS_IMAGE_DIR);
									foreach($files as $buttonImageFile){
										if($buttonImageFile=="."||$buttonImageFile=="..")
											continue;
									?>
										<option 
										<?php 
											echo 
												$this->button_file_name==$buttonImageFile?
												"selected":
												"" 
										?> 
											value="<?php echo $this->check_output_file_name($buttonImageFile, array("mode"=>"attr")); ?>"
										>
											<?php echo $this->check_output_file_name($buttonImageFile); ?>
										</option>
									<?php
									}
									?>									
								</select>
							</div>
							<div style="margin-left:10px;display:inline-block;">
								Anteprima:
							</div>
							<div style="display:inline-block;">
								<div id="sn_iml_login_button_container">
									<?php 
										$this->printItsmeLoginButton(array("button_layout"=>WPSN_IML_BUTTON_LAYOUT_BUTTON_ICON));
									?>
								</div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<?php
		}

		function options_page_report_tab(){
			$this->addReportUserScript();
			wp_enqueue_script( 
				"social-nation-itsme-login-admin-report-settings", 
				WPSN_IML_PLUGIN_JS_URL."/SocialNationItsmeLoginAdminReportSettings.js", 
				array(), 
				WPSN_IML_VERSION,
				true
			);
			?>
			<table class="widefat" id="iml_options_report_table">
				<thead>
					<tr>
						<th colspan="2">Impostazioni Report</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="width:20%;">
							<small>
								Report Interval
							</small>
						</td>
						<td style="width:80%;">
						<!--
							<input 
								type="text" 
								name="sn_iml_report_interval" 
								value="<?php echo $this->report_interval; ?>" 
								style="width:99%;" 
							/>
						-->
							<select id="sn_iml_report_interval" name="sn_iml_report_interval">
								<option 
									<?php echo $this->report_interval==WPSN_IML_REPORT_CRON_INTERVAL_MONTHLY_VALUE?"selected":"" ?> 
									value="<?php echo WPSN_IML_REPORT_CRON_INTERVAL_MONTHLY_VALUE; ?>"
								>
									<?php echo WPSN_IML_REPORT_CRON_INTERVAL_MONTHLY; ?>
								</option>
								<option 
									<?php echo $this->report_interval==WPSN_IML_REPORT_CRON_INTERVAL_WEEKLY_VALUE?"selected":"" ?> 
									value="<?php echo WPSN_IML_REPORT_CRON_INTERVAL_WEEKLY_VALUE; ?>"
								>
									<?php echo WPSN_IML_REPORT_CRON_INTERVAL_WEEKLY; ?>
								</option>
								<option 
									<?php echo $this->report_interval==WPSN_IML_REPORT_CRON_INTERVAL_DAILY_VALUE?"selected":"" ?> 
									value="<?php echo WPSN_IML_REPORT_CRON_INTERVAL_DAILY_VALUE; ?>"
								>
									<?php echo WPSN_IML_REPORT_CRON_INTERVAL_DAILY; ?>
								</option>
								<!--
								<option 
									<?php echo $this->report_interval==WPSN_IML_REPORT_CRON_INTERVAL_10_SECONDS_VALUE?"selected":"" ?> 
									value="<?php echo WPSN_IML_REPORT_CRON_INTERVAL_10_SECONDS_VALUE; ?>"
								>
									<?php echo WPSN_IML_REPORT_CRON_INTERVAL_10_SECONDS; ?>
								</option>	
								<option 
									<?php echo $this->report_interval==WPSN_IML_REPORT_CRON_INTERVAL_30_SECONDS_VALUE?"selected":"" ?> 
									value="<?php echo WPSN_IML_REPORT_CRON_INTERVAL_30_SECONDS_VALUE; ?>"
								>
									<?php echo WPSN_IML_REPORT_CRON_INTERVAL_30_SECONDS; ?>
								</option>	
								<option 
									<?php echo $this->report_interval==WPSN_IML_REPORT_CRON_INTERVAL_60_SECONDS_VALUE?"selected":"" ?> 
									value="<?php echo WPSN_IML_REPORT_CRON_INTERVAL_60_SECONDS_VALUE; ?>"
								>
									<?php echo WPSN_IML_REPORT_CRON_INTERVAL_60_SECONDS; ?>
								</option>	
								<option 
									<?php echo $this->report_interval==WPSN_IML_REPORT_CRON_INTERVAL_5_MINUTES_VALUE?"selected":"" ?> 
									value="<?php echo WPSN_IML_REPORT_CRON_INTERVAL_5_MINUTES_VALUE; ?>"
								>
									<?php echo WPSN_IML_REPORT_CRON_INTERVAL_5_MINUTES; ?>
								</option>	
								-->								
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="width:20%;">
							<small>
								Data ultimo report:
							</small>
							<small id="iml_last_report_date">
								<?php
									/*
									echo SocialNationItsMeLoginUtils::convertDateToLocale(array(
										"dateTime"=>$this->last_report_date
									));
									*/
									echo $this->last_report_date_strong_with_timezone;
								?>
							</small>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="width:20%;">
							<small>
								Sottoscrittori Totali:								
							</small> 
							<small id="iml_total_subscriber">
								<?php
									$total_subscriber = $this->total_subscriber;
									echo $total_subscriber;
								?>
							</small>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="width:20%;">
							<small>
								Sottoscrittori aggiornati nell'ultimo report: 						
							</small>
							<small id="iml_updated_subscriber_number_spinner">
							</small>
							<small id="iml_updated_subscriber_number">
								<?php
									$last_uuid_updated = $this->uuid_to_update;
									$num_updated = 0;
									if($last_uuid_updated && is_array($last_uuid_updated)){
										$num_updated = count($last_uuid_updated);
									}
									echo $num_updated;
								?>
							</small>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="checkbox" id="socialNationItsmeLoginReportLogCheckbox"/>
							<div 
								class="socialNationItsmeLoginReportShowHideLogWrapper"
							>
								<label 
									class="socialNationItsmeLoginReportShowHideLog socialNationItsmeLoginReportShowLog"
									for="socialNationItsmeLoginReportLogCheckbox"
								>
									<small>Mostra log ultimo report</small>
								</label >
								<label 
									class="socialNationItsmeLoginReportShowHideLog socialNationItsmeLoginReportHideLog"
									for="socialNationItsmeLoginReportLogCheckbox"
								>
									<small>Nascondi log ultimo report</small>
								</label >
								<div 
									id="socialNationItsmeLoginReportLogWarning"
									class="socialNationItsmeLoginReportLogWarning"
								>
									<div >
										<small>
										Si sono verificati degli errori, controlla il Log</small>
									</div>
									<div alt="f534" class="dashicons dashicons-warning"></div>
								</div>
								<div 
									id="socialNationItsmeLoginReportLogSuccess"
									class="socialNationItsmeLoginReportLogSuccess"
								>
									<div >
										<small>User report eseguito correttamente</small>
									</div>
									<span class="dashicons dashicons-yes"></span>
								</div>	
								<textarea 
									class="socialNationItsmeLoginReportBox" 
									id="iml_updated_subscriber_log" 
									class="debug-log-textarea" 
									autocomplete="off" 
									readonly=""
								><?php echo $this->check_output_textarea(get_option("sn_iml_user_report_log")); ?></textarea>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="width:20%;">
							<button type="button" id="socialNationItsmeLoginReportExecute">
								Esegui report manualmente
							</button> 
						</td>
					</tr>
				</tbody>
			</table>
			<?php
		}

		function options_page_save(){
			if ( !current_user_can('manage_options') ){ 
				wp_die( 'You do not have sufficient permissions to access this page.' ); 
			}

			check_admin_referer( 
				'save_socialnationitsmelogin', 
				'_socialnationitsmelogin_nonce'  
			);

			if ( ! file_exists( WPSN_IML_LOG_DIR_PATH ) ) {
			    wp_mkdir_p( WPSN_IML_LOG_DIR_PATH );
			}

			if(isset($_POST['sn_iml_client_secret'])){
				$sn_iml_client_secret = $this->check_input_text($_POST['sn_iml_client_secret']);
				update_option('sn_iml_client_secret', $sn_iml_client_secret);
			}
			if(isset($_POST['sn_iml_client_id'])){
				$sn_iml_client_id = $this->check_input_text($_POST['sn_iml_client_id']);
				update_option('sn_iml_client_id', $sn_iml_client_id);
			}
			if(isset($_POST['sn_iml_redirect_uri'])){
				$sn_iml_redirect_uri = $this->check_input_url($_POST['sn_iml_redirect_uri']);
				update_option('sn_iml_redirect_uri', $sn_iml_redirect_uri);
			}
			if(isset($_POST['sn_iml_report_interval'])){
				$sn_iml_report_interval = $this->check_input_text($_POST['sn_iml_report_interval']);
				update_option('sn_iml_report_interval', $sn_iml_report_interval);
			}
			//if checkbox $_POST['sn_iml_enable_log'] is setted then is checked
			//if not setted it is not checked
			if(isset($_POST['sn_iml_enable_log'])){
				$sn_iml_enable_log = $this->check_input_boolean($_POST['sn_iml_enable_log']);
				update_option('sn_iml_enable_log', $sn_iml_enable_log);
			}
			else{
				update_option('sn_iml_enable_log', 0);
			}
			if(isset($_POST['sn_iml_test_mode'])){
				$sn_iml_test_mode = $this->check_input_boolean($_POST['sn_iml_test_mode']);
				update_option('sn_iml_test_mode', $sn_iml_test_mode);
			}
			else{
				update_option('sn_iml_test_mode', 0);
			}
			//if(isset($_POST['sn_iml_button_layout'])){
			//	$sn_iml_button_layout = $_POST['sn_iml_button_layout'];
			//	update_option('sn_iml_button_layout', $sn_iml_button_layout);
			//}
			if(isset($_POST['sn_iml_button_file_name'])){
				$sn_iml_button_file_name = $this->check_input_file_name($_POST['sn_iml_button_file_name']);
				update_option('sn_iml_button_file_name', $sn_iml_button_file_name);
			}

			$this->getAllOptions();

			//delete_option('sn_iml_client_secret');
		}

		function addParamsToUri($options=array()){
			$uri = $options["uri"]?$options["uri"]:"";
			$params = $options["params"]?$options["params"]:"";
			$uri .= 
				( strpos($uri, '?')===false ? "?" : "&" ) . 
				$params;
			return $uri;
		}

		function printItsmeLoginButton($options=array()){
			$text = $options["text"]?$options["text"]:"";
			$href = $options["href"]?$options["href"]:"";
			//$img_url = isset($options["img_url"])?$options["img_url"]:false;
			$text_after = $options["text_after"]?$options["text_after"]:"";
			//$button_layout = isset($options["button_layout"])?$options["button_layout"]:$this->button_layout;
			$button_file_name = isset($options["button_file_name"])?$options["button_file_name"]:$this->button_file_name;

			/*if($img_url===false){
				if($button_file_name==WPSN_IML_BUTTON_LAYOUT_BUTTON_ICON){
					$img_url = WPSN_IML_LOGIN_BUTTON_ICON_IMAGE_URL;
				}
				else{
					$img_url = WPSN_IML_LOGIN_BUTTON_IMAGE_URL;
				}
			}*/
			/*
			if($button_file_name==WPSN_IML_BUTTON_LAYOUT_BUTTON_ICON){
				$img_class = "sn_iml_login_button_icon";
			}
			else{
				$img_class = "sn_iml_login_button";
			}
			*/
			?>
			<div class="sn_iml_login_button">
				<div class="sn_iml_login_button_text">
					<?php echo $this->check_output_text($text); ?>
				</div>
				<div class="sn_iml_login_button_img">
					<a 
						href="<?php echo $this->check_output_file_name($href, array("mode"=>"attr")); ?>" 
						class="sn_iml_login_button"
					>
						<img 
							src="<?php echo WPSN_IML_LOGIN_BUTTONS_IMAGE_URL."/".$this->check_output_file_name($button_file_name); ?>"
							class="sn_iml_login_button"
						/>
					</a>
				</div>
				<div class="sn_iml_login_button_text_after">
					<?php echo $this->check_output_text($text_after); ?>
				</div>
			</div>
			<?php
		}

		function load_scripts(){
			$version=WPSN_IML_VERSION;
			wp_enqueue_style( "social-nation-itsme-login", WPSN_IML_PLUGIN_CSS_URL."/social-nation-itsme-login.css", array(), $version);
		}
		function load_admin_scripts(){
			$version=WPSN_IML_VERSION;
			wp_enqueue_style( "social-nation-itsme-login-admin", WPSN_IML_PLUGIN_CSS_URL."/social-nation-itsme-login-admin.css", array(), $version);
		}

		function addReportUserScript(){
			$version=WPSN_IML_VERSION;
			$api_url = $this->api_url;
			$this->enqueue_api_scripts();
			wp_enqueue_script( 
				"social-nation-itsme-login-apiClient", 
				WPSN_IML_PLUGIN_JS_URL."/apiClient.js", 
				array('jquery'), 
				$version
			);
			wp_localize_script( 
				'social-nation-itsme-login-apiClient', 
				'SnImlApiClientData', 
				array( 
					'ajax_url' => admin_url('admin-ajax.php')
				) 
			);
			/*
			wp_enqueue_script( 
				"social-nation-itsme-login-sdk-axios-dist-axiosstandalone", 
				$api_url."/lib/axios/dist/axios.standalone.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-CryptoJS-rollups-hmacsha256", 
				$api_url."/lib/CryptoJS/rollups/hmac-sha256.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-CryptoJS-rollups-sha256", 
				$api_url."/lib/CryptoJS/rollups/sha256.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-CryptoJS-components-hmac", 
				$api_url."/lib/CryptoJS/components/hmac.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-CryptoJS-components-encbase64", 
				$api_url."/lib/CryptoJS/components/enc-base64.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-url-template-url-template", 
				$api_url."/lib/url-template/url-template.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-apiGatewayCore-sigV4Client", 
				$api_url."/lib/apiGatewayCore/sigV4Client.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-apiGatewayCore-apiGatewayClient", 
				$api_url."/lib/apiGatewayCore/apiGatewayClient.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-apiGatewayCore-simpleHttpClient", 
				$api_url."/lib/apiGatewayCore/simpleHttpClient.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-apiGatewayCore-utils", 
				$api_url."/lib/apiGatewayCore/utils.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-apigClient", 
				$api_url."/apigClient.js", 
				array(), 
				$version
			);
			*/
			
			wp_enqueue_script( 
				"social-nation-itsme-login-user-report", 
				WPSN_IML_PLUGIN_JS_URL."/SocialNationItsmeLoginCheckReport.js", 
				array("jquery"), 
				$version.time()
			);
			wp_localize_script( 
				'social-nation-itsme-login-user-report', 
				'socialNationItsmeAjax', 
				array( 
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'auth' => "Basic ".base64_encode($this->client_id.":".$this->client_secret)
				) 
			);			
		}

		function enqueue_api_scripts(){
			$version=WPSN_IML_VERSION;
			$api_url = $this->api_url;

			wp_enqueue_script( 
				"social-nation-itsme-login-sdk-axios-dist-axiosstandalone", 
				$api_url."/lib/axios/dist/axios.standalone.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-CryptoJS-rollups-hmacsha256", 
				$api_url."/lib/CryptoJS/rollups/hmac-sha256.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-CryptoJS-rollups-sha256", 
				$api_url."/lib/CryptoJS/rollups/sha256.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-CryptoJS-components-hmac", 
				$api_url."/lib/CryptoJS/components/hmac.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-CryptoJS-components-encbase64", 
				$api_url."/lib/CryptoJS/components/enc-base64.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-url-template-url-template", 
				$api_url."/lib/url-template/url-template.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-apiGatewayCore-sigV4Client", 
				$api_url."/lib/apiGatewayCore/sigV4Client.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-apiGatewayCore-apiGatewayClient", 
				$api_url."/lib/apiGatewayCore/apiGatewayClient.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-apiGatewayCore-simpleHttpClient", 
				$api_url."/lib/apiGatewayCore/simpleHttpClient.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-apiGatewayCore-utils", 
				$api_url."/lib/apiGatewayCore/utils.js", 
				array(), 
				$version
			);
		    wp_enqueue_script( 
				"social-nation-itsme-login-sdk-apigClient", 
				$api_url."/apigClient.js", 
				array(), 
				$version
			);
		}

		/*
			Manually manage cron job with two variables: interval, last_report_date (GMT timezone)
			Problem: 	Wordpress execute cron job asynchronously from the user http request, 
						so we cannot execute js client-side
		*/
		function checkCronJob(){
			//user report
			$interval = $this->report_interval;
			$last_report_date = $this->last_report_date;
			if($last_report_date===false)
				return;
			$last_report_date_time = $this->last_report_date->getTimestamp();
			$curr = new DateTime();
			$curr_time = $curr->getTimestamp();
			//$interval=10;
			if($this->enable_log) file_put_contents(
				WPSN_IML_LOG_FILE_PATH, 
				"\n".date("d-m-Y H:i:s")."  DEBIG DEBUG CRONJOB USER REPORT script added: ".
				"curr_time=".$curr_time." last_report_date_time=".$last_report_date_time." interval=".$interval."\n",
				FILE_APPEND
			);
			if($curr_time>=$last_report_date_time+$interval){
				//do
				$this->addReportUserScript();
				wp_enqueue_script( 
					"social-nation-itsme-login-execute-user-report", 
					WPSN_IML_PLUGIN_JS_URL."/SocialNationItsmeLoginExecuteReport.js", 
					array("jquery"), 
					WPSN_IML_VERSION.time()
				);
				if($this->enable_log) file_put_contents(
					WPSN_IML_LOG_FILE_PATH, 
					"\n".date("d-m-Y H:i:s")." CRONJOB USER REPORT script added: ".
					"interval=$interval sec. - last_report=".$last_report_date->format("d-m-Y H:i:s").
					" - current time=".$curr->format("d-m-Y H:i:s").".\n",
					FILE_APPEND
				);
				/* moved in ajax.php userReport
				update_option('sn_iml_last_report_date', $curr);
				$this->last_report_date = get_option('sn_iml_last_report_date');
				$this->last_report_date_strong_with_timezone = SocialNationItsMeLoginUtils::convertDateToLocale(array(
					"dateTime" => $this->last_report_date,
					"useLocalTimeZone" => true,
					"printTimezone" => true
				));
				*/
			}

			echo "";
		}

		//validate/sanitize/escape data functions, generally used before inserts into db
		function validate_text($value){
			return $value;
		}
		function validate_email($value){
			if(!is_email($value)){
				return "";
			}
			return $value;
		}
		function validate_url($value){
			return esc_url($value);
		}
		function validate_boolean($value){
			return filter_var($value, FILTER_VALIDATE_BOOLEAN);
		}
		function validate_file_name($value){
			return sanitize_file_name($value);
		}
		function validate_integer($value){
			return intval($value);
		}

		//sanitize data
		function sanitize_text($value){
			return sanitize_text_field($value);
		}
		function sanitize_email($value){
			return sanitize_email($value);
		}
		function sanitize_file_name($value){
			return sanitize_file_name($value);
		}

		//check input data generally used before insert into db
		function check_input_text($value){
			return $this->sanitize_text($value);
		}
		function check_input_email($value){
			return $this->validate_email($value);
		}
		function check_input_url($value){
			return $this->validate_url($value);
		}
		function check_input_boolean($value){
			return $this->validate_boolean($value);
		}
		function check_input_file_name($value){
			return $this->sanitize_file_name($value);
		}
		function check_input_integer($value){
			return $this->validate_integer($value);
		}
		function check_input_textarea($value){
			return esc_textarea($value);
		}

		//check output data generally used before display it
		function check_output_text($value, $options=array()){
			$mode = $options["mode"]?$options["mode"]:"html";

			if($mode=="js")
				return esc_js($value);
			else if($mode=="attr")
				return esc_attr($value);

			return esc_html($value);
		}
		function check_output_text_js($value){
			return esc_html($value, array("mode"=>"js"));
		}
		function check_output_text_attr($value){
			return esc_html($value, array("mode"=>"attr"));
		}
		function check_output_email($value){
			return $this->check_output_text($value);
		}
		function check_output_url($value){
			return esc_url($value);
		}
		function check_output_boolean($value){
			return $this->check_output_text($value);
		}
		function check_output_file_name($value){
			return $this->check_output_text($value);
		}
		function check_output_integer($value){
			return $this->check_output_text($value);
		}
		function check_output_textarea($value){
			return esc_textarea($value);
		}
	}	

	// instantiate
	$social_nation_itsme_login = new SocialNationItsMeLogin();

	if (isset($social_nation_itsme_login)) {

		register_activation_hook (
			__FILE__, 
			array($social_nation_itsme_login, 'activate')
		);

		//add setup link in plugin list
		add_filter (
			'plugin_action_links_'.plugin_basename(__FILE__), 
			array($social_nation_itsme_login, 'add_setup_link'), 
			10, 
			2
		);
		
		// create the menu
		add_action(
			'admin_menu', 
			array($social_nation_itsme_login,'create_menu')
		);

		add_action( 
			'init', 
			array($social_nation_itsme_login,'sn_iml_process_login' )
		);

		// if submitted, process the data
		if (isset($_POST['social_nation_itsme_login_form_hidden'])) {
			add_action(
				'admin_init', 
				array($social_nation_itsme_login,'options_page_save')
			);
		}

		//set report hook
		/*
		add_action(
			'admin_init', 
			array($social_nation_itsme_login,'checkCronJob')
		);
		*/
		//if(is_admin() && (!defined( 'DOING_AJAX' ) || !DOING_AJAX)){
			add_action(
				'init', 
				array($social_nation_itsme_login,'checkCronJob')
			);
		//}

		//Enqueue styles
		add_action( 'wp_enqueue_scripts', array( $social_nation_itsme_login, 'load_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $social_nation_itsme_login, 'load_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $social_nation_itsme_login, 'load_admin_scripts' ) );
	}
?>