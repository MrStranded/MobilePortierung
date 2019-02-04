<div class="sidebar">

    <hr class="dark">

    <div class="home">
        <h1 class="home-title" name="top"><a href="<?php echo get_bloginfo( 'wpurl' );?>"><?php echo get_bloginfo( 'name' ); ?></a></h1>
        <p class="home-description"><?php echo get_bloginfo( 'description' ); ?></p>
    </div>

	<div class="pages">

        <?php
            $pages = get_pages();
            foreach($pages as $page) {
                echo '<hr class="dark">';
                echo '<a href="' . get_page_link($page->ID) . '">' . $page->post_title . '</a>';
            }
        ?>
	</div>

    <hr class="dark">

</div><!-- /.blog-sidebar -->