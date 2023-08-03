<?php

namespace App\Controller;

use App\Project\ProjectGame;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PlayerRaiseController extends AbstractController
{
    /**
     * @Route("/proj/playerraise", name="proj_player_raise", methods={"POST"})
     */
    public function projPlayerRaise(SessionInterface $session, Request $request): Response
    {
        $raiseAmount = $request->request->get('raise-amount');
        $game = $session->get('game');

        $player = $game->dequePlayer();

        $player->addToBets($raiseAmount);
        $player->decreaseChips($raiseAmount);
        $game->addToPot($raiseAmount);

        $game->enquePlayer($player);

        $player->getPlayerActions()->addToRoundActions("raise");

        $bRoute = $session->get('route-back');

        $session->set('game', $game);

        if ($game->roundOver()) {
            return $this->redirectToRoute('proj_round_over');
        }

        if ($game->checkNextStage()) {
            return $this->redirectToRoute('proj_change_stage');
        }

        return $this->redirectToRoute($bRoute);
    }
}
