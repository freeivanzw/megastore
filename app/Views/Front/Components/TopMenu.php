
<?php

function renderTopMenu($menu) {

    echo '<ul>';

        foreach ($menu as $menu_item) {
            echo '<li>';

                echo '<a href="' . base_url($menu_item['url']) . '">';

                echo $menu_item['title'];

                echo '</a>';

                if (isset($menu_item['children']) && count($menu_item['children']) > 0) {

                    renderTopMenu($menu_item['children']);
                    
                }

            echo '</li>';
        }

    echo '</ul>';
}

renderTopMenu($top_menu);
?>
