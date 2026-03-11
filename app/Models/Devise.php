<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Devise extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = ['nom', 'deleted_at'];

    public function wallets() : HasMany
    {
        return $this->hasMany(Wallet::class);
    }
}
