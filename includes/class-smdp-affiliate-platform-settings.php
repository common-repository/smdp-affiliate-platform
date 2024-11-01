<?php

if ( ! defined( 'ABSPATH' ) ) exit;



class smdp_Affiliate_platform_Settings {

	/**
	 * The single instance of smdp_Affiliate_platform_Settings.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * The main plugin object.
	 * @var 	object
	 * @access  public
	 * @since 	1.0.0
	 */
	public $parent = null;

	/**
	 * Prefix for plugin settings.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $base = '';

	/**
	 * Available settings for plugin.
	 * @var     array
	 * @access  public
	 * @since   1.0.0
	 */
	public $settings = array();

	public function __construct ( $parent ) {
		$this->parent = $parent;

		$this->base = 'smdps_';

		// Initialise settings
		add_action( 'init', array( $this, 'init_settings' ), 11 );

		// Register plugin settings
		add_action( 'admin_init' , array( $this, 'register_settings' ) );

		// Add settings page to menu
		add_action( 'admin_menu' , array( $this, 'add_menu_item' ) );

		// Add settings link to plugins page
		add_filter( 'plugin_action_links_' . plugin_basename( $this->parent->file ) , array( $this, 'add_settings_link' ) );
	}

	/**
	 * Initialise settings
	 * @return void
	 */
	public function init_settings () {
		$this->settings = $this->settings_fields();
	}

	/**
	 * Add settings page to admin menu
	 * @return void
	 */
	public function add_menu_item () {
		$page = add_options_page( __( 'Plugin Settings', 'smdp-affiliate-platform' ) , __( 'SMDP Referral Platform Settings', 'smdp-affiliate-platform' ) , 'manage_options' , $this->parent->_token . '_settings' ,  array( $this, 'settings_page' ) );
		add_action( 'admin_print_styles-' . $page, array( $this, 'settings_assets' ) );
	}

	/**
	 * Load settings JS & CSS
	 * @return void
	 */
	public function settings_assets () {

		// We're including the farbtastic script & styles here because they're needed for the colour picker
		// If you're not including a colour picker field then you can leave these calls out as well as the farbtastic dependency for the wpt-admin-js script below
		wp_enqueue_style( 'farbtastic' );
    	wp_enqueue_script( 'farbtastic' );

    	// We're including the WP media scripts here because they're needed for the image upload field
    	// If you're not including an image upload then you can leave this function call out
    	wp_enqueue_media();

    	wp_register_script( $this->parent->_token . '-settings-js', $this->parent->assets_url . 'js/settings' . $this->parent->script_suffix . '.js', array( 'farbtastic', 'jquery' ), '1.0.0' );
    	wp_enqueue_script( $this->parent->_token . '-settings-js' );
	}

	/**
	 * Add settings link to plugin list table
	 * @param  array $links Existing links
	 * @return array 		Modified links
	 */
	public function add_settings_link ( $links ) {
		$settings_link = '<a href="options-general.php?page=' . $this->parent->_token . '_settings">' . __( 'Settings', 'smdp-affiliate-platform' ) . '</a>';
  		array_push( $links, $settings_link );
  		return $links;
	}

