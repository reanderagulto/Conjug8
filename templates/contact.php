<?php 

/*
 * Template Name: Contact
 */

get_header();

$form_name = "Get in Touch";
$form_ID = get_page_by_title( $form_name, '', 'wpcf7_contact_form' )->ID;

$post_id = get_the_ID();
$post_fields = get_fields( );
$fields_to_get = array(
    'contact_us_section',
);
foreach ( $fields_to_get as $field ) {
    ${$field} = $post_fields[ $field ];
}

?>

<!-- Start of Get in Touch Section -->
<?php if($contact_us_section): ?>
<?php 
    $contact_header = $contact_us_section[ 'contact_us_header' ] ?? '';
    $contact_subheader = $contact_us_section[ 'contact_us_subheader' ] ?? '';
    $contact_email = $contact_us_section[ 'contact_us_information' ]['contact_us_email'];
    $contact_location = $contact_us_section[ 'contact_us_information' ]['contact_us_location'];
    $contact_phone = $contact_us_section[ 'contact_us_information' ]['contact_us_phone'];
?>
<section id="contact-section">
    <div class="contact-wrap flex items-start justify-center">
        <div class="contact-info" data-aos="fade-right" data-aos-once="true">
            <h2 class="section-header"><?= $contact_header ?></h2>
            <h3 class="section-subheader"><?= $contact_subheader ?></h3>
            <div class="contact-links flex items-center">
                <i class="envelope"><img src="<?=do_shortcode('[stylesheet_directory]')?>/images/svg/ai-icon-envelope.svg" class="img-responsive" width="24" height="18"/></i>
                <p><?php echo do_shortcode( '[mail_to email="' . $contact_email . '"]' . $contact_email . '[/mail_to]' ); ?></p>
            </div>
            <div class="contact-links flex items-start">
                <i class="map-locator"><img src="<?=do_shortcode('[stylesheet_directory]')?>/images/svg/ai-icon-locator.svg" class="img-responsive"  width="16" height="21"/></i>
                <p><?= nl2br($contact_location) ?></p>
            </div>
            <div class="contact-links flex items-center">
                <i class="phone"><img src="<?=do_shortcode('[stylesheet_directory]')?>/images/svg/ai-icon-mobile.svg" class="img-responsive" width="15" height="22"/></i>
                <p><?php echo do_shortcode( '[ai_phone href="' . $contact_phone. '"]' . $contact_phone . '[/ai_phone]' ); ?></p>					
            </div>
        </div>
        <div class="contact-form" data-aos="fade-left" data-aos-once="true">
            <?= do_shortcode('[contact-form-7 id="' . $form_ID . '" title="' . $form_name . '" html_class="use-floating-validation-tip"]') ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- End of Get in Touch Section -->
<?php get_footer(); ?>