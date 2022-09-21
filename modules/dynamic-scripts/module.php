<?php

/**
*
* Requires the specific css/js of the page or post by `POST ID`/`TEMPLATE NAME` 
* inside the `theme_directory > css/js > custom-page` folder directory
*
*/

if ( ! function_exists( 'aios_starter_theme_require_child_specific_scripts' ) ) {
    
    function aios_starter_theme_require_child_specific_scripts () {
        
        // Template Path
        $template_path = get_stylesheet_directory();
        
        // Creates the css and js folder for this plugin
        if (!is_dir($template_path . '/css/custom-page')) {
            mkdir($template_path . '/css/custom-page', 0775, true);
        }
        if (!is_dir($template_path . '/js/custom-page')) {
            mkdir($template_path . '/js/custom-page', 0775, true);
        }
        
        // Disable on Homepage
        // if ( is_home() || is_front_page() || is_page_template( 'template-homepage.php' ) ) return false;
        
        // Gets the current ID of the post/page
        $post_id = get_the_ID();
        
        // Creates the CSS file directory by the given ID
        if ( is_page_template() ) {
            // Get Template Name
            $template_name = basename( get_page_template( $post_id ) );
            $template_name = str_replace( '.php', '', $template_name );
                
            $css_path = get_stylesheet_directory() . '/css/custom-page/' .  $template_name . '.css';
            $css_path_uri = get_stylesheet_directory_uri() . '/css/custom-page/' .  $template_name . '.css';
        }
        else {
            $css_path = get_stylesheet_directory() . '/css/custom-page/post-' . $post_id . '.css';
            $css_path_uri = get_stylesheet_directory_uri() . '/css/custom-page/post-' . $post_id . '.css';
        }
        
        // Checks if the css file exists on the CSS Path
        if ( file_exists( $css_path ) ) {
            // Enqueue the specific css if the file exists
            wp_enqueue_style( 'custom-style-' . $template_name, $css_path_uri );
        }
        
        // Creates the JS file directory by the given ID
        if ( is_page_template() ) {
            // Get Template Name
            $template_name = basename( get_page_template( $post_id ) );
            $template_name = str_replace( '.php', '', $template_name );
                
            $js_path = get_stylesheet_directory() . '/js/custom-page/' . $template_name . '.js';
            $js_path_uri = get_stylesheet_directory_uri() . '/js/custom-page/' . $template_name . '.js';
        }
        else {
            $js_path = get_stylesheet_directory() . '/js/custom-page/post-' . $post_id . '.js';
            $js_path_uri = get_stylesheet_directory_uri() . '/js/custom-page/post-' . $post_id . '.js';
        }
        
        // Checks if the JS file exists on the CSS Path
        if ( file_exists( $js_path ) ) {
            // Enqueue the specific css if the file exists
            wp_enqueue_script( 'custom-script-' . $template_name, $js_path_uri );
        }
    }
    
    add_action( 'wp_enqueue_scripts', 'aios_starter_theme_require_child_specific_scripts', PHP_INT_MAX );
}