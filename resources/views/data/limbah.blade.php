@extends('layout.app')
@section('title', 'Limbah')
@section('content')
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Limbah</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Master Data</li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Limbah
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Tempatkan pesan notifikasi di sini -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="pd-20 card-box mb-30">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Add/Edit Limbah</h4>
                    </div>
                    <form action="{{ route('limbah.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" id="form_method" value="POST">
                        <input type="hidden" name="id" id="limbah_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kode_limbah">Code</label>
                                    <input type="text" name="kode_limbah" class="form-control" id="kode_limbah" required>
                                    @error('kode_limbah')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_limbah">Name</label>
                                    <input type="text" name="nama_limbah" class="form-control" id="nama_limbah" required>
                                    @error('nama_limbah')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- List Limbah Table -->
            <div class="clearfix mb-20" style="padding-top: 24px">
                <div class="pull-left">
                    <h4 class="text-blue h4">List Limbah</h4>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped" id="documentTableBody">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($limbah as $item)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $item->kode_limbah }}</td>
                                <td>{{ $item->nama_limbah }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <button class="btn btn-warning btn-sm"
                                        onclick="editLimbah({{ $item->id }}, '{{ $item->kode_limbah }}', '{{ $item->nama_limbah }}')">
                                        <i class="icon-copy bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#deletemodal-{{ $item->id }}">
                                        <i class="icon-copy bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No Data Available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @foreach ($limbah as $item)
        <div class="modal fade" id="deletemodal-{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center font-18">
                        <h4 class="padding-top-30 mb-30 weight-500">
                            Are you sure you want to delete?
                        </h4>
                        <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto">
                            <div class="col-6">
                                <button type="button"
                                    class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                    data-dismiss="modal">
                                    <i class="fa fa-times"></i>
                                </button>
                                NO
                            </div>
                            <div class="col-6">
                                <form action="{{ route('limbah.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-primary border-radius-100 btn-block confirmation-btn">
                                        <i class="fa fa-check"></i>
                                    </button>
                                    YES
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Script untuk mengisi form edit -->
    <script>
        function editLimbah(id, code, name) {
            // Set nilai pada form edit
            document.getElementById('limbah_id').value = id;
            document.getElementById('kode_limbah').value = code;
            document.getElementById('nama_limbah').value = name;

            // Ubah method form menjadi PUT untuk update
            document.getElementById('form_method').value = 'PUT';

            // Set action URL ke route update
            document.querySelector('form').action = '{{ route('limbah.update', ':id') }}'.replace(':id', id);
        }

        // Menyembunyikan alert setelah 3 detik
        setTimeout(function() {
            $('.alert').alert('close');
        }, 3000); // 3000 ms = 3 detik
    </script>
@endsection
