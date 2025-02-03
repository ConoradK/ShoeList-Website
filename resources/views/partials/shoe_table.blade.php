<!-- resources/views/partials/shoe_table.blade.php -->

<!-- Check if there are any shoes to display -->
@if($shoes->count())

    <!-- Table to display shoe information -->
    <div class="table-responsive"> <!-- Makes the table responsive for different screen sizes -->
        <table class="table">
            <thead>
                <tr>
                    <!-- Table headers for each column -->
                    <th>Name</th> <!-- Shoe Name -->
                    <th>Brand</th> <!-- Shoe Brand -->
                    <th>Type</th> <!-- Shoe Type -->
                    <th>Material</th> <!-- Materials of the shoe -->
                    <th>Price</th> <!-- Price of the shoe -->
                    <th>Colour</th> <!-- Colour options for the shoe -->
                    <th>Stock</th> <!-- Available stock of the shoe -->
                    <th>Release Date</th> <!-- Release date of the shoe -->

                    <!-- Display "Actions" column for admins -->
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <th>Actions</th> <!-- Admin actions like edit and delete -->
                    @endif

                    <!-- Display "Favorites" column for regular users -->
                    @if(Auth::check() && Auth::user()->role === 'user')
                        <th>Favorites</th> <!-- Option for users to mark shoes as favorites -->
                    @endif
                </tr>
            </thead>
            <tbody>
                <!-- Loop through each shoe item and display it in a table row -->
                @foreach($shoes as $shoe)
                    <tr>
                        <td>{{ $shoe->name }}</td> <!-- Display the shoe name -->
                        <td>{{ $shoe->brand->name }}</td> <!-- Display the brand name (from the related brand model) -->
                        <td>{{ $shoe->type->name }}</td> <!-- Display the type name (from the related type model) -->
                        
                        <!-- Display the materials for the shoe, separated by commas -->
                        <td>
                            @foreach($shoe->materials as $material)
                                {{ $material->name }}@if(!$loop->last), @endif <!-- If not the last material, add a comma -->
                            @endforeach
                        </td>

                        <td>£{{ $shoe->price }}</td> <!-- Display the shoe price -->
                        
                        <!-- Display the colours for the shoe, separated by commas -->
                        <td>
                            @foreach($shoe->colours as $colour)
                                {{ $colour->name }}@if(!$loop->last), @endif <!-- If not the last colour, add a comma -->
                            @endforeach
                        </td>

                        <td>{{ $shoe->stock }}</td> <!-- Display the available stock -->
                        <td>{{ $shoe->release_date }}</td> <!-- Display the release date of the shoe -->

                        <!-- Admin actions: Edit and Delete buttons -->
                        @if(Auth::check() && Auth::user()->role === 'admin')
                            <td>
                                <!-- Edit button that links to the edit page for the shoe -->
                                <a href="{{ route('edit', $shoe->id) }}" class="btn btn-warning">Edit</a>
                                
                                <!-- Form to delete the shoe -->
                                <form action="{{ route('delete', $shoe->id) }}" method="POST" style="display:inline-block;">
                                    @csrf <!-- CSRF token for security -->
                                    @method('DELETE') <!-- HTTP DELETE method -->
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        @endif

                        <!-- User actions: Add or remove from favorites -->
                        @if(Auth::check() && Auth::user()->role === 'user')
                            <td>
                                <!-- Check if the shoe is already in the user's favorites -->
                                @php
                                    $isFavourite = Auth::user()->shoes->contains($shoe->id);
                                @endphp

                                <!-- If the shoe is in the user's favorites, show the remove button -->
                                @if($isFavourite)
                                    <form action="{{ route('favorites.remove', $shoe->id) }}" method="POST">
                                        @csrf <!-- CSRF token for security -->
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-star"></i> <!-- Icon for a filled star (favorite) -->
                                        </button>
                                    </form>
                                <!-- If the shoe is not in the user's favorites, show the add button -->
                                @else
                                    <form action="{{ route('favorites.add', $shoe->id) }}" method="POST">
                                        @csrf <!-- CSRF token for security -->
                                        <button type="submit" class="btn btn-light">
                                            <i class="fas fa-star"></i> <!-- Icon for an empty star (add to favorite) -->
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

    <!-- Result Information: Display the range of displayed results and the total number of results -->
    <div class="result-info">
        <p><b>Displaying {{ $shoes->firstItem() }} - {{ $shoes->lastItem() }} of {{ $shoes->total() }} results</b></p>
    </div>

    <!-- Pagination: Display pagination links for the shoes -->
    <div class="pagination-container">
        {{ $shoes->links('pagination.custom') }} <!-- Custom pagination style -->
    </div>

<!-- If no shoes are found, display a message -->
@else
    <p>No shoes found.</p>
@endif
