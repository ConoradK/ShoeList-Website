@extends('layouts.app') <!-- Extends the base layout to inherit the common page structure -->

@section('content') <!-- Start of the content section that will be injected into the layout's content area -->

    <h1>Search Shoes</h1> 

    <!-- Display a success message if the session has a 'success' key -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <!-- Form to filter shoes by various criteria -->
    <form action="{{ route('search') }}" method="GET" class="mb-3">
        <div class="card p-3">
            <div class="row g-2">
                <!-- Name Filter: Text input to search by shoe name -->
                <div class="col-md-4 col-lg-2">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{ request('name') }}">
                </div>
                
                <!-- Brand Filter: Dropdown allowing multiple brands to be selected -->
                <div class="col-md-4 col-lg-2">
                    <label for="brand" class="form-label">Brand</label>
                    <select id="brand" name="brand[]" class="form-control" multiple>
                        @foreach($brands as $brand) <!-- Loop through available brands -->
                            <option value="{{ $brand }}" {{ in_array($brand, request('brand', [])) ? 'selected' : '' }}>{{ ucfirst($brand) }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Hold Ctrl</small> <!-- Message for Ctrl selection -->
                </div>
                
                <!-- Type Filter: Dropdown to select shoe type -->
                <div class="col-md-4 col-lg-2">
                    <label for="type" class="form-label">Type</label>
                    <select id="type" name="type" class="form-control">
                        <option value="">Select Type</option>
                        @foreach($types as $type) <!-- Loop through available types -->
                            <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Material Filter: Dropdown allowing multiple materials to be selected -->
                <div class="col-md-4 col-lg-2">
                    <label for="material" class="form-label">Material</label>
                    <select id="material" name="material[]" class="form-control" multiple>
                        @foreach($materials as $material) <!-- Loop through available materials -->
                            <option value="{{ $material }}" {{ in_array($material, request('material', [])) ? 'selected' : '' }}>{{ ucfirst($material) }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Hold Ctrl</small> <!-- Message for Ctrl selection -->
                </div>

                <!-- Price Range Filter: Dropdown to select price range -->
                <div class="col-md-4 col-lg-2">
                    <label for="price" class="form-label">Price Range</label>
                    <select id="price" name="price" class="form-control">
                        <option value="">Price Range</option>
                        <option value="under50" {{ request('price') == 'under50' ? 'selected' : '' }}>Less than 50</option>
                        <option value="50to100" {{ request('price') == '50to100' ? 'selected' : '' }}>50 - 100</option>
                        <option value="100to250" {{ request('price') == '100to250' ? 'selected' : '' }}>100 - 250</option>
                        <option value="250to500" {{ request('price') == '250to500' ? 'selected' : '' }}>250 - 500</option>
                        <option value="500plus" {{ request('price') == '500plus' ? 'selected' : '' }}>500+</option>
                    </select>
                </div>

                <!-- Colour Filter: Dropdown allowing multiple colours to be selected -->
                <div class="col-md-4 col-lg-2">
                    <label for="colours" class="form-label">Colour</label>
                    <select id="colours" name="colours[]" class="form-control" multiple>
                        @foreach($colours as $colour) <!-- Loop through available colours -->
                            <option value="{{ $colour }}" {{ in_array($colour, request('colours', [])) ? 'selected' : '' }}>{{ ucfirst($colour) }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Hold Ctrl</small> <!-- Message for Ctrl selection -->
                </div>
            </div>

            <!-- Submit Button Row - Centered -->
            <div class="row mt-3 justify-content-center">
                <div class="col-md-4 col-lg-2 d-flex">
                    <button type="submit" class="btn btn-primary w-100">Filter</button> <!-- Submit button to apply filters -->
                </div>
            </div>
        </div>
    </form>

    <!-- Shoes Table: Display the filtered list of shoes -->
    @if($shoes->count()) <!-- Check if there are any shoes to display -->
        <div class="table-responsive">
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Type</th>
                        <th>Material</th>
                        <th>Price</th>
                        <th>Colour</th>
                        <th>Stock</th>
                        <th>Release Date</th>
                        <th>Actions</th> <!-- Action buttons for each shoe (edit and delete) -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($shoes as $shoe) <!-- Loop through the list of filtered shoes -->
                        <tr>
                            <td>{{ $shoe->name }}</td>
                            <td>{{ $shoe->brand }}</td>
                            <td>{{ $shoe->type }}</td>
                            <td>{{ $shoe->material }}</td>
                            <td>{{ $shoe->price }}</td>
                            <td>{{ $shoe->colour }}</td>
                            <td>{{ $shoe->stock }}</td>
                            <td>{{ $shoe->release_date }}</td>
                            <td>
                                <a href="{{ route('edit', $shoe->product_code) }}" class="btn btn-warning btn-sm">Edit</a> <!-- Edit button -->
                                <form action="{{ route('delete', $shoe->product_code) }}" method="POST" style="display:inline-block;"> <!-- Delete form -->
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button> <!-- Delete button -->
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination for the shoes list -->
        <div class="d-flex justify-content-center mt-3">
        <!-- Pagination links with query parameters preserved -->
        {{ $shoes->appends(request()->query())->links('pagination::bootstrap-4') }} 
        </div>
    @else
        <p class="text-center">No shoes found.</p> <!-- Message displayed if no shoes are found -->
    @endif

@endsection <!-- End of content section -->
