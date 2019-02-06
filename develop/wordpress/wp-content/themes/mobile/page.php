<?php get_header(); ?>

    <div class="row-nomargin">

        <?php get_sidebar(); ?>

        <?php if (!wp_is_mobile()) { echo '<div class="content">'; }; ?>
            <?php include("flexible_content.php"); ?>
        <?php if (!wp_is_mobile()) { echo '</div>'; }; ?>

    </div> <!-- /row-nomargin -->

<?php get_footer(); ?>