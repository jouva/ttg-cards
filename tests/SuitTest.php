<?php

use Jouva\TTGCards\Cards\Standard\StandardCardSuit;

class SuitTest extends PHPUnit\Framework\TestCase
{
    public function testCreateSuit()
    {
        $club = StandardCardSuit::club();
        $this->assertEquals(StandardCardSuit::CLUB, $club->value());
        $this->assertEquals("Club", $club->name());

        $diamond = StandardCardSuit::diamond();
        $this->assertEquals(StandardCardSuit::DIAMOND, $diamond->value());
        $this->assertEquals("Diamond", $diamond->name());

        $heart = StandardCardSuit::heart();
        $this->assertEquals(StandardCardSuit::HEART, $heart->value());
        $this->assertEquals("Heart", $heart->name());

        $spade = StandardCardSuit::spade();
        $this->assertEquals(StandardCardSuit::SPADE, $spade->value());
        $this->assertEquals("Spade", $spade->name());
    }

    public function testSharedSuit()
    {
        // These should be shared
        $spade = StandardCardSuit::spade();
        $spade2 = StandardCardSuit::spade();

        $this->assertSame($spade, $spade2);

        // These should not be shared
        $spade = StandardCardSuit::spade();
        $spade3 = StandardCardSuit::spade(false);

        $this->assertNotSame($spade, $spade3);
    }

    public function testToString()
    {
        $spade = StandardCardSuit::spade();
        $this->assertEquals('Spade', $spade);

        $spade = StandardCardSuit::diamond();
        $this->assertEquals('Diamond', $spade);
    }
}
