<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit();

//options
delete_option( 'sn_iml_enable_log' );
delete_option( 'sn_iml_report_interval' );
delete_option( 'sn_iml_redirect_uri' );
delete_option( 'sn_iml_client_secret' );
delete_option( 'sn_iml_client_id' );
delete_option( 'sn_iml_test_mode' );
//delete_option( 'sn_iml_button_layout' );
delete_option( 'sn_iml_button_file_name' );
delete_option( 'sn_iml_last_report_date' );
delete_option( 'sn_iml_total_subscriber' );
delete_option( 'sn_iml_uuid_to_update' );
delete_option( 'sn_iml_users_to_update' );				

//user meta
//delete all sn_iml_* usermeta... so risky
//delete sn_iml_identifier, sn_iml_at, sn_iml_rt

?>