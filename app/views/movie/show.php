<?php require 'app/views/templates/headerPublic.php'; ?>

<main class="container py-5">
    <h2><?= $movie['Title'] ?? 'Movie Not Found' ?></h2>

    <?php if (!empty($movie['Poster']) && $movie['Poster'] != 'N/A'): ?>
        <img src="<?= $movie['Poster'] ?>" class="img-fluid mb-3" style="max-height: 400px;">
    <?php endif; ?>

    <p><strong>Year:</strong> <?= $movie['Year'] ?></p>
    <p><strong>Plot:</strong> <?= $movie['Plot'] ?></p>
    <p><strong>Rating:</strong> <?= $avgRating ?>/5</p>

    <form method="post" action="/movie/rate" class="mb-3">
        <input type="hidden" name="title" value="<?= $movie['Title'] ?>">
        <label for="rating">Rate this movie:</label>
        <select name="rating" class="form-select w-auto d-inline mx-2" required>
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor; ?>
        </select>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>

    <form method="post" id="reviewForm">
        <input type="hidden" name="title" value="<?= $movie['Title'] ?>">
        <button type="submit" class="btn btn-info">Get AI Review</button>
    </form>

    <div id="ai-review" class="mt-4 border p-3 rounded bg-light"></div>
</main>

<script>
document.getElementById("reviewForm").addEventListener("submit", async function(e) {
    e.preventDefault();
    const form = new FormData(this);
    const res = await fetch('/movie/review', {
        method: 'POST',
        body: form
    });
    const data = await res.json();
    document.getElementById("ai-review").innerText = data.review;
});
</script>
