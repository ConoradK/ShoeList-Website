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

    // Specify a custom primary key for the model. By default, 
    //Eloquent expects the primary key to be id,
    // but we set it to product_code.
    protected $primaryKey = 'product_code';

    // This allows these fields to be filled
    // directly when creating or updating the model. 
    protected $fillable = [
        'name',        // The shoe's name
        'brand',       // The brand of the shoe
        'type',        // The type of the shoe 
        'material',    // The material the shoe is made of 
        'price',       // The price of the shoe
        'colour',      // The colour of the shoe
        'stock',       // The quantity of the shoe available in stock
        'release_date' // The release date of the shoe
    ];

    // Mutators: These are methods that modify the data before it's saved to the database.
    // Here, we use mutators to ensure that the first letter of certain fields 
    // is capitalised before saving them to the database.

    public function setNameAttribute($value)
    {
        // Capitalies the first letter of the 'name' attribute
        $this->attributes['name'] = ucfirst($value);
    }

    public function setBrandAttribute($value)
    {
        // Capitalise the first letter of the 'brand' attribute
        $this->attributes['brand'] = ucfirst($value);
    }

    public function setTypeAttribute($value)
    {
        // Capitalise the first letter of the 'type' attribute
        $this->attributes['type'] = ucfirst($value);
    }

    public function setMaterialAttribute($value)
    {
        // Capitalise the first letter of the 'material' attribute
        $this->attributes['material'] = ucfirst($value);
    }

    public function setColourAttribute($value)
    {
        // Capitalise the first letter of the 'colour' attribute
        $this->attributes['colour'] = ucfirst($value);
    }
}
