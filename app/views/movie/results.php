<?php require 'app/views/templates/headerPublic.php'; ?>
<main class="container py-5">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
        <a href="/movie/index" class="btn btn-secondary mt-3">Search Another Movie</a>
    <?php elseif ($movie): ?>
        <h2><?= htmlspecialchars($movie['Title']) ?> (<?= htmlspecialchars($movie['Year']) ?>)</h2>
        <p><strong>Genre:</strong> <?= htmlspecialchars($movie['Genre']) ?></p>
        <p><strong>Plot:</strong> <?= htmlspecialchars($movie['Plot']) ?></p>
        <img src="<?= htmlspecialchars($movie['Poster']) ?>" alt="Poster" class="img-fluid">

        <div class="mt-4">
            <h4>AI Review:</h4>
            <div class="alert alert-info"><?= nl2br(htmlspecialchars($review)) ?></div>
        </div>
    <?php else: ?>
        <p class="text-danger">Unexpected Error. Movie data not found.</p>
    <?php endif; ?>
</main>
<?php require 'app/views/templates/footer.php'; ?>
