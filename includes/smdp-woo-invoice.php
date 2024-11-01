<?php



if ( ! defined( 'ABSPATH' ) ) exit;



/**
* Below code save extra fields.
*/
function smdp_save_extra_register_fields( $customer_id ) {
    
    
      if(isset($_POST['smdp_usrcommission'])){
update_user_meta( $customer_id, 'smdp_usrcommission', sanitize_text_field($_POST['smdp_usrcommission']) );
}


}
add_action( 'woocommerce_created_customer', 'smdp_save_extra_register_fields' );


//**********************************************************************************************************************




// Fill the meta 'foo_privacy_policy' with the value of the checkbox
add_action( 'personal_options_update', 'smdp_privacy_policy_save' );
add_action( 'edit_user_profile_update', 'smdp_privacy_policy_save' );
add_action( 'user_register', 'smdp_privacy_policy_save' );
add_action( 'woocommerce_created_customer', 'smdp_privacy_policy_save', 12 );
function smdp_privacy_policy_save( $user_id ) {
    
    
           if ( ! empty( $_POST['smdp_usrcommission'] )  ) {
		update_user_meta( $user_id, 'smdp_usrcommission',  sanitize_text_field($_POST['smdp_usrcommission'])  );
	}
         
}


//************************************************************************************************************************************


function smdp_vregistration_form() {


        $smdp_usrcommission = ! empty( $_POST['smdp_usrcommission'] ) ?  sanitize_text_field($_POST['smdp_usrcommission'])  : '0';
        
        

}





add_action( 'woocommerce_save_account_details', 'smdp_woocommerce_save_account_details' );

function smdp_woocommerce_save_account_details( $user_id ) {
    
          if ( ! empty( $_POST['smdp_usrcommission'] ) ) {
update_user_meta( $user_id, 'smdp_usrcommission',  sanitize_text_field($_POST[ 'smdp_usrcommission' ])  );
    }
}


add_action( 'edit_user_created_user', 'smdp_vuser_register' );
add_action( 'woocommerce_created_customer', 'smdp_vuser_register' );
add_action( 'user_register', 'smdp_vuser_register' );
function smdp_vuser_register( $user_id ) {
    
                   if ( ! empty( $_POST['smdp_usrcommission'] ) ) {
		update_user_meta( $user_id, 'smdp_usrcommission', sanitize_text_field( $_POST['smdp_usrcommission'] ) );
	}
        
 
}

/**
 * Back end registration
 */

add_action( 'register_form', 'smdp_vadmin_registration_form' );
add_action( 'user_new_form', 'smdp_vadmin_registration_form' );
function smdp_vadmin_registration_form( $operation ) {
	if ( 'add-new-user' !== $operation ) {
		
		return;
	}

        $smdp_usrcommission = ! empty( $_POST['smdp_usrcommission'] ) ?  sanitize_text_field($_POST['smdp_usrcommission'])  : '0';
        
	
        
         ?>
        <table>

        
        <tr>
			<td></td>
			<td>
				<input type="text"
			       id="smdp_usrcommission"
			       name="smdp_usrcommission"
			       value="<?php echo esc_attr( $smdp_usrcommission ); ?>"
			       class="regular-text"
				/>
			</td>
		</tr>
        
        
        
        
        </table>
        </p>
        
         <br>
        
	<?php
}







add_action( 'woocommerce_edit_account_form', 'smdp_vshow_extra_profile_fields', 12 ); // my account

function smdp_vshow_extra_profile_fields( $user ) {

    
    $user_id = get_current_user_id();
    $smdp_usrcommission = get_the_author_meta( 'smdp_usrcommission', $user_id );
        

}





add_action( 'show_user_profile', 'smdp_vshow_extra_profile_fieldsb' );
add_action( 'edit_user_profile', 'smdp_vshow_extra_profile_fieldsb' );

function smdp_vshow_extra_profile_fieldsb( $user ) {
   

    $user_id = 0;  
    if ( isset($_GET['user_id']) && !empty($_GET['user_id'])  ) { 
  $user_id = $_GET['user_id'];  
    }
  if ( isset($user->ID) && !empty($user->ID)  ) { 
      
     $user_id = $user->ID; 
  }

    
	
         $smdp_usrrefid = get_the_author_meta( 'smdp_usrrefid', $user_id );
       if (!isset($smdp_usrrefid) || empty ($smdp_usrrefid)) {
            $smdp_usrrefid = get_user_meta(  $user_id, 'smdp_usrrefid' );
        }
    if (!isset($smdp_usrrefid) || empty ($smdp_usrrefid)) { 
      $smdp_usrrefid =  rand(100000,999999);
        
    }
  
  
  
        
        $smdp_usrcommission = get_the_author_meta( 'smdp_usrcommission', $user_id );
       
        if (!isset($smdp_usrcommission)) {
            $smdp_usrcommission = get_user_meta(  $user_id, 'smdp_usrcommission' );
        }
        

       // GET GENERAL PLUGIN VALUE - OPTION FOR COMMISSION  referrers
       if ( !isset($smdp_usrcommission) || empty($smdp_usrcommission)  ) {
            $smdp_usrcommission = get_option( 'smdps_smdp_commission' );
                
        }
        

	?>
        
        

        
	<h3><?php esc_html_e( 'Referral Data', 'smdp-affiliate-platform' ); ?></h3>

           <p>
        <table class="form-table">
         		<tr>
			
                            							<th>
		<label for="smdp_usrrefid"><?php esc_html_e( 'Referral ID', 'smdp-affiliate-platform' ); ?></label>
							</th>
                                                        <td>
			      <input type="text"
			       id="smdp_usrrefid"
                               size="6"
			       name="smdp_usrrefid"
			       value="<?php echo esc_attr( $smdp_usrrefid ); ?>"
			       class="regular-text"
                               readonly 
				/>
			</td>
		</tr>      
        		<tr>
			
                            							<th>
		<label for="smdp_usrcommission"><?php esc_html_e( 'Commission', 'smdp-affiliate-platform' ); ?></label>
							</th>
                                                        <td>
			      <input type="number"
			       id="smdp_usrcommission"
                               min="0"
                               max="100"
			       name="smdp_usrcommission"
			       value="<?php echo esc_attr( $smdp_usrcommission ); ?>"
			       class="regular-text"
				/>
			</td>
		</tr>
        
        </table>
        </p>
	<?php
}




//add_action( 'edit_user_created_user', 'smdp_vupdate_profile_fields' );
add_action( 'personal_options_update', 'smdp_vupdate_profile_fields' );
add_action( 'edit_user_profile_update', 'smdp_vupdate_profile_fields' );

function smdp_vupdate_profile_fields( $user_id ) {
	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

        
                if ( ! empty( $_POST['smdp_usrcommission'] )  ) {
		update_user_meta( $user_id, 'smdp_usrcommission', sanitize_text_field($_POST['smdp_usrcommission'])  );
	}
        
               if ( ! empty( $_POST['smdp_usrrefid'] )  ) {
		update_user_meta( $user_id, 'smdp_usrrefid', sanitize_text_field($_POST['smdp_usrrefid'])  );
	}
        

        
}



    
// 3. SAVE FIELDS
  
add_action( 'woocommerce_created_customer', 'smdp_dosave_name_fields' );
  
function smdp_dosave_name_fields( $customer_id ) {
    
    
              if ( isset( $_POST['smdp_usrcommission'] ) ) {
        update_user_meta( $customer_id, 'smdp_usrcommission', sanitize_text_field( $_POST['smdp_usrcommission'] ) );
    }
        
    

}


        

