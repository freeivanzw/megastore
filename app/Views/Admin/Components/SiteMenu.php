<section>
    <span>Верхнє меню</span>

    <ul>
        <?php foreach ($top_menu as $lvl_1): ?>
            <li data-menu-id=<?=$lvl_1['id'];?>>
                <?=$lvl_1['title'];?>
                <button data-action="add-submenu">[+]</button>
                <button data-action="remove-menu">[X]</button>
                <?php if (isset($lvl_1['children']) && count($lvl_1['children']) > 0):?>
                    <ul>
                        <?php foreach ($lvl_1['children'] as $lvl_2): ?>
                            <li data-menu-id=<?=$lvl_2['id'];?>>
                                <?=$lvl_2['title'];?>
                                <button data-action="add-submenu">[+]</button>
                                <button data-action="remove-menu">[X]</button>
                                <?php if (isset($lvl_2['children']) && count($lvl_2['children']) > 0):?>
                                    <ul>
                                        <?php foreach ($lvl_2['children'] as $lvl_3): ?>
                                            <li data-menu-id=<?=$lvl_3['id'];?>>
                                                <?=$lvl_3['title'];?>
                                                <button data-action="add-submenu">[+]</button>
                                                <button data-action="remove-menu">[X]</button>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<script type="text/javascript">
    const removeBtns = document.querySelectorAll('[data-action="remove-menu"]');
    
    removeBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            const $menuItem = this.closest('[data-menu-id]');
            const menuId = this.closest('[data-menu-id]').getAttribute('data-menu-id');

            fetch(`/admin/menu/?menu_id=${menuId}`, {
                method: 'DELETE',
            }).then(response => response.json()).then(function (result) {
                if (!result.success) {
                    return false;
                }

                $menuItem.remove();
            })
        })
    });
</script>