<div>
<div class="container">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
    <h1>Details du Bien</h1>

    <div>
        <h3> Titre : <?php echo $page->titre ?> </h3>
    </div>
    <div>
        <!--img style="<?php if(empty($page->url)) echo 'display: none' ?>" src="<?php echo pathinfo($_SERVER['HTTP_REFERER'], PATHINFO_DIRNAME)."/{$page->url}";?>" alt="Chargement de l'image..." width="300" height="300"/-->
        <?php
            $arrayUrl = explode('/', pathinfo($_SERVER['HTTP_REFERER'], PATHINFO_DIRNAME));
            $imageUrl = $arrayUrl[0] . '//' . $arrayUrl[2] . '/' . BASE_URL . '/' . $page->url;
            echo '<img  src="' . $imageUrl . '" alt="Chargement de l\'image..."  />'
           
            ?>
    </div>
    <p><strong> Type d'annonce :</strong> <?php echo $page->typeannonce;  ?> <br>
       <strong> Type du bien : </strong><?php echo $page->typebien;  ?> <br>
       <strong> Prix du bien : </strong><?php echo $page->prix; ?> <br>
        <strong> Ville : </strong><?php echo $page->ville; ?> <br>
        <strong> Code postal : </strong><?php echo $page->codepostal; ?> <br>
        <strong> Description du bien : </strong> <?php echo $page->descrption; ?> <br>
       <strong> Emis le : </strong> <?php echo $page->modif; ?> <br>
    </p>
    <!--<a href="<?php
                if (isset($_SESSION['User'])) echo Router::url("panier/add/userid:{$_SESSION['User']->id}/bienid:{$page->id}");
                else echo '#'; ?>" title="">
        <?php if (isset($_SESSION['User'])) echo 'Ajouter au panier'; ?>
    </a>-->

    <button id="btnImprime" class="btn btn-outline-info" onclick="printPdf(<?php $_SERVER['PATH_INFO']?>)"> Imprimer </button> 

    <script>
        printPdf = function (pdfUrl) {
            //On désactive les éléments que l'on ne souhaite pas voir sur le pdf
            document.getElementById("btnImprime").style.display = "none";
            window.print();
            //On réactive les éléments cachés
            document.getElementById("btnImprime").style.display = "block";
        }
    </script>

</div>
</div>
</div>