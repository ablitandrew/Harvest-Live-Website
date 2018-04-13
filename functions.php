<?php

   /**
    *
    * load languages
    *
    */

    load_theme_textdomain( 'martanian', get_template_directory() .'/_assets/_languages' );

   /**
    *
    * blog post thumbnails
    *
    */

    add_theme_support( 'post-thumbnails' );

   /**
    *
    * support automatic feed links
    *
    */

    add_theme_support( 'automatic-feed-links' );

   /**
    *
    * support "title tag"
    *
    */

    add_theme_support( 'title-tag' );

   /**
    *
    * comments reply script
    *
    */

    add_action( 'comment_form_before', 'martanian_enqueue_comments_reply' );
    function martanian_enqueue_comments_reply() {

        if( get_option( 'thread_comments' ) ) {

            wp_enqueue_script( 'comment-reply' );
      	}
    }

   /**
    *
    * include TGM Plugin Activation class
    *
    */

    require_once( dirname( __FILE__ ) .'/_assets/_plugins/class-tgm-plugin-activation.php' );

   /**
    *
    * register required plugins
    *
    */

    add_action( 'tgmpa_register', 'martanian_register_required_plugins' );
    function martanian_register_required_plugins() {

        # required plugins array
        $plugins = array(
            array(
                'name' => esc_html( __( 'Insurance Shortcodes', 'martanian' ) ),
                'slug' => 'insurance-shortcodes',
                'source' => get_stylesheet_directory() .'/_assets/_plugins/insurance-shortcodes.zip',
                'required' => true,
                'version' => '1.0'
            )
        );

        # start the script
        tgmpa( $plugins );
    }

   /**
    *
    * setting up content width
    *
    */

    if( !isset( $content_width ) ) {

        $content_width = 1100;
    }

   /**
    *
    * register wp_nav menus
    *
    */

    if( function_exists( 'register_nav_menu' ) ) {

        # main menu
        register_nav_menu( 'martanian_main_menu', esc_html( __( 'Insurance Main Menu', 'martanian' ) ) );

        # footer menu
        register_nav_menu( 'martanian_footer_menu', esc_html( __( 'Insurance Footer Menu', 'martanian' ) ) );
    }

   /**
    *
    * enquerue scripts
    *
    */

    add_action( 'wp_enqueue_scripts', 'martanian_enqueue_scripts' );
    function martanian_enqueue_scripts() {

        # get theme options
        $martanian_options = get_option( 'martanian_theme_options' );

        # get google maps api key
        $api_key = isset( $martanian_options['contact-form'] ) && isset( $martanian_options['contact-form']['google-map-api-key'] ) ? $martanian_options['contact-form']['google-map-api-key'] : '';

        # jquery
        wp_enqueue_script( 'jquery' );

        # parallax
        wp_enqueue_script( 'martanian-parallax', get_template_directory_uri() .'/_assets/_libs/parallax.js', array( 'jquery' ), null, true );

        # noUIslider
        wp_enqueue_script( 'martanian-no-ui-slider', get_template_directory_uri() .'/_assets/_libs/no-ui-slider/jquery.nouislider.all.min.js', array( 'jquery' ), null, true );

        # google maps
        wp_enqueue_script( 'martanian-google-maps', ( is_ssl() ? 'https' : 'http' ) .'://maps.google.com/maps/api/js'. esc_attr( !empty( $api_key ) ? '?key='. $api_key : '' ), array( 'jquery' ), null, true );

        # main theme functions
        wp_enqueue_script( 'martanian-javascript-functions', get_template_directory_uri() .'/_assets/_js/functions.js', array( 'jquery' ), null, true );

        # font-awesome stylesheet
        wp_enqueue_style( 'martanian-font-awesome', get_template_directory_uri() .'/_assets/_libs/font-awesome/css/font-awesome.css', false, null );

        # animate.css stylesheet
        wp_enqueue_style( 'martanian-animate', get_template_directory_uri() .'/_assets/_libs/animate.css', false, null );

        # noUIslider
        wp_enqueue_style( 'martanian-no-ui-slider', get_template_directory_uri() .'/_assets/_libs/no-ui-slider/jquery.nouislider.css', false, null );

        # google font - signika
        wp_enqueue_style( 'martanian-signika-font', ( is_ssl() ? 'https' : 'http' ) .'://fonts.googleapis.com/css?family=Signika:300,400,600,700', false, null );

        # main theme stylesheet
        wp_enqueue_style( 'martanian-stylesheet', get_template_directory_uri() .'/style.css', false, null );
    }

   /**
    *
    * getting google map location lat and lng
    *
    */

    function martanian_get_map_position( $address, $api_key ) {

        $address_hash = md5( $address );

	       $url_encode_address = str_replace( ' ', '+', $address );
        $url = 'https://maps.google.com/maps/api/geocode/xml?address='. $url_encode_address .'&sensor=false'. ( $api_key != '' ? '&key='. esc_attr( $api_key ) : '' );

        $response = wp_remote_get( esc_url( $url ) );
 	      if( is_wp_error( $response ) ) return;

 	      $xml = wp_remote_retrieve_body( $response );
 	      if( is_wp_error( $xml ) ) return;

        if( $response['response']['code'] != 200 ) return false;
        else {

	          $data = new SimpleXMLElement( $xml );
            if( $data -> status == 'OK' ) {

                return array(
                    'lat' => ( string ) $data -> result -> geometry -> location -> lat,
                    'lng' => ( string ) $data -> result -> geometry -> location -> lng
                );
            }
        }

        return false;
    }

   /**
    *
    * clear empty paragraphs (for shortcodes)
    *
    */

    function martanian_clear_empty_p( $content ) {

        # clear div's
        $content = str_replace( '<p><div', '<div', $content );
        $content = str_replace( '</div></p>', '</div>', $content );

        # clear blockquotes
        $content = str_replace( '<p><blockquote', '<blockquote', $content );
        $content = str_replace( '</blockquote></p>', '</blockquote>', $content );

        # clear ul lists
        $content = str_replace( '<p><ul', '<ul', $content );
        $content = str_replace( '</ul></p>', '</ul>', $content );

        # clear ol lists
        $content = str_replace( '<p><ol', '<ol', $content );
        $content = str_replace( '</ol></p>', '</ol>', $content );

        # clear forms
        $content = str_replace( '<p><form', '<form', $content );
        $content = str_replace( '</form></p>', '</form>', $content );

        return( $content );
    }

   /**
    *
    * show heading menu
    *
    */

    function martanian_heading_menu( $menu ) {

        $depth = 1;
        $menu = explode( '<li', $menu );

        for( $i = 1; $i < count( $menu ); $i++ ) {

            $menu[$i] = '<li'. $menu[$i];

            if( strpos( $menu[$i], '<ul class="sub-menu">' ) !== false ) {

                $depth = $depth + 1;
                $menu[$i] = str_replace( 'sub-menu', 'sub-menu '. ( $depth == 2 ? 'animated speed fadeInDown' : 'animated speed fadeInRight' ), $menu[$i] );

                if( $depth == 2 ) {

                    $menu[$i] = str_replace( '<ul class="sub-menu', '<i class="fa fa-caret-down"></i><ul class="sub-menu', $menu[$i] );
                }

                else {

                    $menu[$i] = explode( '>', $menu[$i] );
                    $menu[$i][2] = '<i class="fa fa-caret-left"></i> '. $menu[$i][2];
                    $menu[$i] = trim( implode( '>', $menu[$i] ) );
                }
            }

            else if( strpos( $menu[$i], '</ul>' ) !== false ) {

                $depth = $depth - 1;
            }
        }

        echo martanian_create_popup_buttons( implode( '', $menu ) );
    }

   /**
    *
    * show footer menu
    *
    */

    function martanian_footer_menu( $menu ) {

        $menu = explode( '<li', $menu );
        for( $i = 1; $i < count( $menu ); $i++ ) {

            $menu[$i] = '<li'. $menu[$i];
            if( strpos( $menu[$i], '<ul class="sub-menu">' ) !== false ) {

                $menu[$i] = explode( '>', $menu[$i] );
                $menu[$i][1] = $menu[$i][1] .'><h4';
                $menu[$i][2] = substr( $menu[$i][2], 0, strpos( $menu[$i][2], '</a' ) ) .'</h4></a';
                $menu[$i] = implode( '>', $menu[$i] );
            }
        }

        echo martanian_create_popup_buttons( implode( '', $menu ) );
    }

   /**
    *
    * change hex color to rgb
    *
    */

    function martanian_hex2rgb( $hex ) {

        $hex = str_replace( '#', '', $hex );

        if( strlen( $hex ) == 3 ) {

            $r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1 ) );
            $g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1 ) );
            $b = hexdec( substr( $hex, 2, 1 ).substr( $hex, 2, 1 ) );
        }

        else {

            $r = hexdec( substr( $hex, 0, 2 ) );
            $g = hexdec( substr( $hex, 2, 2 ) );
            $b = hexdec( substr( $hex, 4, 2 ) );
        }

        return( $r .', '. $g .', '. $b );
    }

   /**
    *
    * create popup buttons
    *
    */

    function martanian_create_popup_buttons( $menu ) {

        # contact popup button
        $menu = preg_replace( '/<a href="#show-contact-popup">(.*?)<\/a>/', '<button class="menu-element" data-action="show-contact-popup">$1</button>', $menu );

        # quote popup button
        $menu = preg_replace( '/<a href="#show-quote-popup-(.*?)">(.*?)<\/a>/', '<button class="menu-element" data-action="show-quote-popup" data-quote-key="$1">$2</button>', $menu );

        # return result
        return( $menu );
    }

   /**
    *
    * translate date to "human" value
    *
    */

    function martanian_show_when( $date, $display = true ) {

        # translate date
        $when = human_time_diff( $date, current_time( 'timestamp' ) ) . ' '. __( 'ago', 'martanian' );

        # display or return?
        if( $display == true ) echo esc_html( $when );
        else {

            return $when;
        }
    }

   /**
    *
    * get post feature image
    *
    */

    function martanian_get_featured_image( $post_id ) {

        # if we have post thumbnail
        if( has_post_thumbnail( $post_id ) ) {

            # getting post thumbnail
            $thumbnail = get_the_post_thumbnail( $post_id );

            # there is no thumbnail image?
            if( $thumbnail == '' || $thumbnail == false ) return false;

            # getting post thumbnail URL
            $thumbnail_url = explode( 'src="', $thumbnail );
            $thumbnail_url = substr( $thumbnail_url[1], 0, strpos( $thumbnail_url[1], '"' ) );

            # return thumbnail url
            return( $thumbnail_url );
        }

        return( '' );
    }

   /**
    *
    * check if plugin is activated
    *
    */

    function martanian_is_plugin_active( $plugin ) {

        # check if known plugin is activated
        switch( $plugin ) {

            # insurance shortcodes plugin
            case 'insurance-shortcodes': return( function_exists( 'martanian_shortcode_link' ) ); break;
        }

        # plugin unknown
        return( false );
    }

   /**
    *
    * register blog sidebar
    *
    */

    if( function_exists( 'register_sidebar' ) ) {

        register_sidebar( array(
            'name' => esc_html( __( 'Sidebar for blog', 'martanian' ) ),
            'id' => 'blog-sidebar',
            'description' => esc_html( __( 'Sidebar for blog', 'martanian' ) ),
            'before_title' => '<h3>',
            'after_title' => '</h3>',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>'
        ));
    }

   /**
    *
    * add admin scripts
    *
    */

    add_action( 'admin_enqueue_scripts', 'martanian_add_admin_scripts' );
    function martanian_add_admin_scripts() {

        wp_enqueue_media();
        wp_enqueue_script( 'martanian_admin_scripts', get_template_directory_uri() .'/_assets/_js/admin.js', false, '1.0', true );
    }

   /**
    *
    * add admin page for Insurance
    *
    */

    add_action( 'admin_menu', 'martanian_add_admin_page' );
    function martanian_add_admin_page() {

        add_theme_page(
            __( 'Insurance Options', 'martanian' ),
            __( 'Insurance Options', 'martanian' ),
            'manage_options',
            'martanian_admin',
            'martanian_show_admin_page'
        );

        add_theme_page(
            __( 'Insurance Sections Manager', 'martanian' ),
            __( 'Insurance Sections Manager', 'martanian' ),
            'manage_options',
            'martanian_admin_sections_manager',
            'martanian_show_sections_manager_page'
        );
    }

   /**
    *
    * register settings
    *
    */

    add_action( 'admin_init', 'martanian_register_settings' );
    function martanian_register_settings() {

        register_setting(
            'martanian_theme_options',
            'martanian_theme_options',
            'martanian_validate_options'
        );

        add_settings_section(
            'martanian_theme_options_pages',
            '',
            'martanian_theme_options_pages',
            'martanian_admin'
        );
    }

    function martanian_theme_options_pages() {
    }

   /**
    *
    * settings validation function
    *
    */

    function martanian_validate_options( $input ) {

        # getting current options
        $martanian_options = get_option( 'martanian_theme_options' );

        # is there "pages" array?
        if( isset( $input['pages'] ) && is_array( $input['pages'] ) && count( $input['pages'] ) > 0 ) {

            # update only sections for selected page
            foreach( $input['pages'] as $key => $value ) {

                $martanian_options['pages'][$key] = martanian_secure( $value );
            }
        }

        # option keys
        $option_keys = array(
            'colors',
            'logo',
            'contact-form',
            'get-a-quote-forms',
            'footer'
        );

        # for each option keys
        foreach( $option_keys as $option_key ) {

            if( isset( $input[$option_key] ) ) {

                $martanian_options[$option_key] = martanian_secure( $input[$option_key] );
            }
        }

        # return values
        return( $martanian_options );
    }

   /**
    *
    * function for secure values
    * before saving in database
    *
    */

    function martanian_secure( $data ) {

        if( !is_array( $data ) ) return( esc_attr( $data ) );
        else {

            foreach( $data as $key => $value ) {

                $data[$key] = martanian_secure( $value );
            }
        }

        return $data;
    }

   /**
    *
    * prepare default age values
    *
    */

    function martanian_prepare_age_values() {

        $result = array(
            '1' => array(
                'value' => esc_html( __( 'Your age...', 'martanian' ) ),
                'unselectable' => 'yes'
            )
        );

        for( $i = 18; $i < 100; $i++ ) {

            $result[] = array(
                'value' => $i,
                'unselectable' => 'no'
            );
        }

        return( $result );
    }

   /**
    *
    * prepare default registration year values
    *
    */

    function martanian_prepare_registration_year_values() {

        $result = array(
            '1' => array(
                'value' => esc_html( __( 'Registration year...', 'martanian' ) ),
                'unselectable' => 'yes'
            )
        );

        for( $i = date( 'Y' ); $i >= 1950; $i-- ) {

            $result[] = array(
                'value' => $i,
                'unselectable' => 'no'
            );
        }

        return( $result );
    }

   /**
    *
    * default martanian_theme_options
    *
    */

    function martanian_get_default_option( $option ) {

        # default background image
        $default_background = get_template_directory_uri() .'/_assets/_img/image.png';

        # default options
        $martanian_options = array(
            'default-background' => esc_html( $default_background ),
            'logo' => get_template_directory_uri() .'/_assets/_img/logo.png',
            'colors' => array(
                'main-color' => '#2C3459',
                'second-main-color' => '#7DBA2F',
                'third-main-color' => '#91DA32',
                'text-color' => '#9498ab',
                'header-link-color' => '#a4adca',
                'gray-background-color' => '#f5f5f5'
            ),
            'get-a-quote-forms' => array(
                'recipient' => get_option( 'admin_email' ),
                'smtp' => array(
                    'use-smtp' => 'no',
                    'port' => '',
                    'host' => '',
                    'username' => '',
                    'password' => ''
                ),
                'button-text' => esc_html( __( 'Get a quote', 'martanian' ) ) .' [icon class="fa-paper-plane-o"]',
                'notice-after-sending' => esc_html( __( 'Your Quote Form has been sent successfully.', 'martanian' ) ),
                'next-form-id' => '5',
                'forms' => array(
                    '1' => array(
                        'client-name-field' => '3',
                        'client-email-field' => '6',
                        'name' => esc_html( __( 'Travel insurance', 'martanian' ) ),
                        'prefix' => sanitize_title( __( 'Travel insurance', 'martanian' ) ),
                        'heading' => esc_html( __( 'Travel insurance [color]Quote[/color]', 'martanian' ) ),
                        'image' => esc_html( $default_background ),
                        'background-icon' => 'fa-bus',
                        'next-field-id' => '10',
                        'fields' => array(
                            '1' => array(
                                'type' => 'slider',
                                'name' => esc_html( __( 'Level of protection:', 'martanian' ) ),
                                'from' => '10000',
                                'to' => '1000000',
                                'step' => '10000',
                                'start' => '200000',
                                'before-text' => '$',
                                'after-text' => ''
                            ),
                            '2' => array(
                                'type' => 'heading',
                                'text' => esc_html( __( 'Contact details:', 'martanian' ) )
                            ),
                            '3' => array(
                                'type' => 'text-field',
                                'name' => esc_html( __( 'Name', 'martanian' ) ),
                                'placeholder' => esc_html( __( 'Full Name...', 'martanian' ) )
                            ),
                            '4' => array(
                                'type' => 'select',
                                'name' => esc_html( __( 'How many persons?', 'martanian' ) ),
                                'next-possible-value-id' => '12',
                                'possible-values' => array(
                                    '1' => array(
                                        'value' => esc_html( __( 'How many persons?', 'martanian' ) ),
                                        'unselectable' => 'yes'
                                    ),
                                    '2' => array(
                                        'value' => '1',
                                        'unselectable' => 'no'
                                    ),
                                    '3' => array(
                                        'value' => '2',
                                        'unselectable' => 'no'
                                    ),
                                    '4' => array(
                                        'value' => '3',
                                        'unselectable' => 'no'
                                    ),
                                    '5' => array(
                                        'value' => '4',
                                        'unselectable' => 'no'
                                    ),
                                    '6' => array(
                                        'value' => '5',
                                        'unselectable' => 'no'
                                    ),
                                    '7' => array(
                                        'value' => '6',
                                        'unselectable' => 'no'
                                    ),
                                    '8' => array(
                                        'value' => '7',
                                        'unselectable' => 'no'
                                    ),
                                    '9' => array(
                                        'value' => '8',
                                        'unselectable' => 'no'
                                    ),
                                    '10' => array(
                                        'value' => '9',
                                        'unselectable' => 'no'
                                    ),
                                    '11' => array(
                                        'value' => '10',
                                        'unselectable' => 'no'
                                    )
                                )
                            ),
                            '5' => array(
                                'type' => 'text-field',
                                'name' => esc_html( __( 'Phone', 'martanian' ) ),
                                'placeholder' => esc_html( __( 'Phone Number...', 'martanian' ) )
                            ),
                            '6' => array(
                                'type' => 'text-field',
                                'name' => esc_html( __( 'E-mail', 'martanian' ) ),
                                'placeholder' => esc_html( __( 'E-mail Address...', 'martanian' ) )
                            ),
                            '7' => array(
                                'type' => 'heading',
                                'text' => esc_html( __( 'Travel', 'martanian' ) ),
                            ),
                            '8' => array(
                                'type' => 'text-field',
                                'name' => esc_html( __( 'Destination', 'martanian' ) ),
                                'placeholder' => esc_html( __( 'Destination...', 'martanian' ) )
                            ),
                            '9' => array(
                                'type' => 'select',
                                'name' => esc_html( __( 'How long?', 'martanian' ) ),
                                'next-possible-value-id' => '7',
                                'possible-values' => array(
                                    '1' => array(
                                        'value' => esc_html( __( 'How long?', 'martanian' ) ),
                                        'unselectable' => 'yes'
                                    ),
                                    '2' => array(
                                        'value' => esc_html( __( 'less than 1 week', 'martanian' ) ),
                                        'unselectable' => 'no'
                                    ),
                                    '3' => array(
                                        'value' => esc_html( __( '1 week', 'martanian' ) ),
                                        'unselectable' => 'no'
                                    ),
                                    '4' => array(
                                        'value' => esc_html( __( '2 weeks', 'martanian' ) ),
                                        'unselectable' => 'no'
                                    ),
                                    '5' => array(
                                        'value' => esc_html( __( '3 weeks', 'martanian' ) ),
                                        'unselectable' => 'no'
                                    ),
                                    '6' => array(
                                        'value' => esc_html( __( '4 weeks and more', 'martanian' ) ),
                                        'unselectable' => 'no'
                                    )
                                )
                            )
                        )
                    ),
                    '2' => array(
                        'client-name-field' => '2',
                        'client-email-field' => '5',
                        'name' => esc_html( __( 'Car insurance', 'martanian' ) ),
                        'prefix' => sanitize_title( __( 'Car insurance', 'martanian' ) ),
                        'heading' => esc_html( __( 'Car insurance [color]Quote[/color]', 'martanian' ) ),
                        'image' => esc_html( $default_background ),
                        'background-icon' => 'fa-car',
                        'next-field-id' => '10',
                        'fields' => array(
                            '1' => array(
                                'type' => 'heading',
                                'text' => esc_html( __( 'Contact details:', 'martanian' ) )
                            ),
                            '2' => array(
                                'type' => 'text-field',
                                'name' => esc_html( __( 'Name', 'martanian' ) ),
                                'placeholder' => esc_html( __( 'Full Name...', 'martanian' ) )
                            ),
                            '3' => array(
                                'type' => 'select',
                                'name' => esc_html( __( 'Age', 'martanian' ) ),
                                'next-possible-value-id' => '84',
                                'possible-values' => martanian_prepare_age_values()
                            ),
                            '4' => array(
                                'type' => 'text-field',
                                'name' => esc_html( __( 'Phone', 'martanian' ) ),
                                'placeholder' => esc_html( __( 'Phone Number...', 'martanian' ) )
                            ),
                            '5' => array(
                                'type' => 'text-field',
                                'name' => esc_html( __( 'E-mail', 'martanian' ) ),
                                'placeholder' => esc_html( __( 'E-mail Address...', 'martanian' ) )
                            ),
                            '6' => array(
                                'type' => 'heading',
                                'text' => esc_html( __( 'Your car:', 'martanian' ) )
                            ),
                            '7' => array(
                                'type' => 'text-field',
                                'name' => esc_html( __( 'Manufacturer', 'martanian' ) ),
                                'placeholder' => esc_html( __( 'Manufacturer...', 'martanian' ) )
                            ),
                            '8' => array(
                                'type' => 'text-field',
                                'name' => esc_html( __( 'Model', 'martanian' ) ),
                                'placeholder' => esc_html( __( 'Model...', 'martanian' ) )
                            ),
                            '9' => array(
                                'type' => 'select',
                                'name' => esc_html( __( 'Registration year', 'martanian' ) ),
                                'next-possible-value-id' => date( 'Y' ) - 1947,
                                'possible-values' => martanian_prepare_registration_year_values()
                            )
                        )
                    ),
                    '3' => array(
                        'client-name-field' => '3',
                        'client-email-field' => '6',
                        'name' => esc_html( __( 'Life insurance', 'martanian' ) ),
                        'prefix' => sanitize_title( __( 'Life insurance', 'martanian' ) ),
                        'heading' => esc_html( __( 'Life insurance [color]Quote[/color]', 'martanian' ) ),
                        'image' => esc_html( $default_background ),
                        'background-icon' => 'fa-umbrella',
                        'next-field-id' => '8',
                        'fields' => array(
                            '1' => array(
                                'type' => 'slider',
                                'name' => esc_html( __( 'Level of protection:', 'martanian' ) ),
                                'from' => '10000',
                                'to' => '1000000',
                                'step' => '10000',
                                'start' => '200000',
                                'before-text' => '$',
                                'after-text' => ''
                            ),
                            '2' => array(
                                'type' => 'heading',
                                'text' => esc_html( __( 'Contact details:', 'martanian' ) )
                            ),
                            '3' => array(
                                'type' => 'text-field',
                                'name' => esc_html( __( 'Name', 'martanian' ) ),
                                'placeholder' => esc_html( __( 'Full Name...', 'martanian' ) )
                            ),
                            '4' => array(
                                'type' => 'select',
                                'name' => esc_html( __( 'Age', 'martanian' ) ),
                                'next-possible-value-id' => '84',
                                'possible-values' => martanian_prepare_age_values()
                            ),
                            '5' => array(
                                'type' => 'text-field',
                                'name' => esc_html( __( 'Phone', 'martanian' ) ),
                                'placeholder' => esc_html( __( 'Phone Number...', 'martanian' ) )
                            ),
                            '6' => array(
                                'type' => 'text-field',
                                'name' => esc_html( __( 'E-mail', 'martanian' ) ),
                                'placeholder' => esc_html( __( 'E-mail Address...', 'martanian' ) )
                            ),
                            '7' => array(
                                'type' => 'checkbox',
                                'name' => esc_html( __( 'Have you used tobacco or nicotine products in the last 12 months?', 'martanian' ) ),
                                'default-value' => 'no',
                                'yes-value' => esc_html( __( 'Yes, I have', 'martanian' ) ),
                                'no-value' => esc_html( __( 'No, I have not', 'martanian' ) )
                            )
                        )
                    ),
                    '4' => array(
                        'client-name-field' => '7',
                        'client-email-field' => '10',
                        'name' => esc_html( __( 'House insurance', 'martanian' ) ),
                        'prefix' => sanitize_title( __( 'House insurance', 'martanian' ) ),
                        'heading' => esc_html( __( 'House insurance [color]Quote[/color]', 'martanian' ) ),
                        'image' => esc_html( $default_background ),
                        'background-icon' => 'fa-home',
                        'next-field-id' => '11',
                        'fields' => array(
                            '1' => array(
                                'type' => 'heading',
                                'text' => esc_html( __( 'Your house:', 'martanian' ) )
                            ),
                            '2' => array(
                                'type' => 'select',
                                'name' => esc_html( __( 'What sort of property is it?', 'martanian' ) ),
                                'next-possible-value-id' => '7',
                                'possible-values' => array(
                                    '1' => array(
                                        'value' => esc_html( __( 'What sort of property is it?', 'martanian' ) ),
                                        'unselectable' => 'yes'
                                    ),
                                    '2' => array(
                                        'value' => esc_html( __( 'House', 'martanian' ) ),
                                        'unselectable' => 'no'
                                    ),
                                    '3' => array(
                                        'value' => esc_html( __( 'Flat / Apartment', 'martanian' ) ),
                                        'unselectable' => 'no'
                                    ),
                                    '4' => array(
                                        'value' => esc_html( __( 'Bungalow', 'martanian' ) ),
                                        'unselectable' => 'no'
                                    ),
                                    '5' => array(
                                        'value' => esc_html( __( 'Town house', 'martanian' ) ),
                                        'unselectable' => 'no'
                                    ),
                                    '6' => array(
                                        'value' => esc_html( __( 'Other', 'martanian' ) ),
                                        'unselectable' => 'no'
                                    )
                                )
                            ),
                            '3' => array(
                                'type' => 'select',
                                'name' => esc_html( __( 'What type of property is it?', 'martanian' ) ),
                                'next-possible-value-id' => '7',
                                'possible-values' => array(
                                    '1' => array(
                                        'value' => esc_html( __( 'What type of property is it?', 'martanian' ) ),
                                        'unselectable' => 'yes'
                                    ),
                                    '2' => array(
                                        'value' => esc_html( __( 'Semi-detached', 'martanian' ) ),
                                        'unselectable' => 'no'
                                    ),
                                    '3' => array(
                                        'value' => esc_html( __( 'Detached', 'martanian' ) ),
                                        'unselectable' => 'no'
                                    ),
                                    '4' => array(
                                        'value' => esc_html( __( 'Link-detached', 'martanian' ) ),
                                        'unselectable' => 'no'
                                    ),
                                    '5' => array(
                                        'value' => esc_html( __( 'Terraced', 'martanian' ) ),
                                        'unselectable' => 'no'
                                    ),
                                    '6' => array(
                                        'value' => esc_html( __( 'End terrace', 'martanian' ) ),
                                        'unselectable' => 'no'
                                    )
                                )
                            ),
                            '4' => array(
                                'type' => 'text-field',
                                'name' => esc_html( __( 'Roughly when was it built?', 'martanian' ) ),
                                'placeholder' => esc_html( __( 'Roughly when was it built?', 'martanian' ) )
                            ),
                            '5' => array(
                                'type' => 'text-field',
                                'name' => esc_html( __( 'House Postcode', 'martanian' ) ),
                                'placeholder' => esc_html( __( 'House Postcode', 'martanian' ) )
                            ),
                            '6' => array(
                                'type' => 'heading',
                                'text' => esc_html( __( 'Contact details:', 'martanian' ) )
                            ),
                            '7' => array(
                                'type' => 'text-field',
                                'name' => esc_html( __( 'Name', 'martanian' ) ),
                                'placeholder' => esc_html( __( 'Full Name...', 'martanian' ) )
                            ),
                            '8' => array(
                                'type' => 'select',
                                'name' => esc_html( __( 'Age', 'martanian' ) ),
                                'next-possible-value-id' => '84',
                                'possible-values' => martanian_prepare_age_values()
                            ),
                            '9' => array(
                                'type' => 'text-field',
                                'name' => esc_html( __( 'Phone', 'martanian' ) ),
                                'placeholder' => esc_html( __( 'Phone Number...', 'martanian' ) )
                            ),
                            '10' => array(
                                'type' => 'text-field',
                                'name' => esc_html( __( 'E-mail', 'martanian' ) ),
                                'placeholder' => esc_html( __( 'E-mail Address...', 'martanian' ) )
                            )
                        )
                    )
                )
            ),
            'contact-form' => array(
                'popup-small-title' => esc_html( __( 'Contact us', 'martanian' ) ),
                'popup-big-title' => esc_html( __( 'Send us an [color]email![/color]', 'martanian' ) ),
                'phone-number' => '(+123) 456 789 000',
                'background-icon' => 'fa-envelope-o',
                'button-text' => esc_html( __( 'Send a message!', 'martanian' ) ) .' [icon class="fa-paper-plane-o"]',
                'notice-after-sending' => 'Your message has been sent successfully.',
                'google-map-location' => 'Palo Alto, Alma St 1',
                'google-map-zoom' => '12',
                'google-map-api-key' => '',
                'recipient' => get_option( 'admin_email' ),
                'smtp' => array(
                    'use-smtp' => 'no',
                    'port' => '',
                    'host' => '',
                    'username' => '',
                    'password' => ''
                ),
                'form' => array(
                    'next-field-id' => '8',
                    'client-name-field' => '2',
                    'client-email-field' => '4',
                    'fields' => array(
                        '1' => array(
                            'type' => 'heading',
                            'text' => esc_html( __( 'Contact details:', 'martanian' ) )
                        ),
                        '2' => array(
                            'type' => 'text-field',
                            'name' => esc_html( __( 'Name', 'martanian' ) ),
                            'placeholder' => esc_html( __( 'Your name...', 'martanian' ) )
                        ),
                        '3' => array(
                            'type' => 'text-field',
                            'name' => esc_html( __( 'Phone', 'martanian' ) ),
                            'placeholder' => esc_html( __( 'Your phone number...', 'martanian' ) )
                        ),
                        '4' => array(
                            'type' => 'text-field',
                            'name' => esc_html( __( 'E-mail', 'martanian' ) ),
                            'placeholder' => esc_html( __( 'Your e-mail...', 'martanian' ) )
                        ),
                        '5' => array(
                            'type' => 'text-field',
                            'name' => esc_html( __( 'Subject', 'martanian' ) ),
                            'placeholder' => esc_html( __( 'E-mail subject...', 'martanian' ) )
                        ),
                        '6' => array(
                            'type' => 'heading',
                            'text' => esc_html( __( 'Message:', 'martanian' ) )
                        ),
                        '7' => array(
                            'type' => 'textarea',
                            'name' => esc_html( __( 'Message', 'martanian' ) ),
                            'placeholder' => esc_html( __( 'Your message...', 'martanian' ) )
                        )
                    )
                )
            ),
            'footer' => array(
                'content' => martanian_is_plugin_active( 'insurance-shortcodes' ) ? esc_html( __( 'Copyright', 'martanian' ) ) .' &copy; '. date( 'Y' ) .' [divider] [link to="'. esc_url( home_url() ) .'"]'. esc_html( __( 'Insurance Agency', 'martanian' ) ) .'[/link]' : esc_html( __( 'Copyright', 'martanian' ) ) .' &copy; '. date( 'Y' ) .' '. esc_html( __( 'Insurance Agency', 'martanian' ) ),
                'facebook-url' => 'https://www.facebook.com/envato'
            ),
            'pages' => array(
                '404-page' => array(
                    'next_section_id' => '2',
                    'sections' => array(
                        '1' => array(
                            'type' => 'box-with-image-right',
                            'title' => esc_html( __( 'Ooops! Nothing found here...', 'martanian' ) ),
                            'small-title' => '',
                            'content' => martanian_is_plugin_active( 'insurance-shortcodes' ) ? esc_html( __( 'It looks like there is nothing here... Please try to use one of the links below or try to use the search form:', 'martanian' ) ) ."\n\n". '[list-menu]'. "\n" .'[search-form]' : esc_html( __( 'It looks like there is nothing here... Please try to use one of the menu links or try to use the search form.', 'martanian' ) ),
                            'boxes' => array(
                                'next-box-id' => '2',
                                '1' => array(
                                    'image' => esc_html( $default_background ),
                                    'caption' => martanian_is_plugin_active( 'insurance-shortcodes' ) ? '[strong]'. esc_html( __( 'Martha Jones', 'martanian' ) ) .'[/strong][newline]'. esc_html( __( 'Specialist on Relations with Customers', 'martanian' ) ) : ''
                                )
                            )
                        )
                    )
                )
            )
        );

        # return result
        return( isset( $martanian_options[$option] ) ? $martanian_options[$option] : false );
    }

   /**
    *
    * getting current page ID
    *
    */

    function martanian_get_current_page_ID() {

        $current_page_ID = '0';
        if( isset( $_GET['martanian_selected_page'] ) ) {

            if( is_numeric( $_GET['martanian_selected_page'] ) && $_GET['martanian_selected_page'] != '' ) $current_page_ID = $_GET['martanian_selected_page'];
            else if( $_GET['martanian_selected_page'] == 'subpages' ) $current_page_ID = 'subpages';
            else if( $_GET['martanian_selected_page'] == '404-page' ) $current_page_ID = '404-page';
        }

        return( $current_page_ID );
    }

   /**
    *
    * include widgets code
    *
    */

    require_once( get_template_directory() .'/_assets/_php/widgets.php' );

   /**
    *
    * include popups code
    *
    */

    require_once( get_template_directory() .'/_assets/_php/popups.php' );

   /**
    *
    * include theme colors code
    *
    */

    require_once( get_template_directory() .'/_assets/_php/colors.php' );

   /**
    *
    * include sections code
    *
    */

    require_once( get_template_directory() .'/_assets/_php/sections.php' );

   /**
    *
    * include sections manager code
    *
    */

    require_once( get_template_directory() .'/_assets/_php/sections_manager.php' );

   /**
    *
    * include theme options code
    *
    */

    require_once( get_template_directory() .'/_assets/_php/theme_options.php' );

   /**
    *
    * message after theme activation
    *
    */

    if( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {

  	    add_action( 'admin_notices', 'martanian_theme_activated' );
    }

    function martanian_theme_activated() {

        $theme_options_url = esc_url( get_admin_url( null, 'admin.php?page=martanian_admin' ) );

        ?>
        <script type="text/javascript">

          	jQuery( document ).ready( function( $ ) {

                $( '#message2' ).html( '<p>Thank you for purchase Insurance WordPress Theme! This theme is now active, you can go to <a href="<?php echo esc_url( $theme_options_url ); ?>">theme options page</a> and customize it! If you have technical problems or other questions, feel free to contact me: <a href="mailto:support@martanian.com">support@martanian.com</a>.</p>' );

            });

        </script>
        <?php
    }
add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<link rel="stylesheet" href="'.get_stylesheet_directory_uri() .'/css/jr-calculator.css" type="text/css" media="all" />';
}
   /**
    *
    * end of file.
    *
    */
