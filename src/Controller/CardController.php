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
    public function draw(SessionInterface $session, $count): Response
    {
        $count = (int) $count; // cast count to an integer
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

    /**
     * @Route("/card/draw-many", name="card_draw_many")
     */
    public function drawManyForm(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('count', IntegerType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Positive(),
                ]
            ])
            ->add('draw', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $count = $data['count'];
            return $this->redirectToRoute('card_deck_draw', ['count' => $count]);
        }

        return $this->render('card/draw_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
