<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;
use App\Cards\Card;
use App\Cards\CardHand;

/**
 * Class CardHandsHelperTest
 *
 * Test the CardHandsHelper class.
 */
class CardHandsHelperTest extends TestCase
{
    /**
     * Construct object.
     */
    public function testCreateObject(): void
    {
        // Arrange
        $cardHandsHelper = new CardHandsHelper();

        // Assert
        $this->assertInstanceOf(CardHandsHelper::class, $cardHandsHelper);
    }

     /**
     * Test faceToNumericAceLow method with K, Q and J.
     */
    public function testFaceToNumericAceLowKQJ(): void
    {
        $cardHandsHelper = new CardHandsHelper();
        $res = $cardHandsHelper->faceToNumericAceLow('K');
        $exp = 13;
        $this->assertEquals($exp, $res);

        $res = $cardHandsHelper->faceToNumericAceLow('Q');
        $exp = 12;
        $this->assertEquals($exp, $res);

        $res = $cardHandsHelper->faceToNumericAceLow('J');
        $exp = 11;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test numericToFace method with 10.
     */
    public function testNumericToFace10(): void
    {
        $cardHandsHelper = new CardHandsHelper();
        $res = $cardHandsHelper->numericToFace(10);
        $exp = '10';
        $this->assertEquals($exp, $res);
    }
}
