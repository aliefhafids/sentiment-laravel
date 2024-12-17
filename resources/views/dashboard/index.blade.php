@extends('dashboard.layouts.main')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Sistem Klasifikasi KNN</h5>
                                <p class="mb-4">
                                    Solusi untuk analisis data dan pengambilan keputusan yang lebih efisien.
                                    Identifikasi pola, kelompokkan data berdasarkan kedekatan dalam ruang fitur.
                                </p>
                                <a href="/dashboard/klasifikasi" class="btn btn-sm btn-outline-primary">Klasifikasi</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="img/illustrations/man-with-laptop-light.png" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <h5 class="card-header">Product</h5>
                    <div class="table-responsive">
                        <table id="preprocessed-table" class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>Id</th>
                                    <th>Product</th>
                                    <th>Positif</th>
                                    <th>Netral</th>
                                    <th>Negatif</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td><span class="fw-medium">{{ $product->product }}</span></td>
                                    <td><span class="badge bg-label-primary me-1">{{ $product->positif_count }}</span>
                                    </td>
                                    <td><span class="badge bg-label-success me-1">{{ $product->netral_count }}</span>
                                    </td>
                                    <td><span class="badge bg-label-warning me-1">{{ $product->negatif_count }}</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="/dashboard/delete/{{ $product->id }}"><i
                                                        class="bx bx-trash me-1"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center">
                        {{ $products->links('dashboard.layouts.pagination') }}
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Dataset</h5>
                            <small class="text-muted">total data yang tersimpan</small>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="orderStatistics" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orderStatistics">
                                <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex flex-column align-items-center gap-1">
                                <h2 class="mb-2">{{ $totalDatasets }}</h2>
                                <span>Total Datasets</span>
                            </div>
                            <canvas id="dashboardPieChart" width="200" height="200"></canvas>
                        </div>
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i
                                            class="bx bx-mobile-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Data Latih</h6>
                                        <small class="text-muted">Baik, Bagus, Sesuai</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-medium">{{ $totalLatih }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success"><i
                                            class="bx bx-closet"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Data Uji</h6>
                                        <small class="text-muted">Standar, Sebanding</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-medium">{{ $totalUji }}</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Order Statistics -->
        </div>
    </div>

</div>
<!-- / Content -->

<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Mengambil nilai-nilai dari PHP dan menetapkannya ke variabel JavaScript
        var positifCount = {{ $positifCount }};
        var netralCount = {{ $netralCount }};
        var negatifCount = {{ $negatifCount }};

        var ctx = document.getElementById('dashboardPieChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Positif', 'Netral', 'Negatif'],
                datasets: [{
                    label: 'Jumlah Klasifikasi',
                    data: [positifCount, netralCount, negatifCount],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' (' + ((tooltipItem.raw / (positifCount + netralCount + negatifCount)) * 100).toFixed(2) + '%)';
                            }
                        }
                    }
                }
            }
        });
    </script>
@endpush