//---------------------------REFERRAL COMMISSION-------------------------------------------------------------------
 
// Add "Referral commission" custom field to Products option pricing
add_action( 'woocommerce_product_options_pricing', 'smdp_add_product_options_prd_commission' );
function smdp_add_product_options_prd_commission()
{
    woocommerce_wp_text_input( array(
        'id' => '_prd_commision',
        'class' => 'wc_prd_commision short',
        'label' => __( 'Referral Commission', 'smdp-affiliate-platform' ) . ' (%)',
        'type' => 'number',
        'custom_attributes' => array(
                'step' 	=> 'any',
                'min'	=> '-1')
    ));
          woocommerce_wp_text_input( array(
        'id' => '_prd_commision_descr',
        'class' => 'wc_prd_commision short',
        'label' => __( 'Commission Description', 'smdp-affiliate-platform' ) ,
        'type' => 'text'
    ))
        
        ;
}

// Add custom field to VARIATIONS option pricing
add_action( 'woocommerce_variation_options_pricing', 'smdp_add_variation_options_pricing_commission', 21, 3 );
function smdp_add_variation_options_pricing_commission( $loop, $variation_data, $post_variation )
{
    $value  = get_post_meta( $post_variation->ID, '_prd_commision', true );
    $symbol = ' (%)';
    $key = '_prd_commision[' . $loop . ']';

    echo '<div class="variable_prd_commision"><p class="form-row form-row-first">
        <label>' . __( "Commission", "smdp-affiliate-platform" ) . $symbol . '</label>
        <input type="text" size="5" name="' . $key .'" value="' . esc_attr( $value ) . '" />
    </p></div>';
    
     $value  = get_post_meta( $post_variation->ID, '_prd_commision_descr', true );
     $key = '_prd_commision_descr[' . $loop . ']';

    echo '<br><div class="variable_prd_commision_descr"><p class="form-row form-row-first">
        <label>' . __( "Commission Description", "smdp-affiliate-platform" ) .  '</label>
        <input type="text" size="255" name="' . $key .'" value="' . esc_attr( $value ) . '" />
    </p></div>';
    
    
}

// Save "Wholesale Price" custom field to Products
add_action( 'woocommerce_process_product_meta_simple', 'smdp_save_product_commission', 21, 1 );
function smdp_save_product_commission( $product_id ) {
    if( isset($_POST['_prd_commision']) )
        update_post_meta( $product_id, '_prd_commision', sanitize_text_field($_POST['_prd_commision']) );
    
    if( isset($_POST['_prd_commision_descr']) )
        update_post_meta( $product_id, '_prd_commision_descr', sanitize_text_field($_POST['_prd_commision_descr']) );
    
}

// Save "Wholesale Price" custom field to VARIATIONS
add_action( 'woocommerce_save_product_variation', 'smdp_save_product_variation_commission', 21, 2 );
function smdp_save_product_variation_commission( $variation_id, $i ){
    if ( isset( $_POST['_prd_commision'][$i] ) ) {
        update_post_meta( $variation_id, '_prd_commision', floatval(sanitize_text_field( $_POST['_prd_commision'][$i] )) );
    }
    
     if ( isset( $_POST['_prd_commision_descr'][$i] ) ) {
        update_post_meta( $variation_id, '_prd_commision_descr', sanitize_text_field( $_POST['_prd_commision_descr'][$i] ) );
    }
    
}



//----------------------------------------------------------------------------------------------------------------



        
        /** Executed on the product page only. */
add_action( 'woocommerce_after_add_to_cart_form', function () {


       //devplus 1-10-2020
$user_id = get_current_user_id();
       $fincommission = 0;
        $rreferral_id = get_user_meta( $user_id, 'smdp_usrrefid', true );
           if (!isset($rreferral_id) || empty ($rreferral_id)  || strlen($rreferral_id) < 6) { 
               return '';
           }
           
        $smdps_smdp_commission = get_user_meta( $user_id, 'smdp_usrcommission', true );
           if (!isset($smdps_smdp_commission) || empty ($smdps_smdp_commission) || $smdps_smdp_commission == 0) { 
              return '';
           }
        
           
 global $product;
           
           
           if ( $product->is_type( 'variable' ) ) {
           	$variations = $product->get_available_variations();
	$var_data = [];
        $productcommission = 0;
        $commissiondescr = '';
	foreach ($variations as $variation) {
		
       
                      $display_commision =   get_post_meta( $variation['variation_id'], '_prd_commision', true ) ;
                      $commissiondescr =   get_post_meta( $variation['variation_id'], '_prd_commision_descr', true ) ;
                      if (!isset($display_commision) || empty ($display_commision) || $display_commision == 0) { 
                      } else {
                           $productcommission = $display_commision;
                      }
			
		
	}
           
           } else {
           
                    $productcommission   = get_post_meta( get_the_ID(), '_prd_commision', true );
                    $commissiondescr   = get_post_meta( get_the_ID(), '_prd_commision_descr', true );
           
                 if (!isset($productcommission) || empty ($productcommission) || $productcommission == 0) { 
              
           }    
           }
                      
           //GET THE MIN
          if  ($smdps_smdp_commission < $productcommission ) {
              $fincommission = $smdps_smdp_commission;
          } else {
              $fincommission = $productcommission;
          }
          
          
//          $myssll = "https" ;
//         if (strpos(get_site_url(), 'https') !== false && strpos(get_site_url(), 'https') == 0) { 
//         } else {
//             $myssll = "http" ; 
//         }
          
          $current_urll=  esc_url($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); 
          //esc_url remove this: $myssll . "://" .
          $myerothmatiko = "?";
          if (strpos($current_urll, '?') !== false) {
    $myerothmatiko = "&";
}
          
          
          $myrefids = $myerothmatiko . 'ref_id='. $rreferral_id . '&plfrm_id=923_prd';
          
          
          
          
          
          if (strpos($current_urll, $myrefids) !== false       ) {
               $rreferral_link = $current_urll;
          } else
          {
               if (strpos($current_urll, 'plfrm_id=923') !== false       ) {
             $rreferral_link = $current_urll ; 
               } else {
                   
               } $rreferral_link = $current_urll   . $myrefids; 
   
          }
      

// Check if the custom field has a value.
if ( ! empty( $fincommission ) && $fincommission > 0) {
   $rreferral_link .=  '<br><strong>' .__( 'Referral commision: ', 'smdp-affiliate-platform' ) . '</strong> <strong> ' . $fincommission .'% </strong><br>'  ;
   echo '<p><strong>' .__( 'Your referral link: ', 'smdp-affiliate-platform' ) . '</strong> ' . $rreferral_link  ;
   echo  '<i>' . $commissiondescr .  '</i></p>'  ;
   
} else {
    return '';
}
        
        
    
   
    
   $smdp_cookie_duration = get_option( 'smdps_smdp_cookie_duration' );
 if(!isset($smdp_cookie_duration) || empty($smdp_cookie_duration)  || $smdp_cookie_duration == 0) { 
     $smdp_cookie_duration = 30;            
     
 }
    

    if(  strlen($rreferral_id) > 5  ) {                                             
                setcookie("plfrm_id", '"'. '923' . '"', time()+60*60*24*$smdp_cookie_duration, "/");      
					}
                                        
       $ppc = '';
        if (isset($_GET['ref_id'])) {
            $ppc = sanitize_text_field($_GET['ref_id']);
           if (isset($ppc) && strlen($ppc > 5)) {
           setcookie("ref_id", ''.$ppc . '', time()+60*60*24*$smdp_cookie_duration, "/"); }
          } else {
                if(  strlen($rreferral_id) > 5  ) {
          setcookie("ref_id", ''.$rreferral_id . '', time()+60*60*24*$smdp_cookie_duration, "/"); 
                }
                }
          
  
});

     

         function smdp_set_new_cookie() {
 
$smdp_cookie_duration = get_option( 'smdps_smdp_cookie_duration' );
 if(!isset($smdp_cookie_duration) || empty($smdp_cookie_duration)  || $smdp_cookie_duration == 0) { 
     $smdp_cookie_duration = 30;            //smdps_smdp_cc_email
 }

    
     $ppc = '';
        if (isset($_GET['ref_id'])) {
            $ppc = sanitize_text_field($_GET['ref_id']);
           if (isset($ppc) && strlen($ppc > 5)) {
           setcookie("plfrm_id", '"'. '923' . '"', time()+60*60*24* $smdp_cookie_duration, "/");  
           setcookie("ref_id", ''.$ppc . '', time()+60*60*24* $smdp_cookie_duration, "/"); }
          } 
    
    
}
add_action( 'init', 'smdp_set_new_cookie');
        
        
 
