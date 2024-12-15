<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form action="/register" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirm">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirm" id="password_confirm" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <a href="login.php">Already have an account? Login here</a>
    </div>
</body>
</html>
