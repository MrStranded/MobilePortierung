<?php /* Template Name: Test */ ?>

<?php get_header(); ?>

	<div class="row">

		<div class="col-sm-8 blog-main">

            <div class="blog-post">
            	<h2 class="blog-post-title"><?php the_title(); ?></h2>
            	<p class="blog-post-text"><?php the_field('Basic_Info_Template'); ?></p>


             <?php the_content(); ?>

            </div><!-- /.blog-post -->

		</div> <!-- /.blog-main -->

		<?php get_sidebar(); ?>

	</div> <!-- /.row -->

<?php get_footer(); ?>