<!-- resources/views/partials/shoe-form.blade.php -->
<div style="max-width: 45%; margin-left: 0;">
    <!-- Input field for the shoe name -->
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $shoe->name ?? '') }}" required>
    </div>

    <!-- Dropdown for selecting the brand of the shoe -->
    <div class="mb-3">
        <label for="brand" class="form-label">Brand</label>
        <select class="form-control" id="brand" name="brand" required>
            <option value="">Select Brand</option>
            <!-- Loop through all available brands and populate the options -->
            @foreach($brands as $brand)
                <option value="{{ $brand }}" {{ old('brand', $shoe->brand ?? '') == $brand ? 'selected' : '' }}>
                    {{ $brand }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Dropdown for selecting the type of shoe -->
    <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <select class="form-control" id="type" name="type" required>
            <option value="">Select Type</option>
            <!-- Loop through all available types and populate the options -->
            @foreach($types as $type)
                <option value="{{ $type }}" {{ old('type', $shoe->type ?? '') == $type ? 'selected' : '' }}>
                    {{ $type }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Dropdown for selecting the material of the shoe -->
    <div class="mb-3">
        <label for="material" class="form-label">Material</label>
        <select class="form-control" id="material" name="material" required>
            <option value="">Select Material</option>
            <!-- Loop through all available materials and populate the options -->
            @foreach($materials as $material)
                <option value="{{ $material }}" {{ old('material', $shoe->material ?? '') == $material ? 'selected' : '' }}>
                    {{ $material }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Input field for the shoe price -->
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $shoe->price ?? '') }}" required>
    </div>

    <!-- Dropdown for selecting the colour of the shoe -->
    <div class="mb-3">
        <label for="colour" class="form-label">Colour</label>
        <select class="form-control" id="colour" name="colour" required>
            <option value="">Select Colour</option>
            <!-- Loop through all available colours and populate the options -->
            @foreach($colours as $colour)
                <option value="{{ $colour }}" {{ old('colour', $shoe->colour ?? '') == $colour ? 'selected' : '' }}>
                    {{ ucfirst($colour) }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Input field for the shoe stock quantity -->
    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $shoe->stock ?? '') }}" required>
    </div>

    <!-- Input field for the release date of the shoe -->
    <div class="mb-3">
        <label for="release_date" class="form-label">Release Date</label>
        <input type="date" class="form-control" id="release_date" name="release_date" value="{{ old('release_date', $shoe->release_date ?? '') }}" required>
    </div>
</div>
