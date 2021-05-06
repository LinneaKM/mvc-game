<?php

declare(strict_types=1);

namespace Lika20\Dice;

use Lika20\Dice\YatzyDiceHand;

use function Mos\Functions\{
    renderView
};

/**
 * Class Game
 */
class YatzyGame
{

    private YatzyDiceHand $player;
    private ?int $rollAmount = null;
    private ?int $roundCounter = null;
    private string $gameStatus = "";
    private array $scoreBoard;
    const CHOICE_TO_NUM = [
        "Aces" => 1,
        "Twos" => 2,
        "Threes" => 3,
        "Fours" => 4,
        "Fives" => 5,
        "Sixes" => 6,
    ];

    public function __construct()
    {
        $this->player = new YatzyDiceHand();
        $this->rollAmount = 0;
        $this->roundCounter = 1;
        $this->gameStatus = "rolling";
        $this->scoreBoard = [
            "Aces" => null,
            "Twos" => null,
            "Threes" => null,
            "Fours" => null,
            "Fives" => null,
            "Sixes" => null,
            "Sum" => 0,
            "Bonus" => 0
        ];
    }

    public function nextRound(): void
    {
        $this->player = new YatzyDiceHand();
        $this->rollAmount = 0;
        $this->roundCounter += 1;
        $this->gameStatus = "rolling";
    }

    public function getRollAmount(): int
    {
        return $this->rollAmount;
    }

    public function updateRollAmount(): void
    {
        $this->rollAmount += 1;
    }

    public function playerRoll(): void
    {
        $this->player->rollAll();
    }

    public function getRollableDice(): array
    {
        return $this->player->getRollableDice();
    }

    public function isAllSaved(): bool
    {
        return count($this->player->getSavedDice()) == 5;
    }

    public function updateRemainingDice(): void
    {
        $this->player->updateRemainingDice();
    }

    public function updateDice(array $unsavedDice, array $savedDice): void
    {
        $this->player->saveDice($unsavedDice, $savedDice);
    }

    public function setGameStatus(string $newStatus): void
    {
        $this->gameStatus = $newStatus;
    }

    public function isGameOver(): bool
    {
        return $this->roundCounter >= 6;
    }

    public function addToScoreBoard(string $choice): void
    {
        $currentPoints = $this->player->calculateScore(self::CHOICE_TO_NUM[$choice]);
        $this->scoreBoard[$choice] = $currentPoints;
        $this->scoreBoard["Sum"] += $currentPoints;
        if ($this->scoreBoard["Sum"] >= 63) {
            $this->scoreBoard["Bonus"] = 50;
        }
    }

    public function runGame(): string
    {
        $data = [];
        $data["unsaved"] = $this->player->getGraphicalRepresentation($this->player->getRollableDice());
        $data["saved"] = $this->player->getGraphicalRepresentation($this->player->getSavedDice());
        $data["gameStatus"] = $this->gameStatus;
        $data["scoreBoard"] = $this->scoreBoard;
        return renderView("layout/yatzy.php", $data);
    }
}
