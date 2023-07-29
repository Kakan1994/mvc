<?php

namespace App\Controller;

use App\Controller\ApiDeckController;
use App\Cards\DeckOfCards;
use App\Game\Game;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\BrowserKit\Cookie;

class ApiDeckControllerTest extends WebTestCase
{
    public function testGetDeck(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/deck');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $responseContent = $client->getResponse()->getContent();
        $responeArray = json_decode($responseContent, true);

        $this->assertCount(52, $responeArray);
    }

    public function testShuffleDeck(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/deck/shuffle');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $responseContent = $client->getResponse()->getContent();
        $responeArray = json_decode($responseContent, true);

        $this->assertCount(52, $responeArray);
    }

    public function testDrawCards(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/deck/draw/5');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $responseContent = $client->getResponse()->getContent();
        $responeArray = json_decode($responseContent, true);

        $this->assertCount(2, $responeArray);
        $this->assertCount(5, $responeArray['drawnCards']);
        $this->assertEquals(47, $responeArray['remainingCards']);
    }

    public function testGetGameStatusNoGame(): void
    {
        $session = new Session(new MockArraySessionStorage());
        $client = static::createClient([], ['session' => $session]);

        $client->request('GET', '/api/game');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        $responseContent = $client->getResponse()->getContent();
        $responseArray = json_decode($responseContent, true);

        $this->assertEquals('No game found', $responseArray['error']); // Assert that we receive the 'No game found' error
    }

    public function testGetGameStatusWithGame(): void
    {
        // Create a client
        $client = static::createClient();
        // Create a new Game instance
        $game = new Game();
        // Retrieve the service container
        $container = self::getContainer();
        // Get the session factory from the container
        $sessionFactory = $container->get('session.factory');
        // Create a new session
        $session = $sessionFactory->createSession();
        // Add the game to the session
        $session->set('game', $game);
        // Save the session
        $session->save();
        // Set the session cookie
        $client->getCookieJar()->set(new Cookie($session->getName(), $session->getId()));
        // Make the request
        $client->request('GET', '/api/game');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $responseContent = $client->getResponse()->getContent();
        $responseArray = json_decode($responseContent, true);

        // Add assertions to check the structure of the returned JSON
        // Example:
        $this->assertIsArray($responseArray['playerCards']);
        $this->assertIsArray($responseArray['dealerCards']);
        $this->assertIsBool($responseArray['dealerHiddenCardRevealed']);
        $this->assertIsInt($responseArray['playerScore']);
        $this->assertIsInt($responseArray['dealerScore']);
        $this->assertIsInt($responseArray['lastPlayerScore']);
        $this->assertIsInt($responseArray['lastDealerScore']);
        $this->assertEquals("First round", $responseArray['lastWinner']);
    }
}
