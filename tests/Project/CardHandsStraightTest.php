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
class CardHandsStraightTest extends TestCase
{
    /**
     * Construct object.
     */
    public function testCreateObject(): void
    {
        // Arrange
        $straight = new CardHandsStraight();

        // Assert
        $this->assertInstanceOf(CardHandsStraight::class, $straight);
    }

    

    /**
     * Test straightCombos with size less than lenght.
     */
    public function testStraightCombosLessThanLenght(): void
    {
        $straight = new CardHandsStraight();
        $res = $straight->straightCombos([1, 2, 3], 5);
        $exp = [];
        $this->assertEquals($exp, $res);
    }

    

}