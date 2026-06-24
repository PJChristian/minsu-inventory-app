<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model; 
use Illuminate\Database\Eloquent\Casts\Attribute;

class Post extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'scanned_documents';

    protected $fillable = [
        'company_id',
        'office_id',
        'pr_number',
        'date',
        'property_number',
        'unit',
        'item_description',
        'quantity',
        'unit_cost',
        'total_cost',
        'grand_total',
        'purpose',
        'requested_by',
    ];

    protected $casts = [
        'date' => 'datetime',
        'quantity' => 'integer',
        'unit_cost' => 'float',
        'total_cost' => 'float',
        'grand_total' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $attributes = [
        'sync_status' => 'pending',
    ];
}
