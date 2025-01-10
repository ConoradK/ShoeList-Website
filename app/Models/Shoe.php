<?php

namespace App\Models;

// Import necessary classes for working with Eloquent models
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    // Use the HasFactory for testing and seeding
    use HasFactory;

    // Disable the default Laravel timestamp fields created_at and updated_at
    // because this model does not require automatic timestamp management
    public $timestamps = false;


    /// Allow mass assignment for these fields
    protected $fillable = [
        'name',           // Shoe name
        'price',          // Shoe price
        'stock',          // Stock quantity
        'release_date',   // Release date
        'brand_id',       // Foreign key for brand
        'type_id',        // Foreign key for type
    ];

    // Relationships

    // Relationships
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'material_shoe', 'shoe_id', 'material_id');
    }

    public function colours()
    {
        return $this->belongsToMany(Colour::class, 'colour_shoe', 'shoe_id', 'colour_id');
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_shoe', 'shoe_id', 'user_id');
    }

    // Mutators: These are methods that modify the data before it's saved to the database.
    // Here, we use mutators to ensure that the first letter of certain fields 
    // is capitalised before saving them to the database.

    public function setNameAttribute($value)
    {
        // Capitalize the first letter of the 'name' attribute
        $this->attributes['name'] = ucfirst($value);
    }
}
