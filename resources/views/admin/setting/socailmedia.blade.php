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
                    <h2>Social Media Links</h2>
                    <form action="{{ route('admin.social-media.update') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="url" class="form-control" id="facebook" name="facebook"
                                value="{{ old('facebook', $socialMedia->facebook ?? '') }}">
                            @error('facebook')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="twitter" class="form-label">Twitter</label>
                            <input type="url" class="form-control" id="twitter" name="twitter"
                                value="{{ old('twitter', $socialMedia->twitter ?? '') }}">
                            @error('twitter')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="url" class="form-control" id="instagram" name="instagram"
                                value="{{ old('instagram', $socialMedia->instagram ?? '') }}">
                            @error('instagram')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="linkedin" class="form-label">LinkedIn</label>
                            <input type="url" class="form-control" id="linkedin" name="linkedin"
                                value="{{ old('linkedin', $socialMedia->linkedin ?? '') }}">
                            @error('linkedin')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save Links</button>
                    </form>
                </div>
            </div>
        {{-- @endif --}}
        </div>
@endsection
