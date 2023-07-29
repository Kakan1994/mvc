<?php

namespace App\Controller;

use App\Repository\LibraryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api_index")
     */
    public function index(): Response
    {
        return $this->render('api/index.html.twig');
    }

    /**
     * @Route("/api/quote", name="api_quote")
     */
    public function quote(): JsonResponse
    {
        $quotes = [
            "Det enda sättet att göra bra arbete är att älska det du gör.",
            "Framgång är inte slutmålet, det är att vara modig nog att börja.",
            "Om du kan drömma det, kan du göra det.",
        ];


        $quote = $quotes[array_rand($quotes)];
        $timestamp = new DateTime();

        return new JsonResponse([
            'quote' => $quote,
            'date' => $timestamp->format('Y-m-d'),
            'timestamp' => $timestamp->format('H:i:s'),
        ]);
    }
}
