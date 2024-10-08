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
                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

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
                                        <input type="text" class="form-control" id="license_plate" name="license_plate">
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
                                        <input type="text" class="form-control" id="nama_limbah" name="nama_limbah"
                                            readonly>
                                        @error('nama_limbah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <div class="d-flex">
                                            <input type="number" class="form-control" id="quantity" name="quantity"
                                                placeholder="Enter quantity">
                                            <select class="form-control ml-2" id="unit" name="unit"
                                                style="max-width: 80px;">
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
                                        <textarea class="form-control" id="description" name="description" rows="1"
                                            style="width: 100%; max-height: 70px;"></textarea>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="photo">Photo (Optional)</label>
                                        <input type="file" class="form-control" id="photo" name="photo">
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
                            <input type="hidden" name="details" id="details">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="submit-form">Submit</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to handle next step navigation
        document.getElementById('next-step').addEventListener('click', function() {
            document.getElementById('step-1').style.display = 'none';
            document.getElementById('step-2').style.display = 'block';
        });

        // Function to handle previous step navigation
        document.getElementById('prev-step').addEventListener('click', function() {
            document.getElementById('step-2').style.display = 'none';
            document.getElementById('step-1').style.display = 'block';
        });

        // Event listener for adding details
        document.getElementById('add-detail').addEventListener('click', function() {
            const kodeLimbah = document.getElementById('kode_limbah');
            const namaLimbah = document.getElementById('nama_limbah');
            const quantity = document.getElementById('quantity');
            const unit = document.getElementById('unit');
            const description = document.getElementById('description'); // Tambahkan elemen input untuk description
            const photo = document.getElementById('photo'); // Tambahkan elemen input untuk photo

            // Check if any required field is empty
            if (!kodeLimbah.value || !quantity.value) {
                alert("Please fill in the required fields.");
                return;
            }

            // Get the selected text for kode limbah
            const selectedLimbahCode = kodeLimbah.options[kodeLimbah.selectedIndex].text;

            // Check for duplicate kode limbah in the summary table
            const existingRows = document.querySelectorAll('#details-tbody tr');
            for (let row of existingRows) {
                const existingCode = row.cells[0].innerText; // Assuming kode limbah is in the first cell
                if (existingCode === selectedLimbahCode) {
                    alert("This Limbah Code is already added to the detail. Please select a different code.");
                    return;
                }
            }

            // Create a new row for the summary
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
        <td>${selectedLimbahCode}</td>  <!-- Use the text of the selected option -->
        <td>${namaLimbah.value}</td>
        <td>${quantity.value}</td>
        <td>${unit.value}</td>
        <td>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeDetail(this)">Remove</button>
        </td>
    `;

            // Append the new row to the details summary table
            document.getElementById('details-tbody').appendChild(newRow);

            // Add the detail to hidden input, including description and photo
            addDetailToHiddenInput(kodeLimbah.value, namaLimbah.value, quantity.value, unit.value, description
                .value, photo.files[0]); // Ambil photo sebagai file

            // Clear the inputs after adding
            kodeLimbah.value = '';
            namaLimbah.value = '';
            quantity.value = '';
            unit.value = '';
            description.value = ''; // Reset description input
            photo.value = ''; // Reset photo input

            // Disable the Previous button
            const previousButton = document.getElementById('prev-step');
            previousButton.disabled = true;
        });

        function addDetailToHiddenInput(kodeLimbah, namaLimbah, quantity, unit, description, photo) {
            const detailsInput = document.getElementById('details');
            // Get existing details or initialize empty array
            const existingDetails = detailsInput.value ? JSON.parse(detailsInput.value) : [];

            // Add the new detail
            existingDetails.push({
                kode_limbah: kodeLimbah,
                nama_limbah: namaLimbah,
                quantity: quantity,
                unit: unit,
                description: description, // Simpan description ke dalam detail
                photo: photo ? photo.name : null // Simpan nama file photo ke dalam detail
            });

            // Update the hidden input with the new details
            detailsInput.value = JSON.stringify(existingDetails);
        }

        // Function to auto-save data (You can replace this with your actual saving logic)
        function autoSaveData(row) {
            // Here, you can implement your actual saving logic (e.g., AJAX request to the server)
            console.log("Data saved:", row.innerHTML);
        }

        function removeDetail(button) {
            // Dapatkan baris (tr) dari tombol yang diklik
            var row = button.closest('tr');
            // Hapus baris tersebut dari tabel
            row.remove();
        }
        // Example remove function (if you need it)
        function removestoreDetail(button) {
            const detailId = button.getAttribute('data-id'); // Ambil ID detail dari atribut data-id
            const row = button.closest('tr'); // Ambil baris (tr) tempat tombol berada

            if (confirm("Are you sure you want to delete this detail?")) {
                fetch(`/report/detail/delete/${detailId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            // Hapus baris dari tabel jika penghapusan berhasil
                            row.remove();
                        } else {
                            alert('Error deleting detail.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        }

        // Function to show report details
        function showDetail(id) {
            fetch(`/report/detail/${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data); // Debugging: tampilkan data
                    if (data.details) {
                        populateDetailsTable(data.details);
                    } else {
                        console.error('Details are missing in the response:', data);
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        function populateDetailsTable(details) {
            const tbody = document.getElementById('details-tbody');
            tbody.innerHTML = ''; // Kosongkan tabel sebelum menambahkan data baru

            details.forEach(detail => {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td>${detail.limbah.kode_limbah}</td>
            <td>${detail.limbah.nama_limbah}</td>
            <td>${detail.quantity}</td>
            <td>${detail.unit}</td>
            <td>
                <button type="button" class="btn btn-warning btn-sm" data-id="${detail.id}" onclick="editDetail(this)">Edit</button>
                <button type="button" class="btn btn-danger btn-sm" data-id="${detail.id}" onclick="removestoreDetail(this)">Remove</button>
            </td>
        `;
                tbody.appendChild(row);
            });
        }

        // Function to delete a report
        function deleteReport(id) {
            if (confirm("Are you sure you want to delete this report?")) {
                // Implement the AJAX request to delete the report
                // Example:
                fetch(`/report/delete/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            // Refresh the page or remove the row from the table
                            location.reload();
                        } else {
                            alert('Error deleting report.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        }

        function editDetail(button) {
            const detailId = button.getAttribute('data-id'); // Ambil ID detail dari atribut data-id
            const row = button.closest('tr'); // Ambil baris (tr) tempat tombol berada

            // Ambil sel dalam baris yang ingin diedit
            const kodeLimbahCell = row.querySelector('td:nth-child(1)'); // Mengganti limbahIdCell dengan kodeLimbahCell
            const namaLimbahCell = row.querySelector('td:nth-child(2)');
            const quantityCell = row.querySelector('td:nth-child(3)');
            const unitCell = row.querySelector('td:nth-child(4)');

            // Simpan nilai lama untuk digunakan saat cancel
            const oldKodeLimbah = kodeLimbahCell.textContent.trim(); // Mengganti oldLimbahId dengan oldKodeLimbah
            const oldNamaLimbah = namaLimbahCell.textContent.trim();
            const oldQuantity = quantityCell.textContent.trim();
            const oldUnit = unitCell.textContent.trim();

            // Fetch data limbah dari server untuk populasi dropdown
            fetch('/api/limbah') // Pastikan Anda membuat route API untuk mendapatkan data limbah
                .then(response => response.json())
                .then(data => {
                    // Buat dropdown untuk limbah_id dengan data yang diterima dari server
                    let limbahDropdown = `<select id="edit-limbah-id" class="form-control">`;
                    data.forEach(limbah => {
                        // Pastikan membandingkan ID dengan benar, gunakan tipe data yang sama
                        limbahDropdown += `
                    <option value="${limbah.id}" ${oldKodeLimbah == limbah.kode_limbah ? 'selected' : ''}>
                        ${limbah.kode_limbah} <!-- Menggunakan kode_limbah untuk ditampilkan -->
                    </option>
                `;
                    });
                    limbahDropdown += `</select>`;

                    // Replace cell content dengan dropdown untuk limbah_id
                    kodeLimbahCell.innerHTML = limbahDropdown;

                    // Menampilkan nama limbah yang sesuai dengan oldKodeLimbah jika tidak ada yang dipilih
                    namaLimbahCell.innerHTML = `
                <input type="text" value="${oldNamaLimbah}" class="form-control" id="edit-nama-limbah" disabled>
            `;

                    quantityCell.innerHTML = `
                <input type="number" value="${oldQuantity}" class="form-control" id="edit-quantity">
            `;

                    // Tambahkan dropdown untuk unit dengan opsi "kg" dan "pcs"
                    unitCell.innerHTML = `
                <select id="edit-unit" class="form-control">
                    <option value="kg" ${oldUnit === 'kg' ? 'selected' : ''}>kg</option>
                    <option value="pcs" ${oldUnit === 'pcs' ? 'selected' : ''}>pcs</option>
                </select>
            `;

                    // Ganti tombol "Edit" dengan tombol "Save" dan "Cancel"
                    button.outerHTML = `
                <button type="button" class="btn btn-success btn-sm" data-id="${detailId}" onclick="saveEditDetail(this)">Save</button>
                <button type="button" class="btn btn-secondary btn-sm" onclick="cancelEdit(this, ${detailId}, '${oldKodeLimbah}', '${oldNamaLimbah}', '${oldQuantity}', '${oldUnit}')">Cancel</button>
            `;

                    // Tambahkan event listener untuk mengubah nama limbah saat kode dipilih
                    document.getElementById('edit-limbah-id').addEventListener('change', function() {
                        const selectedLimbahId = this.value;
                        const selectedLimbah = data.find(limbah => limbah.id == selectedLimbahId);
                        if (selectedLimbah) {
                            document.getElementById('edit-nama-limbah').value = selectedLimbah
                                .nama_limbah; // Mengupdate nama limbah
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching limbah data:', error);
                });
        }

        function saveEditDetail(button) {
            const detailId = button.getAttribute('data-id'); // Ambil ID detail dari atribut data-id
            const row = button.closest('tr'); // Ambil baris (tr) tempat tombol berada

            // Ambil nilai dari input
            const limbahId = row.querySelector('#edit-limbah-id').value;
            const namaLimbah = row.querySelector('#edit-nama-limbah').value;
            const quantity = row.querySelector('#edit-quantity').value;
            const unit = row.querySelector('#edit-unit').value;

            // Ambil CSRF token dari meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Buat payload untuk dikirim
            const payload = {
                limbah_id: limbahId,
                nama_limbah: namaLimbah,
                quantity: quantity,
                unit: unit,
                _token: csrfToken // Tambahkan CSRF token ke dalam payload
            };

            // Kirim permintaan menggunakan jQuery AJAX
            $.ajax({
                url: `/report/detail/update/${detailId}`,
                type: 'PUT', // Pastikan menggunakan PUT untuk pembaruan
                data: payload,
                success: function(response) {
                    // Tangani respons sukses
                    console.log('Success:', response);
                    // Update tampilan atau beri notifikasi ke user
                    alert('Detail updated successfully!');
                    console.log(detailId);
                    showDetail(detailId); // Pastikan fungsi ini memuat detail yang benar
                },
                error: function(xhr, status, error) {
                    // Tangani kesalahan
                    console.error('Error:', error);
                    alert('Error occurred while updating detail.');
                }
            });
        }


        function cancelEdit(button, detailId) {
            // Panggil fungsi showDetail dengan detailId yang sesuai
            showDetail(detailId);
        }

        // Populate Limbah Name when selecting a Limbah Code
        document.getElementById('kode_limbah').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            document.getElementById('nama_limbah').value = selectedOption.getAttribute('data-nama');
        });
    </script>
@endpush
