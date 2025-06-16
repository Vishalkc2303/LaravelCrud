@extends('admin.layouts.app')

@section('content')
    <style>
        .container {
            border: 1px solid #ddd;
            border-radius: 5px;
            max-width: 1250px;
            padding: 20px;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .styled-table th {
            background-color: #f2f2f2;
        }

        .styled-table tr:hover {
            background-color: #f1f1f1;
        }

        .styled-table img {
            border-radius: 5px;
        }
    </style>
    <style>
        .status-pending {
            background-color: red;
            color: white;
        }

        .status-published {
            background-color: green;
            color: white;
        }

        .status-draft {
            background-color: yellow;
            color: black;
        }
    </style>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($news->isEmpty())
            <p>No news available.</p>
        @else
            <div class="table-responsive">
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($news as $item)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                        class="img-fluid" width="100">
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->category->name }}</td>
                                {{-- <td>
                                    <form action="{{ route('news.updateStatus', $item->id) }}" method="POST"
                                        class="status-form">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-control status-dropdown"
                                            data-item-id="{{ $item->id }}">
                                            <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Pending
                                            </option>
                                            <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Published
                                            </option>
                                            <option value="2" {{ $item->status == 2 ? 'selected' : '' }}>Draft</option>
                                        </select>
                                    </form>
                                </td> --}}
                                <td>
                                    <form action="{{ route('news.updateStatus', $item->id) }}" method="POST"
                                        class="status-form">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-control status-dropdown"
                                            data-item-id="{{ $item->id }}" onchange="updateDropdownColor(this)">
                                            <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Pending
                                            </option>
                                            <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Published
                                            </option>
                                            {{-- <option value="2" {{ $item->status == 2 ? 'selected' : '' }}>Draft</option> --}}
                                        </select>
                                    </form>
                                </td>

                                <td>

                                    <a href="{{ route('news.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $item->id }}">Delete</button>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">
                                                        Confirm
                                                        Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this news article?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close
                                                    </button>
                                                    <form action="{{ route('news.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
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
        @endif
    </div>
    <!-- Modal -->
    {{-- <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this news article?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div> --}}

@endsection

@section('scripts')
    <!-- DataTables CSS and JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.flash.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            // $('#example').DataTable({
            //     dom: 'Bfrtip',
            //     buttons: [
            //         'copy', 'csv', 'excel', 'pdf', 'print'
            //     ]
            // });

            // JavaScript to handle the dropdown change
            $('.status-dropdown').change(function() {
                $(this).closest('form').submit();
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Apply the initial color based on the current status
            document.querySelectorAll('.status-dropdown').forEach(function(dropdown) {
                updateDropdownColor(dropdown);
            });
        });

        function updateDropdownColor(dropdown) {
            // Remove existing status classes
            dropdown.classList.remove('status-pending', 'status-published', 'status-draft');

            // Add the new class based on the selected value
            if (dropdown.value == '0') {
                dropdown.classList.add('status-pending');
            } else if (dropdown.value == '1') {
                dropdown.classList.add('status-published');
            } else if (dropdown.value == '2') {
                dropdown.classList.add('status-draft');
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#confirmDelete').on('click', function() {
                $('#deleteForm').submit();
            });
        });
    </script>



    <script>
        new DataTable('#example', {
            layout: {
                topStart: {
                    buttons: [{
                            extend: 'createState',
                            config: {
                                creationModal: true,
                                toggle: {
                                    columns: {
                                        search: true,
                                        visible: true
                                    },
                                    length: true,
                                    order: true,
                                    paging: true,
                                    search: true
                                }
                            }
                        },
                        'savedStates'
                    ]
                }
            }
        });
    </script>
@endsection
