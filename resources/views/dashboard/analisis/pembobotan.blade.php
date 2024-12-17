@extends('dashboard.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>

        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <h5 class="card-header">Hasil TF-IDF</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Document</th>
                            <th>Panjang Vector</th>
                            <th>Kemiripan Vector</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>
                                <span class="fw-medium">1</span>
                            </td>
                            <td>128,92</td>
                            <td>
                              0
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-medium">2</span>
                            </td>
                            <td>128,92</td>
                            <td>
                              0
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-medium">3</span>
                            </td>
                            <td>128,92</td>
                            <td>
                              0
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