add_action( 'wp_ajax_insurance_data', 'insurance_data_result' );
add_action( 'wp_ajax_nopriv_insurance_data', 'insurance_data_result' );

function insurance_data_result()
{
	global $wpdb;
	parse_str($_POST['dataform'], $insurdata);
	$firstname = $insurdata['firstname'];
    $lastname = $insurdata['lastname'];
    $occupation = $insurdata['occupation'];
    $email = $insurdata['email'];
    $phone = $insurdata['phone'];
    $dob = $insurdata['dob'];
	
    $dpdate_type = $insurdata['dpdate'];
	
	$dp_email_lable ='';

	if($dpdate_type == "yes")
	{
		$dp_email_lable = 'DP was issued two or more years ago.';
		$dpdate = 3;
	} 
	else 
	{
		$dp_email_lable = 'DP was issued less than two years ago.';
		$dpdate = 1;
	}
	    
	$vehicleregistration = $insurdata['vehicleregistration'];
    
	$make = $insurdata['make'];
    $modal = $insurdata['modal'];
    $vehiclevalue = $insurdata['vehiclevalue'];
    $isthevehicle = $insurdata['isthevehicle'];
    $enginesize = $insurdata['enginesize'];
    $vehicletype = $insurdata['vehicletype'];
    $claimdiscount = $insurdata['claimdiscount'];
    $additionaldis = $insurdata['additionaldis'];
    $antitheft = $insurdata['antitheft'] ;
    $windshield = $insurdata['windshield'];
    $insurancetype = $insurdata['insurancetype'];
    $vehiclemanufacture = $insurdata['vehiclemanufacture'];
    $usetype = $insurdata['usetype'];
    $claimsyears = $insurdata['claimsyears'];
	if($insurdata['additionalyoungdriver'])
	{
    	$additionalyoungdriver = Yes;
	}
	else
	{
		 $additionalyoungdriver = No;
	}
	if($insurdata['lossuse'])
	{
    	$lossuse = Yes;
	}
	else
	{
		 $lossuse = No;
	}
	if($insurdata['personalaccident'])
	{
    	$personalaccident = Yes;
	}
	else
	{
		 $personalaccident = No;
	}
	$roadsideassistance = Yes;
	$vehicle_data = array('first_name' =>$insurdata['firstname'],		 
		'last_name' =>$insurdata['lastname'],		 
		'occupation' =>$insurdata['occupation'],	 
		'email' =>$insurdata['email'], 
		'phone' =>$insurdata['phone'],	 
		'date_of_birth' =>$insurdata['dob'],	 
		'dp_issue' =>$dpdate,	 
		'vehicle_registration_number' =>$insurdata['vehicleregistration'],		 
		'make_eg_toyota' =>$insurdata['make'],	 
		'model_eg_corolla' =>$insurdata['modal'],		 
		'vehicle_value'=>$insurdata['vehiclevalue'],	 
		'is_the_vehicle' =>$insurdata['isthevehicle'], 
		'engine_size' =>$insurdata['enginesize'],	 
		'type_of_insurance' =>$insurdata['insurancetype'], 
		'type_of_use' =>$insurdata['usetype'],
		'vehicle_year_of_manufacture' =>$insurdata['vehiclemanufacture'],	 
		'have_you_had_any_claims' =>$insurdata['claimsyears'],	 
		'type_of_vehicle' =>$insurdata['vehicletype'],	 
		'no_claim_discount' =>$insurdata['claimdiscount'], 
		'additional_discount' =>$insurdata['additionaldis'], 
		'anti_theft' =>$insurdata['antitheft'], 
		'windshield_value' =>$insurdata['windshield'], 
		'additional_young_driver' =>$additionalyoungdriver,
		'loss_of_use' =>$lossuse, 
		'personal_accident_benefit' =>$personalaccident,
		'roadside_assistance' =>$roadsideassistance,
		);
	    $premium_data = insurance_calc($vehicle_data);
       print_r($premium_data);
		$to = $insurdata['email'];
        $subject = "New quote done by Nigel Kangalee";
		$message_cust = "Hello ".$insurdata['firstname']." ".$insurdata['lastname']." <br/>

As requested, the following is the premium offered by J.Rampersad & Co. Ltd. please note this is at a sum insured of ".$insurdata['vehiclevalue']."  ".$insurdata['insurancetype']."<br/>


A premium of $".$premium_data['premium_value']." is inclusive of:-<br/>
	Special Perils (that is occurrences of nature, example floods, hurricanes, tornadoes etc.)<br/>
	Windshield $".$insurdata['windshield']."<br/>
	24hr Roadside Assistance<br/><br/>


Please note that this quote is subject to change upon verification of details and validation of documentation by our Customer <br/>Services Representative. Please call 1-868-388-8888 or email info@jrcoltd.com.
";
		
	     $header = "From:instantquote@jrcoltd.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         //$cust_retval = mail ($to,$subject,$message_cust,$header);	
		  
	 	 $admin_mail = "oliviaelkhoury@gmail.com,rampersad.justin@gmail.com,nigel.kangalee@gmail.com";
	     $to = $admin_mail;
         $subject = "New quote done by Nigel Kangalee";
         
         $message = "EMAIL SUBJECT: New quote done by ".$firstname." ".$lastname."<br/>";
         $message .= "Name: ".$firstname." ".$lastname." <br/>
					Date of Birth:  ".$dob." <br/>
					Occupation:  ".$occupation." <br/>
					Phone:  ".$phone." <br/>
					Email:  ".$email." <br/>
					DP Issue Date:  ".$dp_email_lable." <br/>
					Previous claim in the last 3 years:  ".$claimsyears." <br/>
					No Claim Discount:  ".$claimdiscount." year<br/> 
					Type of insurance :  ".$insurancetype." <br/>
					Type of Use:  ".$usetype." <br/>
					Vehicle value: $".$vehiclevalue." <br/>
					Engine Size:  ".$enginesize." <br/>
					Registration : ".$vehicleregistration."<br/>
					Year of manufacture:  ".$vehiclemanufacture." <br/>
					Make:  ".$make." <br/>
					Model:  ".$modal." <br/>
					Additional Discount:  ".$additionaldis." %<br/>
					Anti Theft:  ".$antitheft." %<br/>
					Additional Young Driver:  ".$additionalyoungdriver." <br/>
					Loss of Use:  ".$lossuse." <br/>
					Personal Accident Benefit:  ".$personalaccident."<br/> 
					Windshield Value:  $".$windshield." <br/>
					Road Side Assist:  ".$roadsideassistance." <br/>
					Premium Value:  $".$windshield."<br/>
					";
         
         $header = "From: ".$email." \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
        // $retval = mail($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo $mail_suc = "success";
         }else {
           echo  $mail_suc = "fail";
         }
		$tablename = $wpdb->prefix.'insurance_data';
		$data = array('first_name' =>$insurdata['firstname'],		 
		'last_name' =>$insurdata['lastname'],		 
		'occupation' =>$insurdata['occupation'],	 
		'email' =>$insurdata['email'], 
		'phone' =>$insurdata['phone'],	 
		'date_of_birth' =>$insurdata['dob'],	 
		'dp_issue' =>$insurdata['dpdate'],	 
		'vehicle_registration_number' =>$insurdata['vehicleregistration'],		 
		'make_eg_toyota' =>$insurdata['make'],	 
		'model_eg_corolla' =>$insurdata['modal'],		 
		'vehicle_value'=>$insurdata['vehiclevalue'],	 
		'is_the_vehicle' =>$insurdata['isthevehicle'], 
		'engine_size' =>$insurdata['enginesize'],	 
		'type_of_insurance' =>$insurdata['insurancetype'], 
		'type_of_use' =>$insurdata['usetype'],
		'vehicle_year_of_manufacture' =>$insurdata['vehiclemanufacture'],	 
		'have_you_had_any_claims' =>$insurdata['claimsyears'],	 
		'type_of_vehicle' =>$insurdata['vehicletype'],	 
		'no_claim_discount' =>$insurdata['claimdiscount'], 
		'additional_discount' =>$insurdata['additionaldis'], 
		'anti_theft' =>$insurdata['antitheft'], 
		'windshield_value' =>$insurdata['windshield'], 
		'additional_young_driver' =>$additionalyoungdriver,
		'loss_of_use' =>$lossuse, 
		'personal_accident_benefit' =>$personalaccident,
		'roadside_assistance' =>$roadsideassistance,
        'premium_value' =>$premium_data['premium_value'],
        'sum_insured' =>$premium_data['sum_insured'],
		);
     	//$insert_data = $wpdb->insert( $tablename, $data);
		die;
	}
	
