<?php

namespace App\Controller;

use App\Entity\Library;
use App\Form\BookType;
use App\Repository\LibraryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController
{
    #[Route('/library', name: 'app_library')]
    public function index(): Response
    {
        return $this->render('library/index.html.twig', [
            'controller_name' => 'LibraryController',
        ]);
    }

    #[Route('/library/add', name: 'app_library_add', methods: ['GET', 'POST'])]
    public function add(Request $request, ManagerRegistry $doctrine): Response
    {
        $book = new Library();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('app_library');
        }

        return $this->render('library/add.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/library/book/{id}', name: 'app_library_book', methods: ['GET'])]
    public function viewBook(LibraryRepository $libraryRepository, int $id): Response
    {
        $book = $libraryRepository->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }

        return $this->render('library/book.html.twig', [
            'book' => $book,
        ]);
    }

    #[Route('/library/books', name: 'app_library_books', methods: ['GET'])]
    public function viewBooks(LibraryRepository $libraryRepository): Response
    {
        $books = $libraryRepository->findAll();

        return $this->render('library/books.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/library/book/{id}/edit', name: 'app_library_book_edit', methods: ['GET', 'POST'])]
    public function update(Request $request, ManagerRegistry $doctrine, LibraryRepository $libraryRepository, int $id): Response
    {
        $book = $libraryRepository->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('app_library_books');
        }

        return $this->render('library/edit.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/library/delete/{id}', name: 'app_library_delete', methods: ['POST'])]
    public function delete(ManagerRegistry $doctrine, LibraryRepository $libraryRepository, int $id): Response
    {
        $book = $libraryRepository->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }

        $entityManager = $doctrine->getManager();
        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('app_library_books');
    }

    #[Route('/library/book/redirect', name: 'app_library_book_redirect', methods: ['POST'])]
    public function redirectBook(Request $request, LibraryRepository $libraryRepository): Response
    {
        $id = $request->request->get('id');
        $book = $libraryRepository->find($id);

        if (!$book) {
            $this->addFlash('error', 'No book found with id ' . $id);
            return $this->redirectToRoute('app_library');
        }

        return $this->redirectToRoute('app_library_book', ['id' => $id]);
    }

}
