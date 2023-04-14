<?php

namespace Jouva\TTGCards\Decks;

use Jouva\TTGCards\Cards\Providers\StandardCardProvider;
use Jouva\TTGCards\Cards\Standard\StandardCard;
use Jouva\TTGCards\Contracts\CardProvider;
use Jouva\TTGCards\Contracts\Deck as DeckContract;
use Jouva\TTGCards\Contracts\Shuffleable;
use Jouva\TTGCards\Exceptions\ShuffleException;
use Jouva\TTGCards\Shufflers\StandardShuffle;
use UnderflowException;

/**
 * A deck of cards
 */
class StandardDeck implements DeckContract
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
     * By default, creates a Standard 52-card deck
     *
     * @param CardProvider|null $provider provider the initial cards for the deck
     */
    public function __construct(CardProvider $provider = null)
    {
        if (is_null($provider)) {
            $provider = new StandardCardProvider;
        }

        $this->cards = $provider->getCards();
    }

    /**
     * Draw a card from the deck
     *
     * @throws UnderflowException
     */
    public function draw(): StandardCard
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
     * Get the cards drawn from the deck
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
     * Shuffles all cards that have not been drawn. Returns the deck object
     *
     * @throws ShuffleException
     *
     * @see reset
     * @see setShuffler
     */
    public function shuffle(): self
    {
        if (is_null($this->shuffler)) {
            $this->setShuffler(new StandardShuffle);
        }

        $this->shuffler->shuffle($this->cards);

        return $this;
    }

    /**
     * Set a new Shuffle algorithm.
     */
    public function setShuffler(Shuffleable $shuffleable): void
    {
        $this->shuffler = $shuffleable;
    }

    /**
     * Returns all drawn cards to the deck
     */
    public function reset(): void
    {
        while (count($this->cardsDrawn)) {
            $c = array_pop($this->cardsDrawn);
            $this->cards[] = $c;
        }
    }
}
