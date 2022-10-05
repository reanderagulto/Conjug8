
<?php 

/*
 * Template Name: About
 */

get_header();

$post_id = get_the_ID();
$post_fields = get_fields( );
$fields_to_get = array(
    'content_section',
    'mission_vision',
);
foreach ( $fields_to_get as $field ) {
    ${$field} = $post_fields[ $field ];
}

?>
<!-- Start of Icons  -->
<section id="icons-section">
    <div class="icons-wrap">
        <div class="icons-container flex justify-between" data-aos="fade-up" data-aos-once="true">
            <div class="icon">
                <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/lightbulb.png" class="img-responsive" width="68" height="88" alt="Sharp Brain" >
                <h3>Sharp Brain</h3>
            </div>
            <div class="icon">
                <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/brain.png" class="img-responsive" width="84" height="78" alt="Sound Mind" >
                <h3>Sound Mind</h3>
            </div>
            <div class="icon">
                <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/heart-beat.png" class="img-responsive" width="77" height="77" alt="Healty Life" >
                <h3>Healthy Life</h3>
            </div>
        </div>
    </div>
</section>
<!-- End of Icons -->

<!-- Start of About Content -->
<?php if(!empty($content_section)): ?>
<?php 
    $section_1 = $content_section[ 'about_section_1' ];
    $section_2 = $content_section[ 'about_section_2' ];

?>
<section id="about-content">
    <div class="content-wrap">
        <div class="about-section-1 flex justify-start items-start" data-aos="fade-up" data-aos-once="true">
            <div class="section-text">
                <?php 
                    $contentHTML = '';
                    $contents1 = $section_1['content_text'];
                    if(!empty($contents1)){
                        foreach ($contents1 as $item) {
                            echo '
                                <div class="section-content">
                                    <h3 class="content-header">' . $item['title'] . '</h3>
                                    <p>' . nl2br($item['message']) . '</p>
                                </div>
                            ';
                        }
                    }
                ?>
            </div>
            <div class="section-image">
                <?php if(!empty($section_1['image'])): ?>
                <div class="img-container">
                    <canvas width="<?= $section_1['image']['width'] ?>" height="<?= $section_1['image']['height'] ?>"></canvas>
                    <img src="<?= $section_1['image']['url'] ?>" width="<?= $section_1['image']['width'] ?>" height="<?= $section_1['image']['height'] ?>" alt="<?= $section_1['image']['alt'] ?>" class="img-responsive">
                </div>
                <?php else: ?>
                <div class="img-container">
                    <canvas width="537" height="631"></canvas>
                    <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/about-us-section-image.png" alt="About Us Section 1" width="537" height="631" class="img-responsive">
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="about-section-2 flex justify-center items-center" data-aos="fade-up" data-aos-once="true">
            <div class="section-image">
                <?php if(!empty($section_2['image'])): ?>
                <div class="img-container">
                    <canvas width="<?= $section_2['image']['width'] ?>" height="<?= $section_2['image']['height'] ?>"></canvas>
                    <img src="<?= $section_2['image']['url'] ?>" width="<?= $section_2['image']['width'] ?>" height="<?= $section_2['image']['height'] ?>" alt="<?= $section_2['image']['alt'] ?>" class="img-responsive">
                </div>
                <?php else: ?>
                <div class="img-container">
                    <canvas width="537" height="631"></canvas>
                    <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/about-us-section-image.png" alt="About Us Section 1" width="537" height="631" class="img-responsive">
                </div>
                <?php endif; ?>
            </div>
            <div class="section-text">
                <?php 
                    $contentHTML = '';
                    $contents1 = $section_2['content_text'];
                    if(!empty($contents1)){
                        foreach ($contents1 as $item) {
                            echo '
                                <div class="section-content">
                                    <h3 class="content-header">' . $item['title'] . '</h3>
                                    <p>' . nl2br($item['message']) . '</p>
                                </div>
                            ';
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</section>


<!-- Start of Mission Vision Section -->
<?php 
    $missionTitle = $mission_vision['mission']['title'];
    $missionMsg = $mission_vision['mission']['message'];
    $visionTitle = $mission_vision['vision']['title'];
    $visionMsg = $mission_vision['vision']['message'];
?>
<section id="mission-vision">
    <div class="mission-vision-wrap flex items-center justify-center">
        <div class="mission-wrap" data-aos="fade-right" data-aos-once="true">
            <h2>
                <?php echo $missionTitle; ?>
            </h2>
            <p>
                <?php echo nl2br($missionMsg); ?>
            </p>
        </div>
        <div class="vision-wrap" data-aos="fade-left" data-aos-once="true">
            <h2>
                <?php echo $visionTitle; ?>
            </h2>
            <p>
                <?php echo nl2br($visionMsg); ?>
            </p>
        </div>
    </div>
</section>
<!-- End of Mission Vision Section -->

<?php echo do_shortcode('[agentpro_board_members_about_archive]'); ?>

<?php endif; ?>
<!-- End of About Content -->
<?php get_footer(); ?>