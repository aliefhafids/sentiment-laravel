@extends('dashboard.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Classification /</span> Klasifikasi</h4>

        <div class="row mb-5">
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card">
                    <div class="card-header">Data Latih</div>
                    <div class="card-body">
                        <h5 class="card-title">Klasifikasi K-Nearest Neighbor</h5>
                        <p class="card-text">
                            Proses K-Nearest Neighbors (KNN) digunakan untuk menganalisis dan mengklasifikasikan review
                            produk. Langkah dalam memperluas dataset latihan, melakukan preprocessing
                            data, dan memberikan bobot kata, memahami konteks review dan membuat prediksi akurat tentang sentimen pada data latih.
                        </p>
                        <a href="javascript:void(0)" id="klasifikasiBtn" class="btn btn-primary" onclick="classifyData()">Proses Klasifikasi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card">
                    <div class="card-header">Data Uji</div>
                    <div class="card-body">
                        <h5 class="card-title">Klasifikasi K-Nearest Neighbor</h5>
                        <p class="card-text">
                            Proses K-Nearest Neighbors (KNN) digunakan untuk menganalisis dan mengklasifikasikan review
                            produk. Langkah dalam memperluas dataset latihan, melakukan preprocessing
                            data, dan memberikan bobot kata, memahami konteks review dan membuat prediksi akurat tentang sentimen pada data uji.
                        </p>
                        <a href="javascript:void(0)" id="klasifikasiUji" class="btn btn-primary" onclick="classifyData()">Proses Klasifikasi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
