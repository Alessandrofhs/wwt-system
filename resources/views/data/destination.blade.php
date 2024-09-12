@extends('layout.app')
@section('title', 'Destination')
@section('content')
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Destination</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Master Data</li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Destination
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
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
                        <h4>Add/Edit Destination</h4>
                    </div>
                    <form action="{{ route('destination.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" id="form_method" value="POST">
                        <!-- Untuk metode edit/update -->
                        <input type="hidden" name="id" id="destinasi_id"> <!-- Menampung id destinasi -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama_destinasi">Nama Destinasi</label>
                                    <input type="text" class="form-control" name="nama_destinasi" id="nama_destinasi">
                                    @error('nama_destinasi')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="clearfix mb-20" style="padding-top: 24px">
                <div class="pull-left">
                    <h4 class="text-blue h4">List Destination</h4>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped" id="documentTableBody">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($destination as $item)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $item->nama_destinasi }}</td>
                                <td><!-- Tombol Edit -->
                                    <button class="btn btn-warning btn-sm"
                                        onclick="editDestination({{ $item->id }}, '{{ $item->nama_destinasi }}')">
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

        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By
            <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
        </div>
    </div>
    @foreach ($destination as $item)
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
                                <form action="{{ route('destination.delete', $item->id) }}" method="POST">
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
    <script>
        function editDestination(id, nama_destinasi) {
            // Set nilai pada form edit
            document.getElementById('destinasi_id').value = id;
            document.getElementById('nama_destinasi').value = nama_destinasi;

            // Ubah method form menjadi PUT untuk update
            document.getElementById('form_method').value = 'PUT';

            // Set action URL ke route update
            document.querySelector('form').action = '{{ route('destination.update', ':id') }}'.replace(':id', id);
        }
        setTimeout(function() {
            $('.alert').alert('close');
        }, 3000);
    </script>
@endsection
