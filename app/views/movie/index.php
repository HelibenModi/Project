<?php require 'app/views/templates/headerPublic.php'; ?>
<style>
    body {
        background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
        min-height: 100vh;
        color: #fff;
    }
    .card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.1);
    }
    .form-control {
        background: rgba(255,255,255,0.1);
        color: #fff;
        border: 1px solid rgba(255,255,255,0.2);
    }
    .form-control::placeholder {
        color: rgba(255,255,255,0.5);
    }
    .btn-primary {
        background-color: #ff7e5f;
        border: none;
    }
    .btn-primary:hover {
        background-color: #feb47b;
    }
    .btn-outline-secondary, .btn-outline-primary {
        border-color: rgba(255,255,255,0.5);
        color: #fff;
    }
    .btn-outline-secondary:hover, .btn-outline-primary:hover {
        background-color: rgba(255,255,255,0.2);
    }
</style>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-body p-5 text-center">
                    <h1 class="display-6 mb-4 fw-bold">Welcome to MovieFinder</h1>
                    <p class="mb-4 text-light">Search any movie, rate it, and get AI-generated reviews!</p>

                    <!-- Search Form -->
                    <form method="get" action="/movie/index" class="d-flex mb-4">
                        <input type="text" name="title" class="form-control form-control-lg" placeholder="Enter movie title..." required>
                        <button type="submit" class="btn btn-primary btn-lg ms-3">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </form>

                    <div class="d-flex justify-content-center mt-4">
                        <a href="/login/index" class="btn btn-outline-secondary me-3">Login</a>
                        <a href="/create/index" class="btn btn-outline-primary">Create Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require 'app/views/templates/footer.php'; ?>
