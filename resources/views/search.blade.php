@extends('layouts.app')

@section('content')

    @push('styles')
        @vite([
            'resources/css/filter_form_style.css',
            'resources/css/table_style.css',
            'resources/css/edit_message_style.css',
            'resources/css/action_button_1_style.css',
            'resources/css/action_button_2_style.css',
            'resources/css/search_button_style.css',
            'resources/css/result_info_style.css'
        ])
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @endpush

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <!-- Include the custom delete button JavaScript -->
        @vite([
            'resources/js/delete_button.js',
            'resources/js/filter_toggle.js',
            'resources/js/autocomplete.js',
            'resources/js/reset_after_search.js'
        ])
    @endpush

    <div class="search-header">
        <h1>Search Shoes</h1>
        <form id="filter-form" action="{{ route('search') }}" method="GET" class="filter-form">
            <div class="search-bar">
                <button type="button" id="filter-btn" class="filter-btn" aria-label="Toggle filter">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <input type="text" id="name" name="name" placeholder="Name" value="{{ request('name') }}" aria-label="Search by name">
                <button type="button" id="name-search-btn" class="search-btn" aria-label="Search">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Display Success Message if Present in Session -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>    
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Wrap filter and table together in a container -->
    <div class="search-container">
        <div class="filter-container">
            <div class="filter-options">
                <!-- Only one form for filters -->
                <form action="{{ route('search') }}" method="GET" class="filter-form">
                    <div class="card">
                        <!-- Filter Fields -->
                        <div>
                            <label for="brand">Brand</label>
                            <select id="brand" name="brand[]" multiple>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ in_array($brand->id, request('brand', [])) ? 'selected' : '' }}>
                                        {{ ucfirst($brand->name) }}
                                    </option>
                                @endforeach
                            </select>
                            <small>Hold Ctrl</small>
                        </div>

                        <div>
                            <label for="type">Type</label>
                            <select id="type" name="type">
                                <option value="">Select Type</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                                        {{ ucfirst($type->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="material">Material</label>
                            <select id="material" name="material[]" multiple>
                                @foreach($materials as $material)
                                    <option value="{{ $material->id }}" {{ in_array($material->id, request('material', [])) ? 'selected' : '' }}>
                                        {{ ucfirst($material->name) }}
                                    </option>
                                @endforeach
                            </select>
                            <small>Hold Ctrl</small>
                        </div>

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

                        <div>
                            <label for="colours">Colour</label>
                            <select id="colours" name="colours[]" multiple>
                                @foreach($colours as $colour)
                                    <option value="{{ $colour->id }}" {{ in_array($colour->id, request('colours', [])) ? 'selected' : '' }}>
                                        {{ ucfirst($colour->name) }}
                                    </option>
                                @endforeach
                            </select>
                            <small>Hold Ctrl</small>
                        </div>

                        @if(Auth::check() && Auth::user()->role === 'user')
                            <!-- Only show "Favorites" filter for normal users -->
                            <div>
                                <label for="favorites">Show Favorites</label>
                                    <input type="checkbox" name="favorites" id="favorites" value="1" {{ request('favorites') == '1' ? 'checked' : '' }}>
                            </div>
                        @endif

                        <div class="button-row">
                            <button type="submit" class="btn-primary">Apply</button>
                            <a href="{{ route('search') }}" class="btn-reset">Clear</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-container">
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
                                @if(Auth::check() && Auth::user()->role === 'admin')
                                    <th>Actions</th>
                                @endif
                                @if(Auth::check() && Auth::user()->role === 'user')
                                    <th>Favorites</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shoes as $shoe)
                                <tr>
                                    <td>{{ $shoe->name }}</td>
                                    <td>{{ $shoe->brand->name }}</td>
                                    <td>{{ $shoe->type->name }}</td>
                                    <td>
                                        @foreach($shoe->materials as $material)
                                            {{ $material->name }}@if(!$loop->last), @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $shoe->price }}</td>
                                    <td>
                                        @foreach($shoe->colours as $colour)
                                            {{ $colour->name }}@if(!$loop->last), @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $shoe->stock }}</td>
                                    <td>{{ $shoe->release_date }}</td>
                                    @if(Auth::check() && Auth::user()->role === 'admin')
                                        <td>
                                            <a href="{{ route('edit', $shoe->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('delete', $shoe->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" >Delete</button>
                                            </form>
                                        </td>
                                    @endif
                                    @if(Auth::check() && Auth::user()->role === 'user')
                                        <td>
                                            @php
                                                // Check if the shoe is already in the user's favourites
                                                $isFavourite = Auth::user()->shoes->contains($shoe->id);
                                            @endphp

                                            @if($isFavourite)
                                                <!-- Show blue button to remove from favorites -->
                                                <form action="{{ route('favorites.remove', $shoe->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-star"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <!-- Show normal button to add the shoe to favourites -->
                                                <form action="{{ route('favorites.add', $shoe->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-light">
                                                        <i class="fas fa-star"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="result-info">
                    <p>
                        <b>Displaying {{ $shoes->firstItem() }} - {{ $shoes->lastItem() }} of {{ $shoes->total() }} results</b>
                    </p>
                </div>

                <div class="pagination-container">
                    {{ $shoes->links('pagination.custom') }}
                </div>
            @else
                <p>No shoes found.</p>
            @endif
        </div>
    </div>

@endsection
