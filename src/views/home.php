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
    <a href="?action=logout" class="button">Logout</a>
  </header>

  <main class="grid">
    <div class="card-col">
      <div>
        <svg viewBox="-10.08 -10.08 44.16 44.16" fill="none" xmlns="http://www.w3.org/2000/svg"
          transform="matrix(1, 0, 0, 1, 0, 0)">
          <g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)">
            <rect x="-10.08" y="-10.08" width="44.16" height="44.16" rx="8.831999999999999" fill="#FFEDD4"
              strokewidth="0"></rect>
          </g>
          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC"
            stroke-width="0.048"></g>
          <g id="SVGRepo_iconCarrier">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M12 1C8.96243 1 6.5 3.46243 6.5 6.5C6.5 9.53757 8.96243 12 12 12C15.0376 12 17.5 9.53757 17.5 6.5C17.5 3.46243 15.0376 1 12 1ZM8.5 6.5C8.5 4.567 10.067 3 12 3C13.933 3 15.5 4.567 15.5 6.5C15.5 8.433 13.933 10 12 10C10.067 10 8.5 8.433 8.5 6.5Z"
              fill="#FDB018"></path>
            <path
              d="M8 14C4.68629 14 2 16.6863 2 20V22C2 22.5523 2.44772 23 3 23C3.55228 23 4 22.5523 4 22V20C4 17.7909 5.79086 16 8 16H16C18.2091 16 20 17.7909 20 20V22C20 22.5523 20.4477 23 21 23C21.5523 23 22 22.5523 22 22V20C22 16.6863 19.3137 14 16 14H8Z"
              fill="#FDB018"></path>
          </g>
        </svg>
      </div>
    </div>
  </main>
</body>

</html>