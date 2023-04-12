<?php

namespace Jouva\TTGCards;

use Jouva\TTGCards\Contracts\CardProvider;
use Jouva\TTGCards\Contracts\Shuffleable;
use UnderflowException;

/**
 * A deck of cards
 */
class Deck
{
    /**
     * The current cards in the deck
     */
    protected array $cards;

    /**
     * The cards drawn. i.e. not in the deck
     */
    protected array $cardsDrawn = [];

    /**
     * The shuffler for the deck
     */
    protected Shuffleable|null $shuffler = null;


    /**
     * A new deck of cards.
     * By default, creates a standard 52 card deck.
     *
     * @param CardProvider|null $provider provider the initial cards for the deck
     */
    public function __construct(CardProvider $provider = null)
    {
        if (is_null($provider)) {
            $provider = new StandardDeckProvider;
        }

        $this->cards = $provider->getCards();
    }

    /**
     * Draw a card from the deck
     *
     * @throws UnderflowException
     */
    public function draw(): Card
    {
        if ($this->count() === 0) {
            throw new UnderflowException('No more cards in the deck!');
        }

        $card = array_pop($this->cards);
        $this->cardsDrawn[] = $card;

        return $card;
    }

    /**
     * Draw a hand of cards from the deck
     *
     * @throws UnderflowException
     */
    public function drawHand($numberOfCardsToDraw = 1): array
    {
        $hand = [];

        for ($i = 0; $i < $numberOfCardsToDraw; ++$i) {
            $hand[] = $this->draw();
        }

        return $hand;
    }

    /**
     * Get the cards in the deck
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * Get the cards in the deck
     */

    public function getDrawnCards(): array
    {
        return $this->cardsDrawn;
    }

    /**
     * Get the number of cards in the deck
     */
    public function count(): int
    {
        return count($this->cards);
    }

    /**
     * Get the number of cards drawn
     */
    public function countDrawn(): int
    {
        return count($this->cardsDrawn);
    }

    /**
     * Reset the deck (all drawn cards are 'inserted back'), and Shuffles all the cards.
     */
    public function shuffle(): bool
    {
        if (is_null($this->shuffler)) {
            $this->setShuffler(new StandardShuffle);
        }

        $this->reset();

        return $this->shuffler->shuffle($this->cards);
    }

    /**
     * Set a new Shuffle algorithm
     */
    public function setShuffler(Shuffleable $shuffleable): void
    {
        $this->shuffler = $shuffleable;
    }

    protected function reset(): void
    {
        while (count($this->cardsDrawn)) {
            $c = array_pop($this->cardsDrawn);
            $this->cards[] = $c;
        }
    }
}
