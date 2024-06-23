@extends('admin.layout.master')
@section('title', 'Setting | Yetera')
@section('menuDashboard', 'active')

@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4 text-center">
                        @if ($users->foto_profile)
                            <img src="{{ asset('storage/' . $users->foto_profile) }}" class="img-fluid rounded-circle"
                                width="150">
                        @else
                            <img src="{{ asset('images/foto-profile.png') }}" class="img-fluid rounded-circle" width="150">
                        @endif
                    </div>
                    <div class="mb-4 text-center">
                        <h5>{{ $users->name ?? '-' }}</h5>
                        <p><i>{{ $users->level ?? '-' }}</i></p>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <p><b>Nama Lengkap</b><br>
                            <i>{{ $users->name ?? '-' }}</i>
                        </p>
                    </div>
                    <div class="mb-3">
                        <p><b>Email Address</b><br>
                            <i>{{ $users->email ?? '-' }}</i>
                        </p>
                    </div>
                    <div class="mb-3">
                        <p><b>Status</b><br>
                            <i>{{ $users->level ?? '-' }}</i>
                        </p>
                    </div>
                    <div class="mb-3">
                        <p><b>Telepon</b><br>
                            <i>{{ $users->telp ?? '-' }}</i>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Ubah Email</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">Ubah Password</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-disabled" type="button" role="tab"
                                aria-controls="pills-disabled" aria-selected="false">Ubah Gambar</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab" tabindex="0">
                            <form action="#" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="mb-3">
                                            <label>Nama Lengkap</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Masukan nama lengkap"
                                                value="{{ old('name', $users->name ?? '-') }}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label>Nomor Telepon</label>
                                            <input type="number" name="telp"
                                                class="form-control @error('telp') is-invalid @enderror"
                                                placeholder="Masukan nomor telepon"
                                                value="{{ old('telp', $users->telp ?? '-') }}">
                                            @error('telp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                            tabindex="0">...</div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                            tabindex="0">...</div>
                        <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab"
                            tabindex="0">...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
