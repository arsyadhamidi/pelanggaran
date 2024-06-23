@extends('admin.layout.master')
@section('title', 'Dashboard | Yetera')
@section('menuDashboard', 'active')

@section('content')
    <div class="row">
        <div class="col-lg mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat Datang {{ Auth()->user()->name ?? '-' }}! 🎉</h5>
                            <p class="mb-4">
                                Selamat datang di Dashboard Anda, di mana segala sesuatu menjadi lebih mudah dan
                                terorganisir. Dashboard Anda siap membantu! Lihatlah data terbaru dan kelola aktivitas Anda
                                dengan efisien
                            </p>

                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('admin/assets/img/illustrations/man-with-laptop-light.png') }}"
                                height="140" alt="View Badge User"
                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
