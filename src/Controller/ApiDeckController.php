<?php

namespace App\Controller;

use App\Cards\DeckOfCards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ApiDeckController extends AbstractController
{
    /**
     * @Route("/api/deck", name="api_deck", methods={"GET"})
     */
    public function getDeck(): JsonResponse
    {
        $deck = new DeckOfCards();
        $cards = $deck->getCards();
        $cardData = array_map(fn ($card) => $card->getCardText(), $cards);

        return new JsonResponse($cardData);
    }

    /**
     * @Route("/api/deck/shuffle", name="api_deck_shuffle", methods={"POST"})
     */
    public function shuffleDeck(SessionInterface $session): JsonResponse
    {
        $deck = new DeckOfCards();
        $deck->shuffle();
        $cards = $deck->getCards();
        $cardData = array_map(fn ($card) => $card->getCardText(), $cards);

        $session->set('deck', $deck);

        return new JsonResponse($cardData);
    }

    /**
     * @Route("/api/deck/draw/{number}", name="api_deck_draw", methods={"POST"}, requirements={"number"="\d+"}, defaults={"number"=1})
     */
    public function drawCards(SessionInterface $session, int $number): JsonResponse
    {
        /**
         * @var DeckOfCards $deck
         */
        $deck = $session->get('deck', new DeckOfCards());
        $drawnCards = $deck->draw($number);
        $cardData = array_map(fn ($card) => $card->getCardText(), $drawnCards);
        $remainingCards = count($deck->getCards());

        $session->set('deck', $deck);

        return new JsonResponse([
            'drawnCards' => $cardData,
            'remainingCards' => $remainingCards,
        ]);
    }
}
