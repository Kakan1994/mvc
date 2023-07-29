<?php

namespace ContainerDNHp8fj;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getBookTypeService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'App\Form\BookType' shared autowired service.
     *
     * @return \App\Form\BookType
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/form/FormTypeInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/form/AbstractType.php';
        include_once \dirname(__DIR__, 4).'/src/Form/BookType.php';

        return $container->privates['App\\Form\\BookType'] = new \App\Form\BookType();
    }
}