add_action( 'woocommerce_thankyou', 'smdp_add_content_thankyou' );
 
function smdp_add_content_thankyou($order_id) {
global $wpdb;
    $user_email = '';
     $commission_amount = 0;
     
     
        if (empty($order_id) || $order_id == 0 || $order_id == '') {
            
           $order_id = wc_get_order_id_by_order_key( sanitize_key($_GET['key']) );
            
        }
     
     
    // $order_id = wc_get_order_id_by_order_key( sanitize_key($_GET['key']) );
     
     if (empty($order_id) || $order_id == 0 || $order_id == '') {return;}
     
  // ASFALEIA *********************************************************************************************************************
  
   //SAFETY FOR DOUBLE INSERTING
   $table_name = $wpdb->base_prefix.'sm_commissions_trans';
   
   $myid =  $wpdb->get_var("SELECT transaction_id  FROM " . $table_name ." WHERE details like '%Order ID: " .  $order_id . "%';" ); 
   
   
   if (isset($myid) && $myid > 0 ) {
       return '';
   }
   //***********************************************************************************************************************************

     
     
     
     
     
     
     
     $plfrm_id = '';
     if(isset($_COOKIE['plfrm_id']) && !empty($_COOKIE['plfrm_id'])  ) { 
         $plfrm_id = htmlspecialchars($_COOKIE['plfrm_id']) ;
     }
     $ref_id = '';
     if(isset($_COOKIE['ref_id']) && !empty($_COOKIE['ref_id'])  ) { 
         $ref_id = htmlspecialchars($_COOKIE['ref_id']) ;
     }
     
     //--------------------------------------------------------------------------------------------------
    //IF REF ID EXISTS GET USER END HIS COMMISSION
     
     if ((strpos($plfrm_id, '923') !== false) && strlen($ref_id) > 5){
                    
       $args = array(
           'meta_query' => array(
               array(
                   'key' => 'smdp_usrrefid',
                   'value' => $ref_id,
                   'compare' => 'like'
               )
           )
       );
       $member_arr = get_users($args);
       if ($member_arr) {
         foreach ($member_arr as $user) {
           $user_id = $user->ID;
           
           $user_info = get_userdata($user_id);
           if (is_email($user_info->user_email)) {
           $user_email = $user_info->user_email;
           }
           
            $user_name = $user->display_name;
            
         }
       } else {
           return '';
        // echo 'no users found';
       }
     
     
       
       
       $smdp_usrcommission = get_user_meta( $user_id, 'smdp_usrcommission', true );
       
          $sumcommission = 0; 
          $masouriorderitems = '';
         
          
       if (isset($smdp_usrcommission) && $smdp_usrcommission > -1) {


     //GET ORDER OBJECT AND ITS DATA ---------------------------------------------------------------
           
          
     $order = wc_get_order( $order_id );
     if ( $order ) {

   
  
   // Get and Loop Over Order Items
foreach ( $order->get_items() as $item_id => $item ) {
   $product_id = $item->get_product_id();
   $variation_id = $item->get_variation_id();
   
   if (isset($variation_id) && $variation_id > 0) {
      $productcommission   = get_post_meta( $variation_id, '_prd_commision', true );
   } elseif (isset($product_id) && $product_id > 0) {
         $productcommission   = get_post_meta( $product_id, '_prd_commision', true );
   } else {
       $productcommission   =  0;
   }
   
   //get min value
   if ($smdp_usrcommission < $productcommission) {
       $productcommission = $smdp_usrcommission;
   }
   
   
 $quantity = 1;
  $subtotal = $item->get_subtotal();


  
  if (empty($quantity)) {$quantity = 1;}
  if (empty($subtotal)) {$subtotal = 0;}
   
   $myearncommision = $quantity *  $subtotal * $productcommission / 100;
   
   if (isset($myearncommision) && $myearncommision > 0) {
       
      $match_order_meta = wc_get_order_item_meta( $item_id, '_smdp_referrer');
      if (!isset($match_order_meta) || empty($match_order_meta)) {
   wc_add_order_item_meta( $item_id, '_smdp_referrer', $ref_id );
      }
      
       $match_order_meta = wc_get_order_item_meta( $item_id, '_smdp_commission');
     if (!isset($match_order_meta) || empty($match_order_meta)) {
            wc_add_order_item_meta( $item_id, '_smdp_commission', $myearncommision );
      }
 
   
    $sumcommission += $myearncommision;
    $orderitemname = $item->get_name();
    $masouriorderitems .= $orderitemname . ' , ';
   }
    
}
   

   
      }
      }
   //----------------------------------------------------------------------------------------------
   
}
     
     
if ($sumcommission == 0) {return '';}
     
     //-----------------------------------------------------------------------------------------------
     
    $smdps_smdp_from_email = get_option( 'smdps_smdp_from_email' );
 if(!isset($smdps_smdp_from_email) || empty($smdps_smdp_from_email)  || !is_email($smdps_smdp_from_email) ) { 
     $smdps_smdp_from_email = 'noreply@' . $_SERVER['SERVER_NAME']  ;            //
 } 


    $smdps_smdp_cc_email = get_option( 'smdps_smdp_cc_email' );
 if(!isset($smdps_smdp_cc_email) || empty($smdps_smdp_cc_email)  || !is_email($smdps_smdp_cc_email) ) { 
     $smdps_smdp_cc_email = '';            //
 } 
     $smdps_smdp_bcc_email = get_option( 'smdps_smdp_bcc_email' );
 if(!isset($smdps_smdp_bcc_email) || empty($smdps_smdp_bcc_email)  || !is_email($smdps_smdp_bcc_email) ) { 
     $smdps_smdp_bcc_email = '';            //
 } 
 
//email to parthner
$to = $user_email;

$subject = 'You have earned Commission from product selling';
$message = 'Congratulations ' . $user_name .', you earned the value ' . $sumcommission . ' from selling ' . $masouriorderitems  . ' products. Order ID: ' . $order_id  ;
//$headers[] = array('Content-Type: text/html; charset=UTF-8');



if (is_email($smdps_smdp_from_email)) {
$headers[] = 'From: ' . $_SERVER['SERVER_NAME']. ' <'.$smdps_smdp_from_email.'>';
}
//$headers[] = 'From: Hyperion.club <info@hypermall.club>';
if (is_email($smdps_smdp_cc_email)) {
$headers[] = 'Cc:   <'.$smdps_smdp_cc_email.'>';
}
//$headers[] = 'Cc: Production Department <develop@yperad.gr>';
if (is_email($smdps_smdp_bcc_email)) {
$headers[] = 'Bcc:   <'.$smdps_smdp_bcc_email.'>';
}


wp_mail( $to, $subject, $message , $headers);
    

//email to admin
$to = get_bloginfo('admin_email');
if (isset($to) && !empty($to) && is_email($to) ) {
$subject = 'Partner was given a commission because he sold products';
$message = 'The partner with name ' . $user_name .' and referral ID: ' . $ref_id . ', earned the value ' . $sumcommission . ' from selling ' . $masouriorderitems  . ' products. Order ID: ' . $order_id  ;

if (is_email($smdps_smdp_from_email)) {
$headersb[] = 'From: ' . $_SERVER['SERVER_NAME']. ' <'.$smdps_smdp_from_email.'>';
}

if (is_email($smdps_smdp_cc_email)) {
$headersb[] = 'Cc:   <'.$smdps_smdp_cc_email.'>';
}

if (is_email($smdps_smdp_bcc_email)) {
$headersb[] = 'Bcc:   <'.$smdps_smdp_bcc_email.'>';
}

wp_mail( $to, $subject, $message , $headersb);
}



// UPDATE MY COMMISISION TABLE ON DATABASE ************************************************************************************************************

$table_name = $wpdb->base_prefix.'sm_commissions_trans';
      if($wpdb->get_var( "show tables like '$table_name'" ) == $table_name) 
    {
        //********************************************************************
        //  $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('15.  $user_id')";
        //  $mmyreq = $wpdb->query($ssql);
        //************************************************************************************
          
   $details = 'Earned from selling ' . $masouriorderitems  . ' products. Order ID: ' . $order_id  ;
    
   $balance = 0;
   
   $tmpp =  $wpdb->get_var("SELECT balance FROM " . $table_name ." WHERE deleted = 0 and user_id = $user_id ORDER BY transaction_id DESC;"); 
   if (isset($tmpp) && $tmpp > 0) {
       $balance = $tmpp;
   }
   
   $balance += $sumcommission;
   
    $wpdb->insert($table_name, array(
    'blog_id' => '1',
    'user_id' => $user_id,
    'type' => 'credit', 
    'amount' =>  $sumcommission , 
    'balance' =>   $balance, 
    'currency' => 'EUR', 
    'details' =>  sanitize_textarea_field($details) , 
    'created_by' => $user_id, 
    'deleted' => '0', 
    'date' => current_time('mysql') 
));
    
    $transaction_id = $wpdb->insert_id;
  //  if ($transaction_id > 0) {
      //  update_user_meta($user_id, '_current_woo_wallet_balance', $balance); 
      //  delete_transient("woo_wallet_transaction_resualts_{$user_id}");
      //   do_action( 'woo_wallet_transaction_recorded', $transaction_id, $user_id, $sumcommission, 'credit');
  //  }
    
   

 
 //------------------------gggg-----------END OF woo_wallet INTERGRATION -------20/10/2020  3  --------   -------------------------------------------------------------------------

    
}
    
    
    
    

 







//***************************************************************************************************************************************

//-------------------------woo_wallet INTERGRATION -------12/10/2020--------------------------------------------------------------

$smdp_terawallet_integration = get_option( 'smdps_smdp_terawallet_integration' );

if(isset($smdp_terawallet_integration) && !empty($smdp_terawallet_integration)  && $smdp_terawallet_integration == 'on') { 
global $wpdb;
$table_name = $wpdb->base_prefix.'woo_wallet_transactions';
$query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );

if ( ! $wpdb->get_var( $query ) == $table_name ) {
   //do nothing
} else
{
    
   $details = 'Earned from selling ' . $masouriorderitems  . ' products. Order ID: ' . $order_id  ;
    
   $balance = 0;
   $balance =  $wpdb->get_var("SELECT balance FROM " . $table_name ." WHERE user_id = $user_id ORDER BY transaction_id DESC;"); 
   $balance += $sumcommission;
   
    $wpdb->insert($table_name, array(
    'blog_id' => '1',
    'user_id' => $user_id,
    'type' => 'credit', 
    'amount' =>  $sumcommission , 
    'balance' =>   $balance, 
    'currency' => 'EUR', 
    'details' =>  sanitize_textarea_field($details) , 
    'created_by' => $user_id, 
    'deleted' => '0', 
    'date' => current_time('mysql') 
));
    
    $transaction_id = $wpdb->insert_id;
    if ($transaction_id > 0) {
        update_user_meta($user_id, '_current_woo_wallet_balance', $balance); 
        delete_transient("woo_wallet_transaction_resualts_{$user_id}");
         do_action( 'woo_wallet_transaction_recorded', $transaction_id, $user_id, $sumcommission, 'credit');
    }
    
   
}
 } 
 //------------------------gggg-----------END OF woo_wallet INTERGRATION -------20/10/2020  3  --------   -------------------------------------------------------------------------
}


