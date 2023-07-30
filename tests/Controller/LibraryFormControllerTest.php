<?php

namespace App\Controller;

use App\Entity\Library;
use App\Form\BookType;
use App\Repository\LibraryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class LibraryFormControllerTest extends WebTestCase
{
    private $client;
    private $entityManager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        self::bootKernel();
        $this->entityManager = static::$kernel->getContainer()
        ->get('doctrine')
        ->getManager();
}

    public function testAddGetRequest()
    {
        $this->client->request('GET', '/library/add');

        $this->assertResponseIsSuccessful();
    }

    public function testAddPostRequestValid()
    {
        $crawler = $this->client->request('GET', '/library/add');

        $form = $crawler->selectButton('submit')->form();

        // set some values
        $form['book[title]'] = 'A valid book title';
        $form['book[author]'] = 'A valid author name';
        $form['book[isbn]'] = '123-456-789';
        $form['book[img]'] = 'https://example.com/a-valid-image-url.jpg';

        // submit the form
        $this->client->submit($form);

        $this->assertResponseRedirects('/library');

        $libraryRepository = $this->entityManager->getRepository(Library::class);
        $book = $libraryRepository->findOneBy(['isbn' => '123-456-789']);

        if ($book) 
        {
            $this->entityManager->remove($book);
            $this->entityManager->flush();
        }
    }

    public function testUpdatePostRequestValid()
    {
        $library = new Library();
        $library->setTitle('Test Book');
        $library->setAuthor('Test Author');
        $library->setIsbn('1234567890');

        $this->entityManager->persist($library);
        $this->entityManager->flush();

        $bookid = $library->getId();

        $crawler = $this->client->request('GET', '/library/book/'.$bookid.'/edit');

        $form = $crawler->selectButton('submit')->form();

        // set some values
        $form['book[title]'] = 'A valid book title';
        $form['book[author]'] = 'A valid author name';
        $form['book[isbn]'] = '123-4569';
        $form['book[img]'] = 'https://example.com/a-valid-image-url.jpg';

        // submit the form
        $this->client->submit($form);
        $this->entityManager->flush();

        $this->assertResponseRedirects('/library/books');
    }

    public function testBookEditted()
    {
        $libraryRepository = $this->entityManager->getRepository(Library::class);
        $book = $libraryRepository->findOneBy(['isbn' => '123-4569']);
        $this->assertSame('A valid book title', $book->getTitle());
        $this->assertSame('A valid author name', $book->getAuthor());
        $this->assertSame('123-4569', $book->getIsbn());
        $this->assertSame('https://example.com/a-valid-image-url.jpg', $book->getImg());

        if ($book) 
        {
            $this->entityManager->remove($book);
            $this->entityManager->flush();
        }
    }
}





