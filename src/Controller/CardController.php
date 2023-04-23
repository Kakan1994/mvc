<?php

namespace App\Controller;

use App\Cards\CardHand;
use App\Cards\DeckOfCards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardController extends AbstractController
{
    /**
     * @Route("/card", name="card_index")
     */
    public function index(): Response
    {
        return $this->render('card/index.html.twig', [
            'controller_name' => 'CardController',
        ]);
    }

    /**
     * @Route("/card/deck", name="card_deck")
     */
    public function deck(): Response
    {
        $deck = new DeckOfCards();
        return $this->render('card/deck.html.twig', [
            'cards' => $deck->getCards(),
        ]);
    }

    /**
     * @Route("/card/deck/shuffle", name="card_deck_shuffle")
     */
    public function shuffle(SessionInterface $session): Response
    {
        $deck = new DeckOfCards();
        $deck->shuffle();
        $session->set('deck', $deck);
        return $this->render('card/deck.html.twig', [
            'cards' => $deck->getCards(),
        ]);
    }
    /**
     * @Route("/card/deck/draw/{count}", name="card_deck_draw")
     */
    public function draw(SessionInterface $session, int $count = 1): Response
    {
        $deck = $session->get('deck');
        if (!$deck) {
            $deck = new DeckOfCards();
            $deck->shuffle();
        }

        $drawnCards = $deck->draw($count);
        $session->set('deck', $deck);

        return $this->render('card/draw.html.twig', [
            'cards' => $drawnCards,
            'remaining_cards' => count($deck->getCards()),
        ]);
    }
}
