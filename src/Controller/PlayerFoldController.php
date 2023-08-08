<?php

namespace App\Controller;

use App\Project\ProjectGame;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PlayerFoldController extends AbstractController
{
    /**
     * @Route("/proj/playerfold", name="proj_player_fold", methods={"POST"})
     */
    public function projPlayerFold(SessionInterface $session, Request $request): Response
    {

        $game = $session->get('game');

        $player = $game->dequePlayer();

        $player->clearPlayerBets();
        $player->resetHand();
        $player->getPlayerActions()->setHasFolded();

        $game->enquePlayer($player);

        $player->getPlayerActions()->addToRoundActions("fold");

        $session->set('game', $game);

        if ($game->roundOver()) {
            return $this->redirectToRoute('proj_round_over');
        }

        if ($game->checkNextStage()) {
            return $this->redirectToRoute('proj_npcplay');
        }

        return $this->redirectToRoute('proj_npcplay');
    }
}
