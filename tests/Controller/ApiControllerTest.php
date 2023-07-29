<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use App\Entity\Library;
use Symfony\Component\HttpFoundation\Response;

class ApiControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $kernel = self::bootKernel();
        $client = $kernel->getContainer()->get('test.client');

        /** @var KernelBrowser $client */
        $client->request('GET', '/api');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testQuote(): void
    {
        $kernel = self::bootKernel();
        $client = $kernel->getContainer()->get('test.client');

        /** @var KernelBrowser $client */
        $client->request('GET', '/api/quote');

        $response = $client->getResponse();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }
}
