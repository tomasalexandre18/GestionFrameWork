<?php
/** @var array $zone_stocks */
/* id          int auto_increment
        primary key,
    libelle     varchar(100) not null,
    ville       varchar(100) not null,
    adresse     varchar(100) not null,
    code_postal varchar(10)  not null
    ) */
?>

<div class="w-100 d-flex justify-content-center gap-3 align-items-center flex-column">
    <h1>
        Liste des zones de stockage
    </h1>
    <div>
        <h5 class="text-center">Zones de stockage</h5>
        <div class="d-flex flex-wrap justify-content-center gap-3 mt-3">
            <?php foreach ($zone_stocks as $zone): ?>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $zone["libelle"] ?></h5>
                        <p class="card-text">Ville: <?= $zone["ville"] ?></p>
                        <p class="card-text">Adresse: <?= $zone["adresse"] ?></p>
                        <p class="card-text">Code postal: <?= $zone["code_postal"] ?></p>
                        <div class="d-flex justify-content-between gap-2">
                            <a href="/zone_stock/edit/<?= $zone["id"] ?>" class="btn btn-secondary flex-grow-1">Modifier</a>
                            <a href="/zone_stock/delete/<?= $zone["id"] ?>" class="btn btn-danger flex-grow-1">Supprimer</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3 gap-3">
        <a href="/zone_stock/add" class="btn btn-primary">Ajouter une zone de stockage</a>
        <a href="/product/index" class="btn btn-secondary">Gérer les produits</a>
    </div>
</div>
