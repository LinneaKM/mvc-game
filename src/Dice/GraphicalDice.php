<?php

declare(strict_types=1);

namespace Lika20\Dice;

/**
 * Class DiceHand
 */
class GraphicalDice extends Dice
{
    private array $graphics = [
        1 => "   \n * \n   ",
        2 => "*  \n   \n  *",
        3 => "*  \n * \n  *",
        4 => "* *\n   \n* *",
        5 => "* *\n * \n* *",
        6 => "* *\n* *\n* *"
    ];

    public function __construct()
    {
        parent:: __construct(6);
    }

    public function diceRepresentation(): string
    {
        if ($this->roll) {
            return $this->graphics[$this->getLastRoll()];
        }
        return "";
    }
}