if ( ! function_exists( 'smdp_get_commissions_uers_grid_func' ) ) {
function smdp_get_commissions_uers_grid_func($atts, $context = 'view' ){
    $output  = "";
    extract(shortcode_atts( array('id' => '', 'start_date' => '2000-01-01', 'end_date' => '2099-01-01'), $atts));

        if( current_user_can('administrator') ) {  
            $start_daten = $start_date;
            $end_daten = $end_date;
            
       if (isset($_POST['start_date'])  && strlen($_POST['start_date']) > 7) {
           $start_daten = sanitize_text_field($_POST['start_date']);
       }
       
       if (isset($_POST['end_date'])  && strlen($_POST['end_date']) > 7) {
           $end_daten = sanitize_text_field($_POST['end_date']);
       }
       
       
       
        if( current_user_can('administrator') ) {  
              
        $output .= ' <br><h2>Refferal Commissions</h2><br>' . "\n";   
        $output .= '<form method="post" action="" enctype="multipart/form-data">' . "\n";
        $output .= '<label for="start_date">Start Date (yyyy-mm-dd):</label>' . "\n";
        $output .= '<input type="text" id="start_date" name="start_date" value="'. $start_daten .'">' . "\n";
        $output .= '<label for="end_date">End Date (yyyy-mm-dd):</label>' . "\n";
        $output .= '<input type="text" id="end_date" name="end_date" value="'. $end_daten .'">' . "\n";
        $output .= '<input type="submit" name="Search" class="button-primary" value="' . esc_attr( __( 'Search' , 'smdp-affiliate-platform' ) ) .'" /><br>' . "\n";

                        //referrres list---------START------------------------------------------------------------------
                        $args = array(
                         'meta_query' => array(
                             'relation' => 'AND', // Could be OR, default is AND
                                 array(
                                     'key'     => 'smdp_usrrefid',
                                     'value'   => '100000',
                                     'compare' => '>='
                                 ),
                                 array(
                                     'key'     => 'smdp_usrcommission',
                                     'value'   => '0',
                                     'compare' => '>='
                                 )
                         )
                        );
 
$user_query = new WP_User_Query( $args );

if ( ! empty( $user_query->get_results() ) ) {
    
        $output .= ' <br>
	<table class="smdp-table">
	<thead><tr>
	<th scope="col">'.__('Name', 'smdp-affiliate-platform').'</th>
	<th scope="col">'.__('Referral ID', 'smdp-affiliate-platform').'</th>
	<th scope="col" style="text-align:right; padding-right:10px">'.__('Earnings', 'smdp-affiliate-platform').'</th>
	</tr></thead>
	<tbody>';
    
        //<th scope="col"  style="text-align:center;">'.__('Commission(%)', 'smdp-affiliate-platform').'</th>
	foreach ( $user_query->get_results() as $user ) {
            
        $output .=  '<tr>'  ;
	$output .=  '<td>' . $user->display_name . '</td>' ;
        $myrefid = get_user_meta( $user->ID, 'smdp_usrrefid', true );
        $output .=  '<td>' . $myrefid . '</td>' ;
        $mycommission = get_user_meta( $user->ID, 'smdp_usrcommission', true );
        
        
      //  $output .=  '<td style="text-align:center;">' . $mycommission . '%</td>' ;
       

  $args = array(
      'limit' => - 1,
      'status' => ['processing','completed','on-hold']
);
  $orderss = wc_get_orders( $args );
  
 
 $myssum = 0;
 foreach( $orderss as $order ) {
     $order_date =   $order->get_date_created();
     if (strlen($order_date) > 10  ) {
        $order_date = substr($order_date, 0, 10); 
     }
     
    if ($order_date >= $start_daten && $order_date <= $end_daten  )  {
     
   // Get and Loop Over Order Items
foreach ( $order->get_items() as $item_id => $item ) {
        
      $smdp_referrerb = wc_get_order_item_meta( $item_id, '_smdp_referrer');
      
      
      
      if (!isset($smdp_referrerb) || empty($smdp_referrerb)) {
  // wc_add_order_item_meta( $item_id, '_smdp_referrer', $ref_id );
      } else {
          if ($smdp_referrerb == $myrefid) {
              
                   $smdp_commissionb = wc_get_order_item_meta( $item_id, '_smdp_commission');
                    if (isset($smdp_commissionb) && !empty($smdp_commissionb) && $smdp_commissionb > 0) {
                        
                      //  echo ' nnnnn  '. $smdp_referrerb . ' bbbbbbbbbbbb  ' . $item_id  . ' ccccccccccc  ';
                        
                  $myssum += $smdp_commissionb;
      }  
              
          }
      }
      
}
 }
      }
               
     $output .=  '<td style="text-align:right; padding-right:10px">' . number_format($myssum, 2, '.', '')   .  '</td>' ;
     $output .=  '</tr>'  ;
        
     //------------------------------------END INIT EARNINGS------------------------------------------------------------------------------------------               
	}
             $output .=  '</table>'  ;
} else {
    
	$output .=  'No enabled users with commissions found.';
           
}

  $output .= '</form>' . "\n";  
  }            
    //referrres list-------END--------------------------------------------------------------
                                        
  
        }
	return  $output  ;	

}}

