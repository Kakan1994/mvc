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

    /**
     * @Route("/api/library/books", name="api_books")
     */
    public function getBooks(LibraryRepository $libraryRepository): JsonResponse
    {
        $books = $libraryRepository->findAll();
        $booksArray = [];
        foreach($books as $book){
            $booksArray[] = [
                'id' => $book->getId(),
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'isbn' => $book->getIsbn(),
            ];
        }

        $response = $this->json($booksArray);
        $response->setEncodingOptions($response->getEncodingOptions() | JSON_PRETTY_PRINT);

        return $response;
    }

    /**
     * @Route("/api/library/book/{isbn}", name="api_book")
     */
    public function getBookByIsbn($isbn, LibraryRepository $libraryRepository): JsonResponse
    {
        $book = $libraryRepository->findOneBy(['isbn' => $isbn]);

        if (!$book) {
            return new JsonResponse(['message' => 'Book not found'], Response::HTTP_NOT_FOUND);
        }

        $bookArray = [
            'id' => $book->getId(),
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'isbn' => $book->getIsbn(),
        ];

        $response = $this->json($bookArray);
        $response->setEncodingOptions($response->getEncodingOptions() | JSON_PRETTY_PRINT);

        return $response;
    }
}
