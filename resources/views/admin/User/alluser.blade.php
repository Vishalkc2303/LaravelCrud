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

        /* .styled-table th,
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
                                                    } */
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
        @if ($Users->isEmpty())
            <p>No Users available.</p>
        @else
            <div class="table-responsive">
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Username</th>
                            
                            <th>Role</th>
                            <th>Status</th>
                            {{-- <th>Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($Users as $item)
                            <tr>

                                <td>{{ $i++ }}</td>
                                <td>
                                    @if ($item->userDetail && $item->userDetail->profile)
                                        <img src="{{ asset('storage/' . $item->userDetail->profile) }}"
                                            alt="{{ $item->name }}" width="50" height="50">
                                    @else
                                        <img src="{{ asset('default-profile-image.png') }}" alt="Image" width="50"
                                            height="50">
                                    @endif

                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->username }}</td>
                                @if (auth()->user()->role === 'admin')
                                    <td>
                                        <form action="{{ route('User.updateRoleStatus', $item->id) }}" method="POST"
                                            class="status-form">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="form-control role-dropdown"
                                                data-item-id="{{ $item->id }}" onchange="updateDropdownColor(this)">
                                                <option value="admin" {{ $item->role === 'admin' ? 'selected' : '' }}>Admin
                                                </option>
                                                <option value="editor" {{ $item->role === 'editor' ? 'selected' : '' }}>
                                                    Editor</option>
                                                <option value="user" {{ $item->role === 'user' ? 'selected' : '' }}>User
                                                </option>
                                            </select>
                                        </form>
                                    </td>
                                @else
                                    <td>{{ $item->role }}</td>
                                @endif

                                <td>
                                    <form action="{{ route('User.updateUserStatus', $item->id) }}" method="POST"
                                        class="status-form">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-control status-dropdown"
                                            data-item-id="{{ $item->id }}" onchange="updateDropdownColor(this)">
                                            <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Inactive
                                            </option>
                                            <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            {{-- <option value="2" {{ $item->status == 2 ? 'selected' : '' }}>Draft</option> --}}
                                        </select>
                                    </form>
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        @endif
    </div>
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
            $('.role-dropdown').change(function() {
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
