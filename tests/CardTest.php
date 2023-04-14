<?php

use Jouva\TTGCards\Cards\Standard\StandardCard;
use Jouva\TTGCards\Cards\Standard\StandardCardSuit;

class CardTest extends PHPUnit\Framework\TestCase
{

    public function testConstructException()
    {
        $this->expectException(InvalidArgumentException::class);
        $card = new StandardCard(123, StandardCardSuit::club());
    }

    public function testCardSuit()
    {
        $suit = StandardCardSuit::club();

        $card = new StandardCard(StandardCard::ACE, $suit);

        $this->assertEquals($card->suit()->value(), $suit->value());
        $this->assertEquals($card->suit()->name(), $suit->name());
        $this->assertEquals($card->suitName(), $suit->name());
    }

    public function testAceCard()
    {
        $card = new StandardCard(StandardCard::ACE, StandardCardSuit::diamond());
        $this->assertTrue($card->isAce());
        $this->assertEquals(StandardCard::ACE, $card->value());

        // Negate the test too
        $card = new StandardCard(2, StandardCardSuit::diamond());
        $this->assertFalse($card->isAce());
    }

    public function testFaceCard()
    {
        $card = new StandardCard(StandardCard::JACK, StandardCardSuit::diamond());
        $this->assertTrue($card->isJack());
        $this->assertTrue($card->isFaceCard());

        $card = new StandardCard(StandardCard::QUEEN, StandardCardSuit::diamond());
        $this->assertTrue($card->isQueen());
        $this->assertTrue($card->isFaceCard());

        $card = new StandardCard(StandardCard::KING, StandardCardSuit::diamond());
        $this->assertTrue($card->isKing());
        $this->assertTrue($card->isFaceCard());
    }

    public function testNotFaceCard()
    {
        $card = new StandardCard(5, StandardCardSuit::diamond());
        $this->assertFalse($card->isJack());
        $this->assertFalse($card->isQueen());
        $this->assertFalse($card->isKing());
        $this->assertFalse($card->isFaceCard());
    }
}
