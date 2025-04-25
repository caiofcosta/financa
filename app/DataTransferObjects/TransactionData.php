<?php

namespace App\DataTransferObjects;

use App\Enums\TransactionType;

class TransactionData
{
    public function __construct(
        public readonly string $description,
        public readonly float $amount,
        public readonly TransactionType $type,
        public readonly string $date,
        public readonly int $category_id,
    ) {}
} 