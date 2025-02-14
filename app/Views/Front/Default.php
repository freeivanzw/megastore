<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MegaStore</title>

    <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('favicon/apple-touch-icon.png');?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('favicon/favicon-32x32.png');?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('favicon/favicon-16x16.png');?>">
    <link rel="manifest" href="<?=base_url('favicon/site.webmanifest');?>">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="<?=base_url('css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('css/icons/font/bootstrap-icons.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('css/base.css');?>">
</head>
<body>
    <?= $this->render('Front/Components/Header');?>
    
    <div class="content template-12" data-some="info">
        <?= $content; ?>
    </div>
    
    <?= $this->render('Front/Components/Footer');?>

    <script src="<?=base_url('js/bootstrap.bundle.min.js');?>"></script>
    <script src="<?=base_url('js/scripts.js');?>"></script>
</body>
</html>