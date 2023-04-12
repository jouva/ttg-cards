<?php

namespace Jouva\TTGCards\Contracts;

/**
 * For decks to allow for shuffling cards in the deck.
 *
 */
interface Shuffleable
{
    /**
     * Shuffles the deck of cards and returns the shuffled deck
     */
    public function shuffle(array &$cards): bool;
}
