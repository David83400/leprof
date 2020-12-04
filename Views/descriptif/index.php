<?php $this->title = 'Le Prof | Descriptif' ?>
<div class="container-fluid">
    <h1>Page descriptif du site</h1>
    <?php foreach($visitors as $visitor): ?>
        <article>
            <h2><?=  $visitor->lastName ?></h2>
            <h3><?=  $visitor->firstName ?></h3>
        </article>
    <?php endforeach; ?>
</div>