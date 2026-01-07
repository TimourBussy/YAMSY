<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php' ?>

<body class="game">
    <header class="card-row">
        <div class="col">
            <h2>Solo Mode</h2>
            <p><span class="bold underline">3</span> rolls left</p>
        </div>
        <a href="?action=home" class="button">Quit</a>
    </header>

    <div class="grid">
        <div class="card-col">
            <h3>Dice</h3>
            <div class="dices">
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <button class="dice initial">
                        <span class="dot top-left"></span>
                        <span class="dot top-center"></span>
                        <span class="dot top-right"></span>
                        <span class="dot middle-left"></span>
                        <span class="dot middle-center"></span>
                        <span class="dot middle-right"></span>
                        <span class="dot bottom-left"></span>
                        <span class="dot bottom-center"></span>
                        <span class="dot bottom-right"></span>
                    </button>
                <?php endfor ?>
            </div>
            <button class="main-button">
                <svg fill="#ffffff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 861.143 861.143" xml:space="preserve"
                    stroke="#ffffff">
                    <path
                        d="M456.213,730.502c-34.613,0-68.516-5.831-100.765-17.331c-31.171-11.115-60.159-27.272-86.161-48.024 c-52.042-41.536-89.225-99.817-104.693-164.109c-6.783-28.189-35.133-45.546-63.325-38.761 c-28.19,6.783-45.544,35.135-38.761,63.325c10.557,43.872,28.304,85.42,52.748,123.492c23.995,37.372,53.782,70.384,88.534,98.118 c35.098,28.013,74.258,49.833,116.393,64.858c43.6,15.547,89.367,23.431,136.031,23.431c54.643,0,107.678-10.713,157.633-31.843 c48.225-20.396,91.523-49.587,128.695-86.758s66.361-80.471,86.76-128.696c21.129-49.956,31.842-102.99,31.842-157.633 c0-54.642-10.713-107.678-31.842-157.633c-20.398-48.225-49.588-91.525-86.76-128.696S662.07,77.881,613.846,57.484 c-49.955-21.13-102.99-31.843-157.633-31.843c-79.907,0-157.211,23.258-223.558,67.259c-52.833,35.04-96.38,81.557-127.655,135.996 v-84.329c0-28.995-23.505-52.5-52.5-52.5S0,115.572,0,144.567v198.884c0,28.995,23.505,52.5,52.5,52.5h196.21 c28.994,0,52.5-23.505,52.5-52.5c0-28.995-23.506-52.5-52.5-52.5h-58.027c23.445-44.539,57.708-82.493,100.006-110.546 c49.088-32.555,106.324-49.763,165.522-49.763c80.113,0,155.434,31.198,212.084,87.848c56.648,56.65,87.848,131.967,87.848,212.081 s-31.197,155.434-87.848,212.083S536.326,730.502,456.213,730.502z">
                    </path>
                </svg>
                Roll Dice
            </button>
        </div>

        <?php
        $square = "
            <svg width='40' height='40' viewBox='0 0 40 40'>
                <rect x='5' y='5' width='30' height='30' fill='currentColor' />
            </svg>
        ";
        $circle = "
            <svg width='40' height='40' viewBox='0 0 40 40'>
                <circle cx='20' cy='20' r='15' fill='currentColor' />
            </svg>
        ";
        $diamond = "
            <svg width='40' height='40' viewBox='0 0 40 40'>
                <polygon points='20,5 35,20 20,35 5,20' fill='currentColor'/>
            </svg>
        ";
        $triangle = "
            <svg width='40' height='40' viewBox='0 0 40 40'>
                <polygon points='20,5 35,35 5,35' fill='currentColor'/>
            </svg>
        ";
        $star = "
            <svg width='40' height='40' viewBox='0 0 40 40'>
                <polygon points='20,3 24,15 37,15 26,23 30,35 20,27 10,35 14,23 3,15 16,15' fill='currentColor'/>
            </svg>
        ";
        ?>

        <div class="card-col outlined">
            <div class="user-info">
                <h3>
                    <?= htmlspecialchars($_SESSION['username']); ?>
                </h3>
                <span class="rounded-bg">Your turn</span>
            </div>
            <div class="grid game-grid initial">
                <div class="col">
                    <button>Ones (1)</button>
                    <button>Twos (2)</button>
                    <button>Threes (3)</button>
                    <button>Fours (4)</button>
                    <button>Fives (5)</button>
                    <button>Sixes (6)</button>
                </div>
                <div class="col">
                    <button>
                        Three of a Kind
                        <span class="shapes"><?= str_repeat($square, 3); ?></span>
                    </button>
                    <button>
                        Four of a Kind
                        <span class="shapes"><?= str_repeat($circle, 4); ?></span>
                    </button>
                    <button>
                        Full House
                        <span class="shapes"><?= str_repeat($diamond, 3) . str_repeat($triangle, 2); ?></span>
                    </button>
                    <button>
                        Small Straight
                        <span class="shapes"><?= $square . $circle . $diamond . $triangle; ?></span>
                    </button>
                    <button>
                        Large Straight
                        <span class="shapes"><?= $square . $circle . $diamond . $triangle . $star; ?></span>
                    </button>
                    <button>
                        YAMSY
                        <span class="shapes"><?= str_repeat($star, 5); ?></span>
                    </button>
                    <button>Chance (any)</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>