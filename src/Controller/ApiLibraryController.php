<?php

namespace App\Controller;

use App\Repository\LibraryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class ApiLibraryController extends AbstractController
{
    /**
     * @Route("/api/library/books", name="api_books")
     */
    public function getBooks(LibraryRepository $libraryRepository): JsonResponse
    {
        $books = $libraryRepository->findAll();
        $booksArray = [];
        foreach($books as $book) {
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
    public function getBookByIsbn(string $isbn, LibraryRepository $libraryRepository): JsonResponse
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
