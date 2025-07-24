<?php require 'app/views/templates/headerPublic.php'; ?>

<main class="container py-5">
    <h2 class="mb-4 text-center">Search a Movie</h2>
    <form method="get" action="/movie/search" class="d-flex justify-content-center">
        <input type="text" name="title" class="form-control w-50" placeholder="Enter movie title..." required>
        <button type="submit" class="btn btn-primary ms-2">Search</button>
    </form>
</main>
