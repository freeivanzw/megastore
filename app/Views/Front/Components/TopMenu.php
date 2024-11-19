
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



<!-- <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/'); ?>">asdfasdf</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/'); ?>">asdfasdf</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/'); ?>">asdfasdf</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/'); ?>">asdfasdf</a>
    </li>
</ul> -->