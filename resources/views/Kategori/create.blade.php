@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tambah Kategori'])
    <div class="container-fluid py-4">
        <div class="card">
            <form role="form" method="POST" action="{{ route('kategori.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <a href="{{ url('kategori') }}" class=""><i class="fas fa-chevron-left"></i> Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <hr class="horizontal dark">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Kategori Barang</label>
                                <input class="form-control
                                @error('kategori')
                                is-invalid
                                @enderror" 
                                type="text" value="{{ old('kategori') }}" name="kategori" placeholder="Masukkan kategori Barang">
                                {{-- pesan error --}}
                                @error('kategori')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm ms-auto mt-2">Save</button>

                </div>
                
            </form>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
