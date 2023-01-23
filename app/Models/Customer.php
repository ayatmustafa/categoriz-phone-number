<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
* @property string name
* @property string phone

*
* @method  getArrayOfPhoneNumbers|self query
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
