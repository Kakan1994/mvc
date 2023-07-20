<?php

namespace App\Controller;

use App\Cards\CardHand;
use App\Cards\DeckOfCards;
use App\Game\Dealer;
use App\Game\Game;
use App\Game\Player;
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

    /**
     * @Route("/game/blackjack", name="game_blackjack")
     */
    public function gameBlackjack(SessionInterface $session): Response
    {
        /**
         * @var Game|null $game
         */
        $game = $session->get('game');
        if (!$game) {
            $game = new Game();
            $game->startGame();
            $session->set('game', $game);
        }
        if ($game->isGameOver()) {
            $game->revealDealerCard();
            $session->set('game', $game);
        }

        return $this->render('game/game.html.twig', [
            'controller_name' => 'GameController',
            'game' => $game,
        ]);
    }

    /**
     * @Route("/game/blackjack/{action}", name="game_blackjack_action")
     */
    public function gameBlackjackAction(SessionInterface $session, string $action): Response
    {
        /**
         * @var Game|null $game
         */
        $game = $session->get('game');
        if ($game) {
            if ($action === 'hit') {
                $game->hit();
            } elseif ($action === 'stand') {
                $game->stand();
            } elseif ($action === 'next') {
                $game->newRound();
                return $this->redirectToRoute('game_blackjack');
            } elseif ($action === 'reset') {
                $game->reset();
            }
            $session->set('game', $game);
        }

        return $this->redirectToRoute('game_blackjack');
    }
    /**
     * @Route("/game/clear", name="game_clear")
     */
    public function gameClear(SessionInterface $session): Response
    {
        $session->clear();
        return $this->redirectToRoute('game_blackjack');
    }
}
