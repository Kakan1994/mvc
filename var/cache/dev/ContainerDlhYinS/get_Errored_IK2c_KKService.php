<?php

namespace ContainerDlhYinS;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_Errored_IK2c_KKService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.errored.iK2c.KK' shared service.
     *
     * @return \App\Controller\BookRepository
     */
    public static function do($container, $lazyLoad = true)
    {
        throw new RuntimeException('Cannot determine controller argument for "App\\Controller\\ApiController::getBookByIsbn()": the $bookRepository argument is type-hinted with the non-existent class or interface: "App\\Controller\\BookRepository". Did you forget to add a use statement?');
    }
}
