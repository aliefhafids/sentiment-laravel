@extends('dashboard.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Testing data /</span> Data Uji</h4>

        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <h5 class="card-header">Tabel Data Uji</h5>
            <div class="button-cont">
               <a href='/dashboard/uji/create' className='text-decoration-none'>
                    <button type="button" class="btn btn-primary">
                        <i class="tf-icons bx bx-plus"></i>Tambah Data
                    </button>
                </a>
                <a class='text-decoration-none' href="#" data-toggle="modal" data-target="#exampleModal">
                    <button type="button" class="btn btn-warning">
                        <i class="tf-icons bx bx-import"></i> Import Data
                    </button>
                </a>
                 <form action="{{ route('clean.data') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="tf-icons bx bx-trash"></i> Hapus Semua Data
                    </button>
                </form>
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
                        <form action="/dashboard/uji/importesting" method="POST" enctype="multipart/form-data">
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
                    </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Project</th>
                            <th>Rating</th>
                            <th>Klasifikasi Manual</th>
                            <th>Klasifikasi Sistem</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                   <tbody class="table-border-bottom-0">
                        @php  
                            $no = 1;                   
                        @endphp
                        @foreach ($testings as $ts)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                <span class="fw-medium">{{ $ts->review }}</span>
                            </td>
                            <td>
                                @for ($i = 1; $i <= $ts->rating_id; $i++)
                                    <img src="{{ asset('img/star-filled.png') }}" width="10" height="10" alt="Star">
                                @endfor
                            </td>
                            <td><span class="badge bg-label-primary me-1">{{ $ts->classification->name}}</span></td>
                            <td><span class="badge bg-label-primary me-1">{{ $ts->sysclassification->name}}</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/dashboard/uji/edit/{{ $ts->id }}"><i 
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="/dashboard/uji/delete/{{ $ts->id }}"><i
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
                {{ $testings->links('dashboard.layouts.pagination') }}
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
    </div>
</div>
@endsection

