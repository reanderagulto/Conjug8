<?php

if ( ! class_exists( 'agentpro_events_post_type' ) ) { 
    class agentpro_events_post_type {
        /* 
        *
        * Function Name: __construct() 
        *
        */
        function __construct() {
            add_action( 'init', array( $this, 'register_post_type' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueque_scripts'), 15 );        
        }

        /* 
        *
        * Function Name: register_post_type() 
        *
        */
        function register_post_type(){
            $labels = array(
                'name'                => _x( 'Events', 'Post Type General Name', 'Agent Pro' ),
                'singular_name'       => _x( 'Events', 'Post Type Singular Name', 'Agent Pro' ),
                'menu_name'           => __( 'Conjug8 Events', 'Agent Pro' ),
                'name_admin_bar'      => __( 'Conjug8 Event', 'Agent Pro' ),
                'parent_item_colon'   => __( 'Parent Item:', 'Agent Pro' ),
                'all_items'           => __( 'All Conjug8 Events', 'Agent Pro' ),
                'add_new_item'        => __( 'Add New Event', 'Agent Pro' ),
                'add_new'             => __( 'Add New', 'Agent Pro' ),
                'new_item'            => __( 'New Event', 'Agent Pro' ),
                'edit_item'           => __( 'Edit Event', 'Agent Pro' ),
                'update_item'         => __( 'Update Event', 'Agent Pro' ),
                'view_item'           => __( 'View Event', 'Agent Pro' ),
                'search_items'        => __( 'Search Event', 'Agent Pro' ),
                'not_found'           => __( 'No Events Found', 'Agent Pro' ),
                'not_found_in_trash'  => __( 'No Events Found in Trash', 'Agent Pro' ),
            );

            $args = array(
                'label'               => __( 'Events', 'Agent Pro' ),
                'description'         => __( 'custom post type for Agent Pro Events', 'Agent Pro' ),
                'labels'              => $labels,
                'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes', ),
                'taxonomies'          => array( ),
                'hierarchical'        => false,
                'public'              => true,
                'menu_position'       => '4.4',
                'menu_icon'           => 'dashicons-calendar-alt',
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_admin_bar'   => true,
                'show_in_nav_menus'   => true,
                'can_export'          => true,
                'has_archive'         => true,		
                'publicly_queryable'  => true,
                'exclude_from_search' => false,
                'capability_type'     => 'post'
            );

            register_post_type( 'events', $args );
            //update permalinks
            flush_rewrite_rules();
        }

        function enqueque_scripts() {

            if ( is_post_type_archive( 'events' ) ) {
                wp_enqueue_style( 'events-archive', get_stylesheet_directory_uri() . '/modules/events-post-type/css/events-archive.css' );
                wp_enqueue_style( 'events-archive', get_stylesheet_directory_uri() . '/modules/events-post-type/css/events-archive.css' );

            }

            if ( is_singular( 'events' ) ) {
                wp_enqueue_style( 'events-single', get_stylesheet_directory_uri() . '/modules/events-post-type/css/events-single.css' );
                wp_enqueue_script( 'events-single', get_stylesheet_directory_uri() . '/modules/events-post-type/js/events-single.js' );
            }
        }

    }

    $agentpro_events_post_type = new agentpro_events_post_type();

}

// fallback require for shortcodes.php
// if ( ! class_exists( 'agentpro_events_shortcodes' ) && file_exists( __DIR__ . '/shortcodes.php' ) ) {
//     require_once( __DIR__ . '/shortcodes.php' );
// }
