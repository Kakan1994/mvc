<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('api_index');
    }

    public function testQuote(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/quote');
        $this->assertResponseIsSuccessful();
        
        $content = $client->getResponse()->getContent();
        $this->assertNotFalse($content);
        $this->assertJson($content);
        $this->assertRouteSame('api_quote');
    }
}
