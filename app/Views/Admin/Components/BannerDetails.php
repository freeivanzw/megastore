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

        <button type="submit" class="btn btn-primary">Зберегти</button>
    </form>
</section>