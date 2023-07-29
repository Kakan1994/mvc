<?php

namespace ContainerDlhYinS;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getForm_Type_EntityService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'form.type.entity' shared service.
     *
     * @return \Symfony\Bridge\Doctrine\Form\Type\EntityType
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/form/FormTypeInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/form/AbstractType.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/doctrine-bridge/Form/Type/DoctrineType.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/doctrine-bridge/Form/Type/EntityType.php';

        return $container->privates['form.type.entity'] = new \Symfony\Bridge\Doctrine\Form\Type\EntityType(($container->services['doctrine'] ?? $container->getDoctrineService()));
    }
}
