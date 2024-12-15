<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Sign Up</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Sign Up</h1>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <small class="form-text text-muted">Password must be at least 6 characters long.</small>
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
    </div>
</body>
</html>
