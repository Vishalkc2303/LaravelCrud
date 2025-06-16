@extends('admin.layouts.app')
@section('page_name', 'ad-space')
@section('content')
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
    <div class="app-content content ">

        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="flash-message">
                    @if (session('status'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <!-- Basic Vertical form layout section start -->
                <section id="basic-vertical-layouts"> 
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="card my-4 mx-4">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="card-title">Advertisement Space</h4>
                                    <a href="{{ route('allPosition') }}" class="btn btn-sm btn-primary ml-auto">
                                        See all Position
                                    </a>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('admin/add-ad-space') }}" enctype="multipart/form-data"
                                        id="form1" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-1">
                                                    <label class="form-label" for="name">Add Name</label>
                                                    <div class="input-group">
                                                        <input type="text" id="name" class="form-control"
                                                            placeholder="Add Name" name="name"
                                                            value="{{ old('name') }}" />
                                                    </div>
                                                    @if ($errors->has('name'))
                                                        <p class="invalid-feedback text-danger"
                                                            style="display:block!important;" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-1">
                                                    <label class="form-label" for="typeSelect">Select Type</label>
                                                    <div class="input-group">
                                                        <select id="typeSelect" class="country form-control" name="type">
                                                            <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>
                                                                Banner</option>
                                                            <option value="2" {{ old('type') == 2 ? 'selected' : '' }}>
                                                                Iframe</option>
                                                        </select>
                                                    </div>
                                                    @if ($errors->has('type'))
                                                        <p class="invalid-feedback text-danger"
                                                            style="display:block!important;" role="alert">
                                                            <strong>{{ $errors->first('type') }}</strong>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div id="bannerImageDiv" class="col-4"
                                                style="{{ old('type') == 2 ? 'display: none;' : '' }}">
                                                <div class="mb-1">
                                                    <label class="form-label" for="image">Banner Image</label>
                                                    <div class="input-group">
                                                        <input type="file" id="image" class="form-control"
                                                            placeholder="Select Banner Image" name="image" />
                                                    </div>
                                                    @if ($errors->has('image'))
                                                        <p class="invalid-feedback text-danger"
                                                            style="display:block!important;" role="alert">
                                                            <strong>{{ $errors->first('image') }}</strong>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div id="linksDiv" class="col-4"
                                                style="{{ old('type') == 2 ? 'display: none;' : '' }}">
                                                <div class="mb-1">
                                                    <label class="form-label" for="links">Links</label>
                                                    <div class="input-group">
                                                        <input type="text" id="links" class="form-control"
                                                            placeholder="Add Links" name="links"
                                                            value="{{ old('links') }}" />
                                                    </div>
                                                    @if ($errors->has('links'))
                                                        <p class="invalid-feedback text-danger"
                                                            style="display:block!important;" role="alert">
                                                            <strong>{{ $errors->first('links') }}</strong>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div id="scriptDiv" class="col-4"
                                                style="{{ old('type') == 2 ? '' : 'display: none;' }}">
                                                <div class="mb-1">
                                                    <label class="form-label" for="script">Script</label>
                                                    <div class="input-group">
                                                        <input type="text" id="script" class="form-control"
                                                            placeholder="Add Script" name="script"
                                                            value="{{ old('script') }}" />
                                                    </div>
                                                    @if ($errors->has('script'))
                                                        <p class="invalid-feedback text-danger"
                                                            style="display:block!important;" role="alert">
                                                            <strong>{{ $errors->first('script') }}</strong>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                            @php
                                                $positions = App\Models\adPosition::pluck('name', 'id');
                                            @endphp
                                            <div class="col-4">
                                                <div class="mb-1">
                                                    <label class="form-label" for="position">Add Position</label>
                                                    <div class="input-group">
                                                        <select class="country form-control" name="position">
                                                            @foreach ($positions as $id => $name)
                                                                <option value="{{ $id }}"
                                                                    {{ old('position') == $id ? 'selected' : '' }}>
                                                                    {{ $name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @if ($errors->has('position'))
                                                        <p class="invalid-feedback text-danger"
                                                            style="display:block!important;" role="alert">
                                                            <strong>{{ $errors->first('position') }}</strong>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="mb-1">
                                                    <label class="form-label" for="status">Status</label>
                                                    <div class="input-group">
                                                        <select class="country form-control" name="status">
                                                            <option value="0"
                                                                {{ old('status') == 0 ? 'selected' : '' }}>Default status
                                                                is Pending
                                                            </option>
                                                            {{-- <option value="1"
                                                                {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                                            <option value="2"
                                                                {{ old('status') == 2 ? 'selected' : '' }}>Paused</option> --}}
                                                        </select>
                                                    </div>
                                                    @if ($errors->has('status'))
                                                        <p class="invalid-feedback text-danger"
                                                            style="display:block!important;" role="alert">
                                                            <strong>{{ $errors->first('status') }}</strong>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-3 mt-2">
                                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                            </div>
                                            <div class="col-5 mt-2">
                                                <h4 class="text-black mb-1 mt-lg-0">Note:- </h4>
                                                <ul class="list-unstyled">
                                                    <li class="">1. Header banner size should be 728x90.</li>
                                                    <li class="">2. Sidebar top and sidebar bottom image size should
                                                        be 300x300.</li>
                                                    <li class="">3. Detail bottom image size should be 900x150.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Vertical form layout section end -->
            </div>
        </div>

        @php
            $recentAds = App\Models\Advertisement::orderBy('created_at', 'desc')->get();
        @endphp
        <div class="row match-height">
            <div class="col-sm-12 col-md-12 justify-content-center">
                <div class="card mx-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S. No.</th>
                                        <th>Name</th>
                                        <th>Ad</th>
                                        <th>Ads Type</th>
                                        <th>Ads Position</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($recentAds) > 0)
                                        @php $serialNumber = 1; @endphp
                                        @foreach ($recentAds as $ad)
                                            <tr>
                                                <td>{{ $serialNumber }}</td>
                                                <td>{{ $ad->name }}</td>
                                                <td>
                                                    @if ($ad->type == 1)
                                                        <img src="{{ asset('Images/ads/' . $ad->image) }}" height="50px"
                                                            width="120px" alt="advertisement">
                                                    @else
                                                        No Image <br> for Script type
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($ad->type == 1)
                                                        Banner
                                                    @elseif ($ad->type == 2)
                                                        Script
                                                    @else
                                                        Unknown Type
                                                    @endif
                                                </td>
                                                <td>{{ $ad->addposition->name }}</td>
                                                {{-- <td>
                                                    @if ($ad->status == 0)
                                                        Pending Approval
                                                    @elseif ($ad->status == 1)
                                                        Active
                                                    @elseif ($ad->status == 2)
                                                        Paused
                                                    @else
                                                        Unknown Status
                                                    @endif
                                                </td> --}}
                                                <td>
                                                    <form action="{{ route('updateAdStatus', $ad->id) }}" method="POST"
                                                        class="status-form">
                                                        @csrf
                                                        @method('PATCH')
                                                        <select name="status" class="form-control status-dropdown"
                                                            data-item-id="{{ $ad->id }}"
                                                            onchange="updateDropdownColor(this)">
                                                            <option value="0"
                                                                {{ $ad->status == 0 ? 'selected' : '' }}>Pending
                                                            </option>
                                                            <option value="1"
                                                                {{ $ad->status == 1 ? 'selected' : '' }}>Active
                                                            </option>
                                                            <option value="2"
                                                                {{ $ad->status == 2 ? 'selected' : '' }}>Paused</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.editAd', $ad->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        Edit
                                                    </a>
                                                </td>

                                                <td>{{ $ad->created_at }}</td>
                                            </tr>
                                            @php $serialNumber++; @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">No ads found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Content-->
        <script src="{{ asset('js/image-encoded.js') }}"></script>
        <script src="{{ url('https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js') }}"></script>
        <script src="{{ url('https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js') }}"></script>
        <script src="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('https://code.jquery.com/jquery-1.12.4.min.js') }}"></script>
        <script>
            document.getElementById('typeSelect').addEventListener('change', function() {
                var selectedType = this.value;
                if (selectedType === '2') {
                    document.getElementById('bannerImageDiv').style.display = 'none';
                    document.getElementById('linksDiv').style.display = 'none';
                    document.getElementById('scriptDiv').style.display = 'block';
                } else {
                    document.getElementById('bannerImageDiv').style.display = 'block';
                    document.getElementById('linksDiv').style.display = 'block';
                    document.getElementById('scriptDiv').style.display = 'none';
                }
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
        {{-- <script>
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
        </script> --}}

    @endsection
