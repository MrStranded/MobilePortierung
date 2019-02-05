<?php get_header(); ?>

    <div class="row-nomargin">

        <?php if (!wp_is_mobile()) { ?>
            <div class="sidebar">
                <?php get_sidebar(); ?>
            </div>
        <?php }; ?>

        <div class="content">
            <?php include("flexible_content.php"); ?>
        </div>

    </div> <!-- /row-nomargin -->

<?php get_footer(); ?>