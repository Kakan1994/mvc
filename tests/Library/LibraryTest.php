<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;
use ReflectionClass;

class LibraryTest extends TestCase
{
    public function testGetId()
    {
        $library = new Library();

        $reflectionClass = new ReflectionClass(Library::class);

        $idProperty = $reflectionClass->getProperty('id');
        $idProperty->setAccessible(true);
        $idProperty->setValue($library, 1);

        $this->assertEquals(1, $library->getId());
    }
}
