<div class="sidebar" id="sidebar-id">

    <div class="pages">

        <?php
            $currentPage = get_the_ID();

            $pages = get_pages();
            foreach($pages as $page) {
                $buttonClass = "sidebar-button";
                if ($page->ID == $currentPage) {
                    $buttonClass .= " sidebar-button-current";
                }

                echo '<hr class="dark">';
                echo '<a class="' . $buttonClass . '" href="' . get_page_link($page->ID) . '">' . $page->post_title . '</a>';
            }
        ?>

        <hr class="dark">
        <p class="sidebar-button">&nbsp;</p>

        <hr class="dark">
        <a class="sidebar-button" href="index.php">News</a>

    </div>

    <hr class="dark">

</div>
