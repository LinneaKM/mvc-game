<?php

declare(strict_types=1);

namespace Lika20\Dice;

/**
 * Class DiceHand
 */
class GraphicalDice extends Dice
{
    private array $graphics = [
        1 => "dice-1",
        2 => "dice-2",
        3 => "dice-3",
        4 => "dice-4",
        5 => "dice-5",
        6 => "dice-6"
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
