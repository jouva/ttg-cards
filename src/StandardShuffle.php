<?php

namespace Jouva\TTGCards;

use Jouva\TTGCards\Contracts\Shuffleable;

/**
 * Shuffles an array of cards using PHP shuffle
 */
class StandardShuffle implements Shuffleable
{
    public function shuffle(array &$cards): bool
    {
        return shuffle($cards);
    }
}
