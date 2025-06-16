@extends('admin.layouts.app')

@section('content')
    <main style="margin-left: 50px;">
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-5">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="mt-4">Add Category</h1>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('category.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category Name</label>
                                    <input type="text" class="form-control @error('category') is-invalid @enderror"
                                        id="category" name="category" required value="{{ old('category') }}">
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="mt-4">Add Subcategory</h1>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('subcategory.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="existing_category" class="form-label">Existing Category</label>
                                    <select class="form-select @error('existing_category') is-invalid @enderror"
                                        id="existing_category" name="existing_category" required>
                                        <option value="">Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('existing_category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="subcategory" class="form-label">Subcategory Name</label>
                                    <input type="text" class="form-control @error('subcategory') is-invalid @enderror"
                                        id="subcategory" name="subcategory" required value="{{ old('subcategory') }}">
                                    @error('subcategory')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-5 mt-5" id="table-striped">
                    {{-- <div class="col-5"> --}}
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Categories List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Category</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    @php $i = 1; @endphp
                                    <tbody>
                                        @foreach ($categories as $item)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $item->id }}">Edit</button>

                                                    <!-- Edit Modal -->
                                                    <div class="modal fade" id="editModal{{ $item->id }}"
                                                        tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="editModalLabel{{ $item->id }}">
                                                                        Edit Category
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('categories.update', $item->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="mb-3">
                                                                            <label for="categoryName{{ $item->id }}"
                                                                                class="form-label">Category Name</label>
                                                                            <input type="text" class="form-control"
                                                                                id="categoryName{{ $item->id }}"
                                                                                name="category_name"
                                                                                value="{{ $item->name }}">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Save
                                                                                changes</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- </div> --}}
                </div>
                <div class="col-6 mt-5" id="table-striped">
                    {{-- <div class="col-5"> --}}
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Categories List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    @php $i = 1; @endphp
                                    <tbody>
                                        @foreach ($subcategories as $item)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $item->category->name }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $item->id }}">Delete</button>

                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="deleteModal{{ $item->id }}"
                                                        tabindex="-1"
                                                        aria-labelledby="deleteModalLabel{{ $item->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="deleteModalLabel{{ $item->id }}">
                                                                        Confirm Delete
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete this category?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <form action="" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#subeditModal{{ $item->id }}">Edit</button>

                                                    <!-- Edit Modal -->
                                                    <div class="modal fade" id="subeditModal{{ $item->id }}"
                                                        tabindex="-1"
                                                        aria-labelledby="editModalLabel{{ $item->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="editModalLabel{{ $item->id }}">
                                                                        Edit Subcategory
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('subcategories.update', $item->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="mb-3">
                                                                            <label for="categorySelect{{ $item->id }}"
                                                                                class="form-label">Category</label>
                                                                            <select class="form-control"
                                                                                id="categorySelect{{ $item->id }}"
                                                                                name="category_id">
                                                                                @foreach ($categories as $category)
                                                                                    <option value="{{ $category->id }}"
                                                                                        {{ $category->id == $item->category_id ? 'selected' : '' }}>
                                                                                        {{ $category->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label
                                                                                for="subcategoryName{{ $item->id }}"
                                                                                class="form-label">Subcategory Name</label>
                                                                            <input type="text" class="form-control"
                                                                                id="subcategoryName{{ $item->id }}"
                                                                                name="subcategory_name"
                                                                                value="{{ $item->name }}">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Save
                                                                                changes</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </main>
@endsection
