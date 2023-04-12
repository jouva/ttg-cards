<?php

namespace Jouva\TTGCards;

use InvalidArgumentException;

/**
 * A card
 *
 * One of the standard 52 playing cards
 * Ace,2,3,4,5,6,7,8,9,10,Jack,Queen,King
 */
class Card
{
    const ACE = 100;
    const JACK = 101;
    const QUEEN = 102;
    const KING = 103;

    /**
     * The suit of this card
     * @var Suit
     */
    protected Suit $suit;

    /**
     * Face value
     * @var int
     */
    protected int $faceValue;

    /**
     * A new playing card
     *
     * @throws InvalidArgumentException
     */
    public function __construct(int $faceValue, Suit $suit)
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
            $value == self::ACE
            ||
            $value == self::JACK
            ||
            $value == self::QUEEN
            ||
            $value == self::KING);
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
    public function suit(): Suit
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
     * Is this an Ace?
     */
    public function isAce(): bool
    {
        return $this->faceValue === self::ACE;
    }

    /**
     * Is this a King?
     */
    public function isKing(): bool
    {
        return $this->faceValue === static::KING;
    }

    /**
     * Is this a Queen?
     */
    public function isQueen(): bool
    {
        return $this->faceValue == static::QUEEN;
    }

    /**
     * Is this a Jack?
     */
    public function isJack(): bool
    {
        return $this->faceValue == static::JACK;
    }

    /**
     * Is Face card? True if the card is King, Queen or Jack
     */
    public function isFaceCard(): bool
    {
        return $this->isKing() || $this->isQueen() || $this->isJack();
    }
}
