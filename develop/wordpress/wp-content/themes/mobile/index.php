<?php get_header(); ?>

	<div class="row">

        <div class="col">
            <?php get_sidebar(); ?>
        </div>

		<div class="col">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
			endwhile; endif; ?>
		</div> <!-- /.blog-main -->

	</div> <!-- /.row -->

<?php get_footer(); ?>