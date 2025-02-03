<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    // Disable timestamps if not needed
    public $timestamps = false;

    // Define the fillable attributes
    protected $fillable = ['name'];

    // Mutator to capitalize the first letter of the 'name' attribute
    public function setNameAttribute($value)
    {
        // Capitalize the first letter of the type name
        $this->attributes['name'] = ucfirst($value);
    }

    // Define the one-to-many relationship with Shoe
    public function shoes()
    {
        return $this->hasMany(Shoe::class);
    }
}

