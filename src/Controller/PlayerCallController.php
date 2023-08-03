<?php

namespace App\Controller;

use App\Project\ProjectGame;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PlayerCallController extends AbstractController
{
    /**
     * @Route("/proj/playercall", name="proj_player_call", methods={"POST"})
     */
    public function projPlayerCall(SessionInterface $session, Request $request): Response
    {
        $call = $request->request->get('call-amount');

        $game = $session->get('game');

        $player = $game->dequePlayer();

        $player->addToBets($call);
        $player->decreaseChips($call);
        $game->addToPot($call);

        $game->enquePlayer($player);

        $player->getPlayerActions()->addToRoundActions("call");

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
