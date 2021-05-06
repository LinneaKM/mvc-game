<?php

declare(strict_types=1);

namespace Lika20\Dice;

/**
 * Class DiceHand
 */
class DiceHand
{
    protected int $sum;
    protected array $rollableDice;

    public function __construct(int $diceAmount)
    {
        for ($i = 0; $i < $diceAmount; $i++) {
            $this->rollableDice[$i] = new GraphicalDice();
        }
        $this->sum = 0;
    }

    public function rollAll(): void
    {
        $len = count($this->rollableDice);

        $this->sum = 0;
        for ($i = 0; $i < $len; $i++) {
            $this->sum += $this->rollableDice[$i]->roll();
        }
    }

    public function getRollableDice(): array
    {
        return $this->rollableDice;
    }

    public function getLastRoll(): string
    {
        $res = "";
        $len = count($this->rollableDice);
        for ($i = 0; $i < $len; $i++) {
            $res .= $this->rollableDice[$i]->getLastRoll() . ", ";
        }
        return substr($res, 0, -2) . " = " . $this->sum;
    }

    public function getLastSum(): int
    {
        return $this->sum;
    }

    public function getGraphicalRepresentation(array $diceArray): array
    {
        if ($this->sum != 0) {
            $res = [];
            $len = count($diceArray);
            for ($i = 0; $i < $len; $i++) {
                array_push($res, $diceArray[$i]->diceRepresentation());
            }
            return $res;
        }
        return [];
    }
}
