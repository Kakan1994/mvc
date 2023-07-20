<?php

namespace App\Controller;

use App\Cards\CardHand;
use App\Cards\DeckOfCards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game_landing")
     */
    public function gameLanding(): Response
    {
        return $this->render('game/landing.html.twig', [
            'controller_name' => 'GameController',
        ]);
    }

    /**
     * @Route("/game/doc", name="game_doc")
     */
    public function gameDoc(): Response
    {
        return $this->render('game/doc.html.twig', [
            'controller_name' => 'GameController',
        ]);
    }
}