add_shortcode('smdp_get_commissions_uers_grid', 'smdp_get_commissions_uers_grid_func');


//add refferal id and default commission amount for new user
if ( ! function_exists( 'smdp_registration_save_func' ) ) {
function smdp_registration_save_func( $user_id ) {
 
    $smdp_usrrefid = get_user_meta(  $user_id, 'smdp_usrrefid' );
        
    if (!isset($smdp_usrrefid) || empty ($smdp_usrrefid)) { 
        //set refid
        $smdp_usrrefid =  rand(100000,999999);
         update_user_meta( $user_id, 'smdp_usrrefid', $smdp_usrrefid  );
         
         //set user default commission
         // GET GENERAL PLUGIN VALUE - OPTION FOR COMMISSION  referrers
         $smdp_commission = get_option( 'smdps_smdp_commission' );
                
         if (!isset($smdp_commission) || empty ($smdp_commission)) {
             $smdp_commission = 80;
         }
         update_user_meta( $user_id, 'smdp_usrcommission', $smdp_commission  );
        
    }
    
        
     //  update_user_meta($user_id, 'first_name', $_POST['first_name']);
 
}}
add_action( 'user_register', 'smdp_registration_save_func', 10, 1 );







function smdp_woocommerce_payment_complete( $order_id ) {
    smdp_init_commission($order_id);
}
add_action( 'woocommerce_thankyou', 'smdp_woocommerce_payment_complete' );
add_action( 'woocommerce_payment_complete', 'smdp_woocommerce_payment_complete', 10, 1 );
add_action( 'woocommerce_order_status_completed', 'smdp_woocommerce_payment_complete', 10, 1);





