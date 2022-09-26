<?php

if ( ! class_exists( 'agentpro_founders_post_type' ) ) { 
    class agentpro_founders_post_type {
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
                'name'                => _x( 'Founders', 'Post Type General Name', 'Agent Pro' ),
                'singular_name'       => _x( 'Founders', 'Post Type Singular Name', 'Agent Pro' ),
                'menu_name'           => __( 'Founders', 'Agent Pro' ),
                'name_admin_bar'      => __( 'Founder', 'Agent Pro' ),
                'parent_item_colon'   => __( 'Parent Item:', 'Agent Pro' ),
                'all_items'           => __( 'All Founders', 'Agent Pro' ),
                'add_new_item'        => __( 'Add New Founder', 'Agent Pro' ),
                'add_new'             => __( 'Add New', 'Agent Pro' ),
                'new_item'            => __( 'New Founder', 'Agent Pro' ),
                'edit_item'           => __( 'Edit Founder', 'Agent Pro' ),
                'update_item'         => __( 'Update Founder', 'Agent Pro' ),
                'view_item'           => __( 'View Founder', 'Agent Pro' ),
                'search_items'        => __( 'Search Founder', 'Agent Pro' ),
                'not_found'           => __( 'No Founders Found', 'Agent Pro' ),
                'not_found_in_trash'  => __( 'No Founders Found in Trash', 'Agent Pro' ),
            );

            $args = array(
                'label'               => __( 'founder', 'Agent Pro' ),
                'description'         => __( 'custom post type for Agent Pro community', 'Agent Pro' ),
                'labels'              => $labels,
                'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes', ),
                'taxonomies'          => array( ),
                'hierarchical'        => false,
                'public'              => true,
                'menu_position'       => '4.3',
                'menu_icon'           => 'dashicons-admin-users',
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

            register_post_type( 'founders', $args );
            //update permalinks
            flush_rewrite_rules();
        }

        function enqueque_scripts() {

            if ( is_post_type_archive( 'founders' ) ) {
                wp_enqueue_style( 'founders-archive', get_stylesheet_directory_uri() . '/modules/founders-post-type/css/founders-archive.css' );
                wp_enqueue_style( 'founders-archive', get_stylesheet_directory_uri() . '/modules/founders-post-type/css/founders-archive.css' );

            }

            if ( is_singular( 'founders' ) ) {
                wp_enqueue_style( 'founders-single', get_stylesheet_directory_uri() . '/modules/founders-post-type/css/founders-single.css' );
            }
        }

    }

    $agentpro_founders_post_type = new agentpro_founders_post_type();

}
