<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- meta description -->
        <meta name="description"
            content="" />

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary">
        <meta name=”twitter:site” content="@leprof" />
        <meta name="twitter:title" content="Le Prof : site officiel.">
        <meta name="twitter:description"
            content="">
        <!-- <meta name=”twitter:image” content="Public/images/billetSimple.png" /> -->

        <!-- Open Graph -->
        <meta property="og:title" content="Le Prof : site officiel." />
        <meta property="og:type" content="Website" />
        <meta property="og:url" content="http://www.leprof-projet5.fr" />
        <!-- <meta property="og:image" content="Public/images/billetSimple.png" /> -->
        <meta property="og:description"
            content="" />
        <meta property="og:site_name" content="leprof" />

        <!-- CSS Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- Styles -->
        

        <!-- CSS fontawesome -->
        <script src="https://kit.fontawesome.com/c9ef589bf6.js" crossorigin="anonymous"></script>

        <!-- google fonts -->
        <link href="" rel="stylesheet">

        <!-- Favicons -->
        <!-- <link rel="icon" type="image/png" href="Public/images/favicon.png" /> -->
        
        <title><?= $title ?></title>
    </head>
    <body>
        <header>
            <div class="row mainHeader">
                <div class="logo col-7 offset-3 col-sm-8 offset-sm-4 col-md-5 offset-md-4 col-lg-4 offset-lg-2">
                    <a href="index.php"><h1>Logo Le Prof</h1></a>
                </div>
                <div class="socialIcons col-4 offset-4 col-sm-4 offset-sm-4 col-md-4 offset-md-4 col-lg-2 offset-lg-3">
                    <ul>
                        <li><a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </header>
        <?= $navbar ?>

        <?= $content ?>
        
        <?= $footer ?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>