	/**
	 * Build settings fields
	 * @return array Fields to be displayed on settings page
	 */
	private function settings_fields () {

                $settings['commissions'] = array(
			'title'					=> __( 'Refferal Commissions', 'smdp-affiliate-platform' ),
        'description'			=> __( '', 'smdp-affiliate-platform' ),
                        
                    'fields'				=> array(
				array(
					'id' 			=> '11number_field',
					'label'			=> __( '' , 'smdp-affiliate-platform' ),
					'description'	=> __( '', 'smdp-affiliate-platform' ),
					'type'			=> 'hidden',
					'default'		=> '',
					'placeholder'	=> __( '', 'smdp-affiliate-platform' )
				)
				
			)
                    );

                        
                $settings['referrers'] = array(
			'title'					=> __( 'Settings for Referrers', 'smdp-affiliate-platform' ),
			'description'			=> __( 'These are settings for refererres.', 'smdp-affiliate-platform' ),
			'fields'				=> array(
				array(
					'id' 			=> 'smdp_commission',
					'label'			=> __( 'Commision (%)' , 'smdp-affiliate-platform' ),
					'description'	=> __( 'This is a general value for commission on sales. This can change - overwriting for each group of referrers and each product too.', 'smdp-affiliate-platform' ),
					'type'			=> 'number',
					'default'		=> '',
					'placeholder'	=> __( '0', 'smdp-affiliate-platform' )
				),
                            				array(
					'id' 			=> 'smdp_cookie_duration',
					'label'			=> __( 'Cookie Duration (days)' , 'smdp-affiliate-platform' ),
					'description'	=> __( 'This is the cookie duration for referred.', 'smdp-affiliate-platform' ),
					'type'			=> 'number',
					'default'		=> '30',
					'placeholder'	=> __( '30', 'smdp-affiliate-platform' )
				),
                            	array(
					'id' 			=> 'smdp_from_email',
					'label'			=> __( 'Sender Email address (From)' , 'smdp-affiliate-platform' ),
					'description'	=> __( 'This is the sender email address for cc info after a succesfull given commission.', 'smdp-affiliate-platform' ),
					'type'			=> 'email',
					'default'		=> '',
					'placeholder'	=> __( '', 'smdp-affiliate-platform' )
				),
                            	array(
					'id' 			=> 'smdp_cc_email',
					'label'			=> __( 'CC Email address' , 'smdp-affiliate-platform' ),
					'description'	=> __( 'This is the email address for cc info after a succesfull given commission.', 'smdp-affiliate-platform' ),
					'type'			=> 'email',
					'default'		=> '',
					'placeholder'	=> __( '', 'smdp-affiliate-platform' )
				),
                            array(
					'id' 			=> 'smdp_bcc_email',
					'label'			=> __( 'BCC Email address' , 'smdp-affiliate-platform' ),
					'description'	=> __( 'This is the email address for bcc info after a succesfull given commission.', 'smdp-affiliate-platform' ),
					'type'			=> 'email',
					'default'		=> '',
					'placeholder'	=> __( '', 'smdp-affiliate-platform' )
				),
                                    array(
					'id' 			=> 'smdp_clear_data',
					'label'			=> __( 'Clear Data on Uninstall', 'smdp-affiliate-platform' ),
					'description'	=> __( 'Clear Data on Uninstall', 'smdp-affiliate-platform' ),
					'type'			=> 'checkbox',
					'default'		=> ''
				), 
                            
                            
			)
		);
                
                
                
                
                                $settings['integrations'] = array(
			'title'					=> __( 'Integrations', 'smdp-affiliate-platform' ),
			'description'			=> __( 'These are settings for Integrations  with other plugins.', 'smdp-affiliate-platform' ),
			'fields'				=> array(
				array(
					'id' 			=> 'smdp_terawallet_integration',
					'label'			=> __( 'TeraWallet Integration' , 'smdp-affiliate-platform' ),
					'description'	=> __( 'This requires TeraWallet Plugin installed.', 'smdp-affiliate-platform' ),
					'type'			=> 'checkbox',
					'default'		=> ''
				)
			)
		);
                
                
                
                
                
                
                
                
                

		$settings = apply_filters( $this->parent->_token . '_settings_fields', $settings );

		return $settings;
	}

        

        
	/**
	 * Register plugin settings
	 * @return void
	 */
	public function register_settings () { 
            global $wpdb;
		if ( is_array( $this->settings ) ) {

			// Check posted/selected tab
			$current_section = '';
			if ( isset( $_POST['tab'] ) && $_POST['tab'] ) {
                            
                            
				$current_section = sanitize_key($_POST['tab']);
                                
                                
			} else {
				if ( isset( $_GET['tab'] ) && $_GET['tab'] ) {
                                    
                                    
					$current_section = sanitize_key($_GET['tab']);
                                        
                                        
				}
			}

			foreach ( $this->settings as $section => $data ) {

				if ( $current_section && $current_section != $section ) continue;
				// Add section to page
				add_settings_section( $section, $data['title'], array( $this, 'settings_section' ), $this->parent->_token . '_settings' );

				foreach ( $data['fields'] as $field ) {

					// Validation callback for field
					$validation = '';
					if ( isset( $field['callback'] ) ) {
						$validation = $field['callback'];
					}

					// Register field
					$option_name = $this->base . $field['id'];
                                        
                                        
					register_setting( $this->parent->_token . '_settings', $option_name, $validation );

                            
					// Add field to page
					add_settings_field( $field['id'], $field['label'], array( $this->parent->admin, 'display_field' ), $this->parent->_token . '_settings', $section, array( 'field' => $field, 'prefix' => $this->base ) );
                                        
                                        
                                        
				}

				if ( ! $current_section ) break;
			}
		}
	}


        

        

