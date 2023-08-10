<?php

namespace App\Controller;

use App\Project\NPCMatt;
use App\Project\NPCSteve;
use App\Project\ProjectPlayer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProjectCreatePlayersController extends AbstractController
{
    /**
     * @Route("/proj/create-players", name="proj_create_players", methods={"POST"})
     */
    public function projCreatePlayers(Request $request, SessionInterface $session): Response
    {
        $name = $request->request->get('name');
        $buyIn = $request->request->get('buyin');

        $player = new ProjectPlayer($name, $buyIn);
        $npcMatt = new NPCMatt("Matt", $buyIn);
        $npcSteve = new NPCSteve("Steve", $buyIn);

        $players = [$player, $npcMatt, $npcSteve];

        $session->set('players', $players);
        $session->set('buyin', $buyIn);

        return $this->redirectToRoute('proj_create_game');
    }
}
