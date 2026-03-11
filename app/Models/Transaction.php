<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{

    protected $fillable = ['amount', 'type', 'wallet_id', 'receiver_wallet_id', 'sender_wallet_id', 'balance_after'];

    public function wallet() : BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function sender() : BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }
    public function receiver() : BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }
}
