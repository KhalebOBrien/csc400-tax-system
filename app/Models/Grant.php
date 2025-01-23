<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\UuidTrait;

class Grant extends Model
{
    use HasFactory;
    use SoftDeletes;
    use UuidTrait;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        
        'full_name',
        'age',
        'address',
        'phone_no',
        'email',

        'grant_purpose',
        'idea_short_description',

        'expected_funding',
        'payment_means',
        'fund_use_cases',

        'issued_id_front_path',
        'issued_id_back_path',
        'ssn_or_tin',

        'campaign',
        'received_grants_before',
        'past_grants_details',

        'certification_name',
        'certification_date',

        'status',
        'verification_url',
        'verification_proof_path',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'issued_id_front_path',
        'issued_id_back_path',
        'verification_proof_path',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
