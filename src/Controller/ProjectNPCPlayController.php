<?php

namespace App\Controller;

use App\Project\ProjectGame;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProjectNPCPlayController extends AbstractController
{
    /**
     * @Route("/proj/npcplay", name="proj_npcplay")
     */
    public function projNPCPlay(SessionInterface $session): Response
    {
        $game = $session->get('game');

        $tableCards = $game->getGameState()->getTableCards()->getCards();

        $count = count($tableCards);

        $table = [];

        if ($count == 0) {
            $game->setFlop();
            $game->setNextStage();
            $game->setTurn();
            $game->setNextStage();
            $table = $game->setRiver();
            $game->getAndSetBestHands();
        } elseif ($count == 3) {
            $game->setNextStage();
            $game->setTurn();
            $game->setNextStage();
            $table = $game->setRiver();
            $game->getAndSetBestHands();
        } elseif ($count == 4) {
            $game->setNextStage();
            $table = $game->setRiver();
            $game->getAndSetBestHands();
        }

        $session->set('tableCards', $table);

        return $this->redirectToRoute('proj_start_end_turn');
    }
}
