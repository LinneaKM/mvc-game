<?php

declare(strict_types=1);

namespace Lika20\Dice;

/**
 * Class Dice
 */
class Dice
{

    protected ?int $faces = null;
    protected ?int $roll = null;

    public function __construct(int $amount)
    {
        $this->faces = $amount;
    }

    public function roll(): int
    {
        $this->roll = rand(1, $this->faces);

        return  $this->roll;
    }

    public function getLastRoll(): int
    {
        return $this->roll;
    }
}
