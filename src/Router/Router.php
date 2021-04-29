<?php

// declare(strict_types=1);

// namespace Mos\Router;

// use function Mos\Functions\{
//     destroySession,
//     redirectTo,
//     renderView,
//     renderTwigView,
//     sendResponse,
//     url
// };

// /**
//  * Class Router.
//  */
// class Router
// {
//     public static function dispatch(string $method, string $path): void
//     {
//         if ($method === "GET" && $path === "/") {
//             $data = [
//                 "header" => "Index page",
//                 "message" => "Hello, this is the index page, rendered as a layout.",
//             ];
//             $body = renderView("layout/page.php", $data);
//             sendResponse($body);
//             return;
//         } else if ($method === "GET" && $path === "/session") {
//             $body = renderView("layout/session.php");
//             sendResponse($body);
//             return;
//         } else if ($method === "GET" && $path === "/session/destroy") {
//             destroySession();
//             redirectTo(url("/session"));
//             return;
//         } else if ($method === "GET" && $path === "/debug") {
//             $body = renderView("layout/debug.php");
//             sendResponse($body);
//             return;
//         } else if ($method === "GET" && $path === "/twig") {
//             $data = [
//                 "header" => "Twig page",
//                 "message" => "Hey, edit this to do it youreself!",
//             ];
//             $body = renderTwigView("index.html", $data);
//             sendResponse($body);
//             return;
//         } else if ($method === "GET" && $path === "/some/where") {
//             $data = [
//                 "header" => "Rainbow page",
//                 "message" => "Hey, edit this to do it youreself!",
//             ];
//             $body = renderView("layout/page.php", $data);
//             sendResponse($body);
//             return;
//         } else if ($method === "GET" && $path === "/game21") {
//             $game = null;
//             if (isset($_SESSION["game"])) {
//                 $game = $_SESSION["game"];
//             } else {
//                 $game = new \Lika20\Dice\Game();
//                 $_SESSION["game"] = $game;
//             }
//             $game->runGame();
//             return;
//         } else if ($method === "POST" && $path === "/game21/update") {
//             $game = $_SESSION["game"];
//             if ($_POST["action"] == "Start game") {
//                 $game->initiateGame((int)$_POST["dice"]);
//                 $game->setGameStatus("ingame");
//             } else if ($_POST["action"] == "Roll") {
//                 $game->playerRoll();
//             } else if ($_POST["action"] == "End turn") {
//                 $game->computerRoll();
//                 $game->setGameStatus("endgame");
//             } else if ($_POST["action"] == "New round") {
//                 $game->saveRound();
//                 $game->newRound();
//                 $game->setGameStatus("ingame");
//             } else if ($_POST["action"] == "Clear rounds") {
//                 $game->clearRounds();
//             }
//             redirectTo(url("/game21"));
//             return;
//         }

//         $data = [
//             "header" => "404",
//             "message" => "The page you are requesting is not here. You may also checkout the HTTP response code, it should be 404.",
//         ];
//         $body = renderView("layout/page.php", $data);
//         sendResponse($body, 404);
//     }
// }
