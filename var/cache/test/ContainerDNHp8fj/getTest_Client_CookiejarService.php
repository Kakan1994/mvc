<?php

namespace ContainerDNHp8fj;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getTest_Client_CookiejarService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'test.client.cookiejar' service.
     *
     * @return \Symfony\Component\BrowserKit\CookieJar
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/browser-kit/CookieJar.php';

        $container->factories['service_container']['test.client.cookiejar'] = function () use ($container) {
            return new \Symfony\Component\BrowserKit\CookieJar();
        };

        return $container->factories['service_container']['test.client.cookiejar']();
    }
}
