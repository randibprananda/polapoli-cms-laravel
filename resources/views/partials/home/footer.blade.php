<footer class="pt-11 pb-6 bg-primary position-relative" data-bg-img="{{asset('app-assets/images/bg-footer.png')}}">
    <div class="shape-1" style="height: 150px; overflow: hidden;">
        <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
            <path d="M0.00,49.98 C150.00,150.00 271.49,-50.00 500.00,49.98 L500.00,0.00 L0.00,0.00 Z"
                style="stroke: none; fill: #fff;"></path>
        </svg>
    </div>
    <div class="container mt-7">
        <div class="row">
            <div class="col-12 col-lg-4 col-xl-4 me-auto mb-6 mb-lg-0">
                <img src="{{asset('app-assets/img/logo/logo-dark.svg')}}" width="150px">
                {{-- <p class="text-white mt-4">{{$about->description}}</p> --}}
            </div>
            <div class="col-12 col-lg-6 col-xl-8">
                <div class="row">
                    <div class="col-12 col-sm-4 mt-6 mt-sm-0 navbar-dark">
                        <h5 class="mb-4 text-white capitalize">Pages</h5>
                        <ul class="navbar-nav list-unstyled mb-0">
                            <li class="mb-3 nav-item"><a class="nav-link" href="{{route('home.index')}}">Home</a>
                            </li>
                            <li class="mb-3 nav-item"><a class="nav-link" href="{{route('about.index')}}">About Us</a>
                            </li>
                            <li class="mb-3 nav-item"><a class="nav-link" href="{{route('scope.index')}}">Scope Us</a>
                            </li>
                            <li class="mb-3  nav-item"><a class="nav-link" href="{{route('referral.index')}}">Business Referral</a>
                            </li>
                            <li class="mb-3 nav-item"><a class="nav-link" href="{{route('recent.index')}}">Activity</a>
                            </li>
                            <li class="mb-3 nav-item"><a class="nav-link" href="{{route('business.index')}}">Market Update</a>
                            </li>
                            <li class="mb-3 nav-item"><a class="nav-link" href="{{route('contact.index')}}">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-4 mt-6 mt-sm-0 navbar-dark">
                        <h5 class="mb-4 text-white capitalize">Social Media</h5>
                        <ul class="navbar-nav list-unstyled mb-0">
                            @foreach ($social_medias as $social_media) 
                            @if ($social_media->account_name ?? false)
                                
                            <li class="mb-3 nav-item"><a class="nav-link" href="@php
                            if($social_media->link ?? false){
                                if(preg_match("/^http/i",$social_media->link)){
                                    echo $social_media->link;
                                } else {
                                    echo "http://".$social_media->link; 
                                }
                            } else {
                                echo "#";
                            }
                            @endphp">{{$social_media->account_name ?? "#"}}</a>
                            </li>
                            @endif
                            @endforeach

                        </ul>
                    </div>
                    <div class="col-12 col-sm-4 navbar-dark">
                        <h5 class="mb-4 text-white capitalize">Other Links</h5>
                        <ul class="navbar-nav list-unstyled mb-0">
                            @foreach ($other_links as $other_link) 
                            <li class="mb-3 nav-item"><a class="nav-link" href="{{$other_link->link}}">{{$other_link->title}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-white text-center mt-8">
            <div class="col">
                <hr class="mb-4">Copyright 2022 Pola Poli</div>
        </div>
    </div>
</footer>
