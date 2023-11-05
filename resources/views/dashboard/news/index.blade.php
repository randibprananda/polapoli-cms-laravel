@extends('layouts.dashboard')

@section('title', 'Article | Pola Poli')

@section('content')
    <div class="row mb-32 gy-32">
        <div class="col-12">
            <div class="row justify-content-between gy-32">
                <div class="col-12 col-md-4">
                    <h4 class="h4">Article</h4>
                </div>
                <div class="col-12 col-md-7">
                    <div class="row g-16 align-items-center justify-content-end">
                        <div class="col-12 col-md-6 col-xl-4">
                            <form action="{{ route('dashboard.news.index') }}" method="get">

                                <div class="input-group align-items-center">
                                    <span class="input-group-text bg-white hp-bg-dark-100 border-end-0 pe-0">
                                        <i class="iconly-Light-Search text-black-80" style="font-size: 16px;"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 ps-8" name="search"
                                        placeholder="Search">
                                </div>
                            </form>

                        </div>
                        @can('news-add')
                            <div class="col hp-flex-none w-auto">
                                <a href="{{ route('dashboard.news.create') }}" type="button" class="btn btn-primary w-100">
                                    <i class="ri-add-line remix-icon"></i>
                                    <span>Add Article</span>
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card hp-contact-card mb-32">
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-hover table-borderless">
                            <thead>
                                <tr>
                                    <th>Thumbnail</th>
                                    <th>Title</th>
                                    <th>Publish Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>
                                            <a href="app-contact-detail.html">
                                                <div
                                                    class="avatar-item avatar-lg d-flex align-items-center justify-content-center bg-primary-4 hp-bg-dark-primary text-primary hp-text-color-dark-0 rounded-circle">
                                                    <img src="{{ $item->picture != null ? $item->picture : asset('app-assets/img/default-profile.svg') }}"
                                                        alt="Banner Info">
                                                </div>
                                            </a>
                                        </td>
                                        <td>
                                            {{ $item->title }}
                                        </td>
                                        <td>
                                            {{ $item->created_at }}
                                        </td>
                                        <td>
                                            @if ($item->status == 1)
                                                <div
                                                    class="badge bg-success-4 hp-bg-dark-success text-success border-success">
                                                    active
                                                </div>
                                            @else
                                                <div class="badge bg-danger-4 hp-bg-dark-danger text-danger border-danger">
                                                    inactive
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalData{{ $item->id }}"
                                                class="btn btn-text text-danger btn-sm" title="Detail">
                                                <i class="iconly-Light-Delete "></i>
                                            </button>
                                            @can('news-update')
                                                <a href="{{ route('dashboard.news.edit', $item->id) }}"
                                                    class="btn btn-text text-primary btn-sm" title="Detail">
                                                    <i class="iconly-Light-Show"></i>
                                                </a>
                                            @endcan
                                        </td>
                                        @include('dashboard.news.modal')
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- @include('partials.dashboard.pagination') --}}
                    <div>
                        {{ $data->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('modal')
    <div class="modal fade" id="modalData{{ $item->id }}" tabindex="-1" aria-labelledby="modalDataLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyingModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('dashboard.news.destroy', $item->id) }} }}">
                        @csrf
                        <div id="method">
                            @method('delete')
                        </div>
                        <div class="modal-body">
                            Apakah data ingin dihapus ?
                        </div>

                        <div class="modal-footer pt-0 px-24 pb-24">
                            <div class="divider"></div>
                            <div class="d-flex justify-content-between w-100">
                                <div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-danger btn-save">Delete</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
