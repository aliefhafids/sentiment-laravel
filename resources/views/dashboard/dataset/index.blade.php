@extends('dashboard.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">Datasets</h4>

        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <h5 class="card-header">Dataset Tabel</h5>
            <div class="button-cont">
                <a href='/dashboard/dataset/create' class="text-decoration-none">
                    <button type="button" class="btn btn-primary">
                        <i class="tf-icons bx bx-plus"></i>Tambah Data
                    </button>
                </a>
                <a class="text-decoration-none" href="#" data-toggle="modal" data-target="#exampleModal">
                    <button type="button" class="btn btn-warning">
                        <i class="tf-icons bx bx-import"></i> Import Data
                    </button>
                </a>
                <button type="button" class="btn btn-secondary" onclick="fetchData()">
                    <i class="tf-icons bx bx-import"></i> Split Data
                </button>

                <form action="{{ route('hapus.data') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="tf-icons bx bx-trash"></i> Hapus Semua Data
                    </button>
                </form>
                @if (session('message'))
                <div class="alert alert-success mt-3">
                    {{ session('message') }}
                </div>
                @endif
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/dashboard/dataset/importmain" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="file" name="file" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Project</th>
                            <th>Rating</th>
                            <th>Sentiment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @php
                        $no = 1;
                        @endphp
                        @foreach ($datasets as $dt)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                <span class="fw-medium">{{ $dt->review }}</span>
                            </td>
                            <td>
                                @for ($i = 1; $i <= $dt->rating_id; $i++)
                                    <img src="{{ asset('img/star-filled.png') }}" width="10" height="10" alt="Star">
                                @endfor
                            </td>
                            <td><span class="badge bg-label-primary me-1">{{ $dt->classification->name}}</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/dashboard/dataset/delete/{{ $dt->id }}"><i
                                                class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $datasets->links('dashboard.layouts.pagination') }}
            </div>
        </div>
    </div>
    <!-- Bootstrap Table with Header - Light -->
</div>
@endsection
