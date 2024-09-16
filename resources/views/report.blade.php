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
                        <input type="hidden" name="form_data" id="form_data">

                        <!-- Step 1 -->
                        <div class="step" id="step-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="destination_id">Choose Destination</label>
                                        <select name="destination_id" class="form-control" id="destination_id">
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
                                        <input type="text" name="no_policy" class="form-control" id="no_policy">
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
                                        <select name="kode_limbah" class="form-control" id="kode_limbah">
                                            <option value="">-- Select Limbah --</option>
                                            @foreach ($limbah as $l)
                                                <option value="{{ $l->kode_limbah }}">{{ $l->kode_limbah }}</option>
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
                                        <input type="text" name="nama_limbah" class="form-control" id="nama_limbah"
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
                                            <input type="number" name="quantity" class="form-control" id="quantity"
                                                placeholder="Enter quantity">
                                            <select name="unit" class="form-control ml-2" id="unit"
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
                                        <label for="no_truck">No Truck</label>
                                        <input type="text" name="no_truck" class="form-control" id="no_truck">
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
                                        <textarea name="description" class="form-control" id="description" rows="1"
                                            style="width: 100%; max-height: 70px;"></textarea>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="photo">Photo (Optional)</label>
                                        <input type="file" name="photo" class="form-control" id="photo">
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
                                        <th scope="col">Destination</th>
                                        <th scope="col">No policy</th>
                                        <th scope="col">No Truck</th>
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

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let detailsTable = document.getElementById('details-table').getElementsByTagName('tbody')[0];
                let addButton = document.getElementById('add-detail');
                let step1 = document.getElementById('step-1');
                let step2 = document.getElementById('step-2');
                let nextButton = document.getElementById('next-step');
                let prevButton = document.getElementById('prev-step');
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

                nextButton.addEventListener('click', function() {
                    step1.style.display = 'none';
                    step2.style.display = 'block';
                });

                prevButton.addEventListener('click', function() {
                    step1.style.display = 'block';
                    step2.style.display = 'none';
                });

                kodeLimbahSelect.addEventListener('change', function() {
                    let selectedCode = kodeLimbahSelect.value;
                    let limbah = @json($limbah);

                    let selectedLimbah = limbah.find(limbah => limbah.kode_limbah === selectedCode);
                    if (selectedLimbah) {
                        namaLimbahInput.value = selectedLimbah.nama_limbah;
                        namaLimbahInput.setAttribute('readonly', true);
                    } else {
                        namaLimbahInput.value = '';
                        namaLimbahInput.removeAttribute('readonly');
                    }
                });

                addButton.addEventListener('click', function() {
                    let kodeLimbah = kodeLimbahSelect.value;
                    let namaLimbah = namaLimbahInput.value;
                    let quantity = quantityInput.value;
                    let unit = unitSelect.value;
                    let destination = destinationSelect.options[destinationSelect.selectedIndex].text;
                    let noPolicy = noPolicyInput.value;
                    let noTruck = noTruckInput.value;

                    if (kodeLimbah && namaLimbah && quantity && unit) {
                        let row = detailsTable.insertRow();
                        row.insertCell(0).textContent = kodeLimbah;
                        row.insertCell(1).textContent = namaLimbah;
                        row.insertCell(2).textContent = quantity;
                        row.insertCell(3).textContent = unit;
                        row.insertCell(4).textContent = destination;
                        row.insertCell(5).textContent = noPolicy;
                        row.insertCell(6).textContent = noTruck;

                        let actionCell = row.insertCell(7);
                        let removeButton = document.createElement('button');
                        removeButton.className = 'btn btn-danger btn-sm';
                        removeButton.innerHTML = '<i class="icon-copy bi bi-trash"></i>';
                        removeButton.addEventListener('click', function() {
                            detailsTable.deleteRow(row.rowIndex - 1);
                        });
                        actionCell.appendChild(removeButton);

                        kodeLimbahSelect.value = '';
                        namaLimbahInput.value = '';
                        namaLimbahInput.removeAttribute('readonly');
                        quantityInput.value = '';
                        unitSelect.value = 'KG';
                        noPolicyInput.value = '';
                        noTruckInput.value = '';
                    } else {
                        alert('Please fill all fields before adding.');
                    }
                });

                document.querySelector('form').addEventListener('submit', function(event) {
                    event.preventDefault();
                    let form = this;
                    form.querySelector('input[name="form_data"]').value = JSON.stringify(getDetails());
                    form.submit(); // Submit the form with the form_data included
                });

                function getDetails() {
                    let details = [];
                    document.getElementById('details-table').querySelectorAll('tr').forEach(row => {
                        let cells = row.querySelectorAll('td');
                        details.push({
                            kode_limbah: cells[0].textContent,
                            nama_limbah: cells[1].textContent,
                            quantity: cells[2].textContent,
                            unit: cells[3].textContent,
                            destination: cells[4].textContent,
                            no_policy: cells[5].textContent,
                            no_truck: cells[6].textContent
                        });
                    });
                    return details;
                }

            });
        </script>
    @endpush
@endsection
