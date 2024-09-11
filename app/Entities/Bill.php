<?php

namespace App\Entities;

use Spatie\LaravelData\Data;

class Bill extends Data
{
    /**
     * @param float $amount
     * @param string $currency
     * @param string $description
     */
    public function __construct(
        public float $amount,
        public string $currency,
        public string $description,
    ) {
    }

    /**
     * @return self
     */
    public static function fromRequest(): self
    {
        return new self(
            request('amount'),
            request('currency'),
            request('description'),
        );
    }
}
