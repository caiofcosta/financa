<?php

namespace App\Services;

use App\DataTransferObjects\TransactionData;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Illuminate\Database\Eloquent\Collection;

class TransactionService
{
    public function __construct(
        private readonly TransactionRepository $repository
    ) {}

    public function getAllTransactions(): Collection
    {
        return $this->repository->getAll();
    }

    public function createTransaction(TransactionData $data): Transaction
    {
        return $this->repository->create($data);
    }

    public function updateTransaction(Transaction $transaction, TransactionData $data): bool
    {
        return $this->repository->update($transaction, $data);
    }

    public function deleteTransaction(Transaction $transaction): bool
    {
        return $this->repository->delete($transaction);
    }
} 