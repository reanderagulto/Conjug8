<?php

if ( ! class_exists( 'agentpro_board_members_post_type' ) ) { 
    class agentpro_board_members_post_type {
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
                'name'                => _x( 'Board Members', 'Post Type General Name', 'Agent Pro' ),
                'singular_name'       => _x( 'Board Members', 'Post Type Singular Name', 'Agent Pro' ),
                'menu_name'           => __( 'Conjug8 Board Members', 'Agent Pro' ),
                'name_admin_bar'      => __( 'Conjug8 Board Member', 'Agent Pro' ),
                'parent_item_colon'   => __( 'Parent Item:', 'Agent Pro' ),
                'all_items'           => __( 'All Board Members', 'Agent Pro' ),
                'add_new_item'        => __( 'Add New Board Member', 'Agent Pro' ),
                'add_new'             => __( 'Add New', 'Agent Pro' ),
                'new_item'            => __( 'New Board Member', 'Agent Pro' ),
                'edit_item'           => __( 'Edit Board Member', 'Agent Pro' ),
                'update_item'         => __( 'Update Board Member', 'Agent Pro' ),
                'view_item'           => __( 'View Board Member', 'Agent Pro' ),
                'search_items'        => __( 'Search Board Member', 'Agent Pro' ),
                'not_found'           => __( 'No Board Members Found', 'Agent Pro' ),
                'not_found_in_trash'  => __( 'No Board Members Found in Trash', 'Agent Pro' ),
            );

            $args = array(
                'label'               => __( 'board-members', 'Agent Pro' ),
                'description'         => __( 'custom post type for Agent Pro Board Members', 'Agent Pro' ),
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

            register_post_type( 'board-members', $args );
            //update permalinks
            flush_rewrite_rules();
        }

        function enqueque_scripts() {

            if ( is_post_type_archive( 'board-members' ) ) {
                wp_enqueue_style( 'board-members-archive', get_stylesheet_directory_uri() . '/modules/board-members-post-type/css/board-members-archive.css' );
                wp_enqueue_style( 'board-members-archive', get_stylesheet_directory_uri() . '/modules/board-members-post-type/css/board-members-archive.css' );

            }

            if ( is_singular( 'board-members' ) ) {
                wp_enqueue_style( 'board-members-single', get_stylesheet_directory_uri() . '/modules/board-members-post-type/css/board-members-single.css' );
            }
        }

    }

    $agentpro_board_members_post_type = new agentpro_board_members_post_type();

}

// fallback require for shortcodes.php
if ( ! class_exists( 'agentpro_board_members_shortcodes' ) && file_exists( __DIR__ . '/shortcodes.php' ) ) {
    require_once( __DIR__ . '/shortcodes.php' );
}
