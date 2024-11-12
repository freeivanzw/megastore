<?php

function renderTopMenu($menu) {
    echo '<div class="ms-4 mt-2">';

        echo '<ul class="list-group">';

            foreach ($menu as $menu_item) {
                echo '<li class="list-group-item pe-0" data-menu-id="' . $menu_item['id'] . '">';
                    echo '<div class="d-flex align-items-center">';
                        echo '<button class="btn btn-primary btn-sm me-2" data-action="edit-submenu">Save</button>';

                        echo '<input class="form-control form-control-sm me-2" data-object="menu-title" type="text" value="' . htmlspecialchars($menu_item['title']) . '">';

                        echo '<button class="btn btn-success btn-sm me-2" data-action="add-submenu">[+]</button>';

                        echo '<button class="btn btn-danger btn-sm" data-action="remove-menu">[X]</button>';
                    echo '</div>';

                    if (isset($menu_item['children']) && count($menu_item['children']) > 0) {
    
                        renderTopMenu($menu_item['children']);
                        
                    }

                echo '</li>';
            }

        echo '</ul>';

    echo '</div>';
}

renderTopMenu($menu_items);
?>
