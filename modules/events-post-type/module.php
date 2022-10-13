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
            
            // Ajax Functions
            add_action('wp_ajax_completed_events', array($this, 'completed_events'));
            add_action('wp_ajax_nopriv_completed_events', array($this, 'completed_events'));

            add_action('wp_ajax_upcoming_events', array($this, 'upcoming_events'));
            add_action('wp_ajax_nopriv_upcoming_events', array($this, 'upcoming_events'));

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
                wp_enqueue_script( 'events-archive', get_stylesheet_directory_uri() . '/modules/events-post-type/js/events-archive.js' );

            }

            if ( is_singular( 'events' ) ) {
                wp_enqueue_style( 'events-single', get_stylesheet_directory_uri() . '/modules/events-post-type/css/events-single.css' );
                wp_enqueue_script( 'events-single', get_stylesheet_directory_uri() . '/modules/events-post-type/js/events-single.js' );
            }
        }

        function completed_events() {
            $ajaxposts = new WP_Query([
                'post_type'      => 'events',
                'post_status'    => 'publish',
                'order'          => 'DESC',
                'orderby'        => 'date',
                'offset'         => $_POST['offset'],
                'posts_per_page' => 3,
                'date_query'     => array(
                    //set date ranges with strings!
                    'before'     => 'today',
                    //allow exact matches to be returned
                    'inclusive' => true,
                ),
            ]);

            $max_pages = $ajaxposts->max_num_pages;
            if($ajaxposts->have_posts()): 
                while($ajaxposts->have_posts()): $ajaxposts->the_post(); ?>
                    <div class="completed-events" data-aos="fade-up" data-aos-once="true">
                        <input type="hidden" id="completed-events" value="<?php echo $max_pages; ?>" />
                        <a href="<?php the_permalink(); ?>">
                            <div class="completed-event-container flex items-center justify-center">
                                <div class="img-container">
                                    <canvas width="136" height="117"></canvas>
                                    <img src="<?php the_post_thumbnail_url('full')?>" alt="<?php the_title(); ?>" width="136" height="117" />
                                </div>
                                <div class="events-content">
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php echo get_the_date( 'F j, Y', get_the_ID() ); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endwhile;
            endif; 
            wp_die();
        }

        function upcoming_events() {
            $ajaxposts = new WP_Query([
                'post_type'      => 'events',
                'post_status'    => 'future',
                'order'          => 'DESC',
                'orderby'        => 'date',
                'offset'         => $_POST['offset'],
                'posts_per_page' => 3,
            ]);
            $max_pages = $ajaxposts->max_num_pages;
            if($ajaxposts->have_posts()): 
                while($ajaxposts->have_posts()): $ajaxposts->the_post(); ?>
                    <div class="event" data-aos="fade-up" data-aos-once="true">
                    <input type="hidden" id="upcoming-events" value="<?php echo $max_pages; ?>" />
                        <div class="event-container">
                            <div class="img-container">
                                <canvas width="350" height="299"></canvas>
                                <img src="<?php the_post_thumbnail_url('full')?>" alt="<?php the_title(); ?>" width="350" height="299" />
                            </div>
                            <p class="event-date"><?php echo get_the_date( 'j', get_the_ID() ); ?> <span><?php echo get_the_date( 'M', get_the_ID() ); ?></span></p>
                        </div>
                        <h3><?php the_title(); ?></h3>
                    </div>
                <?php endwhile;
            endif; 
            wp_die();
        }

    }

    $agentpro_events_post_type = new agentpro_events_post_type();

}

// fallback require for shortcodes.php
if ( ! class_exists( 'agentpro_events_shortcodes' ) && file_exists( __DIR__ . '/shortcodes.php' ) ) {
    require_once( __DIR__ . '/shortcodes.php' );
}
