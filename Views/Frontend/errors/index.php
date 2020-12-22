<?php $this->title = 'Le Prof | Erreur : ' .http_response_code() ?>
<section id="error">
    <p>Erreur : <?= http_response_code() ?></p>
    <h1>Nous sommes désolés, mais <?= $errorMessage ?></h1>
    <a href="/" class="btn btn-danger">Retour à la page d'accueil</a>
</section>