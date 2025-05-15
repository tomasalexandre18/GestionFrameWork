<?php
/** @var array $data ['id" => int, 'surname' => string, 'name' => string, 'email' => string, 'age'=>int] */
/** @var bool $successes */
?>

<div id="container">
    <h1 class="text-center">Modifier <?= $data['lastname'] ?> <?= $data['surname'] ?></h1>
    <form method="post" action="/student/edit/<?= $data['id'] ?>">
        <div class="d-flex flex-column align-items-center">
            <div class="mb-3">
                <label for="lastname" class="form-label">Nom</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $data['lastname'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="surname" name="surname" value="<?= $data['surname'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $data['email'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" value="<?= $data['age'] ?>" required>
            </div>

            <?php if ($successes): ?>
                <p style='color:green'>Modification réussie !</p>
            <?php endif; ?>
            <div class="d-flex flex-row gap-2">
                <button type="submit" class="btn btn-primary">Modifier</button>
                <a href="/student/index" class="btn btn-secondary">Annuler</a>
                <a href="/student/delete/<?= $data['id'] ?>" class="btn btn-danger">Supprimer</a>
            </div>
        </div>
    </form>
</div>
