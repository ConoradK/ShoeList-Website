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

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>    
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="search-container">
        @include('partials.filter_form') <!-- Include the filter form -->
        @include('partials.shoe_table')  <!-- Include the shoe table -->
    </div>

@endsection
