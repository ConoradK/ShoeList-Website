<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    // Disable timestamps for this model if not needed
    public $timestamps = false;

    // Define the fillable attributes
    protected $fillable = ['name'];

    // Mutator to capitalize the first letter of the 'name' attribute
    public function setNameAttribute($value)
    {
        // Capitalize the first letter of the material name
        $this->attributes['name'] = ucfirst($value);
    }

    // Define many-to-many relationship with Shoe
    public function shoes()
    {
        return $this->belongsToMany(Shoe::class, 'material_shoe');
    }
}
