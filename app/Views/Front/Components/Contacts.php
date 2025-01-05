
<div class="container contact-container py-5">
    <h1 class="text-center mb-5"><?= $title; ?></h1>
    <div class="row">
            
            <div class="col-md-6">
                <div class="contact-card">
                    <h4>Години роботи</h4>
                    <div class="contact-info">
                        <div class="info-item">
                            <p><?=$work_time;?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-card">
                    <h4>Телефони</h4>
                    <div class="contact-info">
                        <?php foreach ($phones as $phone): ?>
                            <div class="info-item">
                                <a href="tel:<?=$phone;?>"><?=$phone;?></a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-card">
                    <h4>Email</h4>
                    <div class="contact-info">
                        <div class="info-item">
                            <p><?=$email;?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?=html_entity_decode($map);?>
    </div>
</div>