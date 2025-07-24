<?php if (isset($movie)) : ?>
    <div class="container mt-4">
        <h2><?= htmlspecialchars($movie['Title']) ?> (<?= $movie['Year'] ?>)</h2>
        <p><strong>Genre:</strong> <?= htmlspecialchars($movie['Genre']) ?></p>
        <p><strong>Plot:</strong> <?= htmlspecialchars($movie['Plot']) ?></p>
        <img src="<?= htmlspecialchars($movie['Poster']) ?>" alt="Poster" class="img-fluid">
    </div>
<?php else : ?>
    <p class="text-danger">Movie data not found.</p>
<?php endif; ?>
