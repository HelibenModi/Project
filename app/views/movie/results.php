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
     <a href="/movie/rating" class="btn btn-success mt-3">Add your Ratings</a>
      
    <?php else: ?>
        <div class="alert alert-danger">Movie not found.</div>
        <a href="/movie/index" class="btn btn-secondary">Search Another Movie</a>
    <?php endif;
