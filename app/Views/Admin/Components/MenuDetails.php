<section>
    <h1>Компоненти меню '<?= $title; ?>'</h1>
    <br>
    <form action="<?=base_url('admin/component');?>" method="post">
        <input type="hidden" name="menu_id" value=<?= $id; ?>>
        <button type="submit">Додати компонент</button>
    </form>
</section>