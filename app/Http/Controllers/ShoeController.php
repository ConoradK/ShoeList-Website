<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use App\Models\Brand;
use App\Models\Type;
use App\Models\Colour;
use App\Models\Material;
use Illuminate\Http\Request;

class ShoeController extends Controller
{
    // Display the home page
    public function home()
    {
        return view('home');
    }

    public function index(Request $request)
    {
        $query = Shoe::query();

        // Add filters for shoes (brand, type, price, etc.)
        // Example for filtering by name
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Apply the brand filter
        if ($request->has('brand') && !empty($request->brand)) {
            $query->whereIn('brand_id', $request->brand);
        }

        // Apply the type filter (single selection)
        if ($request->has('type') && $request->type != '') {
            $query->where('type_id', $request->type);  // Works for single selection (string)
        }

        // Apply the price filter
        if ($request->has('price') && $request->price != '') {
            switch ($request->price) {
                case 'under50':
                    $query->where('price', '<', 50);
                    break;
                case '50to100':
                    $query->whereBetween('price', [50, 100]);
                    break;
                case '100to250':
                    $query->whereBetween('price', [100, 250]);
                    break;
                case '250to500':
                    $query->whereBetween('price', [250, 500]);
                    break;
                case '500plus':
                    $query->where('price', '>', 500);
                    break;
            }
        }

        // Add filters for colours and materials (using pivot tables)
        if ($request->has('colours') && !empty($request->colours)) {
            $query->whereHas('colours', function ($query) use ($request) {
                $query->whereIn('colour_shoe.colour_id', $request->colours);
            });
        }

        if ($request->has('material') && !empty($request->material)) {
            $query->whereHas('materials', function ($query) use ($request) {
                $query->whereIn('material_shoe.material_id', $request->material);
            });
        }

        // Add eager loading for materials and colours
        $shoes = $query->with(['materials', 'colours', 'brand', 'type'])->paginate(10);

        // Fetch filter values for the front-end (for example, brands, types, colours, materials)
        $brands = Brand::all();
        $types = Type::all();
        $colours = Colour::all();
        $materials = Material::all();

        return view('search', compact('shoes', 'brands', 'types', 'colours', 'materials'));
    }




    // Show the form to create a new shoe
    public function create()
    {
        // Get brands, types, colours, and materials
        $brands = Brand::all();
        $types = Type::all();
        $colours = Colour::all();
        $materials = Material::all();

        return view('create', compact('brands', 'types', 'colours', 'materials'));
    }

    // Store a new shoe in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required', // Changed to brand_id
            'type_id' => 'required',  // Changed to type_id
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'release_date' => 'required|date',
            'colours' => 'required|array', 
            // 'colours.*' => 'exists:colours,id',
            'materials' => 'required|array', // Assuming materials are selected from the pivot table
            // 'materials.*' => 'exists:materials,id',
        ]);

        // Create a new shoe entry
        $shoe = Shoe::create($request->except(['colours', 'materials']));

        // Attach the colours and materials to the shoe using the pivot table
        $shoe->colours()->attach($request->colours);
        $shoe->materials()->attach($request->materials);

        return redirect()->route('create')->with('success', 'Shoe created successfully.');
    }

    





    // Show the form to edit an existing shoe
    public function edit($id)
    {
        session(['previous_page' => url()->previous()]);
        $shoe = Shoe::findOrFail($id);  // Using id instead of product_code
        $brands = Brand::all();
        $types = Type::all();
        $colours = Colour::all();
        $materials = Material::all();

        return view('edit', compact('shoe', 'brands', 'types', 'colours', 'materials'));
    }

    // Update an existing shoe in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required', // Changed to brand_id
            'type_id' => 'required',  // Changed to type_id
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'release_date' => 'required|date',
            'colours' => 'required|array',
            'materials' => 'required|array',
        ]);

        $shoe = Shoe::findOrFail($id);  // Using id instead of product_code
        $shoe->update($request->except(['colours', 'materials']));

        // Update the colours and materials attached to the shoe
        $shoe->colours()->sync($request->colours);
        $shoe->materials()->sync($request->materials);

        return redirect(session()->pull('previous_page', route('search')))
            ->with('success', 'Shoe updated successfully.');
    }

    // Delete an existing shoe from the database
    public function destroy($id)
    {
        $shoe = Shoe::findOrFail($id);  // Using id instead of product_code
        $shoe->delete();

        return redirect()->back()->with('success', 'Shoe deleted successfully.');
    }

    // Autocomplete function for the search field
    public function autocomplete(Request $request)
    {
        $search = $request->input('term');
        $suggestions = Shoe::where('name', 'LIKE', $search . '%')
            ->take(10)
            ->get()
            ->pluck('name');

        return response()->json($suggestions);
    }
}
