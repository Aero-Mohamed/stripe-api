<?php

namespace App\Entities;

use Spatie\LaravelData\Data;

class CreditCard extends Data
{
    /**
     * @param string $card_number
     * @param int $expiration_year
     * @param int $expiration_month
     * @param int $cvc\
     */
    public function __construct(
        public string $card_number,
        public int $expiration_year,
        public int $expiration_month,
        public int $cvc,
    ) {
    }

    /**
     * @return self
     */
    public static function fromRequest(): self
    {
        return new self(
            request('card_number'),
            request('expiration_year'),
            request('expiration_month'),
            request('cvc'),
        );
    }
}
