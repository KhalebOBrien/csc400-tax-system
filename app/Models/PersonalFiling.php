<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\UuidTrait;

class PersonalFiling extends Model
{
    use HasFactory;
    use SoftDeletes;
    use UuidTrait;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        
        'trxn_ref',
        'basic_salary',
        'housing_allowance',
        'transport_allowance',
        'misc_allowance',
        'payment_type',
        'monthly_amount',
        'yearly_amount',

        'short_note',

        'payment_status',
        'status',
        'payment_url'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
