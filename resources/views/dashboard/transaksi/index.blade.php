@extends('layouts.dashboard')

@section('title', 'Transaksi | Pola Poli')

@section('content')
    <div class="row mb-32 gy-32">
        <div class="col-12">
            <div class="row justify-content-between gy-32">
                <div class="col-12 col-md-4">
                    <h4 class="h4">Transaksi</h4>
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
                                    <th>Tanggal</th>
                                    <th>Kode</th>
                                    <th>Email</th>
                                    <th>Nama Tim</th>
                                    <th>Paket</th>
                                    <th>Harga Paket</th>
                                    <th>Add on</th>
                                    <th>Harga Add on</th>
                                    <th>Durasi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ date('H:i:s d-m-Y', strtotime($item->updated_at)) }}</td>
                                        <td>{{ $item->invoice_code }}</td>
                                        <td>{{ $item->user->email }}</td>
                                        <td>{{ $item->tim_relawan->nama_tim_relawan }}</td>
                                        <td>{{ $item->jenis_paket }}</td>
                                        <td>{{ 'IDR ' . number_format($item->amount) }}</td>
                                        <td>
                                            @foreach ($item->order_tim_addon as $t)
                                                {{ $t->title }},
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($item->order_tim_addon as $m)
                                                {{ 'IDR ' . number_format($m->price) }},
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($item->tanggal_awal)) . ' - ' . date('d-m-Y', strtotime($item->tanggal_akhir)) }}
                                        <td>
                                            <!-- Sesuaikan dengan Xendit -->
                                            @if ($item->status == 'PAID')
                                                <div
                                                    class="badge bg-success-4 hp-bg-dark-success text-success border-success">
                                                    paid
                                                </div>
                                            @elseif ($item->status == 'PENDING')
                                                <div
                                                    class="badge bg-warning-4 hp-bg-dark-warning text-warning border-warning">
                                                    pending
                                                </div>
                                            @else
                                                <div class="badge bg-danger-4 hp-bg-dark-danger text-danger border-danger">
                                                    expired
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