function insurance_calc($vehicle_data)
	{
		global $wpdb;
		if($vehicle_data['type_of_insurance'] == 'Comprehensive')
		{
			$insurnce_type = $vehicle_data['type_of_insurance'];
			$engine_size = $vehicle_data['engine_size'];
			$type_use = $vehicle_data['type_of_use'];
			$dob = $vehicle_data['date_of_birth'];
			
		    $vehicle_age = $vehicle_data['dp_issue'];
			
			$premium_value = 0;
			list($day,$month,$year) = explode("-",$dob);
			$user_age = date("Y") - $year;
			
			/*list($day,$month,$year) = explode("/",$dpdate);
			$vehicle_age = date("Y") - $year;*/
			
			
			if($user_age < 25 && $vehicle_age < 2 && $vehicle_data['engine_size'] == '1799')
			{
				  $results = $wpdb->get_results( 
                    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}insurance_values WHERE type_of_insurance ='".$insurnce_type."' AND age_option = 24 AND driving_age = 1 AND select_engine_size = ".$engine_size." AND select_type_of_use = '".$type_use."'") 
                 );
			    $results[0]->id;
				$sum_insured = $results[0]->sum_insured;
				$engine_size = $results[0]->engine_size;
				$loading = $results[0]->loading;
				$anti_theft = $results[0]->anti_theft_discount;
				$special_discount = $results[0]->special_discount;
				//$claimdiscount = $results[0]->ncd;
				$windshield = $results[0]->windscreen;
				$lossofuse = $results[0]->loss_of_use;
				$govtax = $results[0]->government_tax;
				$roadsideamt = $results[0]->motor_assist;
				$vehicle_value = str_replace( '$', '', $vehicle_data['vehicle_value'] );
				$vehicle_value = str_replace( ',', '', $vehicle_value );
				$insureed_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $premium_value + $engine_size;
				$loadingss = $premium_value * $loading / 100;
				$premium_value = $premium_value + $loadingss;
				
				if($vehicle_data['anti_theft'] != 0)
					{
						$anti_theft = $premium_value * $anti_theft / 100;
						$premium_value = $premium_value - $anti_theft;
					}
				if($vehicle_data['additional_discount'] != 0)
					{
						$additional_discount = $premium_value * $special_discount / 100;
						$premium_value = $premium_value - $additional_discount;
					}
				if($vehicle_data['personal_accident_benefit'])
					{
						$premium_value = $premium_value + 50.00;
					}
				if($vehicle_data['no_claim_discount'] != 0)
					{
						if($vehicle_data['no_claim_discount'] == 1)
						{
							$claimdiscount = 30;
						}
						if($vehicle_data['no_claim_discount'] == 2)
						{
							$claimdiscount = 40;
						}
						if($vehicle_data['no_claim_discount'] == 3)
						{
							$claimdiscount = 50;
						}
						if($vehicle_data['no_claim_discount'] == 4)
						{
							$claimdiscount = 60;
						}
						
						$no_claim_discount = $premium_value * $claimdiscount / 100;
						$premium_value = $premium_value - $no_claim_discount; 
					}
				if($vehicle_data['windshield_value'] != 'No')
					{
						$windscreen  = $vehicle_data['windshield_value'] * $windshield / 100;
						$premium_value = $premium_value + $windscreen;
					}
				if($vehicle_data['loss_of_use'] != 'No')
					{
						$premium_value = $premium_value + $lossofuse;
					}
				$gov = $premium_value * $govtax / 100;
				$premium_value = $premium_value + $gov;
				if($vehicle_data['roadside_assistance'] != 'No')
					{
						$premium_value = $premium_value + $roadsideamt;
					}
				$premium_value = $premium_value;
				return $main_value = array('premium_value'=>$premium_value, 'sum_insured'=>$insureed_value);
			}
			if($user_age < 25 && $vehicle_age > 2 && $vehicle_data['engine_size'] == '1799')
			{
				  $results = $wpdb->get_results( 
                    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}insurance_values WHERE type_of_insurance ='".$insurnce_type."' AND age_option = 24 AND driving_age = 3 AND select_engine_size = ".$engine_size." AND select_type_of_use = '".$type_use."'") 
                 );
			    $results[0]->id;
				$sum_insured = $results[0]->sum_insured;
				$engine_size = $results[0]->engine_size;
				$loading = $results[0]->loading;
				$anti_theft = $results[0]->anti_theft_discount;
				$special_discount = $results[0]->special_discount;
				//$claimdiscount = $results[0]->ncd;
				$windshield = $results[0]->windscreen;
				$lossofuse = $results[0]->loss_of_use;
				$govtax = $results[0]->government_tax;
				$roadsideamt = $results[0]->motor_assist;
                $vehicle_value = str_replace( '$', '', $vehicle_data['vehicle_value'] );
                $vehicle_value = str_replace( ',', '', $vehicle_value );
				$insureed_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $premium_value + $engine_size;
				$loadingsss = $premium_value * $loading / 100;
				$premium_value = $premium_value + $loadingsss;
				//echo $premium_value;
				if($vehicle_data['anti_theft'] != 0)
					{
						$anti_theft = $premium_value * $anti_theft / 100;
						$premium_value = $premium_value - $anti_theft;
					}
				if($vehicle_data['additional_discount'] != 0)
					{
						$additional_discount = $premium_value * $special_discount / 100;
						$premium_value = $premium_value - $additional_discount;
					}
				if($vehicle_data['personal_accident_benefit'])
					{
						$premium_value = $premium_value + 50.00;
					}
				if($vehicle_data['no_claim_discount'] != 0)
					{
						if($vehicle_data['no_claim_discount'] == 1)
						{
							$claimdiscount = 30;
						}
						if($vehicle_data['no_claim_discount'] == 2)
						{
							$claimdiscount = 40;
						}
						if($vehicle_data['no_claim_discount'] == 3)
						{
							$claimdiscount = 50;
						}
						if($vehicle_data['no_claim_discount'] == 4)
						{
							$claimdiscount = 60;
						}
						
						$no_claim_discount = $premium_value * $claimdiscount / 100;
						$premium_value = $premium_value - $no_claim_discount; 
					}
				if($vehicle_data['windshield_value'] != 'No')
					{
						$windscreen  = $vehicle_data['windshield_value'] * $windshield / 100;
						$premium_value = $premium_value + $windscreen;
					}
				if($vehicle_data['loss_of_use'] != 'No')
					{
						$premium_value = $premium_value + $lossofuse;
					}
				$gov = $premium_value * $govtax / 100;
				$premium_value = $premium_value + $gov;
				if($vehicle_data['roadside_assistance'] != 'No')
					{
						$premium_value = $premium_value + $roadsideamt;
					}
				$premium_value = $premium_value;
				return $main_value = array('premium_value'=>$premium_value, 'sum_insured'=>$insureed_value);
			}
			if($user_age > 25 && $vehicle_age < 2 && $vehicle_data['engine_size'] == '1799')
			{
				  $results = $wpdb->get_results( 
                    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}insurance_values WHERE type_of_insurance ='".$insurnce_type."' AND age_option = 26 AND driving_age = 1 AND select_engine_size = ".$engine_size." AND select_type_of_use = '".$type_use."'") 
                 );
			    $results[0]->id;
				$sum_insured = $results[0]->sum_insured;
				$engine_size = $results[0]->engine_size;
				$loading = $results[0]->loading;
				$anti_theft = $results[0]->anti_theft_discount;
				$special_discount = $results[0]->special_discount;
				//$claimdiscount = $results[0]->ncd;
				$windshield = $results[0]->windscreen;
				$lossofuse = $results[0]->loss_of_use;
				$govtax = $results[0]->government_tax;
				$roadsideamt = $results[0]->motor_assist;
                $vehicle_value = str_replace( '$', '', $vehicle_data['vehicle_value'] );
                $vehicle_value = str_replace( ',', '', $vehicle_value );
				$insureed_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $premium_value + $engine_size;
				$loadingss = $premium_value * $loading / 100;
                $premium_value = $premium_value + $loadingss;
				
				if($vehicle_data['anti_theft'] != 0)
					{
						$anti_theft = $premium_value * $anti_theft / 100;
						$premium_value = $premium_value - $anti_theft;
					}
				if($vehicle_data['additional_discount'] != 0)
					{
						$additional_discount = $premium_value * $special_discount / 100;
						$premium_value = $premium_value - $additional_discount;
					}
				if($vehicle_data['personal_accident_benefit'])
					{
						$premium_value = $premium_value + 50.00;
					}
				if($vehicle_data['no_claim_discount'] != 0)
					{
						if($vehicle_data['no_claim_discount'] == 1)
						{
							$claimdiscount = 30;
						}
						if($vehicle_data['no_claim_discount'] == 2)
						{
							$claimdiscount = 40;
						}
						if($vehicle_data['no_claim_discount'] == 3)
						{
							$claimdiscount = 50;
						}
						if($vehicle_data['no_claim_discount'] == 4)
						{
							$claimdiscount = 60;
						}
						
						$no_claim_discount = $premium_value * $claimdiscount / 100;
						$premium_value = $premium_value - $no_claim_discount; 

					}
				if($vehicle_data['windshield_value'] != 'No')
					{
						$windscreen  = $vehicle_data['windshield_value'] * $windshield / 100;
						$premium_value = $premium_value + $windscreen;
					}
                    
				if($vehicle_data['loss_of_use'] != 'No')
					{
						$premium_value = $premium_value + $lossofuse;
					}
				$gov = $premium_value * $govtax / 100;
				$premium_value = $premium_value + $gov;
                //echo $premium_value;
				if($vehicle_data['roadside_assistance'] != 'No')
					{
						$premium_value = $premium_value + $roadsideamt;
					}
				$premium_value = $premium_value;
				return $main_value = array('premium_value'=>$premium_value, 'sum_insured'=>$insureed_value);
			}
			
			if($user_age < 25 && $vehicle_age < 2 && $vehicle_data['engine_size'] == '1801')
			{
				  $results = $wpdb->get_results( 
                    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}insurance_values WHERE type_of_insurance ='".$insurnce_type."' AND age_option = 24 AND driving_age = 1 AND select_engine_size = ".$engine_size." AND select_type_of_use = '".$type_use."'") 
                 );
			    $results[0]->id;
				$sum_insured = $results[0]->sum_insured;
				$engine_size = $results[0]->engine_size;
				$loading = $results[0]->loading;
				$anti_theft = $results[0]->anti_theft_discount;
				$special_discount = $results[0]->special_discount;
				//$claimdiscount = $results[0]->ncd;
				$windshield = $results[0]->windscreen;
				$lossofuse = $results[0]->loss_of_use;
				$govtax = $results[0]->government_tax;
				$roadsideamt = $results[0]->motor_assist;
                $vehicle_value = str_replace( '$', '', $vehicle_data['vehicle_value'] );
                $vehicle_value = str_replace( ',', '', $vehicle_value );
				$insureed_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $premium_value + $engine_size;
				$loadingss = $premium_value * $loading / 100;
                $premium_value = $premium_value + $loadingss;
				
				if($vehicle_data['anti_theft'] != 0)
					{
						$anti_theft = $premium_value * $anti_theft / 100;
						$premium_value = $premium_value - $anti_theft;
					}
				if($vehicle_data['additional_discount'] != 0)
					{
						$additional_discount = $premium_value * $special_discount / 100;
						$premium_value = $premium_value - $additional_discount;
					}
				if($vehicle_data['personal_accident_benefit'])
					{
						$premium_value = $premium_value + 50.00;
					}
				if($vehicle_data['no_claim_discount'] != 0)
					{
						if($vehicle_data['no_claim_discount'] == 1)
						{
							$claimdiscount = 30;
						}
						if($vehicle_data['no_claim_discount'] == 2)
						{
							$claimdiscount = 40;
						}
						if($vehicle_data['no_claim_discount'] == 3)
						{
							$claimdiscount = 50;
						}
						if($vehicle_data['no_claim_discount'] == 4)
						{
							$claimdiscount = 60;
						}
						
						$no_claim_discount = $premium_value * $claimdiscount / 100;
						$premium_value = $premium_value - $no_claim_discount; 
					}
				if($vehicle_data['windshield_value'] != 'No')
					{
						$windscreen  = $vehicle_data['windshield_value'] * $windshield / 100;
						$premium_value = $premium_value + $windscreen;
					}
				if($vehicle_data['loss_of_use'] != 'No')
					{
						$premium_value = $premium_value + $lossofuse;
					}
				$gov = $premium_value * $govtax / 100;
				$premium_value = $premium_value + $gov;
				if($vehicle_data['roadside_assistance'] != 'No')
					{
						$premium_value = $premium_value + $roadsideamt;
					}
				$premium_value = $premium_value;
				return $main_value = array('premium_value'=>$premium_value, 'sum_insured'=>$insureed_value);
			}
			if($user_age < 25 && $vehicle_age > 2 && $vehicle_data['engine_size'] == '1801')
			{
				  $results = $wpdb->get_results( 
                    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}insurance_values WHERE type_of_insurance ='".$insurnce_type."' AND age_option = 24 AND driving_age = 3 AND select_engine_size = ".$engine_size." AND select_type_of_use = '".$type_use."'") 
                 );
			    $results[0]->id;
				$sum_insured = $results[0]->sum_insured;
				$engine_size = $results[0]->engine_size;
				$loading = $results[0]->loading;
				$anti_theft = $results[0]->anti_theft_discount;
				$special_discount = $results[0]->special_discount;
				//$claimdiscount = $results[0]->ncd;
				$windshield = $results[0]->windscreen;
				$lossofuse = $results[0]->loss_of_use;
				$govtax = $results[0]->government_tax;
				$roadsideamt = $results[0]->motor_assist;
                $vehicle_value = str_replace( '$', '', $vehicle_data['vehicle_value'] );
                $vehicle_value = str_replace( ',', '', $vehicle_value );
				$insureed_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $premium_value + $engine_size;
				$loadingss = $premium_value * $loading / 100;
                $premium_value = $premium_value + $loadingss;
				
				if($vehicle_data['anti_theft'] != 0)
					{
						$anti_theft = $premium_value * $anti_theft / 100;
						$premium_value = $premium_value - $anti_theft;
					}
				if($vehicle_data['additional_discount'] != 0)
					{
						$additional_discount = $premium_value * $special_discount / 100;
						$premium_value = $premium_value - $additional_discount;
					}
				if($vehicle_data['personal_accident_benefit'])
					{
						$premium_value = $premium_value + 50.00;
					}
				if($vehicle_data['no_claim_discount'] != 0)
					{
						if($vehicle_data['no_claim_discount'] == 1)
						{
							$claimdiscount = 30;
						}
						if($vehicle_data['no_claim_discount'] == 2)
						{
							$claimdiscount = 40;
						}
						if($vehicle_data['no_claim_discount'] == 3)
						{
							$claimdiscount = 50;
						}
						if($vehicle_data['no_claim_discount'] == 4)
						{
							$claimdiscount = 60;
						}
						
						$no_claim_discount = $premium_value * $claimdiscount / 100;
						$premium_value = $premium_value - $no_claim_discount; 
					}
				if($vehicle_data['windshield_value'] != 'No')
					{
						$windscreen  = $vehicle_data['windshield_value'] * $windshield / 100;
						$premium_value = $premium_value + $windscreen;
					}
				if($vehicle_data['loss_of_use'] != 'No')
					{
						$premium_value = $premium_value + $lossofuse;
					}
				$gov = $premium_value * $govtax / 100;
				$premium_value = $premium_value + $gov;
				if($vehicle_data['roadside_assistance'] != 'No')
					{
						$premium_value = $premium_value + $roadsideamt;
					}
				$premium_value = $premium_value;
				return $main_value = array('premium_value'=>$premium_value, 'sum_insured'=>$insureed_value);
			}
			if($user_age > 25 && $vehicle_age < 2 && $vehicle_data['engine_size'] == '1801')
			{
				  $results = $wpdb->get_results( 
                    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}insurance_values WHERE type_of_insurance ='".$insurnce_type."' AND age_option = 26 AND driving_age = 1 AND select_engine_size = ".$engine_size." AND select_type_of_use = '".$type_use."'") 
                 );
			    $results[0]->id;
				$sum_insured = $results[0]->sum_insured;
				$engine_size = $results[0]->engine_size;
				$loading = $results[0]->loading;
				$anti_theft = $results[0]->anti_theft_discount;
				$special_discount = $results[0]->special_discount;
				//$claimdiscount = $results[0]->ncd;
				$windshield = $results[0]->windscreen;
				$lossofuse = $results[0]->loss_of_use;
				$govtax = $results[0]->government_tax;
				$roadsideamt = $results[0]->motor_assist;
                $vehicle_value = str_replace( '$', '', $vehicle_data['vehicle_value'] );
                $vehicle_value = str_replace( ',', '', $vehicle_value );
				$insureed_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $premium_value + $engine_size;
				$loadingss = $premium_value * $loading / 100;
                $premium_value = $premium_value + $loadingss;
				
				if($vehicle_data['anti_theft'] != 0)
					{
						$anti_theft = $premium_value * $anti_theft / 100;
						$premium_value = $premium_value - $anti_theft;
					}
				if($vehicle_data['additional_discount'] != 0)
					{
						$additional_discount = $premium_value * $special_discount / 100;
						$premium_value = $premium_value - $additional_discount;
					}
				if($vehicle_data['personal_accident_benefit'])
					{
						$premium_value = $premium_value + 50.00;
					}
				if($vehicle_data['no_claim_discount'] != 0)
					{
						if($vehicle_data['no_claim_discount'] == 1)
						{
							$claimdiscount = 30;
						}
						if($vehicle_data['no_claim_discount'] == 2)
						{
							$claimdiscount = 40;
						}
						if($vehicle_data['no_claim_discount'] == 3)
						{
							$claimdiscount = 50;
						}
						if($vehicle_data['no_claim_discount'] == 4)
						{
							$claimdiscount = 60;
						}
						
						$no_claim_discount = $premium_value * $claimdiscount / 100;
						$premium_value = $premium_value - $no_claim_discount; 
					}
				if($vehicle_data['windshield_value'] != 'No')
					{
						$windscreen  = $vehicle_data['windshield_value'] * $windshield / 100;
						$premium_value = $premium_value + $windscreen;
					}
				if($vehicle_data['loss_of_use'] != 'No')
					{
						$premium_value = $premium_value + $lossofuse;
					}
				$gov = $premium_value * $govtax / 100;
				$premium_value = $premium_value + $gov;
				if($vehicle_data['roadside_assistance'] != 'No')
					{
						$premium_value = $premium_value + $roadsideamt;
					}
				$premium_value = $premium_value;
				return $main_value = array('premium_value'=>$premium_value, 'sum_insured'=>$insureed_value);
			}
		}
		
		if($vehicle_data['type_of_insurance'] == 'Third Party Fire Theft')
		{
			$insurnce_type = $vehicle_data['type_of_insurance'];
			$engine_size = $vehicle_data['engine_size'];
			$type_use = $vehicle_data['type_of_use'];
			$dob = $vehicle_data['date_of_birth'];
			$dpdate = $vehicle_data['dp_issue'];
            $vehicle_age = $vehicle_data['dp_issue'];
			$premium_value = 0;
			list($day,$month,$year) = explode("-",$dob);
			$user_age = date("Y") - $year;
			/*list($day,$month,$year) = explode("/",$dpdate);
			$vehicle_age = date("Y") - $year;
            */
			if($user_age < 25 && $vehicle_age < 2 && $vehicle_data['engine_size'] == '1799')
			{
				  $results = $wpdb->get_results( 
                    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}insurance_values WHERE type_of_insurance ='".$insurnce_type."' AND age_option = 24 AND driving_age = 1 AND select_engine_size = ".$engine_size." AND select_type_of_use = '".$type_use."'") 
                 );
			    $results[0]->id;
				$sum_insured = $results[0]->sum_insured;
				$engine_size = $results[0]->engine_size;
				$loading = $results[0]->loading;
				$anti_theft = $results[0]->anti_theft_discount;
				$special_discount = $results[0]->special_discount;
				//$claimdiscount = $results[0]->ncd;
				$windshield = $results[0]->windscreen;
				$lossofuse = $results[0]->loss_of_use;
				$govtax = $results[0]->government_tax;
				$roadsideamt = $results[0]->motor_assist;
                $vehicle_value = str_replace( '$', '', $vehicle_data['vehicle_value'] );
                $vehicle_value = str_replace( ',', '', $vehicle_value );
				$insureed_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $vehicle_value* $sum_insured / 100;
				$premium_value = $premium_value + $engine_size;
				$loadingss = $premium_value * $loading /100;
				$premium_value = $premium_value + $loadingss;
				
				if($vehicle_data['anti_theft'] != 0)
					{
						$anti_theft = $premium_value * $anti_theft / 100;
						$premium_value = $premium_value - $anti_theft;
					}
				if($vehicle_data['additional_discount'] != 0)
					{
						$additional_discount = $premium_value * $special_discount / 100;
						$premium_value = $premium_value - $additional_discount;
					}
				if($vehicle_data['no_claim_discount'] != 0)
					{
						if($vehicle_data['no_claim_discount'] == 1)
						{
							$claimdiscount = 15;
						}
						if($vehicle_data['no_claim_discount'] == 2)
						{
							$claimdiscount = 20;
						}
						if($vehicle_data['no_claim_discount'] == 3)
						{
							$claimdiscount = 25;
						}
						if($vehicle_data['no_claim_discount'] == 4)
						{
							$claimdiscount = 35;
						}
						
						$no_claim_discount = $premium_value * $claimdiscount / 100;
						$premium_value = $premium_value - $no_claim_discount; 
					}
				if($vehicle_data['windshield_value'] != 'No')
					{
						$windscreen  = $vehicle_data['windshield_value'] * $windshield / 100;
						$premium_value = $premium_value + $windscreen;
					}
				if($vehicle_data['loss_of_use'] != 'No')
					{
						$premium_value = $premium_value + $lossofuse;
					}
				$gov = $premium_value * $govtax / 100;
				$premium_value = $premium_value + $gov;
				if($vehicle_data['roadside_assistance'] != 'No')
					{
						$premium_value = $premium_value + $roadsideamt;
					}
				$premium_value = $premium_value;
				return $main_value = array('premium_value'=>$premium_value, 'sum_insured'=>$insureed_value);
			}
			if($user_age < 25 && $vehicle_age > 2 && $vehicle_data['engine_size'] == '1799')
			{
				  $results = $wpdb->get_results( 
                    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}insurance_values WHERE type_of_insurance ='".$insurnce_type."' AND age_option = 24 AND driving_age = 3 AND select_engine_size = ".$engine_size." AND select_type_of_use = '".$type_use."'") 
                 );
			    $results[0]->id;
				$sum_insured = $results[0]->sum_insured;
				$engine_size = $results[0]->engine_size;
				$loading = $results[0]->loading;
				$anti_theft = $results[0]->anti_theft_discount;
				$special_discount = $results[0]->special_discount;
				//$claimdiscount = $results[0]->ncd;
				$windshield = $results[0]->windscreen;
				$lossofuse = $results[0]->loss_of_use;
				$govtax = $results[0]->government_tax;
				$roadsideamt = $results[0]->motor_assist;
                $vehicle_value = str_replace( '$', '', $vehicle_data['vehicle_value'] );
                $vehicle_value = str_replace( ',', '', $vehicle_value );
				$insureed_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $premium_value + $engine_size;
				$loadingss = $premium_value * $loading /100;
				$premium_value = $premium_value + $loadingss;
				
				if($vehicle_data['anti_theft'] != 0)
					{
						$anti_theft = $premium_value * $anti_theft / 100;
						$premium_value = $premium_value - $anti_theft;
					}
				if($vehicle_data['additional_discount'] != 0)
					{
						$additional_discount = $premium_value * $special_discount / 100;
						$premium_value = $premium_value - $additional_discount;
					}
				if($vehicle_data['no_claim_discount'] != 0)
					{
						if($vehicle_data['no_claim_discount'] == 1)
						{
							$claimdiscount = 15;
						}
						if($vehicle_data['no_claim_discount'] == 2)
						{
							$claimdiscount = 20;
						}
						if($vehicle_data['no_claim_discount'] == 3)
						{
							$claimdiscount = 25;
						}
						if($vehicle_data['no_claim_discount'] == 4)
						{
							$claimdiscount = 35;
						}
						
						$no_claim_discount = $premium_value * $claimdiscount / 100;
						$premium_value = $premium_value - $no_claim_discount; 
					}
				if($vehicle_data['windshield_value'] != 'No')
					{
						$windscreen  = $vehicle_data['windshield_value'] * $windshield / 100;
						$premium_value = $premium_value + $windscreen;
					}
				if($vehicle_data['loss_of_use'] != 'No')
					{
						$premium_value = $premium_value + $lossofuse;
					}
				$gov = $premium_value * $govtax / 100;
				$premium_value = $premium_value + $gov;
				if($vehicle_data['roadside_assistance'] != 'No')
					{
						$premium_value = $premium_value + $roadsideamt;
					}
				$premium_value = $premium_value;
				return $main_value = array('premium_value'=>$premium_value, 'sum_insured'=>$insureed_value);
			}
			if($user_age > 25 && $vehicle_age < 2 && $vehicle_data['engine_size'] == '1799')
			{
				  $results = $wpdb->get_results( 
                    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}insurance_values WHERE type_of_insurance ='".$insurnce_type."' AND age_option = 26 AND driving_age = 1 AND select_engine_size = ".$engine_size." AND select_type_of_use = '".$type_use."'") 
                 );
			    $results[0]->id;
				$sum_insured = $results[0]->sum_insured;
				$engine_size = $results[0]->engine_size;
				$loading = $results[0]->loading;
				$anti_theft = $results[0]->anti_theft_discount;
				$special_discount = $results[0]->special_discount;
				//$claimdiscount = $results[0]->ncd;
				$windshield = $results[0]->windscreen;
				$lossofuse = $results[0]->loss_of_use;
				$govtax = $results[0]->government_tax;
				$roadsideamt = $results[0]->motor_assist;
                $vehicle_value = str_replace( '$', '', $vehicle_data['vehicle_value'] );
                $vehicle_value = str_replace( ',', '', $vehicle_value );
				$insureed_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $premium_value + $engine_size;
				$loadingss = $premium_value * $loading /100;
				$premium_value = $premium_value + $loadingss;
				
				if($vehicle_data['anti_theft'] != 0)
					{
						$anti_theft = $premium_value * $anti_theft / 100;
						$premium_value = $premium_value - $anti_theft;
					}
				if($vehicle_data['additional_discount'] != 0)
					{
						$additional_discount = $premium_value * $special_discount / 100;
						$premium_value = $premium_value - $additional_discount;
					}
				if($vehicle_data['no_claim_discount'] != 0)
					{
						if($vehicle_data['no_claim_discount'] == 1)
						{
							$claimdiscount = 15;
						}
						if($vehicle_data['no_claim_discount'] == 2)
						{
							$claimdiscount = 20;
						}
						if($vehicle_data['no_claim_discount'] == 3)
						{
							$claimdiscount = 25;
						}
						if($vehicle_data['no_claim_discount'] == 4)
						{
							$claimdiscount = 35;
						}
						
						$no_claim_discount = $premium_value * $claimdiscount / 100;
						$premium_value = $premium_value - $no_claim_discount; 
					}
				if($vehicle_data['windshield_value'] != 'No')
					{
						$windscreen  = $vehicle_data['windshield_value'] * $windshield / 100;
						$premium_value = $premium_value + $windscreen;
					}
				if($vehicle_data['loss_of_use'] != 'No')
					{
						$premium_value = $premium_value + $lossofuse;
					}
				$gov = $premium_value * $govtax / 100;
				$premium_value = $premium_value + $gov;
				if($vehicle_data['roadside_assistance'] != 'No')
					{
						$premium_value = $premium_value + $roadsideamt;
					}
				$premium_value = $premium_value;
				return $main_value = array('premium_value'=>$premium_value, 'sum_insured'=>$insureed_value);
			}
			
			if($user_age < 25 && $vehicle_age < 2 && $vehicle_data['engine_size'] == '1801')
			{
				  $results = $wpdb->get_results( 
                    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}insurance_values WHERE type_of_insurance ='".$insurnce_type."' AND age_option = 24 AND driving_age = 1 AND select_engine_size = ".$engine_size." AND select_type_of_use = '".$type_use."'") 
                 );
			    $results[0]->id;
				$sum_insured = $results[0]->sum_insured;
				$engine_size = $results[0]->engine_size;
				$loading = $results[0]->loading;
				$anti_theft = $results[0]->anti_theft_discount;
				$special_discount = $results[0]->special_discount;
				//$claimdiscount = $results[0]->ncd;
				$windshield = $results[0]->windscreen;
				$lossofuse = $results[0]->loss_of_use;
				$govtax = $results[0]->government_tax;
				$roadsideamt = $results[0]->motor_assist;
                $vehicle_value = str_replace( '$', '', $vehicle_data['vehicle_value'] );
                $vehicle_value = str_replace( ',', '', $vehicle_value );
				$insureed_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $premium_value + $engine_size;
				$loadingss = $premium_value * $loading /100;
				$premium_value = $premium_value + $loadingss;
				
				if($vehicle_data['anti_theft'] != 0)
					{
						$anti_theft = $premium_value * $anti_theft / 100;
						$premium_value = $premium_value - $anti_theft;
					}
				if($vehicle_data['additional_discount'] != 0)
					{
						$additional_discount = $premium_value * $special_discount / 100;
						$premium_value = $premium_value - $additional_discount;
					}
				if($vehicle_data['no_claim_discount'] != 0)
					{
						if($vehicle_data['no_claim_discount'] == 1)
						{
							$claimdiscount = 15;
						}
						if($vehicle_data['no_claim_discount'] == 2)
						{
							$claimdiscount = 20;
						}
						if($vehicle_data['no_claim_discount'] == 3)
						{
							$claimdiscount = 25;
						}
						if($vehicle_data['no_claim_discount'] == 4)
						{
							$claimdiscount = 35;
						}
						
						$no_claim_discount = $premium_value * $claimdiscount / 100;
						$premium_value = $premium_value - $no_claim_discount; 
					}
				if($vehicle_data['windshield_value'] != 'No')
					{
						$windscreen  = $vehicle_data['windshield_value'] * $windshield / 100;
						$premium_value = $premium_value + $windscreen;
					}
				if($vehicle_data['loss_of_use'] != 'No')
					{
						$premium_value = $premium_value + $lossofuse;
					}
				$gov = $premium_value * $govtax / 100;
				$premium_value = $premium_value + $gov;
				if($vehicle_data['roadside_assistance'] != 'No')
					{
						$premium_value = $premium_value + $roadsideamt;
					}
				$premium_value = $premium_value;
				return $main_value = array('premium_value'=>$premium_value, 'sum_insured'=>$insureed_value);
			}
			if($user_age < 25 && $vehicle_age > 2 && $vehicle_data['engine_size'] == '1801')
			{
				  $results = $wpdb->get_results( 
                    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}insurance_values WHERE type_of_insurance ='".$insurnce_type."' AND age_option = 24 AND driving_age = 3 AND select_engine_size = ".$engine_size." AND select_type_of_use = '".$type_use."'") 
                 );
			    $results[0]->id;
				$sum_insured = $results[0]->sum_insured;
				$engine_size = $results[0]->engine_size;
				$loading = $results[0]->loading;
				$anti_theft = $results[0]->anti_theft_discount;
				$special_discount = $results[0]->special_discount;
				//$claimdiscount = $results[0]->ncd;
				$windshield = $results[0]->windscreen;
				$lossofuse = $results[0]->loss_of_use;
				$govtax = $results[0]->government_tax;
				$roadsideamt = $results[0]->motor_assist;
                $vehicle_value = str_replace( '$', '', $vehicle_data['vehicle_value'] );
                $vehicle_value = str_replace( ',', '', $vehicle_value );
				$insureed_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $premium_value + $engine_size;
				$loadingss = $premium_value * $loading /100;
				$premium_value = $premium_value + $loadingss;
				
				if($vehicle_data['anti_theft'] != 0)
					{
						$anti_theft = $premium_value * $anti_theft / 100;
						$premium_value = $premium_value - $anti_theft;
					}
				if($vehicle_data['additional_discount'] != 0)
					{
						$additional_discount = $premium_value * $special_discount / 100;
						$premium_value = $premium_value - $additional_discount;
					}
				if($vehicle_data['no_claim_discount'] != 0)
					{
						if($vehicle_data['no_claim_discount'] == 1)
						{
							$claimdiscount = 15;
						}
						if($vehicle_data['no_claim_discount'] == 2)
						{
							$claimdiscount = 20;
						}
						if($vehicle_data['no_claim_discount'] == 3)
						{
							$claimdiscount = 25;
						}
						if($vehicle_data['no_claim_discount'] == 4)
						{
							$claimdiscount = 35;
						}
						
						$no_claim_discount = $premium_value * $claimdiscount / 100;
						$premium_value = $premium_value - $no_claim_discount; 
					}
				if($vehicle_data['windshield_value'] != 'No')
					{
						$windscreen  = $vehicle_data['windshield_value'] * $windshield / 100;
						$premium_value = $premium_value + $windscreen;
					}
				if($vehicle_data['loss_of_use'] != 'No')
					{
						$premium_value = $premium_value + $lossofuse;
					}
				$gov = $premium_value * $govtax / 100;
				$premium_value = $premium_value + $gov;
				if($vehicle_data['roadside_assistance'] != 'No')
					{
						$premium_value = $premium_value + $roadsideamt;
					}
				$premium_value = $premium_value;
				return $main_value = array('premium_value'=>$premium_value, 'sum_insured'=>$insureed_value);
			}
			if($user_age > 25 && $vehicle_age < 2 && $vehicle_data['engine_size'] == '1801')
			{
				  $results = $wpdb->get_results( 
                    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}insurance_values WHERE type_of_insurance ='".$insurnce_type."' AND age_option = 26 AND driving_age = 1 AND select_engine_size = ".$engine_size." AND select_type_of_use = '".$type_use."'") 
                 );
			    $results[0]->id;
				$sum_insured = $results[0]->sum_insured;
				$engine_size = $results[0]->engine_size;
				$loading = $results[0]->loading;
				$anti_theft = $results[0]->anti_theft_discount;
				$special_discount = $results[0]->special_discount;
				//$claimdiscount = $results[0]->ncd;
				$windshield = $results[0]->windscreen;
				$lossofuse = $results[0]->loss_of_use;
				$govtax = $results[0]->government_tax;
				$roadsideamt = $results[0]->motor_assist;
                $vehicle_value = str_replace( '$', '', $vehicle_data['vehicle_value'] );
                $vehicle_value = str_replace( ',', '', $vehicle_value );
				$insureed_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $premium_value + $engine_size;
				$loadingss = $premium_value * $loading /100;
				$premium_value = $premium_value + $loadingss;
				
				if($vehicle_data['anti_theft'] != 0)
					{
						$anti_theft = $premium_value * $anti_theft / 100;
						$premium_value = $premium_value - $anti_theft;
					}
				if($vehicle_data['additional_discount'] != 0)
					{
						$additional_discount = $premium_value * $special_discount / 100;
						$premium_value = $premium_value - $additional_discount;
					}
				if($vehicle_data['no_claim_discount'] != 0)
					{
						if($vehicle_data['no_claim_discount'] == 1)
						{
							$claimdiscount = 15;
						}
						if($vehicle_data['no_claim_discount'] == 2)
						{
							$claimdiscount = 20;
						}
						if($vehicle_data['no_claim_discount'] == 3)
						{
							$claimdiscount = 25;
						}
						if($vehicle_data['no_claim_discount'] == 4)
						{
							$claimdiscount = 35;
						}
						
						$no_claim_discount = $premium_value * $claimdiscount / 100;
						$premium_value = $premium_value - $no_claim_discount; 
					}
				if($vehicle_data['windshield_value'] != 'No')
					{
						$windscreen  = $vehicle_data['windshield_value'] * $windshield / 100;
						$premium_value = $premium_value + $windscreen;
					}
				if($vehicle_data['loss_of_use'] != 'No')
					{
						$premium_value = $premium_value + $lossofuse;
					}
				$gov = $premium_value * $govtax / 100;
				$premium_value = $premium_value + $gov;
				if($vehicle_data['roadside_assistance'] != 'No')
					{
						$premium_value = $premium_value + $roadsideamt;
					}
				$premium_value = $premium_value;
				return $main_value = array('premium_value'=>$premium_value, 'sum_insured'=>$insureed_value);
			}
			}
		
		
		if($vehicle_data['type_of_insurance'] == 'Third Party')
		{
			$insurnce_type = $vehicle_data['type_of_insurance'];
			$engine_size = $vehicle_data['engine_size'];
			$type_use = $vehicle_data['type_of_use'];
			$dob = $vehicle_data['date_of_birth'];
			$dpdate = $vehicle_data['dp_issue'];
            $vehicle_age = $vehicle_data['dp_issue'];
			$premium_value = 0;
			list($day,$month,$year) = explode("-",$dob);
			$user_age = date("Y") - $year;
			/*list($day,$month,$year) = explode("/",$dpdate);
			$vehicle_age = date("Y") - $year;*/
			if($user_age < 25 && $vehicle_age < 2 && $vehicle_data['engine_size'] == '1799')
			{
				  $results = $wpdb->get_results( 
                    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}insurance_values WHERE type_of_insurance ='".$insurnce_type."' AND age_option = 24 AND driving_age = 1 AND select_engine_size = ".$engine_size." AND select_type_of_use = '".$type_use."'") 
                 );
			    $results[0]->id;
				$sum_insured = $results[0]->sum_insured;
				$engine_size = $results[0]->engine_size;
				$loading = $results[0]->loading;
				$anti_theft = $results[0]->anti_theft_discount;
				$special_discount = $results[0]->special_discount;
				//$claimdiscount = $results[0]->ncd;
				$windshield = $results[0]->windscreen;
				$lossofuse = $results[0]->loss_of_use;
				$govtax = $results[0]->government_tax;
				$roadsideamt = $results[0]->motor_assist;
                $vehicle_value = str_replace( '$', '', $vehicle_data['vehicle_value'] );
                $vehicle_value = str_replace( ',', '', $vehicle_value );
				$insureed_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $premium_value + $engine_size;
				$loadingss = $premium_value * $loading / 100;
				$premium_value = $premium_value + $loadingss;
				
				if($vehicle_data['additional_discount'] != 0)
					{
						$additional_discount = $premium_value * $special_discount / 100;
						$premium_value = $premium_value - $additional_discount;
					}
				 $gov = $premium_value * $govtax / 100;
				 $premium_value = $premium_value + $gov;
				if($vehicle_data['roadside_assistance'] != 'No')
					{
						$premium_value = $premium_value + $roadsideamt;
					}
				$premium_value = $premium_value;
				return $main_value = array('premium_value'=>$premium_value, 'sum_insured'=>$insureed_value);
			}
			
			if($user_age < 25 && $vehicle_age > 2 && $vehicle_data['engine_size'] == '1799')
			{
				  $results = $wpdb->get_results( 
                    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}insurance_values WHERE type_of_insurance ='".$insurnce_type."' AND age_option = 24 AND driving_age = 3 AND select_engine_size = ".$engine_size." AND select_type_of_use = '".$type_use."'") 
                 );
			    $results[0]->id;
				$sum_insured = $results[0]->sum_insured;
				$engine_size = $results[0]->engine_size;
				$loading = $results[0]->loading;
				$anti_theft = $results[0]->anti_theft_discount;
				$special_discount = $results[0]->special_discount;
				//$claimdiscount = $results[0]->ncd;
				$windshield = $results[0]->windscreen;
				$lossofuse = $results[0]->loss_of_use;
				$govtax = $results[0]->government_tax;
				$roadsideamt = $results[0]->motor_assist;
                $vehicle_value = str_replace( '$', '', $vehicle_data['vehicle_value'] );
                $vehicle_value = str_replace( ',', '', $vehicle_value );
				$insureed_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $premium_value + $engine_size;
				$loadingss = $premium_value * $loading / 100;
				$premium_value = $premium_value + $loadingss;
				
				if($vehicle_data['additional_discount'] != 0)
					{
						$additional_discount = $premium_value * $special_discount / 100;
						$premium_value = $premium_value - $additional_discount;
					}
				 $gov = $premium_value * $govtax / 100;
				 $premium_value = $premium_value + $gov;
				if($vehicle_data['roadside_assistance'] != 'No')
					{
						$premium_value = $premium_value + $roadsideamt;
					}
				$premium_value = $premium_value;
				return $main_value = array('premium_value'=>$premium_value, 'sum_insured'=>$insureed_value);
			}
			if($user_age > 25 && $vehicle_age < 2 && $vehicle_data['engine_size'] == '1799')
			{
				  $results = $wpdb->get_results( 
                    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}insurance_values WHERE type_of_insurance ='".$insurnce_type."' AND age_option = 26 AND driving_age = 1 AND select_engine_size = ".$engine_size." AND select_type_of_use = '".$type_use."'") 
                 );
			    $results[0]->id;
				$sum_insured = $results[0]->sum_insured;
				$engine_size = $results[0]->engine_size;
				$loading = $results[0]->loading;
				$anti_theft = $results[0]->anti_theft_discount;
				$special_discount = $results[0]->special_discount;
				//$claimdiscount = $results[0]->ncd;
				$windshield = $results[0]->windscreen;
				$lossofuse = $results[0]->loss_of_use;
				$govtax = $results[0]->government_tax;
				$roadsideamt = $results[0]->motor_assist;
                $vehicle_value = str_replace( '$', '', $vehicle_data['vehicle_value'] );
                $vehicle_value = str_replace( ',', '', $vehicle_value );
				$insureed_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $premium_value + $engine_size;
				$loadingss = $premium_value * $loading / 100;
				$premium_value = $premium_value + $loadingss;
				
				if($vehicle_data['additional_discount'] != 0)
					{
						$additional_discount = $premium_value * $special_discount / 100;
						$premium_value = $premium_value - $additional_discount;
					}
				 $gov = $premium_value * $govtax / 100;
				 $premium_value = $premium_value + $gov;
				if($vehicle_data['roadside_assistance'] != 'No')
					{
						$premium_value = $premium_value + $roadsideamt;
					}
				$premium_value = $premium_value;
				return $main_value = array('premium_value'=>$premium_value, 'sum_insured'=>$insureed_value);
			}
			
			if($user_age < 25 && $vehicle_age < 2 && $vehicle_data['engine_size'] == '1801')
			{
				  $results = $wpdb->get_results( 
                    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}insurance_values WHERE type_of_insurance ='".$insurnce_type."' AND age_option = 24 AND driving_age = 1 AND select_engine_size = ".$engine_size." AND select_type_of_use = '".$type_use."'") 
                 );
			    $results[0]->id;
				$sum_insured = $results[0]->sum_insured;
				$engine_size = $results[0]->engine_size;
				$loading = $results[0]->loading;
				$anti_theft = $results[0]->anti_theft_discount;
				$special_discount = $results[0]->special_discount;
				//$claimdiscount = $results[0]->ncd;
				$windshield = $results[0]->windscreen;
				$lossofuse = $results[0]->loss_of_use;
				$govtax = $results[0]->government_tax;
				$roadsideamt = $results[0]->motor_assist;
                $vehicle_value = str_replace( '$', '', $vehicle_data['vehicle_value'] );
                $vehicle_value = str_replace( ',', '', $vehicle_value );
				$insureed_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $premium_value + $engine_size;
				$loadingss = $premium_value * $loading / 100;
				$premium_value = $premium_value + $loadingss;
				
				if($vehicle_data['additional_discount'] != 0)
					{
						$additional_discount = $premium_value * $special_discount / 100;
						$premium_value = $premium_value - $additional_discount;
					}
				 $gov = $premium_value * $govtax / 100;
				 $premium_value = $premium_value + $gov;
				if($vehicle_data['roadside_assistance'] != 'No')
					{
						$premium_value = $premium_value + $roadsideamt;
					}
				$premium_value = $premium_value;
				return $main_value = array('premium_value'=>$premium_value, 'sum_insured'=>$insureed_value);
			}
			
			if($user_age < 25 && $vehicle_age > 2 && $vehicle_data['engine_size'] == '1801')
			{
				  $results = $wpdb->get_results( 
                    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}insurance_values WHERE type_of_insurance ='".$insurnce_type."' AND age_option = 24 AND driving_age = 3 AND select_engine_size = ".$engine_size." AND select_type_of_use = '".$type_use."'") 
                 );
			    $results[0]->id;
				$sum_insured = $results[0]->sum_insured;
				$engine_size = $results[0]->engine_size;
				$loading = $results[0]->loading;
				$anti_theft = $results[0]->anti_theft_discount;
				$special_discount = $results[0]->special_discount;
				//$claimdiscount = $results[0]->ncd;
				$windshield = $results[0]->windscreen;
				$lossofuse = $results[0]->loss_of_use;
				$govtax = $results[0]->government_tax;
				$roadsideamt = $results[0]->motor_assist;
                $vehicle_value = str_replace( '$', '', $vehicle_data['vehicle_value'] );
                $vehicle_value = str_replace( ',', '', $vehicle_value );
				$insureed_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $vehicle_value * $sum_insured / 100;
				$premium_value = $premium_value + $engine_size;
				$loadingss = $premium_value * $loading / 100;
				$premium_value = $premium_value + $loadingss;
				
				if($vehicle_data['additional_discount'] != 0)
					{
						$additional_discount = $premium_value * $special_discount / 100;
						$premium_value = $premium_value - $additional_discount;
					}
				 $gov = $premium_value * $govtax / 100;
				 $premium_value = $premium_value + $gov;
				if($vehicle_data['roadside_assistance'] != 'No')
					{
						$premium_value = $premium_value + $roadsideamt;
					}
				$premium_value = $premium_value;
				return $main_value = array('premium_value'=>$premium_value, 'sum_insured'=>$insureed_value);
			}
			if($user_age > 25 && $vehicle_age < 2 && $vehicle_data['engine_size'] == '1801')
			{
				  $results = $wpdb->get_results( 
                    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}insurance_values WHERE type_of_insurance ='".$insurnce_type."' AND age_option = 26 AND driving_age = 1 AND select_engine_size = ".$engine_size." AND select_type_of_use = '".$type_use."'") 
                 );
			    $results[0]->id;
				$sum_insured = $results[0]->sum_insured;
				$engine_size = $results[0]->engine_size;
				$loading = $results[0]->loading;
				$anti_theft = $results[0]->anti_theft_discount;
				$special_discount = $results[0]->special_discount;
				//$claimdiscount = $results[0]->ncd;
				$windshield = $results[0]->windscreen;
				$lossofuse = $results[0]->loss_of_use;
				$govtax = $results[0]->government_tax;
				$roadsideamt = $results[0]->motor_assist;
                $vehicle_value = str_replace( '$', '', $vehicle_data['vehicle_value'] );
                $vehicle_value = str_replace( ',', '', $vehicle_value );
				$insureed_value = $vehicle_data['vehicle_value'] * $sum_insured / 100;
				$premium_value = $vehicle_data['vehicle_value'] * $sum_insured / 100;
				$premium_value = $premium_value + $engine_size;
				$loadingss = $premium_value * $loading / 100;
				$premium_value = $premium_value + $loadingss;
				
				if($vehicle_data['additional_discount'] != 0)
					{
						$additional_discount = $premium_value * $special_discount / 100;
						$premium_value = $premium_value - $additional_discount;
					}
				 $gov = $premium_value * $govtax / 100;
				 $premium_value = $premium_value + $gov;
				if($vehicle_data['roadside_assistance'] != 'No')
					{
						$premium_value = $premium_value + $roadsideamt;
					}
				$premium_value = $premium_value;
				return $main_value = array('premium_value'=>$premium_value, 'sum_insured'=>$insureed_value);
			}
			}
		
	}
	
