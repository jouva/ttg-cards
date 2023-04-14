<?php

namespace Jouva\TTGCards\Cards\Standard;

use InvalidArgumentException;
use Jouva\TTGCards\Contracts\Card as CardContract;

/**
 * A card from a standard 52-card deck
 *
 * Consisting of one of four Suits with values of Ace, 2 through 10,
 * Jack, Queen, and King
 */
class StandardCard implements CardContract
{
    const JACK = 11;
    const QUEEN = 12;
    const KING = 13;
    const ACE = 14;

    /**
     * Face value
     */
    protected int $faceValue;

    /**
     * The suit of this card
     */
    protected StandardCardSuit $suit;

    /**
     * A new playing card
     *
     * @throws InvalidArgumentException
     */
    public function __construct(int $faceValue, StandardCardSuit $suit)
    {
        if (!$this->isValidFaceValue($faceValue)) {
            throw new InvalidArgumentException("The face value is not valid: $faceValue");
        }

        $this->faceValue = $faceValue;
        $this->suit = $suit;
    }

    protected function isValidFaceValue($value): bool
    {
        if ($value >= 2 && $value <= 10) {
            return true;
        }

        if ($this->isFaceCardOrAce($value)) {
            return true;
        }

        return false;
    }

    protected function isFaceCardOrAce($value): bool
    {
        return (
            $value === self::JACK
            ||
            $value === self::QUEEN
            ||
            $value === self::KING
            ||
            $value === self::ACE);
    }

    /**
     * Get the Face value of the card
     */
    public function value(): int
    {
        return $this->faceValue;
    }

    /**
     * Get the Suit of the card
     */
    public function suit(): StandardCardSuit
    {
        return $this->suit;
    }

    /**
     * Get the suit name the card
     */
    public function suitName(): string
    {
        return $this->suit->name();
    }

    /**
     * Is this a Jack?
     */
    public function isJack(): bool
    {
        return $this->faceValue === static::JACK;
    }

    /**
     * Is this a Queen?
     */
    public function isQueen(): bool
    {
        return $this->faceValue === static::QUEEN;
    }

    /**
     * Is this a King?
     */
    public function isKing(): bool
    {
        return $this->faceValue === static::KING;
    }

    /**
     * Is this an Ace?
     */
    public function isAce(): bool
    {
        return $this->faceValue === self::ACE;
    }

    /**
     * Is Face card? True if the card is Jack, Queen, or King
     */
    public function isFaceCard(): bool
    {
        return $this->isJack() || $this->isQueen() || $this->isKing();
    }
}
