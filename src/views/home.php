<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php' ?>

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
      <div class="row">
        <svg viewBox="-10 -10 44.15 44.15" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)">
            <rect x="-10" y="-10" width="44.15" height="44.15" rx="8.8" fill="#FFEDD4"></rect>
          </g>
          <g id="SVGRepo_iconCarrier" transform="scale(0.8) translate(3.25 3)">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M12 1C8.96243 1 6.5 3.46243 6.5 6.5C6.5 9.53757 8.96243 12 12 12C15.0376 12 17.5 9.53757 17.5 6.5C17.5 3.46243 15.0376 1 12 1ZM8.5 6.5C8.5 4.567 10.067 3 12 3C13.933 3 15.5 4.567 15.5 6.5C15.5 8.433 13.933 10 12 10C10.067 10 8.5 8.433 8.5 6.5Z"
              fill="#fdb018"></path>
            <path
              d="M8 14C4.68629 14 2 16.6863 2 20V22C2 22.5523 2.44772 23 3 23C3.55228 23 4 22.5523 4 22V20C4 17.7909 5.79086 16 8 16H16C18.2091 16 20 17.7909 20 20V22C20 22.5523 20.4477 23 21 23C21.5523 23 22 22.5523 22 22V20C22 16.6863 19.3137 14 16 14H8Z"
              fill="#fdb018"></path>
          </g>
        </svg>
        <h2>Solo Mode</h2>
      </div>
      <p>Play alone and try to beat your best score!</p>
    </div>

    <div class="card-col">
      <div class="row">
        <svg viewBox="-10 -10 44.15 44.15" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)">
            <rect x="-10" y="-10" width="44.15" height="44.15" rx="8.8" fill="#fef3c6"></rect>
          </g>
          <g id="SVGRepo_iconCarrier" transform="scale(0.8) translate(3.75 3.75)">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M9 0C5.96243 0 3.5 2.46243 3.5 5.5C3.5 8.53757 5.96243 11 9 11C12.0376 11 14.5 8.53757 14.5 5.5C14.5 2.46243 12.0376 0 9 0ZM5.5 5.5C5.5 3.567 7.067 2 9 2C10.933 2 12.5 3.567 12.5 5.5C12.5 7.433 10.933 9 9 9C7.067 9 5.5 7.433 5.5 5.5Z"
              fill="#fa8711"></path>
            <path
              d="M15.5 0C14.9477 0 14.5 0.447715 14.5 1C14.5 1.55228 14.9477 2 15.5 2C17.433 2 19 3.567 19 5.5C19 7.433 17.433 9 15.5 9C14.9477 9 14.5 9.44771 14.5 10C14.5 10.5523 14.9477 11 15.5 11C18.5376 11 21 8.53757 21 5.5C21 2.46243 18.5376 0 15.5 0Z"
              fill="#fa8711"></path>
            <path
              d="M19.0837 14.0157C19.3048 13.5096 19.8943 13.2786 20.4004 13.4997C22.5174 14.4246 24 16.538 24 19V21C24 21.5523 23.5523 22 23 22C22.4477 22 22 21.5523 22 21V19C22 17.3613 21.0145 15.9505 19.5996 15.3324C19.0935 15.1113 18.8625 14.5217 19.0837 14.0157Z"
              fill="#fa8711"></path>
            <path
              d="M6 13C2.68629 13 0 15.6863 0 19V21C0 21.5523 0.447715 22 1 22C1.55228 22 2 21.5523 2 21V19C2 16.7909 3.79086 15 6 15H12C14.2091 15 16 16.7909 16 19V21C16 21.5523 16.4477 22 17 22C17.5523 22 18 21.5523 18 21V19C18 15.6863 15.3137 13 12 13H6Z"
              fill="#fa8711"></path>
          </g>

        </svg>
        <h2>Multiplayer Mode</h2>
      </div>
      <p>Play with 2, 3 or 4 players on the same device!</p>
    </div>

    <div class="card-col">
      <div class="row">
        <svg class="trophee" viewBox="-2.4 -4 28.8 32" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#fdb018"
          stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
          <g transform="translate(0, -1)">
            <path
              d="M12.0002 16C6.24021 16 5.21983 10.2595 5.03907 5.70647C4.98879 4.43998 4.96365 3.80673 5.43937 3.22083C5.91508 2.63494 6.48445 2.53887 7.62318 2.34674C8.74724 2.15709 10.2166 2 12.0002 2C13.7837 2 15.2531 2.15709 16.3771 2.34674C17.5159 2.53887 18.0852 2.63494 18.5609 3.22083C19.0367 3.80673 19.0115 4.43998 18.9612 5.70647C18.7805 10.2595 17.7601 16 12.0002 16Z" />
            <path
              d="M19 5L19.9486 5.31621C20.9387 5.64623 21.4337 5.81124 21.7168 6.20408C22 6.59692 22 7.11873 21.9999 8.16234V8.23487C21.9999 9.09561 21.9999 9.52598 21.7927 9.87809C21.5855 10.2302 21.2093 10.4392 20.4569 10.8572L17.5 12.5" />
            <path
              d="M5 5L4.05132 5.31621C3.06126 5.64623 2.56623 5.81124 2.2831 6.20408C1.99996 6.59692 2 7.11873 2 8.16234V8.23487C2 9.09561 2 9.52598 2.20723 9.87809C2.41441 10.2302 2.79063 10.4392 3.54305 10.8572L6.5 12.5" />
            <path d="M12 17V19" />
            <path
              d="M15.5 22H8.5L8.83922 20.3039C8.93271 19.8365 9.34312 19.5 9.8198 19.5H14.1802C14.6569 19.5 15.0673 19.8365 15.1608 20.3039L15.5 22Z" />
            <path d="M18 22H6" />
          </g>
        </svg>
        <h3>Top 5 Solo Scores</h2>
      </div>
      <p>No games played yet</p>
    </div>

    <div class="card-col">
      <div class="row">
        <svg class="trophee" viewBox="-2.4 -4 28.8 32" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#fa8711"
          stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
          <g transform="translate(0, -1)">
            <path
              d="M12.0002 16C6.24021 16 5.21983 10.2595 5.03907 5.70647C4.98879 4.43998 4.96365 3.80673 5.43937 3.22083C5.91508 2.63494 6.48445 2.53887 7.62318 2.34674C8.74724 2.15709 10.2166 2 12.0002 2C13.7837 2 15.2531 2.15709 16.3771 2.34674C17.5159 2.53887 18.0852 2.63494 18.5609 3.22083C19.0367 3.80673 19.0115 4.43998 18.9612 5.70647C18.7805 10.2595 17.7601 16 12.0002 16Z" />
            <path
              d="M19 5L19.9486 5.31621C20.9387 5.64623 21.4337 5.81124 21.7168 6.20408C22 6.59692 22 7.11873 21.9999 8.16234V8.23487C21.9999 9.09561 21.9999 9.52598 21.7927 9.87809C21.5855 10.2302 21.2093 10.4392 20.4569 10.8572L17.5 12.5" />
            <path
              d="M5 5L4.05132 5.31621C3.06126 5.64623 2.56623 5.81124 2.2831 6.20408C1.99996 6.59692 2 7.11873 2 8.16234V8.23487C2 9.09561 2 9.52598 2.20723 9.87809C2.41441 10.2302 2.79063 10.4392 3.54305 10.8572L6.5 12.5" />
            <path d="M12 17V19" />
            <path
              d="M15.5 22H8.5L8.83922 20.3039C8.93271 19.8365 9.34312 19.5 9.8198 19.5H14.1802C14.6569 19.5 15.0673 19.8365 15.1608 20.3039L15.5 22Z" />
            <path d="M18 22H6" />
          </g>
        </svg>
        <h3>Top 5 Multi Players</h2>
      </div>
      <p>No games played yet</p>
    </div>
  </main>
</body>

</html>