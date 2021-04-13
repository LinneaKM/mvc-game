<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\url;

$updateUrl = url("/game21/update");
?>
<p>Pregame</p>
<form action="<?= $updateUrl ?>" method="POST">
<input type="radio" id="dice1" name="dice" value="1" checked="checked">
<label for="dice1">1</label><br>
<input type="radio" id="dice2" name="dice" value="2">
<label for="dice2">2</label><br>
  <input type="submit" name="action" value="Start game">
</form>
