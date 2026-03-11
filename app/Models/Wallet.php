<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use SoftDeletes;
    protected $fillable = ['balance', 'devise_id', 'deleted_at', 'user_id'];

    public function devise() : BelongsTo
    {
        return $this->belongsTo(Devise::class);
    }
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
