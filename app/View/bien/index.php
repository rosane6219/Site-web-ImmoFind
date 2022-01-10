<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/banderole.css">
    <link rel="stylesheet" href="../css/main.css">

</head>

<body>


    <div>
        <h1>Nos biens</h1>
        <div class="" id="myTopnav">
            <ul>
                <?php foreach ($pages as $b) : ?>
                    <li>
                        <h2> <?php echo $b->titre; ?></h2>
                        <?php echo $b->typebien; ?> <br>
                        <?php echo $b->prix; ?> <br>
                        <?php echo $b->ville; ?> <br>
                        <a href="<?php 
                            if(isset($_SESSION['User'])) echo Router::url("panier/add/userid:{$_SESSION['User']->id}/bienid:{$b->id}"); else echo '#';?>" title="">
                            <?php if(isset($_SESSION['User'])) echo 'Ajouter au panier'; ?>
                        </a>
                        <a href="<?php echo Router::url("bien/view/id:{$b->id}/slug:{$b->titre}");?>" title=""> Lire la suite</a>

                    </li>
                <?php endforeach; ?>
            </ul>
            </a>
        </div>

        <div >
            <ul>
                <?php for ($i = 1; $i <= $page; $i++): ?>
                <a href="?page=<?php echo $i; ?>"> <?php echo $i; ?></a>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
   



</body>

</html>