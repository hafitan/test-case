@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Menunggu Persetujuan') }}</span>
                    @if (Auth::user()->role === 'cs')
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahNasabahModal">
                            Tambah Nasabah
                        </button>
                    @endif
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
                                    <th scope="col" class="fs-6">#</th>
                                    <th scope="col" class="fs-6">Nama</th>
                                    <th scope="col" class="fs-6">Tempat Lahir</th>
                                    <th scope="col" class="fs-6">Tanggal Lahir</th>
                                    <th scope="col" class="fs-6">Jenis Kelamin</th>
                                    <th scope="col" class="fs-6">Alamat</th>
                                    <th scope="col" class="fs-6">Nominal Setor</th>
                                    <th scope="col" class="fs-6">Status</th>
                                    @if (Auth::user()->role === 'supervisi')
                                        <th scope="col" class="fs-6"></th>
                                    @endif
                                </tr>                                
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td scope="row">{{ $i++ }}</td>
                                        <td>{{ $account->name_account }}</td>
                                        <td>{{ $account->birth_place }}</td>
                                        <td>{{ \Carbon\Carbon::parse($account->birth_date)->format('Y-m-d') }}</td>
                                        <td>{{ $account->gender }}</td>
                                        <td>{{ $account->street_name }}</td>
                                        <td>{{ 'Rp ' . number_format($account->deposit_amount, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($account->status === 'disetujui')
                                                <span class="badge bg-success">{{ $account->status }}</span>
                                            @else
                                                <span class="badge text-bg-secondary">{{ $account->status }}</span>
                                            @endif
                                        </td>
                                        @if (Auth::user()->role === 'supervisi')
                                            <td>
                                                <button 
                                                    class="btn btn-sm text-white 
                                                    @if ($account->status === 'disetujui') 
                                                        btn-secondary 
                                                    @else 
                                                        btn-warning 
                                                    @endif"
                                                    @if ($account->status === 'disetujui') 
                                                        disabled 
                                                    @endif
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#updateStatusModal"
                                                    data-id="{{ $account->account_id }}" 
                                                    onclick="setUpdateId(this)">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <!-- Previous Page Button -->
                                <li class="page-item {{ $accounts->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $accounts->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo; Previous</span>
                                    </a>
                                </li>
                        
                                <!-- Page Numbers -->
                                @for ($i = 1; $i <= $accounts->lastPage(); $i++)
                                    <li class="page-item {{ $accounts->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $accounts->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                        
                                <!-- Next Page Button -->
                                <li class="page-item {{ !$accounts->hasMorePages() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $accounts->nextPageUrl() }}" aria-label="Next">
                                        <span aria-hidden="true">Next &raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
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
                                <label for="name_account" class="form-label">Nama Sesuai KTP</label>
                                <input type="text" class="form-control" id="name_account" name="name_account" required>
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
                                <select id="job_id" class="form-select" name="job_id">
                                    @foreach ($jobs as $job)
                                        <option value="{{ $job->job_id }}">{{ $job->job_name }}</option>
                                     @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="deposit_amount" class="form-label">Nominal Setor</label>
                                <input type="number" class="form-control" id="deposit_amount" name="deposit_amount" min="1" required>
                            </div>
                        </div>
            
                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="province_id" class="form-label">Provinsi</label>
                                <select class="form-select" id="province_id" name="province_id" required>
                                    <option value="">Pilih Provinsi</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->province_id }}">{{ $province->province_name }}</option>
                                    @endforeach
                                </select>
                            </div>         
                            <div class="mb-3">
                                <label for="district_id" class="form-label">Kota</label>
                                <select class="form-select" id="district_id" name="district_id" required></select>
                            </div>                   
                            <div class="mb-3">
                                <label for="subdistrict_id" class="form-label">Kecamatan</label>
                                <select class="form-select" id="subdistrict_id" name="subdistrict_id" required></select>
                            </div>
                            <div class="mb-3">
                                <label for="ward_id" class="form-label">Kelurahan</label>
                                <select class="form-select" id="ward_id" name="ward_id" required></select>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#province_id').on('change', function() {
        var provinceId = $(this).val();
        if (provinceId) {
            $.ajax({
                url: '/get-districts/' + provinceId,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#district_id').empty();
                    $('#district_id').append('<option value="">Pilih Kota</option>');
                    $.each(data, function(key, value) {
                        $('#district_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        }
    });

    $(document).ready(function() {
        $('#district_id').on('change', function() {
            var districtId = $(this).val();
            if (districtId) {
                $.ajax({
                    url: '/get-subdistricts/' + districtId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#subdistrict_id').empty();
                        $('#subdistrict_id').append('<option value="">Pilih Kecamatan</option>');
                        $.each(data, function(key, value) {
                            $('#subdistrict_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            }
        });
    });

    $(document).ready(function() {
    $('#subdistrict_id').on('change', function() {
        var subdistrictId = $(this).val();
        if (subdistrictId) {
            $.ajax({
                url: '/get-ward/' + subdistrictId,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log("Data received:", data);
                    $('#ward_id').empty();
                    $('#ward_id').append('<option value="">Pilih Kelurahan</option>');
                    $.each(data, function(key, value) {
                        console.log("Processing item:", key, value);
                        $('#ward_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("AJAX Error:", textStatus, errorThrown);
                    }
                });
            }
        });
    });
    
    });
</script>

<div class="modal" tabindex="-1" id="updateStatusModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Persetujuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menyetujui pembukaan rekening nasabah?</p>
            </div>
            <form id="updateStatusForm" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" name="account_id" id="updateId">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Setuju</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function setUpdateId(button) {
        var id = button.getAttribute('data-id');
        var form = document.getElementById('updateStatusForm');
        form.action = `/update/approval/${id}`;
        document.getElementById('updateId').value = id;
    }
</script>
