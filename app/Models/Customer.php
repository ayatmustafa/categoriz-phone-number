<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
* @property string name
* @property string phone

*
* @method  CustomerQueryBuilder|self query
*
* */
class Customer extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer';

    protected $guarded = ['id'];

    public function getArrayOfPhoneNumbers(): array
    {
        return $this->select('phone')->pluck('phone')->toArray();
    }
}
