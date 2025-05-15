<?php
/** @var $data array ["mat", "note"]*/
/** @var $id_student int */
/** @var $id_note int */
?>

<div id="container">
    <h1 class="text-center">Modifier la note</h1>
    <form method="post" action="/note/edit/<?= $id_student ?>/<?= $id_note ?>">
        <div class="d-flex flex-column align-items-center">
            <div class="mb-3">
                <label for="mat" class="form-label">Matiere</label>
                <input type="text" class="form-control" id="mat" name="mat" value="<?= $data['mat'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <input type="number" class="form-control" id="note" name="note" value="<?= $data['note'] ?>" required>
            </div>
            <div class="d-flex flex-row gap-2">
                <button type="submit" class="btn btn-primary">Modifier</button>
                <a href="/student/info/<?= $id_note ?>" class="btn btn-secondary">Annuler</a>
            </div>
        </div>
    </form>
</div>
