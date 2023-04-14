<?php

use Jouva\TTGCards\Contracts\CardProvider;
use Jouva\TTGCards\Decks\StandardDeck;
use Jouva\TTGCards\Exceptions\ShuffleException;

class DeckTest extends PHPUnit\Framework\TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function testDeckCount()
    {
        $deck = new StandardDeck;

        $this->assertEquals(52, $deck->count());
    }

    public function testDraw()
    {
        $deck = new StandardDeck;
        $c = $deck->draw();

        $this->assertInstanceOf('Jouva\TTGCards\Cards\Standard\StandardCard', $c);
        $this->assertEquals(51, $deck->count());
        $this->assertEquals(1, $deck->countDrawn());
    }

    public function testDeckHadNoCardsException()
    {
        $this->expectException(UnderflowException::class);

        $deck = new StandardDeck(new EmptyCardProvider);
        $deck->draw();
    }

    public function testDrawHand()
    {
        $deck = new StandardDeck();

        $h = $deck->drawHand();
        $this->assertCount(1, $h);

        $hh = $deck->drawHand(10);
        $this->assertCount(10, $hh);
    }

    public function testDrawCard()
    {
        $deck = new StandardDeck();

        $this->assertCount(52, $deck->getCards());
        $this->assertCount(0, $deck->getDrawnCards());
        $deck->draw();
        $deck->draw();
        $this->assertCount(50, $deck->getCards());
        $this->assertCount(2, $deck->getDrawnCards());
    }

    /**
     * @throws ShuffleException
     */
    public function testShuffleResets()
    {
        $deck = new StandardDeck();
        $deck->draw();
        $deck->draw();
        $this->assertCount(50, $deck->getCards());
        $this->assertCount(2, $deck->getDrawnCards());

        $deck->shuffle();

        $this->assertCount(50, $deck->getCards());
        $this->assertCount(2, $deck->getDrawnCards());

        $deck->reset();
        $deck->shuffle();

        $this->assertCount(52, $deck->getCards());
        $this->assertCount(0, $deck->getDrawnCards());
    }

    /**
     * @throws ShuffleException
     */
    public function testShuffleShuffles()
    {
        $this->expectNotToPerformAssertions();

        $deck = new StandardDeck();
        $shuffle = Mockery::mock('Jouva\TTGCards\Contracts\Shuffleable')->shouldReceive('shuffle')->once()->andReturn(true)->getMock();
        $deck->setShuffler($shuffle);

        $deck->shuffle();
    }
}

class EmptyCardProvider implements CardProvider
{
    public function getCards(): array
    {
        return [];
    }
}