function smdp_init_commission($order_id) {

    $user_email = '';
     $commission_amount = 0;
        $sumtotal = 0 ;
    $sumcommission = 0;
      $masouriorderitems ='';
      global $wpdb;
    
           //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('1A $order_id')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************
    
     
     //$order_id = wc_get_order_id_by_order_key( sanitize_key($_GET['key']) );
   //  $order = wc_get_order( $order_id );
     if ($order_id == 0 || $order_id == '') {return;}
     
  // ASFALEIA *********************************************************************************************************************
  
   //SAFETY FOR DOUBLE INSERTING
   $table_name = $wpdb->base_prefix.'sm_commissions_trans';
   $myid =  $wpdb->get_var("SELECT transaction_id  FROM " . $table_name ." WHERE details like '%Order ID: " .  $order_id . "%';" ); 
   if (isset($myid) && $myid > 0 ) {
       return '';
   }
   //***********************************************************************************************************************************

    //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('1B $table_name')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************
    
   
   
           $order = wc_get_order($order_id);
     
    $refferer_ref_id  = ''; 
    $refferer_wpid = 0;  
    $exosoc = false;       
           
   $exocoupon = false ;
   $coupon_amount = 0;
   $discount_type = 0;
   $taxtotal = 0;
   $ship_total  = 0;
   $mycouponcost = 0;
     $order_discount_amount = 0;
     $order_discount_tax_amount = 0;
   
   
   
   
          //tsekaro an exo kouponi ****************devplus 8-1-2021************************************************************************
 //  $coupon_code = 'NOCOUPON';
   foreach( $order->get_coupon_codes() as $coupon_code ) {
    // Get the WC_Coupon object
     //  SOCCER και UNIVERSITY
       
                  //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('1zzzz $coupon_code')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************
       
       
//       if (1 == 2) {
//          $exosoc = true; 
//          $coupon = new WC_Coupon($coupon_code);
//          $discount_type = $coupon->get_discount_type(); 
//          $coupon_amount = $coupon->get_amount();
//       }

}
   
// if ($exosoc  &&  $refferer_wpid == 0) {
//     $mmyuser = get_user_by( 'email', 'yoursocceruniversity@gmail.com' );
//    $refferer_wpid = $mmyuser->ID;
// }
   
    //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('1zzz. $refferer_wpid')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************
   
   
   
   
   
       
   if ($exosoc == false  ||  $refferer_wpid == 0) {
       
     if(isset($_COOKIE['ref_id']) && !empty($_COOKIE['ref_id'])  ) { 
         $refferer_ref_id = htmlspecialchars($_COOKIE['ref_id']) ;
        $sql = "SELECT * FROM  wp_usermeta WHERE meta_key = 'smdp_usrrefid' and meta_value = '$refferer_ref_id' ;";
         $myrefrow = $wpdb->get_row($sql); 
         if (isset ($myrefrow)) {
             $refferer_wpid = $myrefrow->user_id;
         }
     } 

     if ($refferer_wpid > 0) {
         //yoursocceruniversity@gmail.com <yoursocceruniversity@gmail.com>;
     $user_info = get_userdata($refferer_wpid);
    //   if ($user_info->user_login == 'yoursocceruniversity' && $user_info->user_email == 'yoursocceruniversity@gmail.com') ;
      $exosoc = true;
     }
   }
          
     
   if ($exosoc == false) {
       return '';
   }
   
   
   
   
   
   


           //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('2.  $refferer_wpid')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************
 
 
 //if ($refferer_wpid == 0) {return;}
 
$refferer_ref_id = get_user_meta( $refferer_wpid, 'smdp_usrrefid', true );
$ref_id = $refferer_ref_id;
$smdp_usrcommission = get_user_meta( $refferer_wpid, 'smdp_usrcommission', true );

           //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('2.  $refferer_ref_id')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************
  
            //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('82dsdsd.  $smdp_usrcommission')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************
           
           
   //*******************************************************************************************************************
   $customer_id = $order->get_user_id();
/*
   
    $parentuserid = 0;
    if ($customer_id > 0) {
        $smdp_customerrefid = get_user_meta( $customer_id, 'smdp_usrrefid', true );
        $smdp_parentrefid  = get_user_meta( $customer_id, 'smdp_parentrefid', true );
    
        if (isset ($smdp_parentrefid) && strlen($smdp_parentrefid) == 6 ) { 
        //get parent id     
        $sql = "SELECT * FROM  wp_usermeta WHERE meta_key = 'smdp_usrrefid' and meta_value = '$smdp_parentrefid' ;";
         $myrefrow = $wpdb->get_row($sql); 
         if (isset ($myrefrow)) {
             $parentuserid = $myrefrow->user_id;
         }
        }
    } else {
        
            $ref_id = '';
     if(isset($_COOKIE['ref_id']) && !empty($_COOKIE['ref_id'])  ) { 
         $ref_id = htmlspecialchars($_COOKIE['ref_id']) ;
     } 
     
     $smdp_parentrefid = $ref_id ;
        $sql = "SELECT * FROM  wp_usermeta WHERE meta_key = 'smdp_usrrefid' and meta_value = '$smdp_parentrefid' ;";
         $myrefrow = $wpdb->get_row($sql); 
         if (isset ($myrefrow)) {
             $parentuserid = $myrefrow->user_id;
         }
    }
    
    
   
    
    
    
    
    
    //**************tha ELEGXO GIA PROTH PARAGELIA**********************************************************************************************************************
        $parentflag = 1;
        $parentstring = '(parent)';
        if (strlen($refferer_ref_id) == 6  && $refferer_wpid > 0) {  
            $ref_id = $refferer_ref_id; 
            $parentuserid = $refferer_wpid;
            $parentflag = 0;
            $parantstring = '';
        }
   //************************************************************************************************************************************************************* 
    
    if ($parentuserid < 1) {
        $parentuserid == 19;
    }
    $commission_amount = 0;
     $sql = "SELECT * FROM  wp_wcfm_marketplace_orders WHERE (((order_id)=$order_id));";
     $myrefrow = $wpdb->get_row($sql); 
     if (isset ($myrefrow)) {
     
         $commission_amount = $myrefrow->commission_amount ;
     }
     
  */
     
     if (1 == 1  ) { 
         
           $parent_user_info = get_userdata($refferer_wpid);
           
           
           
           
           if (is_email($parent_user_info->user_email)) {
           $parent_user_email = $parent_user_info->user_email;
           }
           $parent_user_name = $parent_user_info->user_login;
             
           if ($customer_id > 0 ) 
               {
           $customer_user_info = get_userdata($customer_id);
           if (is_email($customer_user_info->user_email)) {
           $customer_user_email = $customer_user_info->user_email;
           }
           $customer_user_name = $customer_user_info->user_login;
            } else {
                $customer_user_email = $order->get_billing_email();
                $customer_user_name =  $order->get_billing_last_name();
            }
            
           //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('4.  $parent_user_email')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************
            
            //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('5.  $customer_user_email')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************
           
  foreach( $order->get_items('tax') as $taxitem ){
//    $name        = $item->get_name(); // Get rate code name (item title)
//    $rate_code   = $item->get_rate_code(); // Get rate code
//    $rate_label  = $item->get_label(); // Get label
//    $rate_id     = $item->get_rate_id(); // Get rate Id
//    $tax_total   = $item->get_tax_total(); // Get tax total amount (for this rate)
//    $ship_total  = $item->get_shipping_tax_total(); // Get shipping tax total amount (for this rate)
//    $is_compound = $item->is_compound(); // check if is compound (conditional)
//    $compound    = $item->get_compound(); // Get compound
      $myvvvall = $taxitem->get_tax_total();
        if (isset($myvvvall)  &&  $myvvvall > 0 ) {
  $taxtotal += $taxitem->get_tax_total();
  
  $ship_total  += $taxitem->get_shipping_tax_total();
  }
      
      
}        
           
           
           
  
   // Get and Loop Over Order Items
foreach ( $order->get_items() as $item_id => $item ) {
   $product_id = $item->get_product_id();
   $variation_id = $item->get_variation_id();
   
   if (isset($variation_id) && $variation_id > 0) {
      $productcommission   = get_post_meta( $variation_id, '_prd_commision', true );
   } elseif (isset($product_id) && $product_id > 0) {
         $productcommission   = get_post_meta( $product_id, '_prd_commision', true );
   } else {
       $productcommission   =  0;
   }
   
   
//           $order_discount_amount += wc_get_order_item_meta( $item_id, 'discount_amount', true );
//        $order_discount_tax_amount += wc_get_order_item_meta( $item_id, 'discount_amount_tax', true );
//   
   
   
   
      //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('7.  $productcommission')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************
           
   
   
   
   //get min value
   if ($smdp_usrcommission < $productcommission) {
       $productcommission = $smdp_usrcommission;
   }
   
   
  $quantity = 1;
  $subtotal = $item->get_subtotal();
  

  
  if (empty($quantity)) {$quantity = 1;}
  if (empty($subtotal)) {$subtotal = 0;}
   
  
   $mytotal = $quantity *  $subtotal ; 
   $myearncommision = $quantity *  $subtotal ;
   
      //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('8.  $mytotal')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************
   
   //*******************************************************************************************************************
   $myearncommision = $myearncommision * $productcommission / 100;
   
   
        //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('9.  $myearncommision')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************
   
           
           
           
           
   
   
   if (isset($myearncommision) && $myearncommision > 0) {
       
      $match_order_meta = wc_get_order_item_meta( $item_id, '_smdp_referrer');
      if (!isset($match_order_meta) || empty($match_order_meta)) {
   wc_add_order_item_meta( $item_id, '_smdp_referrer', $ref_id );
      }
      
       $match_order_meta = wc_get_order_item_meta( $item_id, '_smdp_commission');
     if (!isset($match_order_meta) || empty($match_order_meta)) {
            wc_add_order_item_meta( $item_id, '_smdp_commission', $myearncommision );
      }
 
    $sumtotal += $mytotal ;
    $sumcommission += $myearncommision;
    $orderitemname = $item->get_name();
    $masouriorderitems .= $orderitemname . ' -->'. $coupon_code .'<-- , ';
    
    
            //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('10.  $sumcommission')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************
    
    
   }
    
}
   

   
      }
      
      
    // wp_die('fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff');
      
      
   //----------------------------------------------------------------------------------------------
   

     
     
//if ($sumcommission == 0) {return '';}
      
      

//$sumcommission edo afairo kouponi
         // $discount_type = $coupon->get_discount_type(); 
        //  $coupon_amount = $coupon->get_amount();

if (strpos($discount_type, 'percent') !== false) {
   // $sumtotal
    $mycouponcost = $sumtotal * $coupon_amount / 100;
  $sumcommission = $sumcommission -  $mycouponcost;
} elseif   (strpos($discount_type, 'fixed') !== false)  { 
    $sumcommission = $sumcommission - $coupon_amount;
}
//fixed_cart
//
//
              //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('10sumtotalz.  $sumtotal')";
       //   $mmyreq = $wpdb->query($ssql);
           //************************************************************************************

                     //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('10sumcommissionzz.  $sumcommission')";
          // $mmyreq = $wpdb->query($ssql);
           //************************************************************************************
          
         //  $kkkkkkkks = $sumtotal + $taxtotal ;
            
            //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('10zsumtotal + taxtotal888z.  $kkkkkkkks')";
        //   $mmyreq = $wpdb->query($ssql);
           //************************************************************************************

           
                                           //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('1mycouponcost5z.  $mycouponcost')";
        //  $mmyreq = $wpdb->query($ssql);
           //************************************************************************************
           
            $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('1555coupon_amount5555z.  $coupon_amount')";
       //    $mmyreq = $wpdb->query($ssql);
           //************************************************************************************
           
            $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('15taxtotal55z.  $taxtotal')";
      //  $mmyreq = $wpdb->query($ssql);
           //************************************************************************************
           
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('15rder_discount_tax_amount555z.  $order_discount_tax_amount')";
        //   $mmyreq = $wpdb->query($ssql);
           //************************************************************************************
           
           
    
           
           
           
if ($sumcommission <= 0) {return '';}

                 //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('11.  $sumcommission')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************
     //-----------------------------------------------------------------------------------------------
     
    $smdps_smdp_from_email = get_option( 'smdps_smdp_from_email' );
 if(!isset($smdps_smdp_from_email) || empty($smdps_smdp_from_email)  || !is_email($smdps_smdp_from_email) ) { 
     $smdps_smdp_from_email = 'noreply@' . $_SERVER['SERVER_NAME']  ;            //
 } 


    $smdps_smdp_cc_email = get_option( 'smdps_smdp_cc_email' );
 if(!isset($smdps_smdp_cc_email) || empty($smdps_smdp_cc_email)  || !is_email($smdps_smdp_cc_email) ) { 
     $smdps_smdp_cc_email = '';            //
 } 
     $smdps_smdp_bcc_email = get_option( 'smdps_smdp_bcc_email' );
 if(!isset($smdps_smdp_bcc_email) || empty($smdps_smdp_bcc_email)  || !is_email($smdps_smdp_bcc_email) ) { 
     $smdps_smdp_bcc_email = '';            //
 } 
 
//email to parthner
$to = $user_email;

$subject = 'You have earned Commission from product selling';
$message = 'Congratulations ' . $parent_user_name .', you earned the value ' . $sumcommission . ' from selling ' . $masouriorderitems  . ' products. Order ID: ' . $order_id  ;
//$headers[] = array('Content-Type: text/html; charset=UTF-8');

           //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('12.  $parent_user_name')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************

if (is_email($smdps_smdp_from_email)) {
$headers[] = 'From: ' . $_SERVER['SERVER_NAME']. ' <'.$smdps_smdp_from_email.'>';
}
//$headers[] = 'From: Hyperion.club <info@hypermall.club>';
if (is_email($smdps_smdp_cc_email)) {
$headers[] = 'Cc:   <'.$smdps_smdp_cc_email.'>';
}
//$headers[] = 'Cc: Production Department <develop@yperad.gr>';
if (is_email($smdps_smdp_bcc_email)) {
$headers[] = 'Bcc:   <'.$smdps_smdp_bcc_email.'>';
}
              //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('13.  $smdps_smdp_from_email')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************
           
           $to = $parent_user_email;
           
//SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSOOOOOOOOOOOOSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS
wp_mail( $to, $subject, $message , $headers);
    //SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSOOOOOOOOOOOOSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS
       //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('TO 13A.  $to')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************
    
          
//email to admin
$to = get_bloginfo('admin_email');
if (isset($to) && !empty($to) && is_email($to) ) {
$subject = 'Partner was given a commission because he sold products';
$message = 'The partner with name ' . $parent_user_name .' and referral ID: ' . $ref_id . ', earned the value ' . $sumcommission . ' from selling ' . $masouriorderitems  . ' products. Order ID: ' . $order_id  ;

if (is_email($smdps_smdp_from_email)) {
$headersb[] = 'From: ' . $_SERVER['SERVER_NAME']. ' <'.$smdps_smdp_from_email.'>';
}

if (is_email($smdps_smdp_cc_email)) {
$headersb[] = 'Cc:   <'.$smdps_smdp_cc_email.'>';
}

if (is_email($smdps_smdp_bcc_email)) {
$headersb[] = 'Bcc:   <'.$smdps_smdp_bcc_email.'>';
}

     //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('140.  $parent_user_name')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************
              //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('141.  $smdps_smdp_from_email')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************

              //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('14.  $ref_id')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************
//SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSOOOOOOOOOOOOSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS
wp_mail( $to, $subject, $message , $headersb);
//SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS
}

     
                 //*********************************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('TO 14AB.  $to')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************


//-------------------------woo_wallet INTERGRATION -------12/10/2020--------------------------------------------------------------

//$smdp_soccernet_intergration = get_option( 'smdp_soccernet_intergration' );

//if(1 == 1 || isset($smdp_soccernet_intergration) && !empty($smdp_soccernet_intergration)  && $smdp_soccernet_intergration == 'on') { 
if(1 == 1) {
$table_name = $wpdb->base_prefix.'sm_commissions_trans';

//$query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );
//if ( ! $wpdb->get_var( $query ) == $table_name ) {
//   //do nothing
//} else
//{
    
      if($wpdb->get_var( "show tables like '$table_name'" ) == $table_name) 
    {
    
         $user_id = $refferer_wpid;
          
                           //********************************************************************
           $ssql = "INSERT INTO wp_mylog (mytext) VALUES ('15.  $user_id')";
           //$mmyreq = $wpdb->query($ssql);
           //************************************************************************************
          
          
    
   $details = 'Earned from selling ' . $masouriorderitems  . ' products. Order ID: ' . $order_id  ;
    
   $balance = 0;
   
   $tmpp =  $wpdb->get_var("SELECT balance FROM " . $table_name ." WHERE deleted = 0 and user_id = $user_id ORDER BY transaction_id DESC;"); 
   if (isset($tmpp) && $tmpp > 0) {
       $balance = $tmpp;
   }
   
   $balance += $sumcommission;
   
    $wpdb->insert($table_name, array(
    'blog_id' => '1',
    'user_id' => $user_id,
    'type' => 'credit', 
    'amount' =>  $sumcommission , 
    'balance' =>   $balance, 
    'currency' => 'EUR', 
    'details' =>  sanitize_textarea_field($details) , 
    'created_by' => $user_id, 
    'deleted' => '0', 
    'date' => current_time('mysql') 
));
    
    $transaction_id = $wpdb->insert_id;
  //  if ($transaction_id > 0) {
      //  update_user_meta($user_id, '_current_woo_wallet_balance', $balance); 
      //  delete_transient("woo_wallet_transaction_resualts_{$user_id}");
      //   do_action( 'woo_wallet_transaction_recorded', $transaction_id, $user_id, $sumcommission, 'credit');
  //  }
    
   

 
 //------------------------gggg-----------END OF woo_wallet INTERGRATION -------20/10/2020  3  --------   -------------------------------------------------------------------------

    
}
    
    
    
    
}
 return '';
}








