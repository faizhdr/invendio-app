@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tambah Barang'])
    @php
        $rs1 = App\Models\Merek::all();
        $rs2 = App\Models\Kategori::all();
    @endphp
    <div class="container-fluid py-4">
        <div class="card">
            <form role="form" method="POST" action="{{ route('barang.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <a href="{{ url('barang') }}" class=""><i class="fas fa-chevron-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary btn-sm ms-auto mt-3">Save</button>
                    </div>
                </div>
                <div class="card-body">
                    <hr class="horizontal dark">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nama Barang</label>
                                <input class="form-control
                                @error('nama')
                                is-invalid
                                @enderror" 
                                type="text" value="{{ old('nama') }}" name="nama" placeholder="Masukkan Nama Barang">
                                {{-- pesan error --}}
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Gambar Barang</label>
                                <input class="form-control" type="file" name="foto">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Merek</label>
                                <select class="form-control 
                                @error('idmerek')
                                is-invalid
                                @enderror" 
                                name="idmerek">
                                    <option selected disabled>Pilih Merek</option>
                                    @foreach ($rs1 as $m)
                                        <option value="{{ $m->id }}"
                                            {{ old('idmerek') == $m->id ? 'selected' : null }}>{{ $m->merek }}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- pesan error --}}
                                @error('idmerek')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Kategori</label>
                                <select class="form-control
                                @error('idkategori')
                                is-invalid
                                @enderror" 
                                name="idkategori">
                                    <option selected disabled>Pilih Kategori</option>
                                    @foreach ($rs2 as $k)
                                        <option value="{{ $k->id }}"
                                            {{ old('idkategori') == $k->id ? 'selected' : null }}>{{ $k->kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- pesan error --}}
                                @error('idkategori')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Stok Barang</label>
                                <input class="form-control
                                @error('stok')
                                is-invalid
                                @enderror"
                                type="number" value="{{ old('stok') }}" name="stok" placeholder="Masukkan Stok Barang">
                                @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Kondisi Barang</label>
                                <select class="form-control
                                @error('kondisi')
                                is-invalid
                                @enderror" 
                                name="kondisi">
                                    <option selected disabled>Pilih Kondisi barang</option>
                                    <option value="1">Baik</option>
                                    <option value="2">Kurang Baik</option>
                                    <option value="3">Rusak Ringan</option>
                                </select>
                                {{-- pesan error --}}
                                @error('kondisi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Keterangan</label>
                                <textarea class="form-control
                                @error('keterangan')
                                is-invalid
                                @enderror"
                                placeholder="Masukkan Keterangan" name="keterangan">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        @include('layouts.footers.auth.footer')
    </div>
@endsection
