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
                    <form action="{{ route('report.add') }}" method="POST" id="data-form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" id="form_method" value="POST">
                        <input type="hidden" name="form_data" id="form_data">

                        <!-- Step 1 -->
                        <div class="step" id="step-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="destination_id">Choose Destination</label>
                                        <select class="form-control" id="destination_id">
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
                                        <input type="text" class="form-control" id="no_policy">
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
                                        <label for="no_truck">No Truck</label>
                                        <input type="text" class="form-control" id="no_truck">
                                        @error('no_truck')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                @error('no_truck')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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
                                <button type="button" class="btn btn-secondary" id="prev-step"
                                    disabled>Previous</button>
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
                                <tbody>
                                </tbody>
                            </table>
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
                            <th scope="col">Number Plate</th>
                            <th scope="col">Number Truck</th>
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
                                <td>{{ $item->no_policy }}</td>
                                <td>{{ $item->no_truck }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <button class="btn btn-info btn-sm" onclick="detail({{ $item->id }})">
                                        <i class="icon-copy bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#deletemodal-{{ $item->id }}">
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

    <!-- Modal Delete -->
    @foreach ($report as $item)
        <div class="modal fade" id="deletemodal-{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this record?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('report.delete', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let limbah = @json($limbah);
            let kodeLimbahSelect = document.getElementById('kode_limbah');
            let namaLimbahInput = document.getElementById('nama_limbah');
            let quantityInput = document.getElementById('quantity');
            let unitSelect = document.getElementById('unit');
            let destinationSelect = document.getElementById('destination_id');
            let noPolicyInput = document.getElementById('no_policy');
            let noTruckInput = document.getElementById('no_truck');
            let descriptionTextarea = document.getElementById('description');
            let photoInput = document.getElementById('photo');
            let formDataInput = document.getElementById('form_data');
            let detailsTable = document.getElementById('details-table').getElementsByTagName('tbody')[0];
            let addButton = document.getElementById('add-detail');
            let step1 = document.getElementById('step-1');
            let step2 = document.getElementById('step-2');
            let nextButton = document.getElementById('next-step');
            let prevButton = document.getElementById('prev-step');

            let isEditMode = false;
            let rowToEdit = null;

            function updatePreviousButtonState() {
                prevButton.disabled = detailsTable.rows.length === 0;
            }

            nextButton.addEventListener('click', function() {
                step1.style.display = 'none';
                step2.style.display = 'block';
            });

            prevButton.addEventListener('click', function() {
                step1.style.display = 'block';
                step2.style.display = 'none';
            });

            kodeLimbahSelect.addEventListener('change', function() {
                let selectedId = kodeLimbahSelect.value;
                let selectedLimbah = limbah.find(limbah => limbah.id === parseInt(selectedId));

                if (selectedLimbah) {
                    namaLimbahInput.value = selectedLimbah.nama_limbah;
                    namaLimbahInput.setAttribute('readonly', true);
                } else {
                    namaLimbahInput.value = '';
                    namaLimbahInput.removeAttribute('readonly');
                }
            });

            function editDetail(row) {
                rowToEdit = row; // Simpan referensi ke baris yang diedit
                let cells = row.querySelectorAll('td');
                kodeLimbahSelect.value = cells[0].textContent.trim();
                namaLimbahInput.value = cells[1].textContent.trim();
                quantityInput.value = cells[2].textContent.trim();
                unitSelect.value = cells[3].textContent.trim();

                // Set mode edit
                isEditMode = true;
                addButton.textContent = 'Save'; // Ubah label tombol menjadi 'Save'

                // Tampilkan Step 2 dan sembunyikan Step 1
                step1.style.display = 'none';
                step2.style.display = 'block';
            }

            document.getElementById('data-form').addEventListener('submit', function(event) {
                event.preventDefault();
                if (validateForm()) {
                    let formData = {
                        form_limbah: {
                            destination_id: isEditMode ? formDataInput.dataset.oldDestinationId :
                                destinationSelect.value,
                            no_policy: isEditMode ? formDataInput.dataset.oldNoPolicy : noPolicyInput
                                .value,
                            no_truck: isEditMode ? formDataInput.dataset.oldNoTruck : noTruckInput
                                .value,
                            description: descriptionTextarea.value
                        },
                        details: getDetails(),
                        is_edit_mode: isEditMode // Tambahkan parameter untuk menandakan mode edit
                    };

                    formDataInput.value = JSON.stringify(formData);

                    this.submit();
                }
            });


            function showDetail(id) {
                fetch(`/report/${id}/details`)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Data received:', data); // Debugging

                        // Clear existing rows
                        detailsTable.innerHTML = '';

                        // Add new rows to the table
                        data.details.forEach((detail) => {
                            let row = detailsTable.insertRow();
                            row.insertCell(0).textContent = detail.limbah.kode_limbah;
                            row.insertCell(1).textContent = detail.limbah.nama_limbah;
                            row.insertCell(2).textContent = detail.quantity;
                            row.insertCell(3).textContent = detail.unit;

                            let actionCell = row.insertCell(4);
                            // Create edit button
                            let editButton = document.createElement('button');
                            editButton.className = 'btn btn-warning btn-sm';
                            editButton.innerHTML = '<i class="icon-copy bi bi-pencil"></i>';
                            editButton.addEventListener('click', function() {
                                editDetail(row);
                            });
                            actionCell.appendChild(editButton);

                            // Create remove button
                            let removeButton = document.createElement('button');
                            removeButton.className = 'btn btn-danger btn-sm';
                            removeButton.innerHTML = '<i class="icon-copy bi bi-trash"></i>';
                            removeButton.addEventListener('click', function() {
                                detailsTable.deleteRow(row.rowIndex);
                                updatePreviousButtonState();
                            });
                            actionCell.appendChild(removeButton);
                        });

                        updatePreviousButtonState();
                    })
                    .catch(error => console.error('Error fetching details:', error));
            }

            // Attach the showDetail function to the detail button
            window.detail = function(id) {
                showDetail(id);
            };

            // Event listener for form submission
            document.getElementById('data-form').addEventListener('submit', function(event) {
                event.preventDefault();
                if (validateForm()) {
                    let formData = {
                        form_limbah: {
                            destination_id: destinationSelect.value,
                            no_policy: noPolicyInput.value,
                            no_truck: noTruckInput.value,
                            description: descriptionTextarea.value
                        },
                        details: getDetails()
                    };

                    formDataInput.value = JSON.stringify(formData);

                    this.submit();
                }
            });

            function getDetails() {
                let details = [];
                detailsTable.querySelectorAll('tr').forEach(row => {
                    let cells = row.querySelectorAll('td');
                    if (cells.length > 0) {
                        details.push({
                            kode_limbah: cells[0].textContent.trim(),
                            nama_limbah: cells[1].textContent.trim(),
                            quantity: cells[2].textContent.trim(),
                            unit: cells[3].textContent.trim()
                        });
                    }
                });
                return details;
            }

            function closeForm() {
                isEditMode = false;
                addButton.textContent = 'Add'; // Ubah label tombol kembali ke 'Add'
                step1.style.display = 'block';
                step2.style.display = 'none';
            }

            // Initial check for the Previous button state
            updatePreviousButtonState();

            // Auto-close alert after 3 seconds
            setTimeout(function() {
                $('.alert').alert('close');
            }, 3000);
        });

        function validateForm() {
            let destinationId = document.getElementById('destination_id').value;
            if (destinationId === '') {
                alert('Destination ID is required.');
                return false;
            }
            return true;
        }
    </script>
@endpush
