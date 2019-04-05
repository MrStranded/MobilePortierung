<div class="sidebar" id="sidebar-id">

    <div class="pages">

        <?php
            $currentPage = get_the_ID();

            $menus = ["Abteilungen", "Anderes"];
            $first = true;

            foreach($menus as $menu) {

                if ($first == true) {
                    $first = false;
                } else {
                    echo '<hr class="dark" >';
                    echo '<p class="sidebar-button" >&nbsp;</p >';
                }

                $items = wp_get_nav_menu_items($menu);
                foreach ($items as $item) {
                    //$page = get_post($item->object_id);

                    $buttonClass = "sidebar-button";
                    if ($item->object_id == $currentPage) {
                        $buttonClass .= " sidebar-button-current";
                    }

                    echo '<hr class="dark">';
                    echo '<a class="' . $buttonClass . '" href="' . $item->url . '">' . $item->title . '</a>';
                }

            }
        ?>

    </div>

    <hr class="dark">

</div>
