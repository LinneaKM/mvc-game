<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\url;

$updateUrl = url("/yatzy/update");

?>

<div class="yatzy-container">
    <div class="game-container">
        <form action="<?= $updateUrl ?>" method="POST">
            <div class="dice-container">
                <div class="unsaved-container">
                    <h3 class="yatzy-header">Rolled Dice:</h3>
                    <div class="unsaved-dice">
                        <?php foreach ($unsaved as $index => $die) : ?>
                            <div class="dice">
                                <p class="dice-utf8">
                                    <i class="<?= $die ?>"></i>
                                </p>
                                <input type="checkbox" name="unsaved[]" value="<?= $index ?>" <?php echo ($gameStatus == "saving") ? '' : 'disabled'; ?>>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="saved-container">
                    <h3 class="yatzy-header">Saved Dice:</h3>
                    <div class="saved-dice">
                        <?php foreach ($saved as $index => $die) : ?>
                            <div class="dice">
                                <p class="dice-utf8">
                                    <i class="<?= $die ?>"></i>
                                </p>
                                <input type="checkbox" name="saved[]" value="<?= $index ?>" checked <?php echo ($gameStatus == "saving") ? '' : 'disabled'; ?>>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <div class="button-container">
                <input type="submit" name="action" value="Save" <?php echo ($gameStatus == "saving") ? '' : 'disabled'; ?>>
                <input type="submit" name="action" value="Roll" <?php echo ($gameStatus == "rolling") ? '' : 'disabled'; ?>>
                <input type="submit" name="action" value="Next round" <?php echo ($gameStatus == "showscore") ? '' : 'disabled'; ?>>
                <input type="submit" name="action" value="New game" <?php echo ($gameStatus == "gameover") ? '' : 'disabled'; ?>>
            </div>
        </form>
    </div>
    <div class="score-container">
        <h3 class="yatzy-header">Score:</h3>
        <table>

            <?php foreach ($scoreBoard as $key => $value) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $value ?></td>
                    <?php if ($key != "Sum" && $key != "Bonus") : ?>
                        <form action="<?= $updateUrl ?>" method="POST">
                            <td><input type="hidden" name="choice" value="<?= $key ?>" <?php echo ($value == null && $gameStatus == "savescore") ? '' : 'disabled'; ?>></td>
                            <td><input type="submit" name="action" value="Add" <?php echo ($value === null && $gameStatus == "savescore") ? '' : 'disabled'; ?>></td>
                        </form>
                    <?php endif; ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>