<?php
/** @var array $data */
/** @var array $notes */
?>

<div id="container">
    <h1 class="text-center">Information sur <?= $data['lastname'] ?> <?= $data['surname'] ?></h1>
    <div class="d-flex flex-column align-items-center">
        <table class="table table-striped table-bordered w-50">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Age</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $data['lastname'] ?></td>
                    <td><?= $data['surname'] ?></td>
                    <td><?= $data['email'] ?></td>
                    <td><?= $data['age'] ?></td>
                </tr>
            </tbody>
        </table>
        <h1 class="text-center">Notes</h1>
        <h1 class="btn btn-success">
            <a href="/note/add/<?= $data['id'] ?>" class="text-white">Ajouter une note</a>
        </h1>
        <table class="table table-striped table-bordered w-50">
            <thead>
                <tr>
                    <th>Note</th>
                    <th>Matière</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notes as $note): ?>
                    <tr>
                        <td><?= $note['note'] ?></td>
                        <td><?= $note['mat'] ?></td>
                        <td>
                            <a href="/note/delete/<?= $data["id"] ?>/<?= $note['id'] ?>" class="btn btn-danger">Supprimer</a>
                            <a href="/note/edit/<?= $data['id'] ?>/<?= $note["id"] ?>" class="btn btn-warning">Modifier</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="/student/index" class="btn btn-primary">Retour</a>
</div>