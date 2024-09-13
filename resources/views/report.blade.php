@extends('layout.app')
@section('title', 'Limbah')
@section('content')
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Report</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Report
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
                        <h4>Add Report</h4>
                    </div>
                    <form action="{{ route('report.add') }}" method="POST" id="form-limbah" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" id="form_method" value="POST">

                        <!-- Step 1 -->
                        <div class="step" id="step-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="destination_id">Choose Destination</label>
                                        <select name="destination_id" class="form-control" id="destination_id" required>
                                            <option value="">-- Select Destination --</option>
                                            @foreach ($destination as $d)
                                                <option value="{{ $d->id }}">{{ $d->nama_destinasi }}</option>
                                            @endforeach
                                        </select>
                                        @error('destination_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_policy">Vehicle Number</label>
                                        <input type="text" name="no_policy" class="form-control" id="no_policy" required>
                                        @error('no_policy')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary" id="next-step">Next</button>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="step" id="step-2" style="display: none;">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kode_limbah">Limbah Code</label>
                                        <select name="kode_limbah[]" class="form-control" id="kode_limbah" required>
                                            <option value="">-- Select Limbah --</option>
                                            @foreach ($limbah as $l)
                                                <option value="{{ $l->kode_limbah }}">{{ $l->kode_limbah }}</option>
                                            @endforeach
                                        </select>
                                        @error('kode_limbah.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nama_limbah">Limbah Name</label>
                                        <input type="text" name="nama_limbah[]" class="form-control" id="nama_limbah"
                                            required>
                                        @error('nama_limbah.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <div class="d-flex">
                                            <input type="number" name="quantity[]" class="form-control" id="quantity"
                                                placeholder="Enter quantity" required>
                                            <select name="unit[]" class="form-control ml-2" id="unit"
                                                style="max-width: 80px;">
                                                <option value="KG">KG</option>
                                                <option value="PCS">PCS</option>
                                            </select>
                                        </div>
                                        @error('quantity.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="no_truck">No Truck</label>
                                        <input type="text" name="no_truck" class="form-control" id="no_truck" required>
                                        @error('no_truck')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control" id="description" rows="1"
                                            style="width: 100%; max-height: 70px;" required></textarea>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="photo">Photo</label>
                                        <input type="file" name="photo" class="form-control" id="photo"
                                            required>
                                        @error('photo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" id="prev-step">Previous</button>
                                <button type="submit" class="btn btn-success"><i class="icon-copy bi bi-plus"></i>
                                    Add</button>
                            </div>
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
                        @forelse ($report as $item)
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
    @foreach ($report as $item)
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
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const nextStepButton = document.getElementById('next-step');
                const prevStepButton = document.getElementById('prev-step');
                const step1 = document.getElementById('step-1');
                const step2 = document.getElementById('step-2');

                nextStepButton.addEventListener('click', function() {
                    step1.style.display = 'none';
                    step2.style.display = 'block';
                });

                prevStepButton.addEventListener('click', function() {
                    step1.style.display = 'block';
                    step2.style.display = 'none';
                });
            });

            function editLimbah(id, kode_limbah, nama_limbah) {
                document.getElementById('report_id').value = id;
                document.getElementById('kode_limbah').value = kode_limbah;
                document.getElementById('nama_limbah').value = nama_limbah;
                document.getElementById('form_method').value = 'PUT'; // Mengubah metode menjadi PUT untuk update
                document.getElementById('step-1').style.display = 'none';
                document.getElementById('step-2').style.display = 'block';
            }
        </script>
    @endpush
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
        document.addEventListener('DOMContentLoaded', function() {
            const step1 = document.getElementById('step-1');
            const step2 = document.getElementById('step-2');
            const nextStep = document.getElementById('next-step');
            const prevStep = document.getElementById('prev-step');

            // Event listener untuk tombol Next
            nextStep.addEventListener('click', function() {
                step1.style.display = 'none'; // Sembunyikan step 1
                step2.style.display = 'block'; // Tampilkan step 2
            });

            // Event listener untuk tombol Previous
            prevStep.addEventListener('click', function() {
                step1.style.display = 'block'; // Tampilkan step 1
                step2.style.display = 'none'; // Sembunyikan step 2
            });
        });
    </script>
    <script>
        // Data limbah dari server
        const limbahData = @json($limbah);

        document.addEventListener('DOMContentLoaded', function() {
            const kodeLimbahSelects = document.querySelectorAll('#kode_limbah');
            kodeLimbahSelects.forEach(function(select) {
                select.addEventListener('change', function() {
                    const selectedKodeLimbah = this.value;
                    const correspondingLimbah = limbahData.find(limbah => limbah.kode_limbah ===
                        selectedKodeLimbah);

                    if (correspondingLimbah) {
                        // Temukan input nama limbah yang sesuai
                        const namaLimbahInput = this.closest('.row').querySelector(
                            'input[name="nama_limbah[]"]');
                        namaLimbahInput.value = correspondingLimbah.nama_limbah;
                    }
                });
            });
        });
    </script>
@endsection
