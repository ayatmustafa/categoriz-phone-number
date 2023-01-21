<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use PhpParser\ErrorHandler\Collecting;
use Ramsey\Collection\Collection;

/**
* @property int country_id
* @property string phone_number
* @property string state
* @property Country country
* */

class phone extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function country()
    {
        return $this->belongsTo(country::class);
    }

    public function countryStore(string $phoneNumber, bool $state): phone
    {
        return $this->create(['phone_number' => $phoneNumber, 'state' => $state]);
    }

    public function scopWhereStates(Builder $query, bool $state): Builder
    {
        return $query->where('state', $state);
    }

    public function scopeWhereCountry(Builder $query, int $country_id): Builder
    {
        return $query->where('country_id' , $country_id);
    }

    public function scopeWhereHasCountry(Builder $query, string $name): Builder
    {
        return $query->whereHas('country', function($q) use($name) {
            $q->whereName($name);
        });
    }

}
