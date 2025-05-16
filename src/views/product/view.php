<?php
/** @var $product array 1D */
/** @var $zone_stocks array 2D */
/* view file */
?>

<div class="w-100 d-flex justify-content-center gap-3 align-items-center flex-column">
    <h1>
        Détails du produit
    </h1>
    <div class="card" style="width: 18rem;">
        <div class="ratio ratio-1x1">
            <img src="/images/<?= $product["image"] ?>" class="card-img-top object-fit-contain" alt="<?= $product["name"] ?>">
        </div>
        <div class="card-body">
            <h5 class="card-title"><?= $product["name"] ?></h5>
            <p class="card-text">Prix HT: <?= $product["prix_ht"] ?> €</p>
            <p class="card-text">Prix TTC: <?= $product["prix_ttc"] ?> €</p>
            <p class="card-text">Taux TVA: <?= $product["taux_tva"] ?> %</p>
            <p class="card-text">Zone de stockage: <?= $product["id_zone_stock"] ?></p>
        </div>
    </div>
    <div class="d-flex justify-content-center gap-3">
        <a href="/product/index" class="btn btn-secondary">Retour à la liste</a>
        <a href="/product/edit/<?= $product["id"] ?>" class="btn btn-primary">Modifier</a>
        <a href="/product/delete/<?= $product["id"] ?>" class="btn btn-danger">Supprimer</a>
    </div>
</div>