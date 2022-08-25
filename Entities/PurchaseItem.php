<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\Purchase\Database\factories\PurchaseItemFactory::new();
    }
}
