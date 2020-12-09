<div class="container">
    <?php if(isset($_SESSION['erreur']))
    {
    ?>
    <div class="alert alert-danger" role="alert">
    <?php echo $_SESSION['erreur']; unset($_SESSION['erreur']) ?>
    </div>
    <?php } ?>
    <h1>Connexion</h1>
    <?= $loginForm ?>
</div>