function jr_export_data()
{
		if(isset($_POST["export"])&& $_POST['export']=='Export')
		{
			global $wpdb;		
			$MyQuery = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."insurance_data");
			
			// Process report request
			if (! $MyQuery) {
				$Error = $wpdb->print_error();
				die("The following error was found: $Error");
			} 
			else {
			$date = date("d-m-Y");
			$csv_fields = array('First Name','Last Name','Occupation','E-mail','Phone','Date of Birth','Dp Issue','Vehicle Registration Number','Make Eg Toyota'           
		,'Model Eg Corolla'                 
		,'Vehicle Value'         
		,'Is The Vehicle'     
		,'Engine Size'   
		,'Type of Insurance'       
		,'Type of use'               
		,'Vehicle Year of Manufacture'    
		,'Have You Had Any Claims'         
		,'Type of Vehicle'        
		,'No Claim Discount'  
		,'Additional Discount'         
		,'Anti Theft'               
		,'Windshield Value'        
		,'Additional Young Driver'
		,'Loss of Use'
		,'Personal Accident Benefit'          
		,'Roadside Assistance');
			
			$output_filename = 'Report_'.$date.'.csv';
			$output_handle = @fopen( 'php://output', 'w' );
			 
			header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
			header( 'Content-Description: File Transfer' );
			header( 'Content-type: text/csv' );
			header( 'Content-Disposition: attachment; filename=' . $output_filename );
			header( 'Expires: 0' );
			header( 'Pragma: public' );	
			
			// Insert header row
			fputcsv( $output_handle, $csv_fields );
			
			// Parse results to csv format
			foreach ($MyQuery as $Result) 
			{
				unset($Result->id);
				$leadArray = (array) $Result; // Cast the Object to an array
				// Add row to file
				fputcsv( $output_handle, $leadArray );
			} 
			// Close output file stream
			fclose( $output_handle );  
			die(); 
			} 
}
}
add_action('init','jr_export_data');

