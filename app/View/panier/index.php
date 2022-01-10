<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>

    <!-- require la connexion !!!!! -->

    <h2>Mon panier</h2>
    
    <div class="container">
        <div class="row" id="myTopnav">
            <?php foreach ($panier as $b) : ?>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <h4>Titre : <?php echo $b->titre; ?></h4>
                    <strong>Type de bien : </strong><?php echo $b->typebien; ?> <br>
                    <strong>Prix : </strong><?php echo $b->prix; ?> <br>
                    <strong>Ville : </strong><?php echo $b->ville; ?> <br>
                    <strong>Code postal : </strong><?php echo $b->codepostal; ?> <br>
                   
                    <a href="<?php echo Router::url("panier/delete/id:{$b->id}");?>" title="">Retirer du panier</a>
                    <br>
                    <a href="<?php echo Router::url("bien/view/id:{$b->id}/slug:{$b->slug}");?>" title=""> Lire la suite</a>
                </div>
            <?php endforeach; ?>            
        </div>
    </div>
</body>
</html>
