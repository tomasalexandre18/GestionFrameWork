<div id="container">
    <h1 class="text-center">Add a Student</h1>
    <form method="post" action="/student/add/">
        <div class="d-flex flex-column align-items-center">
            <div class="mb-3">
                <label for="lastname" class="form-label">Nom</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="surname" name="surname"" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>

            <div class="d-flex flex-row gap-2">
                <button type="submit" class="btn btn-primary">Add</button>
                <a href="/student/index" class="btn btn-secondary">Annuler</a>
            </div>
        </div>
    </form>
</div>