//******************COMMISSIONS PRODUCTS - ORDERS******************************************************************
if ( ! function_exists( 'smdp_view_prdcts_ords_func' ) ) {
function smdp_view_prdcts_ords_func($atts, $context = 'view' ){
    $output  = "";
    extract(shortcode_atts( array('id' => '', 'start_date' => '2000-01-01', 'end_date' => '2099-01-01'), $atts));

        if(1 == 1) {  
            $start_daten = $start_date;
            $end_daten = $end_date;
            
               $start_datenn = $start_date;
            $end_datenn = $end_date;
            
       if (isset($_POST['start_date'])  && strlen($_POST['start_date']) > 7) {
           $start_daten = sanitize_text_field($_POST['start_date']);
           $start_datenn = date('Y-m-d', strtotime($_POST['start_date']. '-1 days')); 
       }
       
       if (isset($_POST['end_date'])  && strlen($_POST['end_date']) > 7) {
           $end_daten = sanitize_text_field($_POST['end_date']);
            $end_datenn = date('Y-m-d', strtotime($_POST['end_date']. '+1 days')); 
       }


       
       
       
       
  // $id = 13;
       if ($id > 0) {
$user = get_user_by('id', $id);
} else {
    if ($id <> -4) {
    return; }
    
   //$user = wp_get_current_user();
}

 //if (  empty($user ) ) {return '';}


//$id = $user->ID;

 if( current_user_can('administrator') ) { 
    $exoadmin = true;
 } else { 
      $exoadmin = false;
 }

 
 
 //yoursocceruniversity

       if ( 1 == 1) {
           
       //    $user_info = get_userdata($id);
           
          // $user_info->user_email == 'yoursocceruniversity@gmail.com'
           //  if ( $exoadmin || $user_info->user_login == 'yoursocceruniversity@gmail.com') {
//           if ( $exoadmin || 1 == 1) {                    //|| $user_info->user_login == 'yoursocceruniversity'
//                } else {
//                       return '';
//                }
           
           
              
      //  $output .= ' <br><h2>'.__('Commissions', 'smdp-affiliate-platform').'</h2><br>' . "\n";   
 
              
        $output .= ' <br><h2>Refferal Commissions</h2><br>' . "\n";   
        $output .= '<form method="post" action="" enctype="multipart/form-data">' . "\n";
        $output .= '<label for="start_date">Start Date (yyyy-mm-dd):</label>' . "\n";
        $output .= '<input type="text" id="start_date" name="start_date" value="'. $start_daten .'">' . "\n";
        $output .= '<label for="end_date">End Date (yyyy-mm-dd):</label>' . "\n";
        $output .= '<input type="text" id="end_date" name="end_date" value="'. $end_daten .'">' . "\n";
        $output .= '<input type="submit" name="Search" class="button-primary" value="' . esc_attr( __( 'Search' , 'smdp-affiliate-platform' ) ) .'" /><br>' . "\n";

   


    
        $output .= ' <br>
	<table style="width:90%;" class="smdp-table-vouchers">
	<thead><tr>
	<th scope="col">'.__('Trans. ID', 'smdp-affiliate-platform').'</th>';
           if ($exoadmin) {
                $output .= '  <th scope="col">'.__('User', 'smdp-affiliate-platform').'</th>';
           }


        $output .= '<th scope="col">'.__('Date', 'smdp-affiliate-platform').'</th>
	<th scope="col">'.__('Amount', 'smdp-affiliate-platform').'</th>
        <th scope="col">'.__('Details', 'smdp-affiliate-platform').'</th>
	</tr></thead>
	<tbody>';
    

        

        
        global $wpdb;
         $table_name = $wpdb->prefix  . 'sm_commissions_trans' ;
        $sql = "SELECT * FROM $table_name  WHERE 1 ";
        
         if ($id > 0) { 
              $sql .= " AND `user_id` = $id";
         } else {
         if ($exoadmin) { } else { $sql .= " AND `user_id` = $id";}

         }
         
         
         
         
     $sql .= " AND (`date` BETWEEN '$start_datenn' AND '$end_datenn')"; 
         
          $sql .= ";";
        
        $mytransactions =  $wpdb->get_results($sql);
        
        
        if ( $mytransactions ) {
               foreach ( $mytransactions as $mytransaction ){
                $output .= ' <tr> ';
                $output .= ' <td>';
                $output .= $mytransaction->transaction_id ;
                $output .= ' </td> ';
                
                 if ($exoadmin) {
                    $output .= ' <td>';
                    $tmpuser = get_user_by('id', $mytransaction->user_id);
                    $myusername = $tmpuser->user_login;
                    $myemail = $tmpuser->user_email;
                    
                    $output .= $myusername . '(' . $myemail  . ')' ;
                    
                    
                    $output .= ' </td> ';
                 }
                $output .= ' <td>';
                $output .= $mytransaction->date  ;
                $output .= ' </td> ';
                $output .= ' <td>';
                $output .= $mytransaction->amount  ;
                $output .= ' </td> ';
                $output .= ' <td>';
                $output .= $mytransaction->details  ;
                $output .= ' </td> ';   
                $output .= ' </tr> ';  
        }
}
                $output .=  '</table>'  ;           
} 
             
        }
        
	return   $output  ;	

}}
add_shortcode('smdp_view_prdcts_ords', 'smdp_view_prdcts_ords_func');



