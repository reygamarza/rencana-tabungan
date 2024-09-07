@extends('layouts.navbar')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">{{ __('Rencana Tabungan Anda') }}</h2>
    <div class="row">
        @php
            // Data dummy
            $tabungans = [
                [
                    'foto' => 'images/liburan.jpg',
                    'judul' => 'Liburan Bali',
                    'target_nominal' => 5000000,
                    'target_tanggal' => '2024-12-31',
                    'nominal_saat_ini' => 2000000,
                    'status' => false
                ],
                [
                    'foto' => 'images/beli_hp.jpg',
                    'judul' => 'Beli HP Baru',
                    'target_nominal' => 3000000,
                    'target_tanggal' => '2024-10-15',
                    'nominal_saat_ini' => 1500000,
                    'status' => false
                ],
                [
                    'foto' => 'images/renovasi_rumah.jpg',
                    'judul' => 'Renovasi Rumah',
                    'target_nominal' => 20000000,
                    'target_tanggal' => '2025-05-20',
                    'nominal_saat_ini' => 18000000,
                    'status' => true
                ]
            ];
        @endphp

        @foreach ($tabungans as $tabungan)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <img src="{{ asset($tabungan['foto']) }}" class="card-img-top" alt="{{ $tabungan['judul'] }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $tabungan['judul'] }}</h5>
                    <p class="card-text"><strong>Target: </strong>Rp {{ number_format($tabungan['target_nominal'], 0, ',', '.') }}</p>
                    <p class="card-text"><strong>Tanggal Tercapai: </strong>{{ $tabungan['target_tanggal'] }}</p>
                    <p class="card-text"><strong>Status: </strong>{{ $tabungan['status'] ? 'Tercapai' : 'Belum Tercapai' }}</p>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ ($tabungan['nominal_saat_ini'] / $tabungan['target_nominal']) * 100 }}%;" aria-valuenow="{{ $tabungan['nominal_saat_ini'] }}" aria-valuemin="0" aria-valuemax="{{ $tabungan['target_nominal'] }}"></div>
                    </div>
                    <p class="mt-2"><strong>Nominal Saat Ini: </strong>Rp {{ number_format($tabungan['nominal_saat_ini'], 0, ',', '.') }}</p>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-warning btn-sm">Edit</a>
                    <button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
