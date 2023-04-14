<?php

namespace Jouva\TTGCards\Contracts;

use Jouva\TTGCards\Exceptions\ShuffleException;

/**
 * For decks to allow for shuffling cards in the deck.
 *
 */
interface Shuffleable
{
    /**
     * Shuffles the deck of cards
     *
     * @throws ShuffleException
     */
    public function shuffle(array &$cards): void;
}
