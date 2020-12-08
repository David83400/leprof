<?php $this->title = 'Le Prof | Connaitre' ?>
<div class="container-fluid">
    <h1>Page connaitre le visiteur</h1>
        <article>
            <h1><?=  $visitor->lastName ?></h1>
            <h2>Prénom du visiteur : <?=  $visitor->firstName ?></h2>
            <p>id du visiteur : <?=  $visitor->id ?></p>
        </article>
</div>