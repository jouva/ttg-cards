<?php

use Jouva\TTGCards\StandardDeckProvider;

class StandardDeckProviderTest extends PHPUnit\Framework\TestCase
{
    public function testCardCount()
    {
        $provider = new StandardDeckProvider;

        $cards = $provider->getCards();

        $this->assertCount(52, $cards);
    }

    public function testCardsCountInSuit()
    {
        $provider = new StandardDeckProvider;

        $cards = $provider->getCards();

        $suit['Club'] = 0;
        $suit['Diamond'] = 0;
        $suit['Heart'] = 0;
        $suit['Spade'] = 0;

        foreach ($cards as $c) {
            ++$suit[$c->suitName()];
        }

        $this->assertEquals(13, $suit['Club']);
        $this->assertEquals(13, $suit['Diamond']);
        $this->assertEquals(13, $suit['Heart']);
        $this->assertEquals(13, $suit['Spade']);
    }
}
