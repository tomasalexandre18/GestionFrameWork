<?php
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
        Ajouter un produit
    </h1>
    <form action="/product/add" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nom du produit</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="prix_ht" class="form-label">Prix ht</label>
            <input type="number" class="form-control" id="prix_ht" name="prix_ht" required>
        </div>
        <!-- TVA / id_zone_stock / image -->
        <div class="mb-3">
            <label for="taux_tva" class="form-label">taux TVA</label>
            <input type="number" class="form-control" id="taux_tva" name="taux_tva" required>
        </div>

        <div class="mb-3">
            <label for="zone_stock_id" class="form-label">Zone de stockage</label>
            <select class="form-select" id="zone_stock_id" name="id_zone_stock" required>
                <option value="">Zone de stockage</option>
                <?php foreach ($zone_stocks as $zone): ?>
                    <option value="<?= $zone["id"] ?>"><?= $zone["libelle"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">

            <div class="d-flex justify-content-center">
                <label for="image" class="form-control d-flex justify-content-center align-items-center" style="width: 200px">Changer l'image</label>
                <img src="/img.png" class="img-fluid" id="image-preview"  style="width: 200px; height: 200px;" alt="Image de produit">
            </div>
            <input type="file" class="visually-hidden" id="image" name="image" accept="image/*" required>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>
</div>

