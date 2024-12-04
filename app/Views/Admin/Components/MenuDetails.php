<section>
    <h1>Компоненти меню '<?= $menu_data['title']; ?>'</h1>
    <br>
    <form action="<?=base_url('admin/component');?>" method="post">
        <input type="hidden" name="menu_id" value=<?= $menu_data['id']; ?>>
        <?php foreach ($components_list as $component): ?>
            <label>
                <input type="radio" name="component" value="<?=$component;?>">
                <span><?=$component;?></span>
            </label>
        <?php endforeach; ?>
        <button type="submit">Додати компонент</button>
    </form>
</section>