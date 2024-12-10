<section>
    <h1>Компоненти '<?= $menu_data['title']; ?>':</h1>
    <br>
    <form action="<?=base_url('admin/component');?>" method="post" class="create-new_component mb-3">
        <input type="hidden" name="menu_id" value="<?= $menu_data['id']; ?>">
        <input type="hidden" name="component_idx" value="<?= $component_idx; ?>">
        <?php foreach ($components_list as $key => $component): ?>
            <label>
                <input type="radio" name="component" value="<?=$component;?>" <?= $key === 0 ? ' checked' : '' ;?>>
                <span><?=$component;?></span>
            </label>
        <?php endforeach; ?>
        <br>
        <button type="submit" class="btn btn-primary btn-sm">Додати компонент</button>
        <hr>
    </form>
</section>