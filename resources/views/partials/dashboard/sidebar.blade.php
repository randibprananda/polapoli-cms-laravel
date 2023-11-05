<ul>
    <li>
        <div class="menu-title">MAIN</div>
        <ul>
            <li>
                <a href="{{ url('/dashboard') }}" class="{{ Request()->is('dashboard') ? 'active' : '' }}">
                    <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right" title=""
                        data-bs-original-title="Dashboard" aria-label="Dashboard"></div>
                    <span>
                        <i class="iconly-Curved-Home"></i>
                        <span>Dashboard</span>
                    </span>
                </a>
            </li>

            {{-- @can('tim-index') --}}
            <li>
                <a href="{{ url('/dashboard/tim-relawan') }}"
                    class="{{ Request()->is('dashboard/tim-relawan') ? 'active' : '' }}">
                    <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right"
                        title="" data-bs-original-title="Tim Relawan" aria-label="Tim Relawan"></div>
                    <span>
                        <i class="iconly-Curved-Category"></i>
                        <span>Tim Relawan</span>
                    </span>
                </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('transaksi-index') --}}
            <li>
                <a href="{{ url('/dashboard/transaksi') }}"
                    class="{{ Request()->is('dashboard/transaksi') ? 'active' : '' }}">
                    <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right"
                        title="" data-bs-original-title="Transaksi" aria-label="Transaksi"></div>
                    <span>
                        <i class="iconly-Curved-Swap"></i>
                        <span>Transaksi</span>
                    </span>
                </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('withdrawal-index') --}}
            <li>
                <a href="{{ url('/dashboard/withdrawal') }}"
                    class="{{ Request()->is('dashboard/withdrawal') ? 'active' : '' }}">
                    <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right"
                        title="" data-bs-original-title="Withdrawal" aria-label="Withdrawal"></div>
                    <span>
                        <i class="iconly-Curved-Wallet"></i>
                        <span>Withdrawal</span>
                    </span>
                </a>
            </li>
            {{-- @endcan --}}

            <div class="menu-title hp-mt-5">CMS</div>
            @can('usp-index')
                <li>
                    <a href="{{ url('/dashboard/usp') }}" class="{{ Request()->is('dashboard/usp') ? 'active' : '' }}">
                        <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="" data-bs-original-title="USP" aria-label="USP"></div>

                        <span>
                            <i class="iconly-Curved-Star"></i>
                            <span>USP</span>
                        </span>
                    </a>
                </li>
            @endcan

            @can('solusi-index')
                <li>
                    <a href="{{ url('/dashboard/solusi') }}"
                        class="{{ Request()->is('dashboard/solusi') ? 'active' : '' }}">
                        <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="" data-bs-original-title="Solusi" aria-label="Solusi"></div>

                        <span>
                            <i class="iconly-Curved-ShieldDone"></i>
                            <span>Solusi</span>
                        </span>
                    </a>
                </li>
            @endcan

            @can('layanan-index')
                <li>
                    <a href="{{ url('/dashboard/layanan') }}"
                        class="{{ Request()->is('dashboard/layanan') ? 'active' : '' }}">
                        <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="" data-bs-original-title="Layanan" aria-label="Layanan"></div>

                        <span>
                            <i class="iconly-Curved-Work"></i>
                            <span>Layanan</span>
                        </span>
                    </a>
                </li>
            @endcan

            @can('client-index')
                <li>
                    <a href="{{ url('/dashboard/client') }}"
                        class="{{ Request()->is('dashboard/client') ? 'active' : '' }}">
                        <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="" data-bs-original-title="Client" aria-label="Client"></div>

                        <span>
                            <i class="iconly-Curved-TwoUsers"></i>
                            <span>Client</span>
                        </span>
                    </a>
                </li>
            @endcan

            @can('testimonial-index')
                <li>
                    <a href="{{ url('/dashboard/testimonial') }}"
                        class="{{ Request()->is('dashboard/testimonial') ? 'active' : '' }}">
                        <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="" data-bs-original-title="Testimonial" aria-label="Testimonial"></div>

                        <span>
                            <i class="iconly-Curved-Star"></i>
                            <span>Testimonial</span>
                        </span>
                    </a>
                </li>
            @endcan

            @can('pricing-index')
                {{-- <li>
                    <a href="{{ url('/dashboard/pricing') }}"
                        class="{{ Request()->is('dashboard/pricing') ? 'active' : '' }}">
                        <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="" data-bs-original-title="Pricing" aria-label="Pricing"></div>

                        <span>
                            <i class="iconly-Curved-Ticket"></i>
                            <span>Pricing</span>
                        </span>
                    </a>
                </li> --}}

                <li>
                    <a href="javascript:;" class="submenu-item">
                        <span>
                            <i class="iconly-Curved-Ticket"></i>
                            <span>Pricing</span>
                        </span>

                        <div class="menu-arrow"></div>
                    </a>

                    <ul class="submenu-children" data-level="1">
                        <li>
                            <a href="{{ url('/dashboard/division') }}">
                                <span>Division</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/dashboard/pricing') }}">
                                <span>Paket</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.addOn.index') }}">
                                <span>Add On</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('faq-index')
                <li>
                    <a href="{{ url('/dashboard/faq') }}" class="{{ Request()->is('dashboard/faq') ? 'active' : '' }}">
                        <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="" data-bs-original-title="FAQ" aria-label="FAQ"></div>

                        <span>
                            <i class="iconly-Curved-Chat"></i>
                            <span>FAQ</span>
                        </span>
                    </a>
                </li>
            @endcan

            @can('news-index')
                <li>
                    <a href="javascript:;" class="submenu-item">
                        <span>
                            <i class="iconly-Curved-Document"></i>
                            <span>News</span>
                        </span>

                        <div class="menu-arrow"></div>
                    </a>

                    <ul class="submenu-children" data-level="1">
                        <li>
                            <a href="{{ url('/dashboard/news') }}">
                                <span>Article</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('news.category.index') }}">
                                <span>Category</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('web-index')
                <li>
                    <a href="javascript:;" class="submenu-item">
                        <span>
                            <i class="iconly-Curved-Filter"></i>
                            <span>Web Settings</span>
                        </span>

                        <div class="menu-arrow"></div>
                    </a>

                    <ul class="submenu-children" data-level="1">
                        <li>
                            <a href="{{ url('/dashboard/settings/web') }}">
                                <span>Web</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/dashboard/settings/contact') }}">
                                <span>Contact</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/dashboard/settings/social') }}">
                                <span>Social Media</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
        </ul>
    </li>

    <li>
        <div class="menu-title">OTHER</div>
        <ul>
            @can('user-index')
                <li>
                    <a href="{{ url('/dashboard/user') }}">
                        <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="" data-bs-original-title="User Internal" aria-label="User Internal"></div>
                        <span>
                            <i class="iconly-Curved-People"></i>
                            <span>User Internal</span>
                        </span>
                    </a>
                </li>
            @endcan
            @can('role-index')
                <li>
                    <a href="{{ url('/dashboard/role') }}">
                        <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="" data-bs-original-title="Contact" aria-label="Contact"></div>
                        <span>
                            <i class="iconly-Light-Lock"></i>
                            <span>Role & Permission</span>
                        </span>
                    </a>
                </li>
            @endcan
            <li>
                <a href="{{ url('/dashboard/profile') }}">
                    <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right"
                        title="" data-bs-original-title="Contact" aria-label="Contact"></div>
                    <span>
                        <i class="iconly-Curved-User"></i>
                        <span>Profil</span>
                    </span>
                </a>
            </li>
        </ul>
    </li>
</ul>
