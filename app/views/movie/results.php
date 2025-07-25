<?php require 'app/views/templates/headerPublic.php'; ?>
<main class="container py-5">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger text-center">
            <?= htmlspecialchars($error) ?>
        </div>
        <div class="text-center mt-4">
            <a href="/movie/index" class="btn btn-secondary btn-lg">
                <i class="bi bi-arrow-left-circle"></i> Search Another Movie
            </a>
        </div>
    <?php elseif ($movie): ?>
        <div class="row g-5 align-items-start">
            <div class="col-lg-4 text-center">
                <img src="<?= htmlspecialchars($movie['Poster']) ?>" class="img-fluid rounded-4 shadow-sm" alt="<?= htmlspecialchars($movie['Title']) ?>">
            </div>
            <div class="col-lg-8">
                <h2 class="fw-bold"><?= htmlspecialchars($movie['Title']) ?> (<?= htmlspecialchars($movie['Year']) ?>)</h2>
                <p class="fs-5"><strong>Genre:</strong> <?= htmlspecialchars($movie['Genre']) ?></p>
                <p class="fs-6 text-muted"><strong>Plot:</strong> <?= htmlspecialchars($movie['Plot']) ?></p>

                <div class="mt-4">
                    <h4 class="fw-bold">AI Review:</h4>
                    <div class="alert alert-info shadow-sm"><?= nl2br(htmlspecialchars($review)) ?></div>
                </div>

                <div class="mt-4">
                    <!-- Star Rating Form -->
                    <?php require 'app/views/movie/rating.php'; ?>
                </div>

                <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                    <div class="alert alert-success d-flex align-items-center mt-3" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        Thank you! Your rating has been submitted successfully.
                    </div>
                <?php endif; ?>

                <div class="mt-4">
                    <a href="/movie/index" class="btn btn-secondary btn-lg">
                        <i class="bi bi-arrow-left-circle"></i> Search Another Movie
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger text-center">
            Unexpected Error. Movie data not found.
        </div>
    <?php endif; ?>
</main>
<?php require 'app/views/templates/footer.php'; ?>
