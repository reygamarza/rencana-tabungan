@extends('layouts.navbar')

@section('content')
    <div class="content">
        <div class="welcome-section">
            <div class="text-center mb-4">
                <a href="#" class="btn btn-tambah" data-bs-toggle="modal" data-bs-target="#buatTabungan"><i
                        class="fas fa-plus-circle"></i> Buat
                    Tabungan </a>
            </div>
        </div>

        <div class="savings-grid">
            @foreach ($tabungan as $t)
            <div class="savings-card">
                <div class="savings-image-container">
                    <img src="{{ asset('storage/tabungan/' . $t->foto) }}" alt="{{ $t->foto }}" class="savings-image">
                    <div class="savings-image-overlay"></div>
                </div>
                <div class="savings-content">
                    <h2 class="savings-card-title">{{ $t->judul }}</h2>
                    <p class="savings-card-info">Target : Rp {{ number_format($t->target_nominal, 0, ',', '.') }}</p>
                    <p class="savings-card-info">Target Tanggal : {{ date('d M Y', strtotime($t->target_tanggal)) }}</p>
                    <p class="savings-card-info">
                        Terkumpul : Rp {{ number_format($t->nominal_terkumpul, 0, ',', '.') }}
                    </p>

                    <!-- Pemberitahuan jika nominal terkumpul melebihi target -->
                    @if ($t->nominal_terkumpul >= $t->target_nominal)
                        <div class="alert alert-success">
                            <strong>Selamat!</strong> Target tabungan telah tercapai.
                        </div>
                    @endif

                    <div class="progress">
                        <div class="progress-bar" style="width: {{ $t->progress }}%;"></div>
                    </div>

                    <!-- Status berdasarkan kondisi nominal terkumpul -->
                    <p class="savings-card-status">
                        @if ($t->nominal_terkumpul >= $t->target_nominal)
                            <i class="fas fa-check-circle"></i> Target Tercapai
                        @else
                            <i class="fas fa-hourglass-half"></i> In Progress | Belum Tercapai
                        @endif
                    </p>
                </div>

                <div class="pb-3">
                    <form id="delete-form-{{ $t->id }}" action="{{ route('hapus-tabungan', $t->id) }}" method="POST">
                        <div class="savings-buttons-container">
                            <a class="savings-button edit" data-bs-toggle="modal" data-bs-target="#editTabungan{{ $t->id }}">
                                <i class="fa fa-edit"></i> Ubah Data
                            </a>

                            @csrf
                            @method('DELETE')
                            <button type="button" class="savings-button hapus" onclick="confirmDelete({{ $t->id }})">
                                <i class="fa fa-trash"></i> Hapus Data
                            </button>
                        </div>
                    </form>


                    @if ($t->nominal_terkumpul < $t->target_nominal)
                    <div class="savings-buttons-container">
                        <button class="savings-button" data-bs-toggle="modal" data-bs-target="#Menabung{{ $t->id }}">
                            <i class="fa fa-piggy-bank"></i> Tambah Nominal
                        </button>
                    </div>
                    @endif
                </div>
            </div>


                <!-- Modal Edit Tabungan -->
                <div class="modal fade" id="editTabungan{{ $t->id }}" tabindex="-1"
                    aria-labelledby="editTabunganLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTabunganLabel">Edit Tabungan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <!-- Modal Body -->
                            <form action="{{ route('edit-tabungan', $t->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="judul_tabungan" class="form-label">Judul Tabungan</label>
                                        <input type="text" class="form-control" id="judul_tabungan" name="judul"
                                            placeholder="Masukkan judul tabungan" value="{{ $t->judul }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="foto_tabungan" class="form-label">Foto Tabungan</label>
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/tabungan/' . $t->foto) }}"
                                                alt="{{ $t->foto }}" width="150px">
                                        </div>

                                        <input type="file" class="form-control" id="foto_tabungan" name="foto"
                                            accept="image/*">
                                        <small class="text-muted">Unggah gambar baru jika ingin mengganti foto.</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="target_nominal" class="form-label">Target Nominal Tabungan</label>
                                        <input type="number" min="100" class="form-control" id="target_nominal"
                                            name="target_nominal" placeholder="Masukkan target nominal tabungan"
                                            value="{{ $t->target_nominal }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="target_tanggal" class="form-label">Target Tanggal Tercapai</label>
                                        <input type="date" class="form-control" id="target_tanggal" name="target_tanggal"
                                            value="{{ $t->target_tanggal }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nominal_terkumpul" class="form-label">Nominal Terkumpul</label>
                                        <input type="number" min="100" class="form-control" id="nominal_terkumpul"
                                            name="nominal_terkumpul" value="{{ $t->nominal_terkumpul }}"
                                            placeholder="Masukkan nominal awal tabungan">
                                    </div>
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan Tabungan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Menabung -->
                <div class="modal fade" id="Menabung{{ $t->id }}" tabindex="-1" aria-labelledby="MenabungLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="MenabungLabel">Menabung</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <!-- Modal Body -->
                            <form action="{{ route('menabung', $t->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="nominal" class="form-label">Nominal</label>
                                        <input type="number" min="100" class="form-control" id="nominal"
                                            name="nominal" placeholder="Masukkan nominal" required>
                                    </div>
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan Tabungan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Modal Tambah Tabungan -->
            <div class="modal fade" id="buatTabungan" tabindex="-1" aria-labelledby="buatTabunganLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="buatTabunganLabel">Buat Tabungan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <form action="{{ route('buat-tabungan') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="judul_tabungan" class="form-label">Judul Tabungan</label>
                                    <input type="text" class="form-control" id="judul_tabungan" name="judul"
                                        placeholder="Masukkan judul tabungan" required>
                                </div>

                                <div class="mb-3">
                                    <label for="foto_tabungan" class="form-label">Foto Tabungan</label>
                                    <input type="file" class="form-control" id="foto_tabungan" name="foto"
                                        accept="image/*" required>
                                </div>

                                <div class="mb-3">
                                    <label for="target_nominal" class="form-label">Target Nominal Tabungan</label>
                                    <input type="number" min="100" class="form-control" id="target_nominal"
                                        name="target_nominal" placeholder="Masukkan target nominal tabungan" required>
                                </div>

                                <div class="mb-3">
                                    <label for="target_tanggal" class="form-label">Target Tanggal Tercapai</label>
                                    <input type="date" class="form-control" id="target_tanggal" name="target_tanggal"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="nominal_terkumpul" class="form-label">Nominal Awal Tabungan
                                        (Opsional)</label>
                                    <input type="number" min="100" class="form-control" id="nominal_terkumpul"
                                        name="nominal_terkumpul" placeholder="Masukkan nominal awal tabungan">
                                </div>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan
                                    Tabungan</button>
                            </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
