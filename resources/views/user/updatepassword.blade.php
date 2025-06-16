@include('layouts.secondnav')
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
                            <div class="profile-pic">
                                <img alt="User Pic" src="https://d30y9cdsu7xlg0.cloudfront.net/png/138926-200.png"
                                    id="profile-image1" height="200">
                                {{-- <input id="profile-image-upload" class="hidden" type="file" onchange="previewFile()"> --}}
                                <div style="color:#999;"> </div>
                            </div>
                            <form action="" method="post"> <!-- Add method and action -->
                                @csrf <!-- Add CSRF token -->
                                <div class="user-detail">
                                    <div class="form-group">
                                        <label for="password">Current Password </label>
                                        <input type="password" class="form-control" id="oldpassword"
                                            placeholder="Enter Your Current Password" name="old_password">
                                        @error('old_password')
                                            <!-- Display error message -->
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">New Password </label>
                                        <input type="password" class="form-control" id="newpassword"
                                            placeholder="Enter New Password" name="password">
                                        @error('password')
                                            <!-- Display error message -->
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Re Enter Password</label>
                                        <input type="password" class="form-control" id="repassword"
                                            placeholder="Re Enter Password " name="password_confirmation">
                                        @error('confirm_password')
                                            <!-- Display error message -->
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-block" value="Update Password">
                                    <!-- Change to submit button -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
