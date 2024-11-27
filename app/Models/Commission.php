<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commission extends Model
{
    /** @use HasFactory<\Database\Factories\CommissionFactory> */
    use HasFactory;

    /**
     * A tabela associada a model.
     *
     * @var string
     */
    protected $table = 'commission';

    protected $fillable = [
        'value', 'date_commission', 'affiliates_id'
    ];

    public function affiliates()
    {
        return $this->belongsTo(Affiliates::class, 'affiliates_id');
    }
}
