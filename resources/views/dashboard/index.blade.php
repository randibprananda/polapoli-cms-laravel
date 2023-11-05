@extends('layouts.dashboard')

@section('title', 'Dashboard | Pola Poli')

@section('content')
<div class="row mb-32 gy-32">
    <div class="col-12">
        <h3>Welcome back, {{Auth::user()->display_name != "" ? Auth::user()->display_name : Auth::user()->name}} 👋</h3>
    </div>

    <div class="col-12">
        <div class="row g-32">
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row gx-8 gy-16">
                            <div class="col hp-flex-none w-auto">
                                <div
                                    class="avatar-item d-flex align-items-center justify-content-center avatar-lg bg-primary-4 hp-bg-dark-primary rounded-circle">
                                    <i class="ri-user-follow-fill text-primary hp-text-color-dark-primary-2"
                                        style="font-size: 24px;"></i>
                                </div>
                            </div>

                            <div class="col hp-flex-none w-auto">
                                <h5 class="mb-4">{{$data['user_count']}}</h5>
                                <p class="hp-badge-text mb-0 text-black-80 hp-text-color-dark-30">
                                    User Registered
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row gx-8 gy-16">
                            <div class="col hp-flex-none w-auto">
                                <div
                                    class="avatar-item d-flex align-items-center justify-content-center avatar-lg bg-warning-4 hp-bg-dark-warning rounded-circle">
                                    <i class="ri-article-line text-warning" style="font-size: 24px;"></i>
                                </div>
                            </div>

                            <div class="col hp-flex-none w-auto">
                                <h5 class="mb-4">{{$data['article_count']}}</h5>
                                <p class="hp-badge-text mb-0 text-black-80 hp-text-color-dark-30">
                                    Posts 
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row gx-8 gy-16">
                            <div class="col hp-flex-none w-auto">
                                <div
                                    class="avatar-item d-flex align-items-center justify-content-center avatar-lg bg-secondary-4 hp-bg-dark-secondary rounded-circle">
                                    <i class="ri-user-add-line text-secondary" style="font-size: 24px;"></i>
                                </div>
                            </div>

                            <div class="col hp-flex-none w-auto">
                                <h5 class="mb-4">+120</h5>
                                <p class="hp-badge-text mb-0 text-black-80 hp-text-color-dark-30">
                                    Customer
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row gx-8 gy-16">
                            <div class="col hp-flex-none w-auto">
                                <div
                                    class="avatar-item d-flex align-items-center justify-content-center avatar-lg bg-danger-4 hp-bg-dark-danger rounded-circle">
                                    <i class="ri-user-star-line text-danger" style="font-size: 24px;"></i>
                                </div>
                            </div>

                            <div class="col hp-flex-none w-auto">
                                <h5 class="mb-4">24,500</h5>
                                <p class="hp-badge-text mb-0 text-black-80 hp-text-color-dark-30">
                                    Customer
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection
