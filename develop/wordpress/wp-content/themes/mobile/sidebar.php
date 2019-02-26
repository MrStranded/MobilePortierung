<?php
    if (!wp_is_mobile()) {
        echo '<div class="sidebar-desktop">';
    } else {
        echo ' <div class="sidebar-mobile" id="sidebar-mobile-id" style="display: none;">';
    };
?>

    <div class="pages">

        <?php
            $pages = get_pages();
            foreach($pages as $page) {
                echo '<hr class="dark">';
                echo '<a class="sidebar-button" href="' . get_page_link($page->ID) . '">' . $page->post_title . '</a>';
            }
        ?>
    </div>

    <hr class="dark">

</div>
