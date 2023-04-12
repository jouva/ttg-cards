<?php

use Jouva\TTGCards\Suit;

class SuitTest extends PHPUnit\Framework\TestCase
{
    public function testCreateSuit()
    {
        $club = Suit::club();
        $this->assertEquals(Suit::CLUB, $club->value());
        $this->assertEquals("Club", $club->name());

        $diamond = Suit::diamond();
        $this->assertEquals(Suit::DIAMOND, $diamond->value());
        $this->assertEquals("Diamond", $diamond->name());

        $heart = Suit::heart();
        $this->assertEquals(Suit::HEART, $heart->value());
        $this->assertEquals("Heart", $heart->name());

        $spade = Suit::spade();
        $this->assertEquals(Suit::SPADE, $spade->value());
        $this->assertEquals("Spade", $spade->name());
    }

    public function testSharedSuit()
    {
        // These should be shared
        $spade = Suit::spade();
        $spade2 = Suit::spade();

        $this->assertSame($spade, $spade2);

        // These should not be shared
        $spade = Suit::spade();
        $spade3 = Suit::spade(false);

        $this->assertNotSame($spade, $spade3);
    }

    public function testToString()
    {
        $spade = Suit::spade();
        $this->assertEquals('Spade', $spade);

        $spade = Suit::diamond();
        $this->assertEquals('Diamond', $spade);
    }
}
