<?php

namespace App\Repositories;

use App\DataTransferObjects\TransactionData;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;

class TransactionRepository
{
    public function __construct(
        private readonly Transaction $model
    ) {}

    public function getAll(): Collection
    {
        return $this->model->with('category')->get();
    }

    public function create(TransactionData $data): Transaction
    {
        return $this->model->create($data->toArray());
    }

    public function update(Transaction $transaction, TransactionData $data): bool
    {
        return $transaction->update($data->toArray());
    }

    public function delete(Transaction $transaction): bool
    {
        return $transaction->delete();
    }
} 