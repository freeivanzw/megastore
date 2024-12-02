<section>
    <div class="h3">ID: </div>
    <form action="<?=base_url('admin/component/edit' );?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="component_id" value="<?=$id;?>">
        <input type="hidden" name="component_type" value="<?=$component_type;?>">

        <div class="form-group mb-3">
            <label for="name">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" value="<?=$component_title;?>">
        </div>

        <div class="form-group mb-3">
            <label for="description">Короткий опис статті</label>
            <textarea class="form-control" id="description" name="data[description]"><?=$description;?></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="price">Текст</label>
            <textarea class="form-control" id="editor1" name="data[content]"><?=$content;?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Зберегти</button>
    </form>
</section>