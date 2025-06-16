@include('layouts.secondnav')

<div class="py-10"></div>

<div class="breadcrumb-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>My Account</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="py-5">
    <div class="container">
        {{-- @if (session('success'))
            <div class="alert alert-success" role="alert" id="success-alert">
                {{ session('success') }}
            </div>
        @endif --}}
        <div class="row">
            <div class="col-md-3 col-sm-12 col-lg-3 accounts">
                @include('user.sidebar')
            </div>
            <div class="col-md-9 col-sm-12 col-lg-9 py-2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-6 col-xs-12 profile-badge">
                            <form action="{{ route('userdetailUpdate') }}" method="POST" enctype="multipart/form-data">
                                <!-- Add enctype for file upload -->
                                @csrf

                                <div class="profile-pic">
                                    @if(Auth::user()->userDetail && Auth::user()->userDetail->profile)
                                        <img alt="User Pic" src="{{ asset('storage/' . Auth::user()->userDetail->profile) }}" id="profile-image1" height="200">
                                    @else
                                        <img alt="User Pic" src="https://d30y9cdsu7xlg0.cloudfront.net/png/138926-200.png" id="profile-image1" height="200">
                                    @endif
                                    <input id="image" class="hidden" type="file" onchange="previewFile()" name="profile">
                                    <div style="color:#999;"> </div>
                                </div>
                                
                                {{-- <div class="profile-pic">
                                    <img alt="User Pic"
                                        src="{{ Auth::user()->userDetail->profile ? asset('storage/' . Auth::user()->userDetail->profile) : 'https://d30y9cdsu7xlg0.cloudfront.net/png/138926-200.png' }}"
                                        id="profile-image1" height="200">
                                    <input id="image" class="hidden" type="file" onchange="previewFile()"
                                        name="profile">
                                    <div style="color:#999;"> </div>
                                </div> --}}
                                <div class="form-group">
                                    <label for="bio">Your Bio</label>
                                    <input type="text" class="form-control" id="bio"
                                        value="{{ Auth::user()->userDetail->bio ?? '' }}" placeholder="Enter Your Bio"
                                        name="bio">
                                    @error('bio')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="website">Your Website</label>
                                            <input type="text" class="form-control" id="website"
                                                value="{{ Auth::user()->userDetail->website ?? '' }}"
                                                placeholder="Enter Your website" name="website">
                                            @error('website')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="location">Your Location</label>
                                            <input type="text" class="form-control" id="location"
                                                value="{{ Auth::user()->userDetail->location ?? '' }}"
                                                placeholder="Enter Mobile location" name="location">
                                            @error('location')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-block" value="Update Profile">
                                </div>
                            </form>

                            <form action="{{ route('userUpdate') }}" method="POST">
                                <!-- Ensure the form action is correct -->
                                @csrf
                                <div class="user-detail">
                                    <div class="form-group">
                                        <label for="name">Your Name</label>
                                        <input type="text" class="form-control" id="name"
                                            value="{{ Auth::user()->name }}" placeholder="Enter Your Name"
                                            name="name">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-mail ID</label>
                                        <input type="email" class="form-control" id="email"
                                            value="{{ Auth::user()->email }}" placeholder="Enter Email" name="email">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-block" value="Update Profile">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    </div>
</section>

@include('layouts.footer')

</body>

</html>
