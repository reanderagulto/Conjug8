<?php if(have_posts()) : ?>
    <div class="event">
        <div class="event-container">
            <div class="img-container">
                <canvas width="350" height="299"></canvas>
                <img src="<?php the_post_thumbnail_url('full')?>" alt="<?php the_title(); ?>" width="350" height="299" />
            </div>
            <p class="event-date"><?php echo get_the_date( 'j', get_the_ID() ); ?> <span><?php echo get_the_date( 'M', get_the_ID() ); ?></span></p>
        </div>
        <h3><?php the_title(); ?></h3>
    </div>
<?php else: ?>
<p>Coming soon...</p>
<?php endif ?>