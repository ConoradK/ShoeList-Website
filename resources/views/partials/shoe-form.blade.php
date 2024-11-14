<!-- Container div to wrap all input fields, with a maximum width of 45% and left-aligned margin -->
<div style="max-width: 45%; margin-left: 0;">
    
    <!-- Field for Shoe Name -->
    <div class="field-container">
        <label for="name" class="field-label">Name</label>
        <!-- Text input for shoe name, with value pre-filled based on old input or existing shoe data -->
        <input type="text" class="field-input" id="name" name="name" value="{{ old('name', $shoe->name ?? '') }}" required>
    </div>

    <!-- Field for Shoe Brand -->
    <div class="field-container">
        <label for="brand" class="field-label">Brand</label>
        <!-- Dropdown for brand selection, with options populated from $brands array -->
        <select class="field-input" id="brand" name="brand" required>
            <option value="">Select Brand</option>
            @foreach($brands as $brand)
                <!-- Mark the option as selected if it matches the old or existing brand -->
                <option value="{{ $brand }}" {{ old('brand', $shoe->brand ?? '') == $brand ? 'selected' : '' }}>
                    {{ $brand }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Field for Shoe Type -->
    <div class="field-container">
        <label for="type" class="field-label">Type</label>
        <!-- Dropdown for type selection, with options populated from $types array -->
        <select class="field-input" id="type" name="type" required>
            <option value="">Select Type</option>
            @foreach($types as $type)
                <!-- Mark the option as selected if it matches the old or existing type -->
                <option value="{{ $type }}" {{ old('type', $shoe->type ?? '') == $type ? 'selected' : '' }}>
                    {{ $type }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Field for Material -->
    <div class="field-container">
        <label for="material" class="field-label">Material</label>
        <!-- Dropdown for material selection, with options populated from $materials array -->
        <select class="field-input" id="material" name="material" required>
            <option value="">Select Material</option>
            @foreach($materials as $material)
                <!-- Mark the option as selected if it matches the old or existing material -->
                <option value="{{ $material }}" {{ old('material', $shoe->material ?? '') == $material ? 'selected' : '' }}>
                    {{ $material }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Field for Price -->
    <div class="field-container">
        <label for="price" class="field-label">Price</label>
        <!-- Number input for price, allowing decimal values and pre-filled with old or existing price data -->
        <input type="number" step="0.01" class="field-input" id="price" name="price" value="{{ old('price', $shoe->price ?? '') }}" required>
    </div>

    <!-- Field for Colour -->
    <div class="field-container">
        <label for="colour" class="field-label">Colour</label>
        <!-- Dropdown for colour selection, with options populated from $colours array -->
        <select class="field-input" id="colour" name="colour" required>
            <option value="">Select Colour</option>
            @foreach($colours as $colour)
                <!-- Mark the option as selected if it matches the old or existing colour, capitalise colour name -->
                <option value="{{ $colour }}" {{ old('colour', $shoe->colour ?? '') == $colour ? 'selected' : '' }}>
                    {{ ucfirst($colour) }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Field for Stock Quantity -->
    <div class="field-container">
        <label for="stock" class="field-label">Stock</label>
        <!-- Number input for stock quantity, pre-filled with old or existing stock data -->
        <input type="number" class="field-input" id="stock" name="stock" value="{{ old('stock', $shoe->stock ?? '') }}" required>
    </div>

    <!-- Field for Release Date -->
    <div class="field-container">
        <label for="release_date" class="field-label">Release Date</label>
        <!-- Date input for release date, pre-filled with old or existing release date data -->
        <input type="date" class="field-input" id="release_date" name="release_date" value="{{ old('release_date', $shoe->release_date ?? '') }}" required>
    </div>
</div>
