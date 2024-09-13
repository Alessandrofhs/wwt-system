@extends('layout.app')
@section('title', 'Approval')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Approval</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Approval
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Responsive tables Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-blue h4">List Approval</h4>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="documentTableBody">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($approval as $item)
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
                <div class="collapse collapse-box" id="responsive-table">
                    <div class="code-box">
                        <div class="clearfix">
                            <a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left"
                                data-clipboard-target="#responsive-table-code"><i class="fa fa-clipboard"></i> Copy
                                Code</a>
                            <a href="#responsive-table" class="btn btn-primary btn-sm pull-right" rel="content-y"
                                data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i> Hide Code</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By
            <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
        </div>
    </div>
@endsection
