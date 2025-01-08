@push('styles')
    @vite([
        'resources/css/form_style.css',
        'resources/css/action_button_1_style.css',
        'resources/css/edit_message_style.css'
    ])
@endpush

<div class="field-background">
    <div style="max-width: 45%; margin-left: 0;">
        <!-- Shoe Name -->
        <div class="field-container">
            <label for="name" class="field-label">Name</label>
            <input type="text" class="field-input" id="name" name="name" value="{{ old('name', $shoe->name ?? '') }}" required>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Brand -->
        <div class="field-container">
            <label for="brand" class="field-label">Brand</label>
            <select class="field-input" id="brand" name="brand_id" required>
                <option value="">Select Brand</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ old('brand_id', $shoe->brand_id ?? '') == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
            @error('brand_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Type -->
        <div class="field-container">
            <label for="type" class="field-label">Type</label>
            <select class="field-input" id="type" name="type_id" required>
                <option value="">Select Type</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ old('type_id', $shoe->type_id ?? '') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
            @error('type_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Material -->
        <div class="field-container">
            <label for="material" class="field-label">Material</label>
            <select class="field-input" id="material" name="materials[]" multiple required>
                @foreach($materials as $material)
                <option value="{{ $material->id }}" 
                    {{ in_array($material->id, old('materials', isset($shoe) ? $shoe->materials->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                    {{ ucfirst($material->name) }}
                </option>

                @endforeach
            </select>
            @error('materials')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Price -->
        <div class="field-container">
            <label for="price" class="field-label">Price</label>
            <input type="number" step="0.01" class="field-input" id="price" name="price" value="{{ old('price', $shoe->price ?? '') }}" required>
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Colour -->
        <div class="field-container">
            <label for="colour" class="field-label">Colour</label>
            <select class="field-input" id="colour" name="colours[]" multiple required>
                @foreach($colours as $colour)
                <option value="{{ $colour->id }}" 
                    {{ in_array($colour->id, old('colours', isset($shoe) ? $shoe->colours->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                    {{ ucfirst($colour->name) }}
                </option>
                @endforeach
            </select>
            @error('colours')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Stock -->
        <div class="field-container">
            <label for="stock" class="field-label">Stock</label>
            <input type="number" class="field-input" id="stock" name="stock" value="{{ old('stock', $shoe->stock ?? '') }}" required>
            @error('stock')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Release Date -->
        <div class="field-container">
            <label for="release_date" class="field-label">Release Date</label>
            <input type="date" class="field-input" id="release_date" name="release_date" value="{{ old('release_date', $shoe->release_date ?? '') }}" required>
            @error('release_date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
