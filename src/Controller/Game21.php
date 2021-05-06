<?php

declare(strict_types=1);

namespace Lika20\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Lika20\Dice\Game;

use function Mos\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller for the session routes.
 */
class Game21
{
    public function renderGame(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $game = null;

        if (isset($_SESSION["game"])) {
            $game = $_SESSION["game"];

            $body = $game->runGame();

            return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
        }

        $game = new Game();
        $_SESSION["game"] = $game;

        $body = $game->runGame();

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }


    public function updateGame(): ResponseInterface
    {
        $game = $_SESSION["game"];

        if ($_POST["action"] == "Start game") {
            $game->initiateGame((int)$_POST["dice"]);
            $game->setGameStatus("ingame");
        } else if ($_POST["action"] == "Roll") {
            $game->playerRoll();
        } else if ($_POST["action"] == "End turn") {
            $game->computerRoll();
            $game->setGameStatus("endgame");
        } else if ($_POST["action"] == "New round") {
            $game->saveRound();
            $game->newRound();
            $game->setGameStatus("ingame");
        } else if ($_POST["action"] == "Clear rounds") {
            $game->clearRounds();
        }

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/game21"));
    }
}
