@extends('layouts.app')

@section('content')

    <!-- Page Heading for Shoe Search -->
    <h1>Search Shoes</h1>

    <!-- Display Success Message if Present in Session -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filter Form for Shoe Search -->
    <form action="{{ route('search') }}" method="GET" class="filter-form">
        <div class="card">
                <!-- Filter by Shoe Name -->
                <div>
                    <label for="name">Name</label>
                    <!-- Text input for shoe name, with the value pre-filled based on current request parameters -->
                    <input type="text" id="name" name="name" placeholder="Name" value="{{ request('name') }}">
                </div>

                <!-- Filter by Shoe Brand -->
                <div>
                    <label for="brand">Brand</label>
                    <!-- Multi-select dropdown for selecting brands, values populated from $brands array -->
                    <select id="brand" name="brand[]" multiple>
                        @foreach($brands as $brand)
                            <!-- Select the option if it matches one of the currently selected brands -->
                            <option value="{{ $brand }}" {{ in_array($brand, request('brand', [])) ? 'selected' : '' }}>{{ ucfirst($brand) }}</option>
                        @endforeach
                    </select>
                    <small>Hold Ctrl</small>
                </div>

                <!-- Filter by Shoe Type -->
                <div>
                    <label for="type">Type</label>
                    <!-- Dropdown for selecting shoe type, with options populated from $types array -->
                    <select id="type" name="type">
                        <option value="">Select Type</option>
                        @foreach($types as $type)
                            <!-- Mark the option as selected if it matches the current selection -->
                            <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter by Material -->
                <div>
                    <label for="material">Material</label>
                    <!-- Multi-select dropdown for selecting materials, values populated from $materials array -->
                    <select id="material" name="material[]" multiple>
                        @foreach($materials as $material)
                            <!-- Select the option if it matches one of the currently selected materials -->
                            <option value="{{ $material }}" {{ in_array($material, request('material', [])) ? 'selected' : '' }}>{{ ucfirst($material) }}</option>
                        @endforeach
                    </select>
                    <small>Hold Ctrl</small>
                </div>

                <!-- Filter by Price Range -->
                <div>
                    <label for="price">Price Range</label>
                    <!-- Dropdown for selecting price range, each option corresponds to a specific range -->
                    <select id="price" name="price">
                        <option value="">Price Range</option>
                        <option value="under50" {{ request('price') == 'under50' ? 'selected' : '' }}>Less than 50</option>
                        <option value="50to100" {{ request('price') == '50to100' ? 'selected' : '' }}>50 - 100</option>
                        <option value="100to250" {{ request('price') == '100to250' ? 'selected' : '' }}>100 - 250</option>
                        <option value="250to500" {{ request('price') == '250to500' ? 'selected' : '' }}>250 - 500</option>
                        <option value="500plus" {{ request('price') == '500plus' ? 'selected' : '' }}>500+</option>
                    </select>
                </div>

                <!-- Filter by Colour -->
                <div>
                    <label for="colours">Colour</label>
                    <!-- Multi-select dropdown for selecting colours, values populated from $colours array -->
                    <select id="colours" name="colours[]" multiple>
                        @foreach($colours as $colour)
                            <!-- Select the option if it matches one of the currently selected colours -->
                            <option value="{{ $colour }}" {{ in_array($colour, request('colours', [])) ? 'selected' : '' }}>{{ ucfirst($colour) }}</option>
                        @endforeach
                    </select>
                    <small>Hold Ctrl</small>
                </div>
            </div>

            <!-- Submit Button to Apply Filters -->
            <div class="button-row">
                <button type="submit" class="btn">Filter</button>
            </div>
        </div>
    </form>

    <!-- Display Results in a Table if Shoes are Found -->
    @if($shoes->count())
        <div class="table-responsive">
            <table class="table">
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shoes as $shoe)
                        <tr>
                            <!-- Display each attribute of the shoe -->
                            <td>{{ $shoe->name }}</td>
                            <td>{{ $shoe->brand }}</td>
                            <td>{{ $shoe->type }}</td>
                            <td>{{ $shoe->material }}</td>
                            <td>{{ $shoe->price }}</td>
                            <td>{{ $shoe->colour }}</td>
                            <td>{{ $shoe->stock }}</td>
                            <td>{{ $shoe->release_date }}</td>
                            <td>
                                <!-- Edit Button links to edit route -->
                                <a href="{{ route('edit', $shoe->product_code) }}" class="btn btn-warning">Edit</a>
                                <!-- Delete Button posts to delete route, with CSRF token and DELETE method -->
                                <form action="{{ route('delete', $shoe->product_code) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $shoes->links('pagination.custom') }}

    <!-- Message when No Shoes are Found -->
    @else
        <p>No shoes found.</p>
    @endif

@endsection
