<?php
/*
Plugin Name: SMDP Affiliate Platform
Plugin URI: https://soft-master.eu/smdp-afiliatte-platform-woo-wordpress-plugin/
Description: Plugin for woo adding referral links to products.
Author: Ilias Gomatos
Version: 1.4.8
Author URI: https://soft-master.eu/
Text Domain: smdp-affiliate-platform
Domain Path: /lang/
License: GPLv2
*/



if ( ! defined( 'ABSPATH' ) ) exit;




global $SMDPAP;

// Load plugin class files


require_once( 'includes/class-smdp-affiliate-platform.php' );
require_once( 'includes/class-smdp-affiliate-platform-settings.php' );
require_once plugin_dir_path( __FILE__ ) . 'includes/smdp-woo-invoice.php';
//require_once plugin_dir_path( __FILE__ ) . 'includes/class-smdp-partners.php';


// Load plugin libraries
require_once( 'includes/lib/class-smdp-affiliate-platform-admin-api.php' );
require_once( 'includes/lib/class-smdp-affiliate-platform-post-type.php' );
require_once( 'includes/lib/class-smdp-affiliate-platform-taxonomy.php' );

/**
 * Returns the main instance of smdp_Affiliate_platform to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object smdp_Affiliate_platform
 */
function smdp_Affiliate_platform () {
	$instance = smdp_Affiliate_platform::instance( __FILE__, '1.0.0' );

	if ( is_null( $instance->settings ) ) {
		$instance->settings = smdp_Affiliate_platform_Settings::instance( $instance );
	}

	return $instance;
}

//SPDP_Referrers_ls::get_instance();
$SMDPAP = smdp_Affiliate_platform();





    function smdp_create_plugin_database_table()
{
    global  $wpdb;
  //  wp_die('ddddddddddddddddddddddddddddddddddddddddddddddddddddddd');
    $wp_track_table = $wpdb->prefix  . 'sm_commissions_trans' ;
    //$version = get_option( 'smsudp_db_version', '1.0' );
    $smsudp_commtrans_db_version = '1.0.0';
    $charset_collate = $wpdb->get_charset_collate();
 
    
//    $query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $wp_track_table ) );
//
//if (  ! $wpdb->get_var( $query ) == $wp_track_table ) {
//   //do nothing
//} else
//{
    
    //C:\xamppb\htdocs\pluginfactory\wp-content\plugins\smsudp-affiliate-platform\includes\smsudp-woo-invoice.php
    
   if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) 
    {
 
        $sql = "CREATE TABLE $wp_track_table (
        `transaction_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        `blog_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
        `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
        `type` varchar(200)  NOT NULL,
        `amount` float NOT NULL,
        `balance` float NOT NULL,
        `currency` varchar(20) NOT NULL,
        `details` longtext,
        `created_by` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
        `deleted` tinyint(1) NOT NULL DEFAULT '0',
        `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
         PRIMARY KEY (transaction_id)
      )$charset_collate;";
     add_option( 'smsudp_db_version', '1.0' );   
        
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);
       add_option('smdp_commtrans_db_version', $smsudp_commtrans_db_version);
                
//                if ( version_compare( $version, '2.0' ) < 0 ) {
//                        $sql = "CREATE TABLE '$wp_track_table' (
//          transaction_id` bigint(20) UNSIGNED NOT NULL auto_increment,
//          `blog_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
//          `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
//          `type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
//          `amount` float NOT NULL,
//          `balance` float NOT NULL,
//          `currency` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
//          `details` longtext COLLATE utf8mb4_unicode_ci,
//          `created_by` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
//          `deleted` tinyint(1) NOT NULL DEFAULT '0',
//          `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
//           UNIQUE KEY  transaction_id (transaction_id)
//        ) $charset_collate;";
//		dbDelta( $sql );
//	
//	  	update_option( 'smdp_commtrans_db_version', '2.0' );
//		
//        } 

    }
}
 register_activation_hook( __FILE__, 'smdp_create_plugin_database_table' );
 

 
 
 
 function smdp__remove_database() {
     

       $smdps_smdp_clear_data = get_option( 'smdps_smdp_clear_data' );
 if(!isset($smdps_smdp_clear_data) || empty($smdps_smdp_clear_data)   ) { 
     return;
 } else {
     if ($smdps_smdp_clear_data <> 'on') {
     return; 
 }         }
     
     
     
     global $wpdb;
     $table_name = $wpdb->prefix  . 'sm_commissions_trans' ;
     $sql = "DROP TABLE IF EXISTS $table_name;";
     $wpdb->query($sql);
}
register_deactivation_hook( __FILE__, 'smdp__remove_database' );

