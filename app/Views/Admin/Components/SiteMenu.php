<section>
   
    <ul>
        <li class="list-group-item pe-0" data-menu-id="1">
            <div class="d-flex align-items-center">
                <span>Верхнє меню</span>
                <button type="button" data-action="add-submenu" class="btn btn-success btn-sm me-2">[+]</button>
            </div>
            <?=$top_menu;?>
        </li>
    </ul>

    
</section>

<script type="text/javascript">
    let baseUrl = '<?=base_url('');?>';

    $(document).on('click', '[data-action="remove-menu"]', function () {
        const $menuItem = $(this).closest('[data-menu-id]');
        const menuId = $(this).closest('[data-menu-id]').attr('data-menu-id');

        console.log(menuId);

        $.ajax({
            url: `/admin/menu/${menuId}`,
            method: 'DELETE',
            success: function (result) {
                if (!result.success) {
                    return false;
                }
                $menuItem.remove();
            }
        });
    })

    $(document).on('click', '[data-action="edit-submenu"]', function () {
        const $menuItem = $(this).closest('[data-menu-id]');
        const menuId = $(this).closest('[data-menu-id]').attr('data-menu-id');
        const newMenuTitle = $menuItem.find('[data-object="menu-title"]').val();

        $.ajax({
            url: `/admin/menu/${menuId}`,
            method: 'PATCH',
            contentType: 'application/json',
            data: JSON.stringify({ title: newMenuTitle }),
            success: function (result) {
                if (!result.success) {
                    return false;
                }

                console.log(result.message);
            }
        });
    });

    $(document).on('click', '[data-action="add-submenu"]', function () {
        const $menuItem = $(this).closest('[data-menu-id]');
        const menuId = $(this).closest('[data-menu-id]').attr('data-menu-id');

        $.ajax({
            url: `/admin/menu/${menuId}`,
            method: 'POST',
            success: function (result) {
                if (!result.success) {
                    return false;
                }
                const menuItem = result.menu_item;

                
                if ($menuItem.find('.list-group').length === 0) {
                    $menuItem.append('<div class="ms-4 mt-2"><ul class="list-group"></ul></div>')
                }

                const $subitemsList = $menuItem.find('.list-group')[0];
                $($subitemsList).append(`
                    <li class="list-group-item pe-0" data-menu-id="${menuItem.id}"><div class="d-flex align-items-center">
                        <button class="btn btn-primary btn-sm me-2" data-action="edit-submenu">Save</button>
                        <a href="${baseUrl}/admin/menu/${menuItem.id}">link</a>
                        <input class="form-control form-control-sm me-2" data-object="menu-title" type="text" value="${menuItem.title}">
                        <button class="btn btn-success btn-sm me-2" data-action="add-submenu">[+]</button>
                        <button class="btn btn-danger btn-sm" data-action="remove-menu">[X]</button></div>
                    </li>
                `);

                console.log(result.message);
            }
        });
    })

     
</script>