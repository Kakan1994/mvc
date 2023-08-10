<?php

namespace App\Controller;

use App\Project\ProjectGame;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProjStartRiverController extends AbstractController
{
    /**
     * @Route("/proj/start-river", name="proj_start_river")
     */
    public function projStartRiver(SessionInterface $session): Response
    {
        $game = $session->get('game');

        $tableCards = $game->setRiver();

        $game->getAndSetBestHands();

        $session->set('game', $game);
        $session->set('tableCards', $tableCards);

        return $this->redirectToRoute('proj_river');
    }
}
