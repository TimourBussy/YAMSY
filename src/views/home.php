<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'?>

<body class="home">
  <header class="card-row">
    <div class="col">
      <div class="logo-horizontal">
        <img src="/public/images/logo-y.png" alt="YAMSY logo">
        <div class="col">
          <h1>YAMSY</h1>
          <p class="big">Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</p>
        </div>
      </div>
    </div>
    <a href="?action=logout">Déconnexion</a>
  </header>
  <main>

  </main>
</body>

</html>