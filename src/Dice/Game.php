<?php

declare(strict_types=1);

namespace Lika20\Dice;

use Lika20\Dice\DiceHand;

use function Mos\Functions\{
    renderView
};

/**
 * Class Game
 */
class Game
{

    private DiceHand $player;
    private ?int $playerScore = null;
    private DiceHand $computer;
    private ?int $computerScore = null;
    private string $gameStatus = "";
    private ?int $round = null;
    private array $roundArray = [];
    private ?int $dices = null;

    public function __construct()
    {
        $this->gameStatus = "pregame";
    }

    public function setGameStatus(string $newStatus): void
    {
        $this->gameStatus = $newStatus;
    }

    public function initiateGame(int $dices): void
    {
        $this->player = new DiceHand($dices);
        $this->computer = new DiceHand($dices);
        $this->playerScore = 0;
        $this->computerScore = 0;
        $this->round = 1;
        $this->dices = $dices;
    }

    public function newRound(): void
    {
        $this->player = new DiceHand($this->dices);
        $this->computer = new DiceHand($this->dices);
        $this->playerScore = 0;
        $this->computerScore = 0;
        $this->round += 1;
    }

    public function saveRound(): void
    {
        $winLose = $this->checkWinLose();
        if ($winLose == "win") {
            $this->roundArray[$this->round] = "Player = {$this->playerScore} - Computer = {$this->computerScore}";
        } elseif ($winLose == "lose") {
            $this->roundArray[$this->round] = "Computer = {$this->computerScore} - Player = {$this->playerScore}";
        }
    }

    public function clearRounds(): void
    {
        $this->round = 1;
        $this->roundArray = [];
    }

    public function playerRoll()
    {
        $this->player->rollAll();
        $this->playerScore += $this->player->getLastSum();
    }

    public function computerRoll()
    {
        if ($this->playerScore > 21) {
            $this->computer->rollAll();
            $this->computerScore = $this->computer->getLastSum();
            return;
        }
        while ($this->computerScore < $this->playerScore) {
            $this->computer->rollAll();
            $this->computerScore += $this->computer->getLastSum();
        }
    }

    public function checkWinLose(): string
    {
        if ($this->playerScore <= 21 && ($this->computerScore > 21 || $this->playerScore > $this->computerScore)) {
            return "win";
        }
        return "lose";
    }

    public function runGame(): string
    {
        $data = [];
        if ($this->gameStatus == "pregame") {
            return renderView("layout/pregame.php");
        } elseif ($this->gameStatus == "ingame") {
            $data["playerScore"] = $this->playerScore;
            $data["playerRoll"] = $this->player->getGraphicalRepresentation($this->player->getRollableDice());
            $data["winOrLose"] = "";
            $data["computerScore"] = $this->computerScore;
            $data["gameStatus"] = $this->gameStatus;
            $data["roundArray"] = $this->roundArray;
            //$data["computerRoll"] = $this->computer->getGraphicalRepresentation();
            return renderView("layout/ingame.php", $data);
        } elseif ($this->gameStatus == "endgame") {
            $data["playerScore"] = $this->playerScore;
            $data["playerRoll"] = $this->player->getGraphicalRepresentation($this->player->getRollableDice());
            $data["winOrLose"] = $this->checkWinLose();
            $data["computerScore"] = $this->computerScore;
            $data["gameStatus"] = $this->gameStatus;
            $data["roundArray"] = $this->roundArray;
            return renderView("layout/ingame.php", $data);
        }
        return "";
    }
}
