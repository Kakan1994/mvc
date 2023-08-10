<?php

namespace App\Controller;

use App\Project\GameData;
use App\Project\CardHands;
use App\Project\GameLogic;
use App\Project\PlayerInterface;
use App\Project\GameQueue;
use App\Project\GameState;
use App\Project\ProjectGame;
use App\Cards\DeckOfCards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProjectCreateGameController extends AbstractController
{
    /**
     * @Route("/proj/create-game", name="proj_create_game")
     */
    public function projCreateGame(SessionInterface $session, GameLogic $gameLogic, CardHands $cardHands, GameData $gameData): Response
    {
        $players = $session->get('players');

        $queue = new GameQueue($players);
        $gameState = new GameState();

        $deck = new DeckOfCards();
        $deck->shuffle();

        $game = new ProjectGame($deck, $cardHands, $gameLogic, $gameData, $queue, $gameState);

        $session->set('game', $game);

        return $this->redirectToRoute('proj_game_init');
    }


}
