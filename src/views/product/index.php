<?php
/** @var array $products */
/** @var array $zone_stocks */
/** @var int $page */
/** @var int $limit */
/** @var int|string $zone_stock */
/** @var string $search */
/** @var int $nb_products */
?>

<script type="text/javascript">
    const handleZoneChange = (e) => {
        const zone = e.target.value;
        window.location.href = "/product/index/1/<?= $limit ?>/" + zone + "/<?= $search ?>";
    }
    const handleSearch = (e) => {
        const search = document.getElementById('search').value || "null";
        window.location.href = "/product/index/1/<?= $limit ?>/<?= $zone_stock ?>/" + search;
    }
</script>

<div class="w-100 d-flex justify-content-center gap-3 align-items-center">
    <label>
        <select class="form-select" id="zone_stock" name="zone_stock" onchange="handleZoneChange(event)">
            <option value="null">Zone de stockage</option>
            <?php foreach ($zone_stocks as $zone): ?>
            <option value="<?= $zone["id"] ?>"
                <?= $zone["id"] == $zone_stock ? "selected" : "" ?>><?= $zone["libelle"] ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <h1>
        Liste des produits
    </h1>

    <div class="input-group" style="width: auto!important;">
            <input type="text" class="form-control" id="search" name="search" placeholder="Rechercher un produit"
                value="<?= $search ?>">
            <button class="btn btn-outline-secondary" type="button" onclick="handleSearch()">Rechercher</button>
    </div>

</div>
<div class="d-flex flex-wrap justify-content-center gap-3 mt-3">
<?php foreach ($products as $product): ?>
    <div class="card" style="width: 18rem;">
        <img src="/images/<?= $product["image"] ?>" class="card-img-top" alt="<?= $product["name"] ?>">
        <div class="card-body">
            <h5 class="card-title"><?= $product["name"] ?></h5>
            <p class="card-text">Prix HT: <?= $product["prix_ht"] ?> €</p>
            <p class="card-text">Prix TTC: <?= $product["prix_ttc"] ?> €</p>
            <p class="card-text">Taux TVA: <?= $product["taux_tva"] ?> %</p>
            <p class="card-text">Zone de stockage: <?= $product["id_zone_stock"] ?></p>
            <a href="/product/edit/<?= $product["id"] ?>" class="btn btn-primary">Modifier</a>
            <a href="/product/delete/<?= $product["id"] ?>" class="btn btn-danger">Supprimer</a>
        </div>
    </div>
<?php endforeach; ?>
</div>

<div class="d-flex justify-content-center mt-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item <?= $page == 1 ? "disabled" : "" ?>">
                <a class="page-link" href="/product/index/<?= $page - 1 ?>/<?= $limit ?>/<?= $zone_stock ?>/<?= $search ?>">Précédent</a>
            </li>
            <?php for ($i = 1; $i <= ceil($nb_products / $limit); $i++): ?>
                <li class="page-item <?= $i == $page ? "active" : "" ?>">
                    <a class="page-link" href="/product/index/<?= $i ?>/<?= $limit ?>/<?= $zone_stock ?>/<?= $search ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= $page == ceil($nb_products / $limit) ? "disabled" : "" ?>">
                <a class="page-link" href="/product/index/<?= $page + 1 ?>/<?= $limit ?>/<?= $zone_stock ?>/<?= $search ?>">Suivant</a>
            </li>
        </ul>
    </nav>
</div>



