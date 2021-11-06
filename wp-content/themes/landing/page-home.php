<?php /* Template Name: Home */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    get_template_part('template-parts/hero');

    ?>
    <div class="wrapper">
        <?php
        get_template_part('template-parts/section-1');
        get_template_part('template-parts/section-2');
        get_template_part('template-parts/form-section');
        ?>
    </div>

</main><!-- #main -->

<?php
get_footer();
