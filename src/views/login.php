<?php
$mode ??= 'login';
$isSignup = $mode === 'signup';
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php' ?>

<body class="login">
  <div class="card-col login-card">
    <img src="/public/images/logo-full.png" alt="YAMSY logo" class="logo-full">
    <h5><?= $isSignup ? 'Create an account' : 'Login' ?></h5>

    <?php if (isset($error)): ?>
      <div class="error-message">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
      <div class="success-message">
        <?= htmlspecialchars($success) ?>
      </div>
    <?php endif; ?>

    <form action="?action=<?= $isSignup ? 'doSignup' : 'doLogin' ?>" method="post" id="authForm">
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
      <button type="submit" id="loginBtn" class="main-button"><?= $isSignup ? 'Create account' : 'Sign in' ?></button>
      <div class="link-wrapper">
        <a href="?action=<?= $isSignup ? 'login' : 'signup' ?>" class="have-account-link">
          <?= $isSignup ? 'Already have an account? Sign in' : 'No account? Sign up' ?>
        </a>
      </div>
    </form>
  </div>
  <script src="/public/js/loadingBtn.js"></script>
</body>

</html>