<div class="sidebar" id="sidebar-id">

    <div class="pages">

        <?php
            $pages = get_pages();
            foreach($pages as $page) {
                echo '<hr class="dark">';
                echo '<a class="sidebar-button" href="' . get_page_link($page->ID) . '">' . $page->post_title . '</a>';
            }
        ?>

        <hr class="dark">
        <p class="sidebar-button">&nbsp;</p>

        <hr class="dark">
        <a class="sidebar-button" href="index.php">News</a>

    </div>

    <hr class="dark">

</div>
