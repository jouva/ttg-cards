<?php

namespace Jouva\TTGCards\Cards\Standard;

use InvalidArgumentException;

/**
 * A suit of cards
 */
final class StandardCardSuit
{
    const CLUB = 1;
    const DIAMOND = 2;
    const HEART = 3;
    const SPADE = 4;

    private int $suit;

    /**
     * The suits that were instantiated.
     * Since suits are immutable we save some space
     */
    private static array $suits = [];

    private function __construct(int $suit)
    {
        if (!$this->isValidSuit($suit)) {
            throw new InvalidArgumentException("The suit value is not valid: $suit");
        }

        $this->suit = $suit;
    }

    private function isValidSuit(int $suit): bool
    {
        return $suit ===
            self::HEART
            ||
            self::DIAMOND
            ||
            self::HEART
            ||
            self::SPADE;
    }

    /**
     * Make a Club suit
     *
     * @param bool $shareable Share an instance of the suit
     */
    public static function club(bool $shareable = true): self
    {
        if (!$shareable) {
            return new self(self::CLUB);
        }

        return self::makeSuit(self::CLUB);
    }

    /**
     * Make a Diamond suit
     *
     * @param bool $shareable Share an instance of the suit
     */
    public static function diamond(bool $shareable = true): self
    {
        if (!$shareable) {
            return new self(self::DIAMOND);
        }

        return self::makeSuit(self::DIAMOND);
    }

    /**
     * Make a Heart suit
     *
     * @param bool $shareable Share an instance of the suit
     */
    public static function heart(bool $shareable = true): self
    {
        if (!$shareable) {
            return new self(self::HEART);
        }

        return self::makeSuit(self::HEART);
    }

    /**
     * Make a Spade suit
     *
     * @param bool $shareable Share an instance of the suit
     */
    public static function spade(bool $shareable = true): self
    {
        if (!$shareable) {
            return new self(self::SPADE);
        }

        return self::makeSuit(self::SPADE);
    }


    private static function makeSuit($suit)
    {
        if (!isset(self::$suits[$suit])) {
            self::$suits[$suit] = new self($suit);
        }

        return self::$suits[$suit];
    }

    /**
     * Get the suit unique id
     */
    public function value(): int
    {
        return $this->suit;
    }

    /**
     * Get the suit name
     *
     * @return string
     */
    public function name(): string
    {
        return match ($this->suit) {
            self::CLUB => 'Club',
            self::DIAMOND => 'Diamond',
            self::HEART => 'Heart',
            self::SPADE => 'Spade',
            default => '',
        };
    }

    public function __toString(): string
    {
        return $this->name();
    }
}
