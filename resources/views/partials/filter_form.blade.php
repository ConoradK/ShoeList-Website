<!-- resources/views/partials/filter_form.blade.php -->

<div class="filter-container"> <!-- Wrapper for the filter section -->
     <div class="filter-options"> <!-- Container for the filter options form -->
         <!-- The filter form submits a GET request to the search route with the selected filter criteria -->
         <form action="{{ route('search') }}" method="GET" class="filter-form">
             <div class="card"> <!-- Card layout to display the filter fields -->

                 <!-- Filter Fields Section -->

                 <!-- Brand Filter -->
                 <div>
                     <label for="brand">Brand</label> <!-- Label for the brand filter -->
                     <select id="brand" name="brand[]" multiple> <!-- Multiple selection for brands -->
                         @foreach($brands as $brand) <!-- Loop through the brands -->
                             <option value="{{ $brand->id }}" {{ in_array($brand->id, request('brand', [])) ? 'selected' : '' }}>
                                 {{ ucfirst($brand->name) }} <!-- Display the brand name with the first letter capitalized -->
                             </option>
                         @endforeach
                     </select>
                     <small>Hold Ctrl</small> <!-- Instruction to hold Ctrl to select multiple options -->
                 </div>

                 <!-- Type Filter -->
                 <div>
                     <label for="type">Type</label> <!-- Label for the type filter -->
                     <select id="type" name="type"> <!-- Single selection for type -->
                         <option value="">Select Type</option> <!-- Default option to prompt the user -->
                         @foreach($types as $type) <!-- Loop through the shoe types -->
                             <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                                 {{ ucfirst($type->name) }} <!-- Display the type name with the first letter capitalized -->
                             </option>
                         @endforeach
                     </select>
                 </div>

                 <!-- Material Filter -->
                 <div>
                     <label for="material">Material</label> <!-- Label for the material filter -->
                     <select id="material" name="material[]" multiple> <!-- Multiple selection for materials -->
                         @foreach($materials as $material) <!-- Loop through the materials -->
                             <option value="{{ $material->id }}" {{ in_array($material->id, request('material', [])) ? 'selected' : '' }}>
                                 {{ ucfirst($material->name) }} <!-- Display the material name with the first letter capitalized -->
                             </option>
                         @endforeach
                     </select>
                     <small>Hold Ctrl</small> <!-- Instruction to hold Ctrl to select multiple options -->
                 </div>

                 <!-- Price Range Filter -->
                 <div>
                     <label for="price">Price Range</label> <!-- Label for the price filter -->
                     <select id="price" name="price"> <!-- Single selection for price range -->
                         <option value="">Price Range</option> <!-- Default option to prompt the user -->
                         <!-- List price range options with dynamic "selected" based on the request -->
                         <option value="under50" {{ request('price') == 'under50' ? 'selected' : '' }}>Less than 50</option>
                         <option value="50to100" {{ request('price') == '50to100' ? 'selected' : '' }}>50 - 100</option>
                         <option value="100to250" {{ request('price') == '100to250' ? 'selected' : '' }}>100 - 250</option>
                         <option value="250to500" {{ request('price') == '250to500' ? 'selected' : '' }}>250 - 500</option>
                         <option value="500plus" {{ request('price') == '500plus' ? 'selected' : '' }}>500+</option>
                     </select>
                 </div>

                 <!-- Colour Filter -->
                 <div>
                     <label for="colours">Colour</label> <!-- Label for the colour filter -->
                     <select id="colours" name="colours[]" multiple> <!-- Multiple selection for colours -->
                         @foreach($colours as $colour) <!-- Loop through the colours -->
                             <option value="{{ $colour->id }}" {{ in_array($colour->id, request('colours', [])) ? 'selected' : '' }}>
                                 {{ ucfirst($colour->name) }} <!-- Display the colour name with the first letter capitalized -->
                             </option>
                         @endforeach
                     </select>
                     <small>Hold Ctrl</small> <!-- Instruction to hold Ctrl to select multiple options -->
                 </div>

                 <!-- Only show the "Favorites" filter for logged-in normal users -->
                 @if(Auth::check() && Auth::user()->role === 'user')
                     <div>
                         <label for="favorites">Show Favorites</label> <!-- Label for the favorites checkbox -->
                             <input type="checkbox" name="favorites" id="favorites" value="1" {{ request('favorites') == '1' ? 'checked' : '' }}> <!-- Checkbox to show only favorites -->
                     </div>
                 @endif

                 <!-- Button row for form submission and clearing filters -->
                 <div class="button-row">
                     <button type="submit" class="btn-primary">Apply</button> <!-- Button to apply filters -->
                     <a href="{{ route('search') }}" class="btn-reset">Clear</a> <!-- Button to clear all filters and reset search -->
                 </div>
             </div>
         </form>
     </div>
 </div>
