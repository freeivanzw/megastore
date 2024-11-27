<section data-component-id="<?= $id; ?>">
    тип компонента: <?= $type; ?><br>
    Назва: <?= $title; ?><br>
    <a href="<?= base_url('admin/component/' . $id); ?>">edit</a>
    <a href="<?= base_url('admin/component?type=' . $type .'&id=' . $id); ?>">[X]</a>
    <hr>
</section>