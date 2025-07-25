<?php require 'app/views/templates/headerPublic.php'; ?>
<main class="container py-5">

    <?php if ($movie): ?>
        <h2><?= htmlspecialchars($movie['Title']) ?> (<?= htmlspecialchars($movie['Year']) ?>)</h2>
        <p><strong>Genre:</strong> <?= htmlspecialchars($movie['Genre']) ?></p>
        <p><strong>Plot:</strong> <?= htmlspecialchars($movie['Plot']) ?></p>
        <img src="<?= htmlspecialchars($movie['Poster']) ?>" alt="Poster" class="img-fluid mb-4">

        <div class="mt-4">
            <h4>AI Review:</h4>
            <div class="alert alert-info"><?= nl2br(htmlspecialchars($review)) ?></div>
        </div>

        <!-- Include the rating form -->
        <?php require 'app/views/movie/rating.php'; ?>
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            Thank you! Your rating has been submitted successfully.
        </div>
    <?php endif; ?>

    <?php elseif (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <a href="/movie/index" class="btn btn-secondary mt-3">Search Another Movie</a>
    <?php endif; ?>

</main>
<?php require 'app/views/templates/footer.php'; ?>
