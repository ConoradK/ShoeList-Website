<?php

namespace App\Http\Controllers;

// Import model and class for handling HTTP requests
use App\Models\shoe;
use Illuminate\Http\Request;

class ShoeController extends Controller
{
    // Display the home page
    public function home()
    {
        // Return the home view to the user
        return view('home');
    }

    // Display the search page with filters and pagination
    public function index(Request $request)
    {
        // Initialise a query for the Shoe model
        $query = Shoe::query();

        // Apply filters if the corresponding request parameters exist
        if ($request->has('name') && $request->name != '') {
            // Filter shoes by name using a 'like' search
            $query->where('name', 'like', '%' . $request->name . '%'); 
        }

        if ($request->has('brand') && !empty($request->brand)) {
            // Filter shoes by brand (multiple brands can be selected)
            $query->whereIn('brand', $request->brand);
        }
    
        if ($request->has('type') && $request->type != '') {
            // Filter shoes by type (only one type can be selected)
            $query->where('type', $request->type);
        }
    
        if ($request->has('material') && !empty($request->material)) {
            // Filter shoes by material (multiple materials can be selected)
            $query->whereIn('material', $request->material);
        }
        
        if ($request->has('colours') && !empty($request->colours)) {
            // Filter shoes by colours (multiple colours can be selected)
            $query->whereIn('colour', $request->colours);
        }

        // Apply price range filter based on user selection
        if ($request->has('price') && $request->price != '') {
            switch ($request->price) {
                case 'under50':
                    // Shoes priced under 50
                    $query->where('price', '<', 50);
                    break;
                case '50to100':
                    // Shoes priced between 50 and 100
                    $query->whereBetween('price', [50, 100]);
                    break;
                case '100to250':
                    // Shoes priced between 100 and 250
                    $query->whereBetween('price', [100, 250]);
                    break;
                case '250to500':
                    // Shoes priced between $250 and 500
                    $query->whereBetween('price', [250, 500]);
                    break;
                case '500plus':
                    // Shoes priced over 500
                    $query->where('price', '>', 500);
                    break;
            }
        }

        // Displaying 10 shoes per page
        $shoes = $query->paginate(10);

        // Fetch dynamic values for filters from the database for brands, types, materials, and colours
        $brands = Shoe::distinct()->pluck('brand');
        $types = Shoe::distinct()->pluck('type');
        $materials = Shoe::distinct()->pluck('material');
        $colours = Shoe::distinct()->pluck('colour');
    
        // Return the search results along with the filter options to the search view
        return view('search', compact('shoes', 'brands', 'types', 'materials', 'colours'));
    }

    // Show the form to create a new shoe
    public function create()
    {
        // Fetch predefined shoe attributes from the configuration file
        $shoeAttributes = config('shoeAttributes');
        
        // Fetch distinct colours from the database
        $colours = Shoe::distinct()->pluck('colour');

        // Return the create view, passing predefined shoe attributes and colours for selection
        return view('create', [
            'brands' => $shoeAttributes['brands'], // Brands list
            'types' => $shoeAttributes['types'], // Types list
            'materials' => $shoeAttributes['materials'], // Materials list
            'colours' => $colours, // Colours list
        ]);
    }

    // Store a new shoe in the database
    public function store(Request $request)
    {
        // Validate the request data before saving the new shoe
        $request->validate([
            'name' => 'required', // Shoe name is required
            'brand' => 'required', // Brand is required
            'type' => 'required', // Type is required
            'material' => 'required', // Material is required
            'price' => 'required|numeric', // Price is required and must be numeric
            'colour' => 'required', // Colour is required
            'stock' => 'required|integer', // Stock quantity is required and must be an integer
            'release_date' => 'required|date', // Release date is required and must be a valid date
        ]);

        // Create a new shoe entry in the database using the validated request data
        Shoe::create($request->all());
        
        // Redirect to the create page with a success message
        return redirect()->route('create')->with('success', 'Shoe created successfully.');
    }

    // Show the form to edit an existing shoe
    public function edit($productCode)
    {
        // Save the previous page URL for redirection after editing
        session(['previous_page' => url()->previous()]);

        // Find the shoe by its product code, or return a 404 error if not found
        $shoe = Shoe::where('product_code', $productCode)->firstOrFail();

        // Fetch predefined shoe attributes and distinct colours for the edit form
        $shoeAttributes = config('shoeAttributes');
        $colours = Shoe::distinct()->pluck('colour');

        // Return the edit view with the shoe details and attributes for editing
        return view('edit', [
            'shoe' => $shoe, // The shoe details to be edited
            'brands' => $shoeAttributes['brands'], // Brands list
            'types' => $shoeAttributes['types'], // Types list
            'materials' => $shoeAttributes['materials'], // Materials list
            'colours' => $colours, // Colours list
        ]);
    }

    // Update an existing shoe in the database
    public function update(Request $request, $productCode)
    {
        // Validate the request data before updating the shoe
        $request->validate([
            'name' => 'required', // Shoe name is required
            'brand' => 'required', // Brand is required
            'type' => 'required', // Type is required
            'material' => 'required', // Material is required
            'price' => 'required|numeric', // Price is required and must be numeric
            'colour' => 'required', // Colour is required
            'stock' => 'required|integer', // Stock quantity is required and must be an integer
            'release_date' => 'required|date', // Release date is required and must be a valid date
        ]);

        // Find the shoe by product code
        $shoe = Shoe::where('product_code', $productCode)->firstOrFail();

        // Update the shoe with the new request data
        $shoe->update($request->all());

        // Redirect back to the previous page or to the search page with a success message
        //session pull is required so that the variables in the url are preserved
        return redirect(session()->pull('previous_page', route('search')))
            ->with('success', 'Shoe updated successfully.');
    }

    // Delete an existing shoe from the database
    public function destroy($productCode)
    {
        // Find the shoe by product code
        $shoe = Shoe::where('product_code', $productCode)->firstOrFail();

        // Delete the shoe from the database
        $shoe->delete();

        // Redirect back to the previous page with a success message
        return redirect()->back()->with('success', 'Shoe deleted successfully.');
    }
}
