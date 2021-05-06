<?php

declare(strict_types=1);

namespace Lika20\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Lika20\Dice\YatzyGame;

use function Mos\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller for the session routes.
 */
class Yatzy
{
    public function renderGame(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $game = null;

        if (isset($_SESSION["yatzyGame"])) {
            $game = $_SESSION["yatzyGame"];
            $body = $game->runGame();

            return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
        }
        $game = new YatzyGame();
        $_SESSION["yatzyGame"] = $game;

        $body = $game->runGame();

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function updateGame(): ResponseInterface
    {
        $game = $_SESSION["yatzyGame"];

        switch ($_POST["action"]) {
            case "Roll":
                $this->rollPressed($game);
                break;
            case "Save":
                $this->savePressed($game);
                break;
            case "Add":
                $this->addPressed($game);
                break;
            case "Next round":
                $this->nextRoundPressed($game);
                break;
            case "New game":
                $this->newGamePressed();
                break;
        }
        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatzy"));
    }

    private function rollPressed(YatzyGame $game): void
    {
        if ($game->getRollAmount() < 2) {
            $game->playerRoll();
            $game->updateRollAmount();
            $game->setGameStatus("saving");
            return;
        }
        $game->playerRoll();
        $game->updateRollAmount();
        $game->updateRemainingDice();
        $game->setGameStatus("savescore");
    }

    private function savePressed(YatzyGame $game): void
    {
        if (!isset($_POST["unsaved"])) {
            $_POST["unsaved"] = [];
        }
        if (!isset($_POST["saved"])) {
            $_POST["saved"] = [];
        }
        $game->updateDice($_POST["unsaved"], $_POST["saved"]);
        if ($game->isAllSaved()) {
            $game->setGameStatus("savescore");
            return;
        }
        $game->setGameStatus("rolling");
    }

    private function addPressed(YatzyGame $game): void
    {
        $game->addToScoreBoard($_POST["choice"]);
        if ($game->isGameOver()) {
            $game->setGameStatus("gameover");
            return;
        }
        $game->setGameStatus("showscore");
    }

    private function nextRoundPressed($game): void
    {
        $game->nextRound();
    }

    private function newGamePressed(): void
    {
        $_SESSION["yatzyGame"] = new YatzyGame();
    }
}
