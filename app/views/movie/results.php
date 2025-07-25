
<?php require 'app/views/templates/headerPublic.php'; ?>

<main class="container py-4">

<?php if (isset($movie)): ?>
    <h2><?= htmlspecialchars($movie['Title']) ?> (<?= htmlspecialchars($movie['Year']) ?>)</h2>
    <p><strong>Genre:</strong> <?= htmlspecialchars($movie['Genre']) ?></p>
    <p><strong>Plot:</strong> <?= htmlspecialchars($movie['Plot']) ?></p>

    <?php if ($movie['Poster'] !== 'N/A'): ?>
        <img src="<?= htmlspecialchars($movie['Poster']) ?>" alt="Poster" class="img-fluid">
    <?php endif; ?>

    <div class="mt-4">
        <h4>AI Review:</h4>
        <div class="alert alert-info"><?= nl2br(htmlspecialchars($review)) ?></div>
    </div>

<?php else: ?>
    <div class="alert alert-warning">Movie not found.</div>
<?php endif; ?>

</main>

<?php require 'app/views/templates/footer.php'; ?>
