<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../webroot/css/style.css">

</head>

<body>
    <div class="container">
        <br>
        <h2 id="laUne">Les nouveautés de notre agence</h2>
        <br>
        <div class="row" id="myTopnav">
            <?php foreach ($pages as $b) : ?>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <h4>Titre : <?php echo $b->titre; ?></h4>
                    <strong>Type de bien : </strong><?php echo $b->typebien; ?> <br>
                    <strong>Prix : </strong><?php echo $b->prix; ?> <br>
                    <strong>Ville : </strong><?php echo $b->ville; ?> <br>
                    <strong>Code postal : </strong><?php echo $b->codepostal; ?> <br>
                    <a href="<?php
                                if (isset($_SESSION['User'])) echo Router::url("panier/add/userid:{$_SESSION['User']->id}/bienid:{$b->id}");
                                else echo '#'; ?>" title="">
                        <?php if (isset($_SESSION['User'])) echo 'Ajouter au panier'; ?>
                    </a>
                    <br>
                    <a href="<?php echo Router::url("bien/view/id:$b->id/slug:$b->slug"); ?>" title=""> Lire la suite</a>
                    <br><br>
                </div>
                
            <?php endforeach; ?>
        </div>
    </div>


</body>
<footer>
    <div id="banderolle" style="margin: auto; width: 50%; height: 350px">
        <div>
            <!-- ici il faut choisir les images souhaitées /+\ il faudra egalment voir comment faire la redirection avec les liens -->
            <?php
            while (empty($page->url)) {
                $page = $pages[array_rand($pages)];
            }
            $arrayUrl = explode('/', pathinfo($_SERVER['HTTP_REFERER'], PATHINFO_DIRNAME));
            $imageUrl = $arrayUrl[0] . '//' . $arrayUrl[2] . '/' . BASE_URL . '/' . $page->url;
            echo '<a href="' . Router::url("bien/view/id:$page->id/slug:$page->slug") . '"><img src="' . $imageUrl . '" alt="Chargement de l\'image..." /></a>'
            ?>
        </div>
    </div>
</footer>

</html>