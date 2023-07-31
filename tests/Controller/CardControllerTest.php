<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CardControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testDeck(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorExists('.card');
        $this->assertCount(52, $client->getCrawler()->filter('.card'));
    }

    public function testShuffle(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck/shuffle');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorExists('.card');
        // checks that first card is not Ace of Hearts and last card is not King of Clubs
        $this->assertNotEquals('🂱', $client->getCrawler()->filter('.card')->first()->text());
        $this->assertNotEquals('🃞', $client->getCrawler()->filter('.card')->last()->text());
    }

    public function testDraw(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck/draw/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorExists('.card');
    }

    public function testDrawMany(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/draw-many');
        $crawler = $client->request('GET', '/card/draw-many');

        $form = $crawler->selectButton('Draw')->form();

        $form['form[count]'] = '2';

        $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect('/card/deck/draw/2'));

        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorExists('.card');
        $this->assertCount(2, $client->getCrawler()->filter('.card'));
    }
}