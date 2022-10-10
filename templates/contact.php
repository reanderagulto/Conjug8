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
            <a href="<?php echo (!empty($contact_email) ? 'mailto: ' . $contact_email : '#' ); ?>" class="contact-links flex items-center">
                <i class="ai-font-envelope"></i>
                <p><?= $contact_email ?></p>
            </a>
            <div class="contact-links flex items-start">
                <i class="ai-font-location-c"></i>
                <p><?= nl2br($contact_location) ?></p>
            </div>
            <a href="<?php echo (!empty($contact_email) ? 'tel: ' . $contact_phone : '#' ); ?>" class="contact-links flex items-center">
                <i class="ai-font-mobile-b"></i>
                <p><?= $contact_phone ?> </p>
            </a>
        </div>
        <div class="contact-form" data-aos="fade-left" data-aos-once="true">
            <?= do_shortcode('[contact-form-7 id="' . $form_ID . '" title="' . $form_name . '" html_class="use-floating-validation-tip"]') ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- End of Get in Touch Section -->
<?php get_footer(); ?>