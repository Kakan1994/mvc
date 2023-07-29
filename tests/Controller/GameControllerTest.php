<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use App\Game\Game;



class GameControllerTest extends WebTestCase
{
    private function initializeGame(KernelBrowser $client): void
    {
        $client->request('GET', '/game/blackjack');
        // Any additional setup here if needed
    }

    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('game_landing');
    }

    public function testDoc(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/doc');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('game_doc');
    }

    public function testGameBlackjack(): void
    {
        $client = static::createClient();

        // Mocking the SessionInterface and Game classes
        $mockedSession = $this->createMock(SessionInterface::class);
        $mockedGame = $this->createMock(Game::class);

        // Defining the behavior for the mocked classes
        $mockedSession->method('get')->willReturn($mockedGame);
        $mockedGame->method('isGameOver')->willReturn(false);

        // Retrieving the container and setting the mocked service
        $client->getContainer()->set('session', $mockedSession);

        $crawler = $client->request('GET', '/game/blackjack');

        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('game_blackjack');
    }

    public function testGameBlackjackActionHit(): void
    {
        $client = static::createClient();
        $this->initializeGame($client);

        $client->request('GET', '/game/blackjack/hit');
        $this->assertResponseRedirects('/game/blackjack');

        $session = $client->getRequest()->getSession();
        $game = $session->get('game');
        $this->assertCount(3, $game->getPlayer()->getHand()->getCards());
    }

    public function testGameBlackjackActionStand(): void
    {
        $client = static::createClient();
        $this->initializeGame($client);

        $client->request('GET', '/game/blackjack/stand');
        $this->assertResponseRedirects('/game/blackjack');

        $session = $client->getRequest()->getSession();
        $game = $session->get('game');
        $this->assertCount(2, $game->getPlayer()->getHand()->getCards());
        $game->revealDealerCard();
        $dealerCardCount = count($game->getDealer()->getHand()->getCards());
        $this->assertGreaterThanOrEqual(2, $dealerCardCount);
    }

    public function testGameBlackjackActionNext(): void
    {
        $client = static::createClient();
        $this->initializeGame($client);

        $client->request('GET', '/game/blackjack/next');
        $this->assertResponseRedirects('/game/blackjack');

        $session = $client->getRequest()->getSession();
        $game = $session->get('game');
        $this->assertCount(2, $game->getPlayer()->getHand()->getCards());
        $this->assertCount(1, $game->getDealer()->getHand()->getCards());
    }

    public function testGameBlackjackActionReset(): void
    {
        $client = static::createClient();
        $this->initializeGame($client);
        $gameExpected = $client->getRequest()->getSession()->get('game');

        $client->request('GET', '/game/blackjack/reset');
        $this->assertResponseRedirects('/game/blackjack');

        $session = $client->getRequest()->getSession();
        $game = $session->get('game');
        $this->assertNotSame($gameExpected, $game);

    }

    public function testGameClear(): void
    {
        $client = static::createClient();
        $this->initializeGame($client);

        $client->request('GET', '/game/clear');
        $this->assertResponseRedirects('/game/blackjack');

        $session = $client->getRequest()->getSession();
        $this->assertNull($session->get('game'));
    }
}
