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

    public function __construct()
    {
        parent::__construct(self::DICE_AMOUNT);

        $this->savedDice = [];
    }

    public function getSavedDice(): array
    {
        return $this->savedDice;
    }


    public function saveDice(array $rollableIndex, array $savedIndex): void
    {
        $tempDice = [];
        $newRollable = [];
        $newSaved = [];
        //
        foreach ($this->rollableDice as $index => $die) {
            if (in_array(strval($index), $rollableIndex)) {
                array_push($tempDice, $die);
                continue;
            }
            array_push($newRollable, $die);
        }
        $this->rollableDice = $newRollable;

        foreach ($this->savedDice as $index => $die) {
            if (!in_array(strval($index), $savedIndex)) {
                array_push($this->rollableDice, $die);
                continue;
            }
            array_push($newSaved, $die);
        }
        $this->savedDice = $newSaved;

        foreach ($tempDice as $die) {
            array_push($this->savedDice, $die);
        }
    }

    public function updateRemainingDice(): void
    {
        foreach ($this->rollableDice as $die) {
            array_push($this->savedDice, $die);
        }
        $this->rollableDice = [];
    }

    public function calculateScore(int $diceNum): int
    {
        $currentScore = 0;
        foreach ($this->savedDice as $die) {
            if ($die->getLastRoll() == $diceNum) {
                $currentScore += $diceNum;
            }
        }
        return $currentScore;
    }
}
