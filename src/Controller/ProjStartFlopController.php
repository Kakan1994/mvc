<?php

namespace App\Controller;

use App\Project\ProjectGame;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProjStartFlopController extends AbstractController
{
    /**
     * @Route("/proj/start-flop", name="proj_start_flop")
     */
    public function projStartFlop(SessionInterface $session): Response
    {
        $game = $session->get('game');

        $tableCards = $game->setFlop();

        $game->getAndSetBestHands();

        $session->set('game', $game);
        $session->set('tableCards', $tableCards);

        return $this->redirectToRoute('proj_flop');
    }
}