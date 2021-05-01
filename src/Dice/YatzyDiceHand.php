<?php

declare(strict_types=1);

namespace Lika20\Dice;

/**
 * Class DiceHand
 */
class YatzyDiceHand extends DiceHand
{
    const DICE_AMOUNT = 5;

    private array $savedDice;

    function __construct() {
        parent::__construct(self::DICE_AMOUNT);

        $this->savedDice = [];
    }

    // Save dices
    // getters
}