<?php

namespace Jouva\TTGCards\Shufflers;

use Jouva\TTGCards\Contracts\Shuffleable;
use Jouva\TTGCards\Exceptions\ShuffleException;

/**
 * Shuffles an array of cards using PHP shuffle
 */
class StandardShuffle implements Shuffleable
{
    /**
     * Shuffles the deck of cards
     *
     * @throws ShuffleException
     */
    public function shuffle(array &$cards): void
    {
        if (!shuffle($cards)) {
            throw new ShuffleException('Could not shuffle deck');
        };
    }
}
