@extends('dashboard.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>

        <!-- Bootstrap Table with Header - Light -->
        <div class="card mb-3">
            <h5 class="card-header">Hasil Klasifikasi</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Project</th>
                            <th>Klasifikasi Manual</th>
                            <th>Klasifikasi Sistem</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>
                                1
                            </td>
                            <td>
                                <span class="fw-medium">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum
                                    ut dolorem, quasi a sint eum aliquid minima inventore unde. Voluptates laboriosam
                                    unde corrupti inventore debitis dolorem nesciunt delectus dignissimos
                                    molestiae?</span>
                            </td>
                            <td><span class="badge bg-label-primary me-1">Active</span></td>
                            <td><span class="badge bg-label-primary me-1">Active</span></td>
                        </tr>
                        <tr>
                            <td>
                                2
                            </td>
                            <td>
                                <span class="fw-medium">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum
                                    ut dolorem, quasi a sint eum aliquid minima inventore unde. Voluptates laboriosam
                                    unde corrupti inventore debitis dolorem nesciunt delectus dignissimos
                                    molestiae?</span>
                            </td>
                            <td><span class="badge bg-label-success me-1">Completed</span></td>
                            <td><span class="badge bg-label-success me-1">Completed</span></td>
                        </tr>
                        <tr>
                            <td>
                                3
                            </td>
                            <td>
                                <span class="fw-medium">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum
                                    ut dolorem, quasi a sint eum aliquid minima inventore unde. Voluptates laboriosam
                                    unde corrupti inventore debitis dolorem nesciunt delectus dignissimos
                                    molestiae?</span>
                            </td>
                            <td><span class="badge bg-label-info me-1">Scheduled</span></td>
                            <td><span class="badge bg-label-info me-1">Scheduled</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <div id="orderStatisticsChart"></div>
                </div>
                <ul class="p-0 m-0">
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"><i
                                    class="bx bx-mobile-alt"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">Positif</h6>
                                <small class="text-muted">Baik, Bagus, Sesuai</small>
                            </div>
                            <div class="user-progress">
                                <small class="fw-medium">82.5k</small>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-success"><i class="bx bx-closet"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">Netral</h6>
                                <small class="text-muted">Standar, Sebanding </small>
                            </div>
                            <div class="user-progress">
                                <small class="fw-medium">23.8k</small>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">Negatif</h6>
                                <small class="text-muted">Buruk, Rusak, Kurang</small>
                            </div>
                            <div class="user-progress">
                                <small class="fw-medium">849k</small>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
        <div class="card mb-2">
            <h5 class="card-header">Akurasi Metode KNN</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th>Klasifikasi Positif</th>
                            <th>Klasifikasi Netral</th>
                            <th>Klasifikasi Negatif</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>
                                Aktual Positif
                            </td>
                            <td>
                                10
                            </td>
                            <td>
                                11
                            </td>
                            <td>
                                10
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Aktual Netral
                            </td>
                            <td>
                                10
                            </td>
                            <td>
                                11
                            </td>
                            <td>
                                10
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Aktual Negatif
                            </td>
                            <td>
                                10
                            </td>
                            <td>
                                11
                            </td>
                            <td>
                                10
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
