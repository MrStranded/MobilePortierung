<?php get_header(); ?>

	<div class="row-nomargin">

        <?php get_sidebar(); ?>

        <div class="content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
			endwhile; endif; ?>
        </div>

    </div> <!-- /.row-nomargin -->

<?php get_footer(); ?>