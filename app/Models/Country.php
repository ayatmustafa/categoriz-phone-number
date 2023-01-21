<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
* @property string name
* @property string code
*
* @property Phone phones
*
*/
class Country extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function phones()
    {
        return $this->hasMany(phone::class);
    }

    public function store(string $name, string $code): Country
    {
        return $this->firstOrCreate(['name' => $name], ["code" => $code]);
    }

    public function scopeWhereName(Builder $query, String $name): Builder
    {
        return $query->where('name' , $name);
    }
}
