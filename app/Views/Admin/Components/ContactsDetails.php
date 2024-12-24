<section>
    <form action="<?=base_url('admin/component/edit' );?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="component_id" value="<?=$id;?>">
        <input type="hidden" name="component_type" value="<?=$component_type;?>">

        <div class="form-group mb-3">
            <label for="name">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" value="<?=$component_title;?>">
        </div>

        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="data[email]" value="<?=$email;?>">
        </div>

        <div class="form-group mb-3">
            <label for="phones">Телефон</label>
            <input type="tel" class="form-control" id="phones" name="data[phones]" value="<?=$phones;?>">
        </div>

        <div class="form-group mb-3">
            <label for="work_time">Графік</label>
            <textarea class="form-control" id="work_time" name="data[work_time]"><?=$work_time;?></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="work_time">Карта Google</label>
            <textarea class="form-control" id="map" name="data[map]"><?=$map;?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Зберегти</button>
    </form>
</section>