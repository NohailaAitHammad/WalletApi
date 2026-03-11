<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function transactions(Wallet  $wallet)
    {
        $transactions = Transaction::where('wallet_id', $wallet->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Historique des transactions recupere',
            'data' => $transactions
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function deposit(TransactionRequest $request, Wallet  $wallet)
    {
        $validated = $request->validated();
        $validated['wallet_id'] = $wallet->id;
        $transaction = Transaction::create($validated);
        $transaction->balance_after = $wallet->balance + $transaction->amount;
        $wallet->balance = $transaction->balance_after;
        $wallet->save();
        $transaction->save();
        $transaction->load('wallet');

        return response()->json([
            'success' => true,
            'message' => 'Depot effecture avec success',
            'data' => $transaction
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function withdraw(TransactionRequest $request, Wallet  $wallet)
    {
        $validated = $request->validated();
        $validated['wallet_id'] = $wallet->id;
        //if wallet amount < amount transaction
        $transaction = Transaction::create($validated);
        $transaction->balance_after = $wallet->balance - $transaction->amount;
        $wallet->balance = $transaction->balance_after;
        $wallet->save();
        $transaction->save();
        $transaction->load('wallet');

        return response()->json([
            'success' => true,
            'message' => 'Retrait effectué avec succès.',
            'data' => $transaction
        ], 200);
    }

    public function transfer(TransactionRequest $request, Wallet  $wallet)
    {
        $validated = $request->validated();
        $validated['wallet_id'] = $wallet->id;
        //if wallet amount < amount transaction
        $transaction = Transaction::create($validated);
        $transaction->balance_after = $wallet->balance - $transaction->amount;
        $wallet->balance = $transaction->balance_after;
        $wallet->save();
        $transaction->save();
        $transaction->load('wallet');

        return response()->json([
            'success' => true,
            'message' => 'Retrait effectué avec succès.',
            'data' => $transaction
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
