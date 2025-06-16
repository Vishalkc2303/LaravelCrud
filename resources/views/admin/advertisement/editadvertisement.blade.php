@extends('admin.layouts.app')
@section('page_name', 'Edit Advertisement')
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
    <div class="app-content content">
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
                </div>
                <!-- Basic Vertical form layout section start -->
                <section id="basic-vertical-layouts">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="card my-4 mx-4">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Advertisement</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('updateAd', $ad->id) }}" enctype="multipart/form-data"
                                        id="form1" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-1">
                                                    <label class="form-label" for="name">Advertisement Name</label>
                                                    <div class="input-group">
                                                        <input type="text" id="name" class="form-control"
                                                            placeholder="Ad Name" name="name"
                                                            value="{{ old('name', $ad->name) }}" />
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
                                                            <option value="1"
                                                                {{ old('type', $ad->type) == 1 ? 'selected' : '' }}>Banner
                                                            </option>
                                                            <option value="2"
                                                                {{ old('type', $ad->type) == 2 ? 'selected' : '' }}>Iframe
                                                            </option>
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
                                                style="{{ old('type', $ad->type) == 2 ? 'display: none;' : '' }}">
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
                                                style="{{ old('type', $ad->type) == 2 ? 'display: none;' : '' }}">
                                                <div class="mb-1">
                                                    <label class="form-label" for="links">Links</label>
                                                    <div class="input-group">
                                                        <input type="text" id="links" class="form-control"
                                                            placeholder="Add Links" name="links"
                                                            value="{{ old('links', $ad->links) }}" />
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
                                                style="{{ old('type', $ad->type) == 2 ? '' : 'display: none;' }}">
                                                <div class="mb-1">
                                                    <label class="form-label" for="script">Script</label>
                                                    <div class="input-group">
                                                        <input type="text" id="script" class="form-control"
                                                            placeholder="Add Script" name="script"
                                                            value="{{ old('script', $ad->script) }}" />
                                                    </div>
                                                    @if ($errors->has('script'))
                                                        <p class="invalid-feedback text-danger"
                                                            style="display:block!important;" role="alert">
                                                            <strong>{{ $errors->first('script') }}</strong>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="mb-1">
                                                    <label class="form-label" for="position">Position</label>
                                                    <div class="input-group">
                                                        <select class="country form-control" name="position">
                                                            @foreach ($positions as $id => $name)
                                                                <option value="{{ $id }}"
                                                                    {{ old('position', $ad->position) == $id ? 'selected' : '' }}>
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
                                                                {{ old('status', $ad->status) == 0 ? 'selected' : '' }}>
                                                                Draft</option>
                                                            <option value="1"
                                                                {{ old('status', $ad->status) == 1 ? 'selected' : '' }}>
                                                                Published</option>
                                                            <option value="2"
                                                                {{ old('status', $ad->status) == 2 ? 'selected' : '' }}>
                                                                Pending</option>
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
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary mr-1 waves-effect waves-float waves-light">Update</button>
                                                {{-- <a href="{{ route('admin.advertisement.addadvertisement', $ad->id) }}" class="btn btn-outline-secondary waves-effect">Cancel</a> --}}
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic Vertical form layout section end -->
            </div>
        </div>
    </div>
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
@endsection
