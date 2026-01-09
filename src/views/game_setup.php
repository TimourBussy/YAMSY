<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php' ?>

<body class="game-setup">
    <div class="card-col">
        <h2>Game Setup</h2>
        <form action="?action=game" method="post" id="setupForm">
            <fieldset>
                <legend>Number of players</legend>
                <input type="radio" name="nbPlayers" id="nbp2" value="2" checked>
                <label for="nbp2">2 players</label>
                <input type="radio" name="nbPlayers" id="nbp3" value="3">
                <label for="nbp3">3 players</label>
                <input type="radio" name="nbPlayers" id="nbp4" value="4">
                <label for="nbp4">4 players</label>
            </fieldset>
            <fieldset>
                <legend>Player names</legend>
                <div id="playerNames">
                    <input type="text" name="players[]" id="p1Name"
                        placeholder="<?= htmlspecialchars($_SESSION['username']) ?>">
                    <input type="text" name="players[]" id="p2Name" placeholder="Player 2">
                </div>
            </fieldset>
            <div class="row">
                <a href="?action=home" class="button">Cancel</a>
                <button type="submit" id="startBtn" class="main-button">Start</button>
            </div>
        </form>
    </div>

    <script src="/public/js/nbPlayers.js"></script>
</body>

</html>