function smdp_quote_of_the_day(  ) { 
  
    ?>

<div class="smdp-commissions-tablea">
   
<?php

 $user = wp_get_current_user();
 if (  empty($user ) ) {return '';}

$id = $user->ID;

   echo    do_shortcode('[smdp_view_prdcts_ords id="'.$id.'" start_date="2000-01-01" end_date="2099-01-01"]')  ;  

?>
</div>

<?php
}

add_action( 'show_user_profile', 'smdp_quote_of_the_day', 10 );

add_action( 'woocommerce_account_content', 'smdp_quote_of_the_day', 10, 0 ); 



function smdp_quote_of_the_dayb() { 
  
    ?>

<div class="smdp-commissions-tableb">
   
<?php

$user_id = $_GET['user_id'];


 $user = wp_get_current_user();
 if (  empty($user ) ) {return '';}
$id = $user->ID;



 if (  empty($user_id ) ) {return '';}

 //current_user_can('administrator') ||
 //if($user_id == $id) {} else {return;}
 
 
 if (current_user_can('administrator') || $user_id == $id) {

 echo  do_shortcode('[smdp_view_prdcts_ords id="'.$user_id.'" start_date="2000-01-01" end_date="2099-01-01"]')  ;  
 }
?>
</div>

<?php
}
add_action( 'edit_user_profile', 'smdp_quote_of_the_dayb', 10 );

