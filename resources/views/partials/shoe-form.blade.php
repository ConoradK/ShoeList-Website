<!-- Add CSS for this specific view -->
@push('styles')
    @vite(['resources/css/form_style.css',
    'resources/css/action_button_1_style.css',
    'resources/css/edit_message_style.css'])
@endpush

<div class="field-background">
    <!-- Container div to wrap all input fields, with a maximum width of 45% and left-aligned margin -->
    <div style="max-width: 45%; margin-left: 0;">
        
        <!-- Field for Shoe Name -->
        <div class="field-container">
            <label for="name" class="field-label">Name</label>
            <input type="text" class="field-input" id="name" name="name" value="{{ old('name', $shoe->name ?? '') }}" required>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div> <!-- Display the error for the 'name' field -->
            @enderror
        </div>

        <!-- Field for Shoe Brand -->
        <div class="field-container">
            <label for="brand" class="field-label">Brand</label>
            <select class="field-input" id="brand" name="brand" required>
                <option value="">Select Brand</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand }}" {{ old('brand', $shoe->brand ?? '') == $brand ? 'selected' : '' }}>
                        {{ $brand }}
                    </option>
                @endforeach
            </select>
            @error('brand')
                <div class="alert alert-danger">{{ $message }}</div> <!-- Display the error for the 'brand' field -->
            @enderror
        </div>

        <!-- Field for Shoe Type -->
        <div class="field-container">
            <label for="type" class="field-label">Type</label>
            <select class="field-input" id="type" name="type" required>
                <option value="">Select Type</option>
                @foreach($types as $type)
                    <option value="{{ $type }}" {{ old('type', $shoe->type ?? '') == $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>
            @error('type')
                <div class="alert alert-danger">{{ $message }}</div> <!-- Display the error for the 'type' field -->
            @enderror
        </div>

        <!-- Field for Material -->
        <div class="field-container">
            <label for="material" class="field-label">Material</label>
            <select class="field-input" id="material" name="material" required>
                <option value="">Select Material</option>
                @foreach($materials as $material)
                    <option value="{{ $material }}" {{ old('material', $shoe->material ?? '') == $material ? 'selected' : '' }}>
                        {{ $material }}
                    </option>
                @endforeach
            </select>
            @error('material')
                <div class="alert alert-danger">{{ $message }}</div> <!-- Display the error for the 'material' field -->
            @enderror
        </div>

        <!-- Field for Price -->
        <div class="field-container">
            <label for="price" class="field-label">Price</label>
            <input type="number" step="0.01" class="field-input" id="price" name="price" value="{{ old('price', $shoe->price ?? '') }}" required>
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div> <!-- Display the error for the 'price' field -->
            @enderror
        </div>

        <!-- Field for Colour -->
        <div class="field-container">
            <label for="colour" class="field-label">Colour</label>
            <select class="field-input" id="colour" name="colour" required>
                <option value="">Select Colour</option>
                @foreach($colours as $colour)
                    <option value="{{ $colour }}" {{ old('colour', $shoe->colour ?? '') == $colour ? 'selected' : '' }}>
                        {{ ucfirst($colour) }}
                    </option>
                @endforeach
            </select>
            @error('colour')
                <div class="alert alert-danger">{{ $message }}</div> <!-- Display the error for the 'colour' field -->
            @enderror
        </div>

        <!-- Field for Stock Quantity -->
        <div class="field-container">
            <label for="stock" class="field-label">Stock</label>
            <input type="number" class="field-input" id="stock" name="stock" value="{{ old('stock', $shoe->stock ?? '') }}" required>
            @error('stock')
                <div class="alert alert-danger">{{ $message }}</div> <!-- Display the error for the 'stock' field -->
            @enderror
        </div>

        <!-- Field for Release Date -->
        <div class="field-container">
            <label for="release_date" class="field-label">Release Date</label>
            <input type="date" class="field-input" id="release_date" name="release_date" value="{{ old('release_date', $shoe->release_date ?? '') }}" required>
            @error('release_date')
                <div class="alert alert-danger">{{ $message }}</div> <!-- Display the error for the 'release_date' field -->
            @enderror
        </div>
    </div>
</div>
