<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;

?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<div class="yatzy-container">
    <div class="game-container">
        <form action="" method="">
            <div class="dice-container">
                <div class="unsaved-container">
                    <h3 class="yatzy-header">Rolled Dice:</h3>
                    <div class="unsaved-dice">
                        <?php foreach ($unsaved as $index => $die) : ?>
                            <div class="dice">
                                <p><?= $die ?></p>
                                <input type="checkbox" name="unsaved" value="<?= $index ?>">
                            </div>
                        <?php endforeach ?>
                            </div>
                    </div>
                    <div class="saved-container">
                        <h3 class="yatzy-header">Saved Dice:</h3>
                        <div class="saved-dice">
                        <?php foreach ($saved as $index => $die) : ?>
                            <div class="dice">
                                <p><?= $die ?></p>
                                <input type="checkbox" name="saved" value="<?= $index ?>" checked>
                            </div>
                        <?php endforeach ?>
                        </div>
                    </div>
            </div>
            <div class="button-container">
                <button>Klicka på mig!</button>
            </div>
        </form>
    </div>
    <div class="score-container">
        <h3 class="yatzy-header">Score:</h3>
    </div>
</div>