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
    /**
     * Display the home page.
     * 
     * This method returns the home view for the shoe store.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Show a list of shoes, applying filters 
     *
     * This method fetches shoes from the database and applies filters based on the user's request.
     * The results are paginated and displayed in the 'search' view.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Shoe::query();

        // Filter shoes by name if provided
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Apply the brand filter if selected
        if ($request->has('brand') && !empty($request->brand)) {
            $query->whereIn('brand_id', $request->brand);
        }

        // Apply the type filter (single selection)
        if ($request->has('type') && $request->type != '') {
            $query->where('type_id', $request->type);
        }

        // Apply the price filter based on predefined ranges
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

        // Filter by colors and materials using pivot tables
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

        // Check if the user wants to filter by their favorites
        if ($request->has('favorites') && auth()->check()) {
            $user = auth()->user();
            if ($user->role !== 'admin') {
                $query->whereHas('users', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });
            }
        }

        // Eager load the related brand, type, colours, and materials to optimize performance
        $shoes = $query->with(['materials', 'colours', 'brand', 'type'])->paginate(10);

        // Fetch filter options for the front-end (brands, types, colours, materials)
        $brands = Brand::all();
        $types = Type::all();
        $colours = Colour::all();
        $materials = Material::all();

        return view('search', compact('shoes', 'brands', 'types', 'colours', 'materials'));
    }

    /**
     * Show the form to create a new shoe.
     *
     * This method returns the view where the user can input details to create a new shoe.
     * It also fetches available brands, types, colours, and materials for the form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $brands = Brand::all();
        $types = Type::all();
        $colours = Colour::all();
        $materials = Material::all();

        return view('create', compact('brands', 'types', 'colours', 'materials'));
    }

    /**
     * Store a newly created shoe in the database.
     *
     * This method validates the input, creates a new shoe, and attaches the selected colours and materials.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
            'type_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'release_date' => 'required|date',
            'colours' => 'required|array',
            'colours.*' => 'exists:colours,id',
            'materials' => 'required|array',
            'materials.*' => 'exists:materials,id',
        ]);

        // Create a new shoe entry
        $shoe = Shoe::create($request->except(['colours', 'materials']));

        // Attach the selected colours and materials to the shoe
        $shoe->colours()->attach($request->colours);
        $shoe->materials()->attach($request->materials);

        // Redirect back to the create page with a success message
        return redirect()->route('create')->with('success', 'Shoe created successfully.');
    }

    /**
     * Show the form to edit an existing shoe.
     *
     * This method retrieves an existing shoe by ID and returns the edit form with the current details.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        session(['previous_page' => url()->previous()]);
        $shoe = Shoe::findOrFail($id);
        $brands = Brand::all();
        $types = Type::all();
        $colours = Colour::all();
        $materials = Material::all();

        return view('edit', compact('shoe', 'brands', 'types', 'colours', 'materials'));
    }

    /**
     * Update the details of an existing shoe.
     *
     * This method validates the input, updates the shoe, and syncs the selected colours and materials.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
            'type_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'release_date' => 'required|date',
            'colours' => 'required|array',
            'materials' => 'required|array',
        ]);

        // Find and update the shoe
        $shoe = Shoe::findOrFail($id);
        $shoe->update($request->except(['colours', 'materials']));

        // Sync the colours and materials (update any changes)
        $shoe->colours()->sync($request->colours);
        $shoe->materials()->sync($request->materials);

        // Redirect back to the previous page or the search page with a success message
        return redirect(session()->pull('previous_page', route('search')))
            ->with('success', 'Shoe updated successfully.');
    }

    /**
     * Delete a shoe from the database.
     *
     * This method deletes a shoe by ID and redirects the user back with a success message.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $shoe = Shoe::findOrFail($id);
        $shoe->delete();

        // Redirect back to the previous page with a success message
        return redirect()->back()->with('success', 'Shoe deleted successfully.');
    }

    /**
     * Provide autocomplete suggestions for the shoe search.
     *
     * This method provides autocomplete functionality for the search field by returning shoe names
     * that match the search term entered by the user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function autocomplete(Request $request)
    {
        $search = $request->input('term');
        $suggestions = Shoe::where('name', 'LIKE', $search . '%')
            ->take(10)
            ->get()
            ->pluck('name');

        return response()->json($suggestions);
    }

    /**
     * Add a shoe to the user's favorites.
     *
     * This method adds a shoe to the currently authenticated user's favorites list.
     * It ensures the shoe is not already in the user's favorites.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $shoeId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToFavorites(Request $request, $shoeId)
    {
        $user = auth()->user();

        // Check if the shoe is already in the user's favorites
        if ($user->shoes()->where('shoe_id', $shoeId)->exists()) {
            return redirect()->back()->with('error', 'This shoe is already in your favorites.');
        }

        // Add the shoe to the user's favorites
        $user->shoes()->attach($shoeId);

        return redirect()->back()->with('success', 'Shoe added to your favorites!');
    }

    /**
     * Remove a shoe from the user's favorites.
     *
     * This method removes a shoe from the currently authenticated user's favorites list.
     * It checks if the shoe is in the user's favorites before removing it.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $shoeId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFromFavourites(Request $request, $shoeId)
    {
        $user = auth()->user();

        // Check if the shoe is in the user's favorites
        if (!$user->shoes()->where('shoe_id', $shoeId)->exists()) {
            return redirect()->back()->with('error', 'This shoe is not in your favorites!');
        }

        // Remove the shoe from the user's favorites
        $user->shoes()->detach($shoeId);

        return redirect()->back()->with('success', 'Shoe removed from your favorites!');
    }
}
