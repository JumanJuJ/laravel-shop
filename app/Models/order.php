<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fields = [
        'user_id',
        'product_id',
        'quantity',
        'total_price'
    ];

    # db relationships
    # il model order contiene una relationship con user perché ogni ordine è associato ad un utente che lo ha effettuato , order contiene il campo del model di user   
    public function orderedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
