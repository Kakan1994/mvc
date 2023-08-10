<?php

namespace App\Controller;

use App\Project\ProjectGame;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProjectRoundController extends AbstractController
{
    /**
     * @Route("/proj/changestage", name="proj_change_stage")
     */
    public function projChangeStage(SessionInterface $session): Response
    {
        $game = $session->get('game');

        $game->setNextStage();

        $fRoute = $session->get('route-forward');

        $session->set('game', $game);

        return $this->redirectToRoute($fRoute);
    }


    /**
     * @Route("/proj/roundover", name="proj_round_over")
     */
    public function projRoundOver(SessionInterface $session): Response
    {
        $game = $session->get('game');
        $game->setNewRound();


        $session->set('game', $game);

        return $this->redirectToRoute('proj_pre_flop');
    }

    /**
     * @Route("/proj/tiedroundover", name="proj_tied_round_over")
     */
    public function projTiedRoundOver(SessionInterface $session): Response
    {
        $game = $session->get('game');
        $game->setNewRoundTie();

        $session->set('game', $game);

        return $this->redirectToRoute('proj_pre_flop');
    }
}
