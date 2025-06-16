@extends('layouts.app')
@section('content')
    <section class="py-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2 class="text-center">Contact us</h2>
                    <p class="text-center">
                        Call or submit our online form to request an estimate or for general questions about Designed
                        Publishing Inc. and our services. We look forward to serving you!
                    </p>
                    <div class="row">
                        <div class="col-lg-8">

                        </div>
                    </div>

                    <form id="contact-form" class="my-5" action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name">Your name*:</label>
                                    <input class="form-control form-control-name @error('name') is-invalid @enderror"
                                        name="name" id="name" type="text" required value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Your Email Address*:</label>
                                    <input class="form-control form-control-email @error('email') is-invalid @enderror"
                                        name="email" id="email" type="email" required value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Your Phone No*:</label>
                                    <input class="form-control form-control-phone @error('phone') is-invalid @enderror"
                                        name="phone" id="phone" type="text" required value="{{ old('phone') }}">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="subject">Your Query Topic*:</label>
                                    <input class="form-control form-control-subject @error('subject') is-invalid @enderror"
                                        name="subject" id="subject" type="text" required value="{{ old('subject') }}">
                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message">Your Message*:</label>
                                    <textarea class="form-control form-control-message @error('message') is-invalid @enderror" name="message" id="message"
                                        rows="7" required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button class="btn btn-primary solid blank mt-3" type="submit">Send Message</button>
                            </div>
                            <div class="col-lg-4">
                                <h4 class="text-black mb-4 mt-5 mt-lg-0">Hello! We’d like to make sure that your contact
                                    submission/feedback is directed to us.</h4>
                                <p class="lead">Please read through the following carefully before submitting below:</p>
                                <ul class="list-unstyled">
                                    <li class="mb-3">1. We can only address issues related to themefisher.com. We are not
                                        affiliated with the sites we write about.</li>
                                    <li class="mb-3">2. If you would like to submit news, please see the “Submit News to
                                        Form” page that has more details.</li>
                                    <li class="mb-3">3. For more information on advertising, please see our Advertising
                                        Information Page first.</li>
                                </ul>
                            </div>
                        </div>
                    </form>




                </div>
            </div>
        </div>
    </section>
@endsection
