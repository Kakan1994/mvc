<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use App\Game\Game;



class HomeControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('home');
    }

    public function testAbout(): void
    {
        $client = static::createClient();
        $client->request('GET', '/about');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('about');
    }

    public function testReport(): void
    {
        $client = static::createClient();
        $client->request('GET', '/report');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('report');
    }

    public function testLucky(): void
    {
        $client = static::createClient();
        $client->request('GET', '/lucky');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('lucky');
    }

    public function testMetrics(): void
    {
        $client = static::createClient();
        $client->request('GET', '/metrics');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('metrics');
    }
}
