<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!empty($_SESSION['auth'])) {
		header('Location: /reminders');
		exit;
}
require 'app/views/templates/headerPublic.php';
?>
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
										<h1 class="fw-bold">Login</h1>
										<p class="lead">It's so much better when you sign in.</p>
								</div>

								<?php if (!empty($_SESSION['error'])): ?>
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
												<?= $_SESSION['error'] ?>
												<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										</div>
										<?php unset($_SESSION['error']); ?>
								<?php endif; ?>

								<form action="/login/verify" method="post">
										<div class="mb-3">
												<input type="text" name="username" class="form-control form-control-lg" placeholder="Username" required>
										</div>
										<div class="mb-4">
												<input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
										</div>
										<button type="submit" class="btn btn-primary btn-lg w-100">Login</button>
								</form>

							
						</div>
				</div>
		</div>
</main>
<?php require 'app/views/templates/footer.php'; ?>
