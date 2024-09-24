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
                    {{-- <form action="{{ route('report.add') }}" method="POST" id="data-form" enctype="multipart/form-data">
                        @csrf --}}
                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <!-- Step 1 -->
                    <div class="step" id="step-1">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="destination_id">Choose Destination</label>
                                    <select class="form-control" id="destination_id" name="destination_id">
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
                                    <label for="license_plate">License Plate</label>
                                    <input type="text" class="form-control" id="license_plate">
                                    @error('license_plate')
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
                                    <select class="form-control" id="kode_limbah">
                                        <option value="">-- Select Limbah --</option>
                                        @foreach ($limbah as $l)
                                            <option value="{{ $l->id }}" data-nama="{{ $l->nama_limbah }}">
                                                {{ $l->kode_limbah }}</option>
                                        @endforeach
                                    </select>
                                    @error('kode_limbah')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nama_limbah">Limbah Name</label>
                                    <input type="text" class="form-control" id="nama_limbah" readonly>
                                    @error('nama_limbah')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <div class="d-flex">
                                        <input type="number" class="form-control" id="quantity"
                                            placeholder="Enter quantity">
                                        <select class="form-control ml-2" id="unit" style="max-width: 80px;">
                                            <option value="KG">KG</option>
                                            <option value="PCS">PCS</option>
                                        </select>
                                    </div>
                                    @error('quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="description">Description (Optional)</label>
                                    <textarea class="form-control" id="description" rows="1" style="width: 100%; max-height: 70px;"></textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="photo">Photo (Optional)</label>
                                    <input type="file" class="form-control" id="photo">
                                    @error('photo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" id="prev-step">Previous</button>
                            <button type="button" class="btn btn-success" id="add-detail">Add Detail</button>
                        </div>
                    </div>

                    <!-- Summary of added details -->
                    <div id="details-summary" class="pd-20 mt-4">
                        <h4>Details Summary</h4>
                        <table class="table table-striped" id="details-table">
                            <thead>
                                <tr>
                                    <th scope="col">Limbah Code</th>
                                    <th scope="col">Limbah Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Unit</th>

                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="details-tbody">
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" id="submit-form">Submit</button>
                    </div>
                    {{-- </form> --}}
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
                            <th scope="col">Destination</th>
                            <th scope="col">Date</th>
                            <th scope="col">License Plate</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($report as $item)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $item->destination->nama_destinasi }}</td>
                                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                <td>{{ $item->license_plate }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <button type="button" class="btn btn-info btn-sm"
                                        onclick="showDetail({{ $item->id }})">
                                        <i class="icon-copy bi bi-eye"></i> Detail
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteReport({{ $item->id }})">
                                        <i class="icon-copy bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No Data Available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function deleteReport(id) {
            if (confirm('Apakah Anda yakin ingin menghapus form limbah ini?')) {
                fetch(`/report/delete/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Pastikan untuk menyertakan CSRF token jika menggunakan Laravel
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message) {
                            alert(data.message);
                            location.reload();
                            // Refresh atau update tampilan tabel sesuai kebutuhan
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

        function showDetail(itemId) {
            fetch(`/report/detail/${itemId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Detail tidak ditemukan');
                    }
                    return response.json();
                })
                .then(detail => {
                    // Ambil tbody untuk menampilkan detail
                    const detailsTbody = document.getElementById('details-tbody');
                    detailsTbody.innerHTML = ''; // Kosongkan isi tbody
                    let row = '';
                    // Tambahkan baris baru ke tabel dengan data detail
                    detail.details.forEach((element, index) => {
                        row += `
                            <tr>
                                <td>${element.limbah.kode_limbah}</td>
                                <td>${element.limbah.nama_limbah}</td>
                                <td>${element.quantity}</td>
                                <td>${element.unit}</td>    
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" onclick="editDetail(${index})">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteDetail(${index})">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                    detailsTbody.insertAdjacentHTML('beforeend', row);
                    document.getElementById('step1').style.display = 'none';
                    document.getElementById('step2').style.display = 'block';
                })
                .catch(error => {
                    console.error('Error:', error);
                    const detailsTbody = document.getElementById('details-tbody');
                    detailsTbody.innerHTML =
                        '<tr><td colspan="7" class="text-center">Detail tidak ditemukan</td></tr>';
                });
        }
        // Array to store all details
        let details = [];
        let currentEditIndex = null; // Tambahkan ini untuk melacak index yang sedang diedit
        let step1Data = {
            destination_id: '',
            license_plate: ''
        };

        // Event listeners
        document.getElementById('kode_limbah').addEventListener('change', handleLimbahChange);
        document.getElementById('next-step').addEventListener('click', handleNextStep);
        document.getElementById('prev-step').addEventListener('click', handlePrevStep);
        document.getElementById('add-detail').addEventListener('click', addDetail);
        document.getElementById('submit-form').addEventListener('click', submitForm);

        // Handle change in Limbah selection
        function handleLimbahChange() {
            const limbahSelect = document.getElementById('kode_limbah');
            const selectedOption = limbahSelect.options[limbahSelect.selectedIndex];
            const namaLimbah = selectedOption.getAttribute('data-nama');
            document.getElementById('nama_limbah').value = namaLimbah;
        }

        // Handle clicking the Next button to proceed to the next step
        function handleNextStep() {
            step1Data.destination_id = document.getElementById('destination_id').value;
            step1Data.license_plate = document.getElementById('license_plate').value;

            if (step1Data.destination_id && step1Data.license_plate) {
                showStep(2); // Proceed to step 2
            } else {
                alert('Please fill in all fields in Step 1.');
            }
        }

        function addDetail() {
            const destinationId = step1Data.destination_id;
            const noPolicy = step1Data.license_plate;
            const destinationInput = document.getElementById('destination_id');
            const destinationName = destinationInput.options[destinationInput.selectedIndex].text;

            const limbahSelect = document.getElementById('kode_limbah');
            const selectedLimbahId = limbahSelect.value;
            const selectedLimbahName = limbahSelect.options[limbahSelect.selectedIndex].dataset.nama;
            const quantity = document.getElementById('quantity').value;
            const unit = document.getElementById('unit').value;

            if (selectedLimbahId && quantity && unit) {
                const detail = {
                    kode_limbah: selectedLimbahId,
                    nama_limbah: selectedLimbahName,
                    quantity: quantity,
                    unit: unit,
                    nama_destinasi: destinationName,
                    license_plate: noPolicy
                };

                if (currentEditIndex !== null) {
                    // Jika ada index edit, ganti detail yang ada
                    details[currentEditIndex] = detail;
                    currentEditIndex = null; // Reset index edit setelah mengedit
                } else {
                    // Jika tidak dalam mode edit, tambahkan detail baru
                    details.push(detail);
                }

                renderDetails(); // Tampilkan detail yang telah diperbarui
                resetForm(); // Reset form input
                showStep(2); // Tampilkan step berikutnya
            } else {
                alert('Please fill in all fields.');
            }
        }

        function editDetail(id) {
            // Ambil detail dari database berdasarkan ID
            fetch(`/api/details/${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Detail not found');
                    }
                    return response.json();
                })
                .then(selectedDetail => {
                    // Isi form dengan data yang diambil
                    const limbahSelect = document.getElementById('kode_limbah');
                    limbahSelect.value = selectedDetail.kode_limbah;
                    document.getElementById('nama_limbah').value = selectedDetail.nama_limbah;
                    document.getElementById('quantity').value = selectedDetail.quantity;
                    document.getElementById('unit').value = selectedDetail.unit;

                    // Hapus detail dari tampilan (baris tabel) berdasarkan ID
                    details = details.filter(detail => detail.id !== id);
                    renderDetails(); // Tampilkan detail yang telah diperbarui

                    // Set currentEditIndex ke ID yang sedang diedit
                    currentEditIndex = id;
                    showStep(2);
                    resetForm(); // Tampilkan step 2
                })
                .catch(error => {
                    console.error(error);
                });
        }

        document.getElementById('show-detail').addEventListener('click', function() {
            document.getElementById('step-1').style.display = 'none'; // Sembunyikan step 1
            document.getElementById('step-2').style.display = 'block'; // Tampilkan step 2
        });

        function showDetail(itemId) {
            fetch(`/report/detail/${itemId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Detail tidak ditemukan');
                    }
                    return response.json();
                })
                .then(detail => {
                    // Ambil tbody untuk menampilkan detail
                    const detailsTbody = document.getElementById('details-tbody');
                    detailsTbody.innerHTML = ''; // Kosongkan isi tbody
                    let row = '';
                    // Tambahkan baris baru ke tabel dengan data detail
                    detail.details.forEach((element) => {
                        row += `
                            <tr>
                                <td>${element.limbah.kode_limbah}</td>
                                <td>${element.limbah.nama_limbah}</td>
                                <td>${element.quantity}</td>
                                <td>${element.unit}</td>    
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" onclick="editDetail(${element.id})">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteDetail(${element.id})">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                    detailsTbody.insertAdjacentHTML('beforeend', row);
                })
                .catch(error => {
                    console.error('Error:', error);
                    const detailsTbody = document.getElementById('details-tbody');
                    detailsTbody.innerHTML =
                        '<tr><td colspan="7" class="text-center">Detail tidak ditemukan</td></tr>';
                });
        }

        document.getElementById('prev-step').addEventListener('click', handlePrevStep);

        // Fungsi untuk menangani klik pada tombol Previous
        function handlePrevStep() {
            // Kembali ke langkah sebelumnya, misalnya langkah 1
            showStep(1);
        }

        function updatePreviousButton() {
            const prevButton = document.getElementById('prev-step');
            const detailsTable = document.getElementById('details-table');
            const hasRows = detailsTable.getElementsByTagName('tr').length >
                1; // Cek jumlah baris, minus header

            // Enable or disable the Previous button based on the number of rows
            prevButton.disabled = hasRows; // Disable if there are rows, enable if there are none
        }

        // Render details in the table
        function renderDetails() {
            const detailsTbody = document.getElementById('details-tbody');
            detailsTbody.innerHTML = '';

            details.forEach((detail, index) => {
                const row = `
                    <tr>
                        <td>${detail.kode_limbah}</td>
                        <td>${detail.nama_limbah}</td>
                        <td>${detail.quantity}</td>
                        <td>${detail.unit}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" onclick="editDetail(${index})">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteDetail(${index})">Delete</button>
                        </td>
                    </tr>
                `;
                detailsTbody.insertAdjacentHTML('beforeend', row);
            });

            updatePreviousButton();
        }

        // Submit form to the server
        function submitForm() {
            const detailsArray = details.map(detail => ({
                limbah_id: detail.kode_limbah,
                quantity: detail.quantity,
                unit: detail.unit,
                description: detail.description || '',
                photo: detail.photo || null,
            }));

            const formData = new FormData();
            formData.append('destination_id', step1Data.destination_id);
            formData.append('license_plate', step1Data.license_plate);
            formData.append('details', JSON.stringify(detailsArray));

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/report/add', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                    // Reset the form after success
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Utility functions

        function showStep(stepNumber) {
            document.querySelectorAll('.step').forEach(step => step.style.display = 'none');
            document.getElementById(`step-${stepNumber}`).style.display = 'block';
        }

        function resetForm() {
            document.getElementById('kode_limbah').value = '';
            document.getElementById('nama_limbah').value = ''; // Memperbaiki kesalahan penamaan
            document.getElementById('quantity').value = '';
            document.getElementById('unit').value = 'KG'; // Ubah menjadi huruf besar sesuai pilihan
            document.getElementById('description').value = '';
            document.getElementById('photo').value = ''; // Reset photo input
        }

        function deleteDetail(index) {
            // Hapus detail dari array
            details.splice(index, 1);
            renderDetails(); // Tampilkan detail yang telah diperbarui
        }
    </script>
@endpush
