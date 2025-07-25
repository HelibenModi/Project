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

    <?php
    // Fetch average rating from database
    try {
        $db = new PDO($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
        $stmt = $db->prepare("SELECT AVG(rating) as avg_rating FROM ratings WHERE movie_title = ?");
        $stmt->execute([$movie['Title']]);
        $avg = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $avg = ['avg_rating' => null];
    }
    ?>

    <div class="mt-4">
        <h5>User Rating:</h5>
        <p><?= $avg['avg_rating'] ? round($avg['avg_rating'], 1) . "/10" : "No ratings yet" ?></p>
    </div>

    <div class="mt-4">
        <h5>Rate this Movie:</h5>
        <form action="/movie/rate" method="post" class="d-flex align-items-center gap-2">
            <input type="hidden" name="movie_title" value="<?= htmlspecialchars($movie['Title']) ?>">
            <label for="rating" class="form-label mb-0">Your Rating (1–10):</label>
            <input type="number" name="rating" min="1" max="10" class="form-control w-25" required>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>

<?php else: ?>
    <div class="alert alert-warning">Movie not found.</div>
<?php endif; ?>

</main>

<?php require 'app/views/templates/footer.php'; ?>
