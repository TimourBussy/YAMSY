<?php
$mode ??= 'login';
$isSignup = $mode === 'signup';
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'?>
<body>
    <div class="card login-card">
        <img src="/public/images/logo-full.png" alt="YAMSY logo: orange and yellow Y-shaped symbol with bold yellow text reading YAMSY below it, representing a fun dice game for single and multiplayer gaming" class="logo-full">
        <h4><?= $isSignup ? 'Create an account' : 'Login' ?></h4>
        <form action="?action=doLogin" method="post">
            <div class="text-field-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" autocomplete="username" required>
            </div>
            <div class="text-field-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <?php if (!$isSignup): ?>
                <div class="checkbox-field-group">
                    <input type="checkbox" id="rememberMe" name="rememberMe">
                    <label for="rememberMe">Remember me</label>
                </div>
            <?php endif; ?>
            <button type="submit" class="main-button"><?= $isSignup ? 'Create account' : 'Sign in' ?></button>
            <div class="orange-link-wrapper">
                <a href="?action=login&mode=<?= $isSignup ? 'login' : 'signup' ?>" class="orange-link">
                    <?= $isSignup ? 'Already have an account? Sign in' : 'No account? Sign up' ?>
                </a>
            </div>
        </form>
    </div>
</body>
</html>
