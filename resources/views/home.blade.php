@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Menunggu Persetujuan') }}</span>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahNasabahModal">
                        Tambah Nasabah
                    </button>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <caption>Daftar Nasabah</caption>
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Tempat Lahir</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Nominal Setor</th>
                                    <th scope="col">Status</th>
                                    @if (Auth::user()->role === 'supervisi')
                                        <th scope="col">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>Pria</td>
                                    <td>Jl. Contoh Alamat, Jakarta</td>
                                    <td>Rp. 1.000.000</td>
                                    <td><span class="badge text-bg-secondary">Menunggu</span></td>
                                    @if (Auth::user()->role === 'supervisi')
                                        <td><button class="btn btn-warning btn-sm text-white">Setujui</button></td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pendaftaran Rekening -->
<div class="modal fade" id="tambahNasabahModal" tabindex="-1" aria-labelledby="registerAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerAccountModalLabel">Pendaftaran Rekening Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="registerAccountForm" method="POST" action="{{ route('accounts.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Sesuai KTP</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="birth_place" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="birth_place" name="birth_place" required>
                            </div>
                            <div class="mb-3">
                                <label for="birth_date" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="job_id" class="form-label">Pekerjaan</label>
                                <select class="form-select" id="job_id" name="job_id" required>
                                    @foreach ($jobs as $key => $job)
                                        <option value="{{ $job->job_id }}">{{ $job->job_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="deposit_amount" class="form-label">Nominal Setor</label>
                                <input type="number" class="form-control" id="deposit_amount" name="deposit_amount" required>
                            </div>
                        </div>
            
                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="province_id" class="form-label">Provinsi</label>
                                <select class="form-select" id="province_id" name="province_id" required>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->provice_id }}">{{ $province->province_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="city_id" class="form-label">Kabupaten/Kota</label>
                                <select class="form-select" id="city_id" name="city_id" required></select>
                            </div>
                            <div class="mb-3">
                                <label for="district_id" class="form-label">Kecamatan</label>
                                <select class="form-select" id="district_id" name="district_id" required></select>
                            </div>
                            <div class="mb-3">
                                <label for="subdistrict_id" class="form-label">Kelurahan</label>
                                <select class="form-select" id="subdistrict_id" name="subdistrict_id" required></select>
                            </div>
                            <div class="mb-3">
                                <label for="street_name" class="form-label">Nama Jalan</label>
                                <input type="text" class="form-control" id="street_name" name="street_name" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="rt" class="form-label">RT</label>
                                    <input type="text" class="form-control" id="rt" name="rt" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="rw" class="form-label">RW</label>
                                    <input type="text" class="form-control" id="rw" name="rw" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Daftar Rekening</button>
                </div>
            </form>            
        </div>
    </div>
</div>
@endsection