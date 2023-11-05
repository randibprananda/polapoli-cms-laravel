@extends('layouts.dashboard')

@section('title', 'Withdrawal | Pola Poli')

@section('content')
    <div class="row mb-32 gy-32">
        <div class="col-12">
            <div class="row justify-content-between gy-32">
                <div class="col-12 col-md-4">
                    <h4 class="h4">Withdrawal</h4>
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
            <div class="card hp-contact-card mb-32">
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-hover table-borderless">
                            <thead>
                                <tr>
                                    <th>Tanggal Request</th>
                                    <th>Email</th>
                                    <th>Nama Tim</th>
                                    <th>Bank Tujuan</th>
                                    <th>Nama Penerima</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ date('H:i:s d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->user->email }}</td>
                                        <td>{{ $item->donation->tim_relawan->nama_tim_relawan }}</td>
                                        <td>{{ $item->bank_code }}</td>
                                        <td>{{ $item->account_name }}</td>
                                        <td>{{ 'IDR ' . number_format($item->amount) }}</td>
                                        <td>
                                            <!-- Sesuaikan dengan Xendit -->
                                            @if ($item->status == 'APPROVED')
                                                <div
                                                    class="badge bg-success-4 hp-bg-dark-success text-success border-success">
                                                    selesai
                                                </div>
                                            @elseif($item->status == 'REJECTED')
                                                <div class="badge bg-danger-4 hp-bg-dark-danger text-danger border-danger">
                                                    dibatalkan/ditolak
                                                </div>
                                            @elseif($item->status == 'PENDING')
                                                <div
                                                    class="badge bg-warning-4 hp-bg-dark-warning text-warning border-warning">
                                                    diproses
                                                </div>
                                            @endif
                                        </td>
                                        {{-- @can('withdrawal-update') --}}
                                        <td class="text-end">
                                            <button class="btn btn-text text-primary btn-sm" title="Detail"
                                                data-bs-toggle="modal" data-bs-target="#modalData{{ $item->id }}">
                                                <i class="iconly-Light-Show"></i>
                                            </button>
                                            <div class="modal fade" id="modalData{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="modalDataLabel{{ $item->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header py-16 px-24">
                                                            <h5 class="modal-title" id="modalDataLabel{{ $item->id }}">
                                                                Penarikan Dana</h5>
                                                            <button type="button"
                                                                class="btn-close hp-bg-none d-flex align-items-center justify-content-center"
                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                <i class="ri-close-line hp-text-color-dark-0 lh-1"
                                                                    style="font-size: 24px;"></i>
                                                            </button>
                                                        </div>

                                                        <div class="divider m-0"></div>

                                                        <form id="formData" method="POST" enctype="multipart/form-data"
                                                            action="{{ route('dashboard.withdrawal.status', $item->id) }}">
                                                            @csrf
                                                            <div id="method">
                                                                @method('POST')
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="number" hidden>
                                                                <div class="row gx-8">
                                                                    <div class="col-12 col-md-12">
                                                                        <table class="table">
                                                                            <tr>
                                                                                <td>Tanggal</td>
                                                                                <td>{{ date('H:i:s d-m-Y', strtotime($item->created_at)) }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Email</td>
                                                                                <td>{{ $item->user->email }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Nama Tim</td>
                                                                                <td>{{ $item->donation->tim_relawan->nama_tim_relawan }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Bank Tujuan</td>
                                                                                <td>{{ $item->bank_code }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Nama Penerima</td>
                                                                                <td>{{ $item->account_name }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Nominal</td>
                                                                                <td>{{ 'IDR ' . number_format($item->amount) }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Saldo Saat Ini</td>
                                                                                <td><b>{{ 'IDR ' . number_format($item->donation->total_amount - $item->donation->fluktuatif_penarikan_amount) }}</b>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                    @if ($item->status == 'PENDING')
                                                                        <div class="col-12 col-md-12">
                                                                            <div class="mb-24">
                                                                                <label for="status" class="form-label">
                                                                                    <span class="text-danger me-4">*</span>
                                                                                    Status
                                                                                </label>

                                                                                <select class="form-select" id="status"
                                                                                    name="status" required>
                                                                                    <option selected hidden>Status</option>
                                                                                    <option value="1"
                                                                                        class="text-success">
                                                                                        Selesai</option>
                                                                                    <option value="2"
                                                                                        class="text-warning">
                                                                                        Diproses</option>
                                                                                    <option value="3"
                                                                                        class="text-danger">
                                                                                        Ditolak</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @if ($item->status == 'PENDING')
                                                                <div class="modal-footer pt-0 px-24 pb-24">
                                                                    <div class="divider"></div>
                                                                    <div>
                                                                        <button type="button"
                                                                            class="btn btn-text btn-cancel"
                                                                            data-bs-dismiss="modal">Cancel</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save</button>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="modal-footer pt-0 px-24 pb-24">
                                                                    <div class="divider"></div>
                                                                    <div>
                                                                        <button type="button"
                                                                            class="btn btn-text btn-cancel"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        {{-- @endcan --}}
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
