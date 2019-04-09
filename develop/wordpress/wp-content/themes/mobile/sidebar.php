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
                    echo '<p class="sidebar-button" >&nbsp;</p >';
                }

                $items = wp_get_nav_menu_items($menu);
                foreach ($items as $item) {
                    //$page = get_post($item->object_id);

                    $buttonClass = "sidebar-button";
                    $hrClass = "light";
                    if ($item->object_id == $currentPage || ($item->object_id == 111  && is_home())) {
                        $buttonClass .= " sidebar-button-current";
                        $hrClass = "dark";
                    }

                    echo '<hr class="' . $hrClass . '">';
                    echo '<a class="link-button ' . $buttonClass . '" href="' . $item->url . '">' . $item->title . '</a>';
                }

            }
        ?>

    </div>

</div>
