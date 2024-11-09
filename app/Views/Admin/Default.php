<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyProject</title>
    <link rel="stylesheet" href="<?=base_url('css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('css/admin.css');?>">
</head>
<body>
    <div class="admin_wrapper container-lg mt-5 mb-5">
        <div class="sidebar d-flex flex-column flex-shrink-0 p-3">
            <a href="<?=base_url('admin');?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <span class="fs-4">Адмін панель</span>
            </a>
            <hr>
            <?= $this->render('Admin/Components/Menu'); ?>
        </div>
            
        <div class="content">
            <?= $content; ?> 
        </div>
    </div>    

    <script src="<?=base_url('js/bootstrap.bundle.min.js');?>"></script>
    <script src="<?=base_url('js/admin.js');?>"></script>
</body>
</html>