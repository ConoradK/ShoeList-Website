@extends('layouts.app')

@section('content')

    <!-- Add CSS for this specific view -->
    @push('styles')
        @vite([
            'resources/css/filter_form_style.css',
            'resources/css/table_style.css',
            'resources/css/edit_message_style.css',
            'resources/css/action_button_1_style.css',
            'resources/css/action_button_2_style.css'
        ])
    @endpush

    @push('scripts')
        <!-- jQuery (required for the autocomplete) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- jQuery UI for autocomplete functionality -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <!-- Include the autocomplete.js script -->
        @vite(['resources/js/autocomplete.js'])
    @endpush

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
                <input type="text" id="name" name="name" placeholder="Name" value="{{ request('name') }}">
            </div>

            <!-- Filter by Shoe Brand -->
            <div>
                <label for="brand">Brand</label>
                <select id="brand" name="brand[]" multiple>
                    @foreach($brands as $brand)
                        <option value="{{ $brand }}" {{ in_array($brand, request('brand', [])) ? 'selected' : '' }}>{{ ucfirst($brand) }}</option>
                    @endforeach
                </select>
                <small>Hold Ctrl</small>
            </div>

            <!-- Filter by Shoe Type -->
            <div>
                <label for="type">Type</label>
                <select id="type" name="type">
                    <option value="">Select Type</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter by Material -->
            <div>
                <label for="material">Material</label>
                <select id="material" name="material[]" multiple>
                    @foreach($materials as $material)
                        <option value="{{ $material }}" {{ in_array($material, request('material', [])) ? 'selected' : '' }}>{{ ucfirst($material) }}</option>
                    @endforeach
                </select>
                <small>Hold Ctrl</small>
            </div>

            <!-- Filter by Price Range -->
            <div>
                <label for="price">Price Range</label>
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
                <select id="colours" name="colours[]" multiple>
                    @foreach($colours as $colour)
                        <option value="{{ $colour }}" {{ in_array($colour, request('colours', [])) ? 'selected' : '' }}>{{ ucfirst($colour) }}</option>
                    @endforeach
                </select>
                <small>Hold Ctrl</small>
            </div>

            <!-- Submit Button to Apply Filters -->
            <div class="button-row">
                <button type="submit" class="btn-primary">Filter</button>
                <a href="{{ route('search') }}" class="btn-reset">Reset Filters</a>
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
                            <td>{{ $shoe->name }}</td>
                            <td>{{ $shoe->brand }}</td>
                            <td>{{ $shoe->type }}</td>
                            <td>{{ $shoe->material }}</td>
                            <td>{{ $shoe->price }}</td>
                            <td>{{ $shoe->colour }}</td>
                            <td>{{ $shoe->stock }}</td>
                            <td>{{ $shoe->release_date }}</td>
                            <td>
                                <a href="{{ route('edit', $shoe->product_code) }}" class="btn btn-warning">Edit</a>
                                
                                <!-- Delete Form -->
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

        <p style="text-align: center; background-color: #ffd1d1; width: 60%; margin: 0 auto; padding: 10px; border: 1px solid #ddd;">
            <b>Displaying {{ $shoes->firstItem() }} - {{ $shoes->lastItem() }} of {{ $shoes->total() }} results</b>
        </p>

        <div class="pagination-container">
            {{ $shoes->links('pagination.custom') }}
        </div>

    @else
        <p>No shoes found.</p>
    @endif

@endsection
