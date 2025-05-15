<?php
/** @var int $id */
?>

<div id="container">
    <h1 class="text-center">Add a Student</h1>
    <form method="post" action="/note/add/<?= $id ?>">
        <div class="d-flex flex-column align-items-center">
            <div class="mb-3">
                <label for="mat" class="form-label">Mattiere</label>
                <input type="text" class="form-control" id="mat" name="mat" required>
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <input type="number" class="form-control" id="note" name="note" required>
            </div>

            <div class="d-flex flex-row gap-2">
                <button type="submit" class="btn btn-primary">Add</button>
                <a href="/student/info/<?= $id ?>" class="btn btn-secondary">Annuler</a>
            </div>
        </div>
    </form>
</div>