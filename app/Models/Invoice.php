<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    const STATUS_DRAFT = 'draft';

    const STATUS_PENDING = 'pending';

    const STATUS_PAID = 'paid';

    const STATUSES = [
        self::STATUS_DRAFT => self::STATUS_DRAFT,
        self::STATUS_PENDING => self::STATUS_PENDING,
        self::STATUS_PAID => self::STATUS_PAID,
    ];

    protected $fillable = [
        'id',
        'user_id',
        'from_street_address',
        'from_city',
        'from_post_code',
        'from_country',
        'to_street_address',
        'to_city',
        'to_post_code',
        'to_country',
        'description',
        'client_name',
        'client_email',
        'payment_terms',
        'status',
        'payment_due',
        'invoice_date',
        'total',
    ];

    protected $casts = [
        'payment_due' => 'date',
        'invoice_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
