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
    <a href="/product/add" class="btn btn-primary">Ajouter un produit</a>
    <a href="/zone_stock/index" class="btn btn-secondary">Gérer les zones de stockage</a>
</div>
<div class="d-flex flex-wrap justify-content-center gap-3 mt-3">
<?php foreach ($products as $product): ?>
    <div class="card" style="width: 18rem;">
        <div class="ratio ratio-1x1">
            <img src="/images/<?= $product["image"] ?>" class="card-img-top object-fit-contain" alt="<?= $product["name"] ?>">
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5 class="card-title"><?= $product["name"] ?></h5>
                <h5 class="card-title"><?= $product["prix_ttc"] ?> € TTC</h5>
            </div>
            <p class="card-text">Zone de stockage: <?= $product["id_zone_stock"] ?></p>
            <div class="d-flex justify-content-between gap-2">
                <a href="/product/view/<?= $product["id"] ?>" class="btn btn-primary flex-grow-1">Voir le produit</a>
            </div>
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



