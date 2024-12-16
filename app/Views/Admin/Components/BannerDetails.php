<section>
    <form action="<?=base_url('admin/component/edit' );?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="component_id" value="<?=$id;?>">
        <input type="hidden" name="component_type" value="<?=$component_type;?>">

        <div class="form-group mb-3">
            <label for="name">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" value="<?=$component_title;?>">
        </div>

        <div class="form-group mb-3">
            <label for="description">Підзаголовок</label>
            <input type="text" class="form-control" id="subtitle" name="data[subtitle]" value="<?=$subtitle;?>">
        </div>
        <div class="form-group mb-3">
            <?php if ($image): ?>
                <div class="selected_photo">
                    <img src="<?=base_url($image);?>" alt="banner Image" class="img-thumbnail mt-2" width="150">
                    <a href="<?=base_url('admin/banner/remove/image/' . $id );?>">Видалити</a>
                </div>
            <?php else: ?>
                <label for="advantage-img">Зображення</label>
                <input type="file" class="form-control-file"name="image">
            <?php endif;?>
        </div>

        <button type="submit" class="btn btn-primary">Зберегти</button>
    </form>
</section>