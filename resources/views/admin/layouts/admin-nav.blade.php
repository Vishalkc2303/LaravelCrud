<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    News
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('AllNews') }}">All news</a>
                        <a class="nav-link" href="{{ route('AddNews') }}">Add news</a>
                        <a class="nav-link" href="{{ route('DraftNews') }}">Draft news</a>
                    </nav>
                </div>


                <div class="sb-sidenav-menu-heading">Category</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Add category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('addcategory') }}">Add category</a>
                        {{-- <a class="nav-link" href="layout-sidenav-light.html">Add news</a> --}}
                        {{-- <a class="nav-link" href="layout-sidenav-light.html">Subcategory</a> --}}
                    </nav>
                </div>

                <a class="nav-link" href="{{ route('alluser') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    User list
                </a>
                <a class="nav-link" href="{{ route('advertisement') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Add advertisement
                </a>
                <a class="nav-link" href="{{ route('userquery') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    User Query
                </a>

                <div class="sb-sidenav-menu-heading">Setting</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Setting
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('websiteDetail') }}">Website setting</a>
                        <a class="nav-link" href="{{ route('socailmedialinks') }}">Socailmedia links</a>
                        {{-- <a class="nav-link" href="layout-sidenav-light.html">Subcategory</a> --}}
                    </nav>
                </div>
                {{-- <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="charts.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Charts
                </a>
                <a class="nav-link" href="tables.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tables
                </a> --}}
            </div>
        </div>
        {{-- <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div> --}}
    </nav>
</div>
