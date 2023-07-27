<?php

namespace App\Form;

use App\Entity\Library;
use App\Form\BookType;
use Symfony\Component\Form\Test\TypeTestCase;

class BookTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'title' => 'test title',
            'isbn' => '9783161484100',
            'author' => 'test author',
            'img' => 'test image',
        ];

        $objectToCompare = new Library();
        $form = $this->factory->create(BookType::class, $objectToCompare);

        $object = new Library();
        $object->setTitle($formData['title']);
        $object->setIsbn($formData['isbn']);
        $object->setAuthor($formData['author']);
        $object->setImg($formData['img']);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
