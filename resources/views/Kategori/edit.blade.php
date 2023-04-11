@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Barang'])
    @php
        $rs1 = App\Models\Merek::all();
        $rs2 = App\Models\Kategori::all();
    @endphp
    <div class="container-fluid py-4">
        <div class="card">
            @foreach ($data as $row)
            <form role="form" method="POST" action="{{ route('kategori.update', $row->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
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
                                type="text" value="{{ old('kategori',$row->kategori) }}" name="kategori" placeholder="Masukkan kategori Barang">
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
            @endforeach
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
