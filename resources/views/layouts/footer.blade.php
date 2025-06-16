<footer class="footer">
    <div class="container">
        <div class="row">
            @php
                $websitedetail = App\Models\Websitedetail::first();
                // dd($websitedetail);
            @endphp
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12" style="margin:auto;">
                        <a href="index.html"><img src="{{ Storage::url($websitedetail->logo) }}" width="100%"
                                alt="" class="img-fluid"></a>
                    </div>
                    <div class="col-md-9 col-md-9 col-sm-12" style="margin:auto;">
                        <p class="mt-4">GoNews is Mauritius's Top New-Age media platform that covers latest
                            news
                            from global to regional. We bring to you the latest happenings from Politics, Sports,
                            Technology, Economy, Entertainment, Lifestyle, Health and more. We follow strict
                            editorial policy and ensure that all our news sources are double checked. We are
                            committed to deliver the trusted, fact-based, inclusive news coverage with absolute
                            integrity, boundless energy, and dedication to the essential role of serving the
                            country. Our aim is to be a 24/7 media covering local, regional and world events..</p>
                    </div>
                </div>
            </div>
            <ul class="list-inline my-3">
                {{-- <li class="li list-inline-item"><a href="#">About</a></li> --}}
                {{-- <li class="li list-inline-item"><a href="#">Privacy Policy</a></li> --}}
                <li class="li list-inline-item"><a href="{{ route('term') }}">Terms of Use</a></li>
                <li class="li list-inline-item"><a href="#">Editorial Policy</a></li>
                <li class="li list-inline-item"><a href="#">Copyright Policy</a></li>
                <li class="li list-inline-item"><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
            @php
                $socialMediaLinks = App\Models\Socailmedia::first(); // dd($addetail);

            @endphp

            <ul class="list-inline footer-social">
                @if ($socialMediaLinks)
                    @if ($socialMediaLinks->facebook)
                        <li class="li list-inline-item"><a href="{{ $socialMediaLinks->facebook }}" target="_blank"><i
                                    class="fa fa-facebook"></i></a></li>
                    @endif
                    @if ($socialMediaLinks->twitter)
                        <li class="li list-inline-item"><a href="{{ $socialMediaLinks->twitter }}" target="_blank"><i
                                    class="fa fa-twitter"></i></a></li>
                    @endif
                    @if ($socialMediaLinks->linkedin)
                        <li class="li list-inline-item"><a href="{{ $socialMediaLinks->linkedin }}" target="_blank"><i
                                    class="fa fa-linkedin"></i></a></li>
                    @endif
                    @if ($socialMediaLinks->instagram)
                        <li class="li list-inline-item"><a href="{{ $socialMediaLinks->instagram }}" target="_blank"><i
                                    class="fa fa-instagram"></i></a></li>
                    @endif
                    {{-- Add more social media links as needed --}}
                @endif
            </ul>


            <div class="copyright-text text-center">
                <p class="mb-0">©2024. All Copyright Reserved <a href="#"
                        target="_blank">{{ $websitedetail->website_name }}</a></p>
            </div>
        </div>

        <div class="scroll-to-top">
            <button class="btn btn-primary" title="Back to Top">
                <i class="fa fa-angle-up"></i>
            </button>
        </div>
    </div>
    </div>
</footer>


<!-- THEME JAVASCRIPT FILES
================================================== -->
<!-- initialize jQuery Library -->
<script src="{{ asset('plugins/jquery/jquery.js') }}"></script>
<!-- Bootstrap jQuery -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- Slick Slider -->
<script src="{{ asset('plugins/slick-carousel/slick.min.js') }}"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
<script src="{{ asset('plugins/google-map/gmap.js') }}"></script>
<!-- main js -->
<script src="{{ asset('js/custom.js') }}"></script>
