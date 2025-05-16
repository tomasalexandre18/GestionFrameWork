<?php
// ville / CP / adresse /libelle
?>

<div class="w-100 d-flex justify-content-center gap-3 align-items-center flex-column">
    <h1>
        Ajouter une zone de stockage
    </h1>
    <form method="post" class="w-50">
        <div class="mb-3">
            <label for="libelle" class="form-label">Libelle</label>
            <input type="text" class="form-control" id="libelle" name="libelle" required>
        </div>
        <div class="mb-3">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville" required>
        </div>
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" required>
        </div>
        <div class="mb-3">
            <label for="code_postal" class="form-label">Code postal</label>
            <input type="text" class="form-control" id="code_postal" name="code_postal" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Ajouter</button>
    </form>
    <a href="/zone_stock/index" class="btn btn-secondary mt-3">Retour à la liste des zones de stockage</a>
</div>
