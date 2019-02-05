<?php get_header(); ?>

	<div class="row-nomargin">

        <?php if (!wp_is_mobile()) { ?>
            <div class="sidebar">
                <?php get_sidebar(); ?>
            </div>
        <?php }; ?>

		<div class="content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
			endwhile; endif; ?>
		</div> <!-- /.blog-main -->

	</div> <!-- /.row-nomargin -->

<?php get_footer(); ?>