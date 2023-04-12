<?php

namespace Jouva\TTGCards\Contracts;

/**
 * A card provider. Provides the cards for the deck.
 */
interface CardProvider
{
    /**
     * Provides the cards for a deck
     */
    public function getCards(): array;
}
