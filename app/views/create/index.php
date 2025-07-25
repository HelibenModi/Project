<?php require_once 'app/views/templates/headerPublic.php' ?>
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
        padding: 2rem;
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
</style>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="text-center mb-4">
                    <h1 class="fw-bold">Create Account</h1>
                </div>

                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <form action="/create/register" method="post">
                    <div class="mb-3">
                        <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required 
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}" 
                        title="Must contain at least one number, one uppercase and lowercase letter, and at least 10 or more characters">
                    </div>
                    <div class="mb-4">
                        <input type="password" name="confirm_password" class="form-control form-control-lg" placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100">Register</button>
                </form>

                <div class="text-center mt-4">
                    <a href="/login/index" class="text-white">Already have an account? Login</a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once 'app/views/templates/footer.php' ?>