	public function settings_section ( $section ) {
		$html = '<p> ' . $this->settings[ $section['id'] ]['description'] . '</p>' . "\n";
		echo $html;
	}

	/**
	 * Load settings page content
	 * @return void
	 */
	public function settings_page () {

		// Build page HTML
		$html = '<div class="wrap" id="' . $this->parent->_token . '_settings">' . "\n";
			$html .= '<h2>' . __( 'SMDP Plugin Settings' , 'smdp-affiliate-platform' ) . '</h2>' . "\n";

			$tab = '';
			if ( isset( $_GET['tab'] ) && $_GET['tab'] ) {
				$tab .= sanitize_key($_GET['tab']);
			}

			// Show page tabs
			if ( is_array( $this->settings ) && 1 < count( $this->settings ) ) {

				$html .= '<h2 class="nav-tab-wrapper">' . "\n";

                                
                              
                                
                                
				$c = 0;
				foreach ( $this->settings as $section => $data ) {

					// Set tab class
					$class = 'nav-tab';
					if ( ! isset( $_GET['tab'] ) ) {
						if ( 0 == $c ) {
							$class .= ' nav-tab-active';
						}
					} else {
						if ( isset( $_GET['tab'] ) && $section == $_GET['tab'] ) {
							$class .= ' nav-tab-active';
						}
					}

					// Set tab link
					$tab_link = add_query_arg( array( 'tab' => $section ) );
					if ( isset( $_GET['settings-updated'] ) ) {
						$tab_link = remove_query_arg( 'settings-updated', $tab_link );
					}

					// Output tab
					$html .= '<a href="' . $tab_link . '" class="' . esc_attr( $class ) . '">' . esc_html( $data['title'] ) . '</a>' . "\n";

					++$c;
                                                     
				}

				$html .= '</h2>' . "\n";
			}
 if (! isset( $_GET['tab']) || $_GET['tab'] == 'commissions') {
               //  $html .=   do_shortcode('[smdp_get_commissions_uers_grid id="" start_date="2000-01-01" end_date="2099-01-01"]')  ;  
                 
                   $html .=   do_shortcode('[smdp_view_prdcts_ords id="-4" start_date="2000-01-01" end_date="2099-01-01"]')  ;  
                 
                 
                 
                 
 }
                        
			$html .= '<form method="post" action="options.php" enctype="multipart/form-data">' . "\n";

                        
                         
                        
                          if (! isset( $_GET['tab']) || $_GET['tab'] == 'commissions') {
                              //do nothing
                          } 
                          else {
				// Get settings fields
				ob_start();
				settings_fields( $this->parent->_token . '_settings' );
				do_settings_sections( $this->parent->_token . '_settings' );
				$html .= ob_get_clean();
                          }
                                //COMMISSIONS
                                                 
				$html .= '<p class="submit">' . "\n";
					$html .= '<input type="hidden" name="tab" value="' . esc_attr( $tab ) . '" />' . "\n";
                                        
                  
                                           if (! isset( $_GET['tab']) || $_GET['tab'] == 'commissions') {
                                           
                                        } else {
					$html .= '<input name="Submit" type="submit" class="button-primary" value="' . esc_attr( __( 'Save Settings' , 'smdp-affiliate-platform' ) ) . '" />' . "\n";
                                        }
                                        
                                        $html .= '</p>' . "\n";
			$html .= '</form>' . "\n";
		$html .= '</div>' . "\n";

		echo $html;
	}

	/**
	 * Main smdp_Affiliate_platform_Settings Instance
	 *
	 * Ensures only one instance of smdp_Affiliate_platform_Settings is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see smdp_Affiliate_platform()
	 * @return Main smdp_Affiliate_platform_Settings instance
	 */
	public static function instance ( $parent ) {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self( $parent );
		}
		return self::$_instance;
	} // End instance()

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->parent->_version );
	} // End __clone()

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->parent->_version );
	} // End __wakeup()

}


