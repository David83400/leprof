<?php $this->title = 'Le Prof | Descriptif' ?>
<h1>Page descriptif du site</h1>
<?php foreach($visitors as $visitor): ?>
    <article>
        <h2><a href="/descriptif/connaitre/<?= $visitor->id ?>"><?=  $visitor->lastName ?></a></h2>
        <h3><?=  $visitor->firstName ?></h3>
    </article>
<?php endforeach; ?>