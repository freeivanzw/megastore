<section>
    <h2>Редагування товару</h2>
    <form action="<?=base_url('admin/products/' . $id );?>" method="post">
        <div class="form-group mb-3">
            <label for="name">Назва товару</label>
            <input type="text" class="form-control" id="title" name="title" value="<?=$title;?>">
        </div>

        <div class="form-group mb-3">
            <label for="description">Опис</label>
            <input type="text" class="form-control" id="subtitle" name="description" value="<?=$description;?>">
        </div>

        <div class="form-group mb-3">
            <label for="description">Ціна грн.</label>
            <input type="num" class="form-control" id="subtitle" name="price" value="<?=$price;?>">
        </div>

        <button type="submit" class="btn btn-primary">Зберегти</button>
    </form>
</section>