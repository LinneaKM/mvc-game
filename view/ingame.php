<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\url;

$updateUrl = url("/game21/update");


?>
<div class="score-div">
    <div class="player-score">
        <h3>Player score</h3>
        <p><?= $playerScore ?></p>
        <?php if ($playerRoll) : ?>
            <pre><?= $playerRoll ?></pre>
        <?php endif; ?>
    </div>
    <div class="computer-score">
        <h3>Computer score</h3>
        <p><?= $computerScore ?></p>
    </div>
</div>

<form action="<?= $updateUrl ?>" method="POST">
    <input type="submit" name="action" value="Roll" <?php echo ($gameStatus == "endgame" || $playerScore >= 21) ? "disabled" : ''; ?>>
    <input type="submit" name="action" value="End turn" <?php echo ($gameStatus == "endgame") ? "disabled" : ''; ?>>
    <input type="submit" name="action" value="New round" <?php echo ($gameStatus == "ingame") ? "disabled" : ''; ?>>
    <input type="submit" name="action" value="Clear rounds">
</form>

<?php if ($gameStatus == "ingame" && $playerScore == 21) : ?>
    <h2>Congratulations!!</h2>
<?php elseif ($winOrLose == "win") : ?>
    <h2>You won this round!</h2>
<?php elseif ($winOrLose == "lose") : ?>
    <h2>Computer won this round!</h2>
<?php endif; ?>

<?php if ($roundArray) : ?>
    <?php foreach ($roundArray as $key => $value) : ?>
        <p>Round <?= $key ?>: <?= $value ?></p>
    <?php endforeach ?>
<?php endif ?>
