@extends('layouts.dashboard')

@section('title', 'Tim Relawan | Pola Poli')

@section('content')
    <div class="row mb-32 gy-32">
        <div class="col-12">
            <div class="row justify-content-between gy-32">
                <div class="col-12 col-md-4">
                    <h4 class="h4">Tim Relawan</h4>
                </div>
                <div class="col-12 col-md-7">
                    <div class="row g-16 align-items-center justify-content-end">
                        <div class="col-12 col-md-6 col-xl-4">
                            {{-- <div class="input-group align-items-center">
                                <span class="input-group-text bg-white hp-bg-dark-100 border-end-0 pe-0">
                                    <i class="iconly-Light-Search text-black-80" style="font-size: 16px;"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-8" placeholder="Search">
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
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
            <div class="card hp-contact-card mb-32">
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-hover table-borderless">
                            <thead>
                                <tr>
                                    <th>Email PM</th>
                                    <th>Nama Tim</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->detail_tim_relawan->pm->email ?? ''}}</td>
                                        <td>{{ $item->nama_tim_relawan }}</td>
                                        <td>
                                            @if ($item->is_premium == '0')
                                                <div class="badge bg-danger-4 hp-bg-dark-danger text-danger border-danger">
                                                    inactive
                                                </div>
                                            @else
                                                <div
                                                    class="badge bg-success-4 hp-bg-dark-success text-success border-success">
                                                    active
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{-- {{$data->links("pagination::bootstrap-4")}} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
