@extends('admin.layouts.app')

@section('content')
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-md-10">
            <div class="card ml-5 mx-5">
                <div class="col-md-10 mx-auto my-4">
                    <h2>Website Settings</h2>
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="website_name" class="form-label">Website Name</label>
                            <input type="text" class="form-control" id="website_name" name="website_name"
                                value="{{ old('website_name', $settings->website_name ?? '') }}" required>
                            @error('website_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="website_logo" class="form-label">Website Logo</label>
                            <input type="file" class="form-control" id="website_logo" name="website_logo"
                                accept="image/*">
                            @if (isset($settings->logo))
                                <img src="{{ Storage::url($settings->logo) }}" alt="Website Logo" width="100">
                            @endif
                            @error('website_logo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="website_favicon" class="form-label">Website Favicon</label>
                            <input type="file" class="form-control" id="website_favicon" name="website_favicon"
                                accept="image/*">
                            @if (isset($settings->favicon))
                                <img src="{{ Storage::url($settings->favicon) }}" alt="Website Favicon" width="32">
                            @endif
                            @error('website_favicon')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email', $settings->email ?? '') }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone_no" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_no" name="phone_no"
                                value="{{ old('phone_no', $settings->phone_no ?? '') }}" required>
                            @error('phone_no')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location"
                                value="{{ old('location', $settings->location ?? '') }}" required>
                            @error('location')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="terms_year" class="form-label">Year of Terms and Conditions</label>
                            <input type="number" class="form-control" id="terms_year" name="terms_year"
                                value="{{ old('terms_year', $settings->year ?? '') }}" required>
                            @error('terms_year')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
