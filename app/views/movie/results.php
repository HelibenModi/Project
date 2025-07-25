<?php require 'app/views/templates/headerPublic.php'; ?>

<main class="container py-5">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"> <?= htmlspecialchars($error) ?> </div>
    <?php elseif ($movie): ?>
        <div class="row mb-5">
            <div class="col-md-4">
                <img src="<?= htmlspecialchars($movie['Poster']) ?>" alt="Poster" class="img-fluid rounded">
            </div>
            <div class="col-md-8">
                <h2><?= htmlspecialchars($movie['Title']) ?> (<?= htmlspecialchars($movie['Year']) ?>)</h2>
                <p><strong>Genre:</strong> <?= htmlspecialchars($movie['Genre']) ?></p>
                <p><strong>Plot:</strong> <?= htmlspecialchars($movie['Plot']) ?></p>
                <div class="mt-3">
                    <h4>AI Review:</h4>
                    <div class="alert alert-info"> <?= nl2br(htmlspecialchars($review)) ?> </div>
                </div>
            </div>
        </div>

        <?php require 'app/views/movie/rating.php'; ?>

        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="toast show position-fixed bottom-0 end-0 m-3">
                <div class="toast-header bg-success text-white">
                    <i class="bi bi-check-circle-fill me-2"></i> Success
                    <button type="button" class="btn-close text-white" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body text-dark">
                    Thank you! Your rating has been submitted successfully.
                </div>
                <div class="toast-body text-center">
                    <a href="/movie/index" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-search"></i> Search Another Movie
                    </a>
                </div>
            </div>
        <?php endif; ?>

    <?php else: ?>
        <div class="alert alert-warning mt-4">No movie found. Please try another title.</div>
    <?php endif; ?>
</main>

<?php require 'app/views/templates/footer.php'; ?>
