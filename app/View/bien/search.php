<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <!--    si on veut faire la pagination : video 4 a peu près minute 22-->


    <form action="<?php echo Router::url('bien/search') ?>" method="POST">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <h2>Recherche d'un bien :</h2>
                <?php echo $this->Form->input('typeannonce', 'Type d\'annonce ', array('type' => 'select', '1' => 'Vente', '2' => 'Location')) ?>

                <?php echo $this->Form->input('typebien', 'Type de bien ', array('type' => 'select', '1' => 'Maison', '2' => 'Appartement', '3' => 'Studio', '4' => 'Chambre')) ?>

                <?php echo $this->Form->input('prix', 'Prix ') ?>

                <?php echo $this->Form->input('ville', 'Ville ') ?>

                <?php echo $this->Form->input('codepostal', 'Code Postal ') ?>

                <?php echo $this->Form->input('titre', 'Titre') ?>

                <div class="col">
                    <input type="submit" name="submit" id="search" value="Rechercher"> <!-- modifier action form -->

                </div>
            </div>
    </form>
    <br>

    <h1>Resultats de la Recherche</h1>
    <div class="container" id="myTopnav">
    <br>
        <div class="row" id="myTopnav">
            <?php foreach ($pages as $b) : ?>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <h2> Titre : <?php echo $b->titre; ?></h2>
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
                    <a href="<?php echo Router::url("bien/view/id:{$b->id}/slug:{$b->titre}"); ?>" title=""> Lire la suite</a>
                    <br><br>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>