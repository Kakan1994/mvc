<?php

namespace App\Controller;

use App\Entity\Library;
use App\Form\BookType;
use App\Repository\LibraryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;



class LibraryControllerTest extends WebTestCase
{
    protected function setUpEntityManager(KernelBrowser $client): EntityManagerInterface
    {
        $entityManager = $client->getContainer()->get('doctrine')->getManager();
        // $this->libraryRepository = $this->entityManager->getRepository(Library::class);

        return $entityManager;
    }

    protected function setUpLibraryRepository(KernelBrowser $client): LibraryRepository
    {
        $entityManager = $this->setUpEntityManager($client);
        $libraryRepository = $entityManager->getRepository(Library::class);

        return $libraryRepository;
    }

    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/library');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('app_library');
    }

    public function testViewBook(): void
    {
        $client = static::createClient();
        
        $client->request('GET', '/library/book/4');

        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('app_library_book');
    }

    public function testViewBookNoExist(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);

        $nonExistentBookId = 0;

        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('No book found for id '.$nonExistentBookId);

        $client->request('GET', '/library/book/'.$nonExistentBookId);
    }

    public function testViewBooks(): void
    {
        $client = static::createClient();
        $entityManager = static::getContainer()->get(EntityManagerInterface::class);

        $client->request('GET', '/library/books');

        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('app_library_books');
    }

    public function testUpdateNotExist(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);

        $nonExistentBookId = 0;

        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('No book found for id '.$nonExistentBookId);

        $client->request('GET', '/library/book/'.$nonExistentBookId.'/edit');
    }

    // public function testUpdate(): void
    // {
    //     // Boot the kernel.
    //     $kernel = static::createKernel();
    //     $kernel->boot();
    
    //     // Create a client.
    //     $client = static::createClient();
    
    //     // Add a book to the database to edit.
    //     $library = new Library();
    //     $library->setTitle('Test Book');
    //     $library->setAuthor('Test Author');
    //     $library->setIsbn('1234567890');
    
    //     // Get the EntityManagerInterface service from dependency injection.
    //     $entityManager = $kernel->getContainer()->get('doctrine.orm.entity_manager');
    
    //     $entityManager->persist($library);
    //     $entityManager->flush();
    
    //     // Retrieve the book from the database.
    //     $bookId = $library->getId();
    
    //     // Data for form submission.
    //     $formData = [
    //         'title' => 'Test Book 2',
    //         'author' => 'Test Author 2',
    //         'isbn' => '0987654321'
    //     ];
    
    //     // Send a POST request to the edit page.
    //     $client->request(
    //         'POST',
    //         '/library/book/'.$bookId.'/edit',
    //         [
    //             'book' => $formData,
    //         ]
    //     );
    
    //     // Assert that the form was submitted.
    //     $this->assertTrue($client->getResponse()->isSuccessful());
    
    //     // Assert that the book was updated.
    //     $updatedBook = $entityManager->getRepository(Library::class)->find($bookId);
    //     $this->assertNotSame($formData['title'], $updatedBook->getTitle());
    //     print_r($updatedBook->getTitle());
    //     print_r($formData['title']);
    //     $this->assertNotSame($formData['author'], $updatedBook->getAuthor());
    //     $this->assertNotSame($formData['isbn'], $updatedBook->getIsbn());
    
    //     // Remove the book from the database.
    //     $libraryRepository = $entityManager->getRepository(Library::class);
    //     $book = $libraryRepository->find($bookId);
    //     if ($book) {
    //         $entityManager->remove($book);
    //         $entityManager->flush();
    //     }
    // }


    public function testDeleteNotExist(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);

        $nonExistentBookId = 0;

        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('No book found for id '.$nonExistentBookId);

        $client->request('POST', '/library/delete/'.$nonExistentBookId);
    }

    public function testDelete(): void
    {
        $client = static::createClient();
        $entityManager = static::getContainer()->get(EntityManagerInterface::class);

        // Add a book to the database.
        $library = new Library();
        $library->setTitle('Test Book');
        $library->setAuthor('Test Author');
        $library->setIsbn('1234567890');

        $entityManager->persist($library);
        $entityManager->flush();
    
        // Retrieve the book from the database.
        $bookId = $library->getId();
        print_r($bookId);
    
        // Send a POST request to the delete page.
        $client->request(
            'POST',
            '/library/delete/'.$bookId
        );

        // Assert that the book was deleted.
        $deletedBook = $entityManager->getRepository(Library::class)->find($bookId);
        $this->assertNull($deletedBook);
    }

    public function testRedirectBook(): void
    {
        $client = static::createClient();
    
        // Send a POST request to the redirectBook route.
        $client->request('POST', '/library/book/redirect', [
            'id' => 4,
        ]);
    
        // Assert that the response is a redirect.
        $this->assertTrue($client->getResponse()->isRedirect());
    
        // Get the redirect URL.
        $redirectUrl = $client->getResponse()->headers->get('Location');
    
        // Assert that the redirect URL is the book details page.
        $this->assertSame('/library/book/4', $redirectUrl);
    }

    public function testRedirectBookNoExist(): void
    {
        $client = static::createClient();
    
        // Send a POST request to the redirectBook route.
        $client->request('POST', '/library/book/redirect', [
            'id' => 1,
        ]);
    
        // Assert that the response is a redirect.
        $this->assertTrue($client->getResponse()->isRedirect());
    
        // Get the redirect URL.
        $redirectUrl = $client->getResponse()->headers->get('Location');
    
        // Assert that the redirect URL is the book details page.
        $this->assertSame('/library', $redirectUrl);
    }
}
