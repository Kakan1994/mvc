<?php

namespace App\Controller;

use App\Project\ProjectGame;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PlayerCheckController extends AbstractController
{
    /**
     * @Route("/proj/playercheck", name="proj_player_check", methods={"POST"})
     */
    public function projPlayerCheck(SessionInterface $session, Request $request): Response
    {

        $game = $session->get('game');

        $player = $game->dequePlayer();

        $game->enquePlayer($player);

        $player->getPlayerActions()->addToRoundActions("check");

        $session->set('game', $game);

        $bRoute = $session->get('route-back');

        if ($game->roundOver()) {
            return $this->redirectToRoute('proj_round_over');
        }

        if ($game->checkNextStage()) {
            return $this->redirectToRoute('proj_change_stage');
        }

        return $this->redirectToRoute($bRoute);
    }
}
