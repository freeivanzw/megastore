<section class="card mb-3" data-component-id="<?= $id; ?>">
    <div class="card-body d-flex justify-content-between align-items-center">
        <!-- Left side: Component details -->
        <div>
            <p class="card-text mb-1">
                <span class="text-muted">Тип компонента:</span> <strong><?= $type; ?></strong>
            </p>
            <h5 class="card-title mb-1">Назва: <?= $title; ?></h5>
            <a class="btn btn-primary btn-sm" href="<?= base_url('admin/component/' . $id); ?>">Редагувати</a>
            <a class="btn btn-danger btn-sm" href="<?= base_url('admin/component/remove/' . $type . '/' . $id); ?>">Видалити</a>
        </div>

        <!-- Right side: Position controls -->
        <div class="btn-group-vertical">
            <?php if ($number_order > 0): ?>
                <a class="btn btn-outline-secondary btn-sm" 
                   href="<?= base_url('admin/component/order/?id=' . $id . '&order=' . ($number_order - 1)); ?>">
                   &#8593;
                </a>
            <?php endif; ?>
            <?php if (!$last_order): ?>
                <a class="btn btn-outline-secondary btn-sm" 
                   href="<?= base_url('admin/component/order/?id=' . $id . '&order=' . ($number_order + 1)); ?>">
                   &#8595;
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