add_action( 'wp_ajax_insurance_quote', 'insurance_quote_result' );
add_action( 'wp_ajax_nopriv_insurance_quote', 'insurance_quote_result' );

function insurance_quote_result()
{
	global $wpdb;
	parse_str($_POST['dataform'], $insurdata);
	$firstname = $insurdata['firstname'];
    $lastname = $insurdata['lastname'];
    $home_no = $insurdata['home_no'];
    $mobile_no = $insurdata['mobile_no'];
    $email = $insurdata['email'];
    $address = $insurdata['address'];
	$flooding = $insurdata['flooding'];
	$water_levels = $insurdata['water_levels'];
	$buildings = $insurdata['buildings'];
	$property = $insurdata['property']; 
	 
	$admin_mail = "rampersad.justin@gmail.com";
	//$admin_mail = "testkudosta@gmail.com";
	$to = $admin_mail;
    $subject = "Property Insurance Quote";
    $name = $firstname." ".$lastname;   
	
    $message .= "<strong>Name :</strong> ".$name." <br/>
					<strong>Home Number :</strong> ".$home_no." <br/>
					<strong>Mobile Number :</strong>  ".$mobile_no." <br/> 
					<strong>Email Address :</strong>  ".$email." <br/>
					<strong>Address of property to be insured :</strong>  ".$address." <br/>
					<strong>Is this area prone to flooding? :</strong>  ".$flooding." <br/>
					<strong>Is the property within 100 feet of the high water levels? :</strong>  ".$water_levels."<br/> 
					<strong>Is the property within 12 feet of any other buildings? :</strong>  ".$buildings.'<br/>
					<strong>What is the value of the property? :</strong> '.$property;
          
	$headers[] = 'From: '.$name.' <'.$email.'>';
	$headers[] .= "cc: nigel.kangalee@gmail.com,oliviaelkhoury@gmail.com";
 	array_push($headers, "Content-type: text/html;" );
	$retval = wp_mail($to,$subject,$message,$headers);
	    
    if( $retval == true ) 
	{
		quote_customer_mail($name, $email);
		$mail_suc = "success";     
    }
	else 
	{
        $mail_suc = "fail"; 
    }
	echo $mail_suc;
	exit;
 	
}
  
function quote_customer_mail($name = '', $email = '')
{ 
	$to = $email;
    $subject = "Property Insurance Quote"; 
    
	$message .= 'Hello '.$name.'<br/><br/>
				Thank you for submitting our Property Insurance Form.
				We will respond with 24 Hours with your quote.<br/><br/>Please note that this quote is subject to change upon verification of details and validation of documentation by our Customer
				Services Representative. Please call <a href="tel:1-868-388-8888">1-868-388-8888</a> or e-mail <a href="mailto:info@jrcoltd.com">info@jrcoltd.com.';
    
	$headers[] = 'From: <instantquote@jrcoltd.com >'; 
 	array_push($headers, "Content-type: text/html;" );
	    
    $retval = wp_mail($to,$subject,$message,$headers);
}  