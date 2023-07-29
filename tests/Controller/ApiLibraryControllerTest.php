<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Library;
use Symfony\Component\HttpFoundation\Response;

class ApiLibraryControllerTest extends WebTestCase
{
    public function testGetBooks(): void
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

        $client->request('GET', '/api/library/books');

        $this->assertResponseIsSuccessful();
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testGetBooksEmpty(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/library/books');
        $this->assertResponseIsSuccessful();
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testGetBookByISBN(): void
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

        $client->request('GET', '/api/library/book/1234567890');

        $this->assertResponseIsSuccessful();
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testGetBookByISBNNotFound(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/library/book/nonexistingisbn');

        $this->assertEquals(Response::HTTP_NOT_FOUND, $client->getResponse()->getStatusCode());

        $responseContent = $client->getResponse()->getContent();
        $responseArray = json_decode($responseContent, true);
        
        $this->assertArrayHasKey('message', $responseArray);
        $this->assertEquals('Book not found', $responseArray['message']);

    }
}
