<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Uppgift 5.5</title>
    <link rel="stylesheet" href="https://cdn.rawgit.com/Chalarangelo/mini.css/v3.0.1/dist/mini-default.min.css" &gt; <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="kontainer">
        <h1>Passwordmeter</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label>Lösenord</label>
            <input type="text" name="losen" required>
            <button class="primary">Skicka</button>
        </form>
        <?php
        /* Ta emot data som skickas */
        $losen = filter_input(INPUT_POST, 'losen', FILTER_SANITIZE_STRING);
        $fel = true;
        $vPoäng = 0;
        $gPoäng = 0;
        $sPoäng = 0;
        $spPoäng = 0;
        $lPoäng = 0;
        if ($losen) {
            if (preg_match("/[A-ZÅÄÖ]/", $losen) > 0) {
                $vPoäng += 1;
            }
            if (preg_match("/[a-zåäö]/", $losen) > 0) {
                $gPoäng += 1;
            }
            if (preg_match("/[0-9]/", $losen) > 0) {
                $sPoäng += 1;
            }
            if (preg_match("/[#%&¤_\*\-\+\@\!\?\(\)\[\]\$£€]/", $losen) > 0) {
                $spPoäng += 1;
            }
            if (preg_match("/^.{8,40}$/", $losen) > 0) {
                $lPoäng += 1;
            }
            echo "<p>Ditt lösenord är: $losen</p>";
            echo "<p>Poängen är: $vPoäng + $gPoäng + $sPoäng + $spPoäng + $lPoäng</p>";

            if ($vPoäng == 0 || $gPoäng == 0 || $sPoäng == 0 || $spPoäng == 0 || $lPoäng == 0) {
                echo "<p>Lösenordet uppfyller inte alla kriterier.</p>";
            } else {
                $poäng = $vPoäng + $gPoäng + $sPoäng + $spPoäng + $lPoäng;
                echo "<p>Lösenordet fick $poäng poäng.</p>";
            }
        }
        ?>
    </div>
</body>

</html>