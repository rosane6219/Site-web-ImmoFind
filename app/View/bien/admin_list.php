<div class="container"><br><br>
    <div class="row">
        <div class="col">
            <b>Liste des <?php echo $total ?> biens </b>
        </div>
        <div class="col">
            <a href="<?php echo Router::url('admin/bien/edit') ?>">Créer un bien</a>
        </div>

    </div>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col">
                <strong>ID</strong>
            </div>
            <div class="col">
                <strong> Titre</strong>
            </div>
            <div class="col">
                <strong> Actions</strong>
            </div>
        </div>
    </div>

    <div class="container">
        <?php foreach ($pages as $k => $v) : ?>
            <div class="row">
                <div class="col">
                    <?php echo $v->id ?>
                </div>
                <div class="col">
                    <?php echo $v->titre ?>
                </div>
                <div class="col">
                    <a href="<?php echo Router::url('admin/bien/edit/' . $v->id) ?>">modifier</a>

                    <a onclick="return confirm('Voulez vous vraiment supprimer ce contenu?')" href="<?php echo Router::url('admin/bien/delete/' . $v->id); ?>">supprimer</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>