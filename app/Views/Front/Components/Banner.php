<div class="position-relative overflow-hidden p-3 p-md-5 text-center">
    <?php if ($image !== ''): ?>
        <img src="<?= base_url($image); ?>" class="w-100 h-100 position-absolute top-0 start-0" alt="background image" style="z-index: -1; object-fit: cover;">
    <?php else: ?>
        <img src="<?= base_url('images/no_photo.png'); ?>" class="w-100 h-100 position-absolute top-0 start-0" alt="no photo background image" style="z-index: -1; object-fit: cover;">
    <?php endif; ?>
    <div class="p-lg-5 mx-auto my-5">
        <h1 class="display-3 fw-bold"><?= $title; ?></h1>
        <h3 class="fw-normal text-muted mb-3"><?= $subtitle; ?></h3>
    </div>
    <div class="product-device shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>