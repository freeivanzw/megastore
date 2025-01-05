<section class="container py-4">
    <h2 class="mb-4">Наші товари</h2>

    <form method="post" action="<?=base_url('admin/products'); ?>" class="mb-3">
        <button type="submit" class="btn btn-primary">Створити товар</button>
    </form>

    <?php if (isset($products_list)): ?>
        <ul class="list-group">
            <?php foreach ($products_list as $product): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <a href="<?=base_url('admin/products/' . $product['id']); ?>" class="text-decoration-none">✎</a>
                        <span class="ms-2 fw-bold"> <?=$product['title'];?></span>
                    </div>
                    <a href="<?=base_url('admin/products/remove/' . $product['id']); ?>" class="btn btn-sm btn-danger">[X]</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</section>