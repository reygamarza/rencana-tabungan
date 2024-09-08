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
                        <img src="{{ asset('storage/tabungan/'. $t->foto) }}" alt="{{ $t->foto }}" class="savings-image">
                        <div class="savings-image-overlay"></div>
                    </div>
                    <div class="savings-content">
                        <h2 class="savings-card-title">{{ $t->judul }}</h2>
                        <p class="savings-card-info">Target : Rp {{ number_format($t->target_nominal, 0, ',', '.') }}</p>
                        <p class="savings-card-info">Target Tanggal : {{ date('d M Y', strtotime($t->target_tanggal)) }}</p>
                        <p class="savings-card-info">Terkumpul : Rp {{ number_format($t->nominal_terkumpul, 0, ',', '.') }}
                        </p>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ $t->progress }}%;"></div>
                        </div>
                        <p class="savings-card-status">
                            <i class="fas fa-hourglass-half"></i> In Progress
                        </p>
                    </div>
                    <div class="pb-3">
                        <form action="{{ route('hapus-tabungan', $t->id) }}" method="POST">
                            <div class="savings-buttons-container">
                                <a class="savings-button edit" data-bs-toggle="modal"
                                    data-bs-target="#editTabungan{{ $t->id }}"><i class="fa fa-edit"></i>
                                    Edit</a>

                                @csrf
                                @method('DELETE')
                                <button class="savings-button hapus"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus tabungan ini?')">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>

                            </div>
                        </form>
                        <div class="savings-buttons-container">
                            <button class="savings-button"><i class="fa fa-piggy-bank"></i> Menabung</button>
                        </div>
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
                                @method('PUT') <!-- Ini penting untuk edit/update data -->
                                <div class="modal-body">
                                    <!-- Form Edit Tabungan -->
                                    <!-- Input Judul Tabungan -->
                                    <div class="mb-3">
                                        <label for="judul_tabungan" class="form-label">Judul Tabungan</label>
                                        <input type="text" class="form-control" id="judul_tabungan" name="judul"
                                            placeholder="Masukkan judul tabungan" value="{{ $t->judul }}" required>
                                    </div>

                                    <!-- Input Foto Tabungan -->
                                    <div class="mb-3">
                                        <label for="foto_tabungan" class="form-label">Foto Tabungan</label>

                                        <!-- Pratinjau Foto Saat Ini -->
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/tabungan/'. $t->foto) }}" alt="{{ $t->foto }}"
                                                width="150px">
                                        </div>

                                        <!-- Input File untuk Mengunggah Foto Baru -->
                                        <input type="file" class="form-control" id="foto_tabungan" name="foto"
                                            accept="image/*">
                                        <small class="text-muted">Unggah gambar baru jika ingin mengganti foto.</small>
                                    </div>

                                    <!-- Input Target Nominal -->
                                    <div class="mb-3">
                                        <label for="target_nominal" class="form-label">Target Nominal Tabungan</label>
                                        <input type="number" class="form-control" id="target_nominal" name="target_nominal"
                                            placeholder="Masukkan target nominal tabungan" value="{{ $t->target_nominal }}"
                                            required>
                                    </div>

                                    <!-- Input Target Tanggal Tercapai -->
                                    <div class="mb-3">
                                        <label for="target_tanggal" class="form-label">Target Tanggal Tercapai</label>
                                        <input type="date" class="form-control" id="target_tanggal" name="target_tanggal"
                                            value="{{ $t->target_tanggal }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nominal_terkumpul" class="form-label">Nominal Terkumpul</label>
                                        <input type="number" class="form-control" id="nominal_terkumpul"
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
                                <!-- Form Tambah Tabungan -->
                                <!-- Input Judul Tabungan -->
                                <div class="mb-3">
                                    <label for="judul_tabungan" class="form-label">Judul Tabungan</label>
                                    <input type="text" class="form-control" id="judul_tabungan" name="judul"
                                        placeholder="Masukkan judul tabungan" required>
                                </div>

                                <!-- Input Foto Tabungan -->
                                <div class="mb-3">
                                    <label for="foto_tabungan" class="form-label">Foto Tabungan</label>
                                    <input type="file" class="form-control" id="foto_tabungan" name="foto"
                                        accept="image/*" required>
                                </div>

                                <!-- Input Target Nominal -->
                                <div class="mb-3">
                                    <label for="target_nominal" class="form-label">Target Nominal Tabungan</label>
                                    <input type="number" class="form-control" id="target_nominal" name="target_nominal"
                                        placeholder="Masukkan target nominal tabungan" required>
                                </div>

                                <!-- Input Target Tanggal Tercapai -->
                                <div class="mb-3">
                                    <label for="target_tanggal" class="form-label">Target Tanggal Tercapai</label>
                                    <input type="date" class="form-control" id="target_tanggal" name="target_tanggal"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="nominal_terkumpul" class="form-label">Nominal Awal Tabungan
                                        (Opsional)</label>
                                    <input type="number" class="form-control" id="nominal_terkumpul"
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
