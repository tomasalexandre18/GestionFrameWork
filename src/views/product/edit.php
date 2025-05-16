<?php
/** @var $product array 1D */
/** @var $zone_stocks array 2D */
?>

<script type="module">
    const imageInput = document.getElementById("image");
    const imagePreview = document.getElementById("image-preview")
    imageInput.addEventListener("change", (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

</script>
<div class="w-100 d-flex justify-content-center gap-3 align-items-center flex-column">
    <h1>
        Modifier un produit
    </h1>
    <form action="/product/edit/<?= $product["id"] ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nom du produit</label>
            <input type="text" class="form-control" id="name" name="name" required value="<?= $product["name"] ?>">
        </div>
        <div class="mb-3">
            <label for="prix_ht" class="form-label">Prix ht</label>
            <input type="number" class="form-control" id="prix_ht" name="prix_ht" required value="<?= $product["prix_ht"] ?>">
        </div>
        <!-- TVA / id_zone_stock / image -->
        <div class="mb-3">
            <label for="taux_tva" class="form-label">taux TVA</label>
            <input type="number" class="form-control" id="taux_tva" name="taux_tva" required value="<?= $product["taux_tva"] ?>">
        </div>

        <div class="mb-3">
            <label for="zone_stock_id" class="form-label">Zone de stockage</label>
            <select class="form-select" id="zone_stock_id" name="id_zone_stock" required>
                <option value="">Zone de stockage</option>
                <?php foreach ($zone_stocks as $zone): ?>
                    <option value="<?= $zone["id"] ?>" <?= $zone["id"] == $product["id_zone_stock"] ? "selected" : "" ?>><?= $zone["libelle"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">

            <div class="d-flex justify-content-center">
                <label for="image" class="form-control d-flex justify-content-center align-items-center" style="width: 200px">Changer l'image</label>
                <img src="/images/<?= $product["image"] ?>" class="img-fluid" id="image-preview" alt="<?= $product["name"] ?>" style="width: 200px; height: 200px;">
            </div>
            <input type="file" class="visually-hidden" id="image" name="image" accept="image/*">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Modifier</button>
        </div>
    </form>
</div>

