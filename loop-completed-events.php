<?php if(have_posts()) : ?>
    <div class="completed-events" data-aos="fade-up" data-aos-once="true">
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
<?php else: ?>
<p>Coming soon...</p>
<?php endif ?>