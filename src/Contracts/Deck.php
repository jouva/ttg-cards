<?php

namespace Jouva\TTGCards\Contracts;

interface Deck
{
    /**
     * Draw a card from the deck
     */
    public function draw(): Card;

    /**
     * Get the cards in the deck
     */
    public function getCards(): array;

    /**
     * Get the cards drawn from the deck
     */
    public function getDrawnCards(): array;

    /**
     * Get the number of cards in the deck
     */
    public function count(): int;

    /**
     * Get the number of cards drawn
     */
    public function countDrawn(): int;

    public function shuffle(): Deck;

    public function setShuffler(Shuffleable $shuffleable): void;

    public function reset(): void;
}