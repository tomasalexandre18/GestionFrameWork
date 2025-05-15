<?php
/** @var array $data ['id" => int, 'surname' => string, 'name' => string, 'email' => string, 'age'=>int] */
?>

<div class="d-flex flex-column align-items-center" id="container">
    <div class="d-flex flex-row justify-content-between w-50">
        <h1 style="text-align: center">Student</h1>
        <h1>
            <a href="/student/add" class="btn btn-success">
                Ajouter un élève
            </a>
        </h1>
    </div>
    <table class="table table-striped table-bordered w-50">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $student): ?>
                <tr>
                    <td><?= $student['surname'] ?> <?= $student['lastname'] ?></td>
                    <td><?= $student['email'] ?></td>
                    <td class="d-flex flex-row gap-2">
                        <a href="/student/info/<?= $student['id'] ?>" class="btn btn-primary flex-grow-1">Info</a>
                        <a href="/student/edit/<?= $student['id'] ?>" class="btn btn-warning flex-grow-1">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
</div>
