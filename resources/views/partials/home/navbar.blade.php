<header class="site-header">
    <div id="header-wrap">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand logo text-dark h2 mb-0" href="{{url('/')}}">
                            <img src="{{asset('app-assets/img/logo/logo.svg')}}" width="150px">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item">
                                    <a class="nav-link nav-home" href="{{url('/')}}">
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/about-us')}}">
                                        About Us
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/scope-of-work')}}">
                                        Scope of Work
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/business-referral')}}">
                                        Business Referral
                                    </a>
                                </li>
                                <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#"
                                        data-bs-toggle="dropdown">News</a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{url('/article')}}">Article</a>
                                            <a class="dropdown-item" href="{{url('/market-update')}}">Market Update</a>
                                            <a class="dropdown-item" href="{{url('/activity')}}">Activity</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/contact')}}">
                                        Contact Us
                                    </a>
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="v-divider"></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle dropdown-lang" href="#"
                                        data-bs-toggle="dropdown" id="lang-now">
                                        <i class="flag-en"></i>
                                        <span></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <i class="flag:ES"></i>
                                            <a class="dropdown-item dropdown-item-lang d-flex lang-select" data-lang="id" data-dir="ltr" href="#googtrans(en|id)">
                                                <i class="flag-id"></i>
                                                Indonesia
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item dropdown-item-lang d-flex lang-select" data-lang="en" data-dir="ltr" href="#googtrans(en|en)">
                                                <i class="flag-en"></i>
                                                English
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item dropdown-item-lang d-flex lang-select" data-lang="ar" data-dir="rtl" href="#googtrans(en|ar)">
                                                <i class="flag-ar"></i>
                                                Arabic
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
