<div class="sidebar">

    <div class="home">
        <h1 class="home-title"><a href="<?php echo get_bloginfo( 'wpurl' );?>"><?php echo get_bloginfo( 'name' ); ?></a></h1>
        <p class="home-description"><?php echo get_bloginfo( 'description' ); ?></p>
    </div>

	<div class="pages">
		<h4>Abteilungen</h4>
        <?php wp_list_pages('&title_li='); ?>
	</div>

</div><!-- /.blog-sidebar -->