<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'total',
    ];

    protected $casts = [
        'payment_due' => 'date',
    ];
}
