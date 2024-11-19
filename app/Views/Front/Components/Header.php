<header class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?=base_url('/');?>">MegaStore</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <nav class="top_menu collapse navbar-collapse" id="navbarSupportedContent">
            <?= view('Front/Components/TopMenu', ['top_menu' => $top_menu]) ;?>
        </nav>
    </div>
</header>
