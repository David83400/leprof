<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <button class="navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapse_target">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/"><i class="fas fa-home"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/descriptif">Descriptif</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
        </ul>
    </div>
    <?php
    if (isset($_SESSION['member']) && !empty($_SESSION['member']['id']))
    {
    ?>
    <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?= $_SESSION['member']['lastName'] ?>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="/members/profil">Mon profil</a>
            <a class="dropdown-item" href="/members/logout">Se déconnecter</a>
        </div>
    </div>
    <?php
    }
    else
    {
    ?>
    <div class="connexion">
        <a href="/members/register">Se connecter</a>
    </div>
    <?php
    }
    ?>
</nav>