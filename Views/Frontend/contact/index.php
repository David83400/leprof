<?php $this->title = 'Le Prof | Contactez nous' ?>
<div class="container">
    <h1>Pour prendre contact avec nous, c'est ici</h1>
    <?php if (isset($errors)) { ?>
    <?php foreach ($errors as $error): ?>
        <div class="alert alert-danger">
            <ul>
                <li><?= $error; ?></li>
            </ul>
        </div>
    <?php endforeach; ?>
    <?php } ?>
    <?= $contactForm ?>
</div>