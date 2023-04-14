<?php

namespace Jouva\TTGCards\Cards\Providers;

use Jouva\TTGCards\Cards\Standard\StandardCard;
use Jouva\TTGCards\Cards\Standard\StandardCardSuit;
use Jouva\TTGCards\Contracts\CardProvider;

/**
 * The standards cards in a 52 card deck
 */
class StandardCardProvider implements CardProvider
{
    public function getCards(): array
    {
        $cards = [];

        $suits = [StandardCardSuit::club(), StandardCardSuit::diamond(), StandardCardSuit::heart(), StandardCardSuit::spade()];

        foreach ($suits as $suit) {
            $this->addCards($cards, $suit);
        }

        return $cards;
    }

    private function addCards(&$cards, StandardCardSuit $suit): void
    {
        $values = range(2, 10);
        $values[] = StandardCard::ACE;
        $values[] = StandardCard::JACK;
        $values[] = StandardCard::QUEEN;
        $values[] = StandardCard::KING;

        foreach ($values as $value) {
            $cards[] = new StandardCard($value, $suit);
        }
    }
}
