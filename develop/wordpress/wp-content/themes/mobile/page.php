<?php get_header(); ?>

    <div class="row-nomargin">

        <?php if (!wp_is_mobile()) { ?>
            <div class="sidebar">
                <?php get_sidebar(); ?>
            </div>
        <?php }; ?>

        <?php if (!wp_is_mobile()) { echo '<div class="content">'; }; ?>
            <?php include("flexible_content.php"); ?>
        <?php if (!wp_is_mobile()) { echo '</div>'; }; ?>

    </div> <!-- /row-nomargin -->

<?php get_footer(); ?>