<section>
    <form action="<?=base_url('admin/component/edit' );?>" data-object="contacts-form" enctype="multipart/form-data" class="p-4 border rounded bg-light">
        <input type="hidden" id="component_id" value="<?=$id;?>">
        <input type="hidden" id="component_type" value="<?=$component_type;?>">

        <div class="form-group mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" class="form-control" id="title" value="<?=$component_title;?>">
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" value="<?=$email;?>">
        </div>

        <div class="form-group mb-3">
            <label for="phones" class="form-label">Телефон</label>
            <button type="button" class="btn btn-outline-primary btn-sm ms-2" data-action="add-phone">[+]</button>

            <ul class="list-group mt-2" data-object="phones-list">
                <?php if (isset($phones)): ?>
                    <?php foreach($phones as $k => $phone): ?>
                        <li class="list-group-item d-flex align-items-center">
                            <input type="tel" class="form-control me-2" data-object="phones-item" value="<?=$phone;?>">
                            <?php if ($k !== 0): ?>
                                <button type="button" class="btn btn-danger btn-sm" data-action="remove-phone">[X]</button>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="list-group-item d-flex align-items-center">
                        <input type="tel" class="form-control me-2" data-object="phones-item" value="">
                    </li>
                <?php endif; ?>
                
            </ul>
        </div>

        <div class="form-group mb-3">
            <label for="work_time" class="form-label">Графік</label>
            <textarea class="form-control" id="work_time" rows="3"><?=$work_time;?></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="map" class="form-label">Карта Google</label>
            <textarea class="form-control" id="map" rows="3"><?=$map;?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Зберегти</button>
    </form>

</section>
<script>
    const $form = $('[data-object="contacts-form"]');
    $form.on('submit', function (e) {
        e.preventDefault();
        
        let formData = {
            component_id: $('#component_id').val(),
            component_type: $('#component_type').val(),
            title: $('#title').val(),
            data: {
                email: $('#email').val(),
                work_time: $('#work_time').val(),
                map: $('#map').val(),
                phones: [],
            }
        }

        $('[data-object="phones-item"]').each(function () {
            formData.data.phones.push($(this).val());
        })

        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: formData,
            success: function (result) {
                location.reload();
            }
        });
    })

    $('[data-action="add-phone"]').on('click', function () {
        $('[data-object="phones-list"]').append(`
             <li class="list-group-item d-flex align-items-center">
                <input type="tel" class="form-control me-2" data-object="phones-item" value="">
                <button type="button" class="btn btn-danger btn-sm" data-action="remove-phone">[X]</button>
            </li>
        `);
    });

    $('[data-action="remove-phone"]').on('click', function () {
        $(this).closest('li').remove();
    });
</script>