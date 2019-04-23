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
                    $hrClass = "";//"light";
                    // the home id is hardcoded, possibly has to be changed upon site migration
                    if ($item->object_id == $currentPage || ($item->object_id == 111  && is_home())) {
                        $buttonClass .= " sidebar-button-current";
                        //$hrClass = "dark";
                    }

                    $newTab = "";
                    // custom links lead to a new tab (except custom link to news page)
                    if ($item->type == "custom" && $item->object_id != 111) {
                        $newTab = ' target="_blank"';
                    }

                    echo '<div class="sidebar-div">';
                        echo '<hr>';
                        echo '<a class="' . $buttonClass . '" href="' . $item->url . '" ' . $newTab . '>' . $item->title . '</a>';
                    echo '</div>';
                }

            }
        ?>

    </div>

</div>
