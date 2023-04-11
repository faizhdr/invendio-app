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
            <form method="POST" action="{{ route('barang.update', $row->id) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <a href="{{ url('barang') }}" class=""><i class="fas fa-chevron-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary btn-sm ms-auto mt-2">Save</button>
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
                                type="text" value="{{ old('nama',$row->nama) }}" name="nama">
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
                                <span class="text-warning text-sm">Harap isi kembali foto, Tidak bisa foramat .webp</span>
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
                                    @foreach ($rs1 as $opt)
                                        <option value="{{ $opt->id }}"
                                            {{ old('idmerek',$row->idmerek) == $opt->id ? 'selected' : null }}>
                                            {{ $opt->merek }}
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
                                    <option selected disabled>-- Pilih Kategori --</option>
                                    @foreach ($rs2 as $opt)
                                        <option value="{{ $opt->id }}"
                                            {{ old('idkategori',$row->idkategori) == $opt->id ? 'selected' : null }}>
                                            {{ $opt->kategori }}
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
                                type="number" value="{{ old('stok',$row->stok) }}" name="stok" >
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
                                    <option value="1" {{ $row->kondisi == 1 ? 'selected' : '' }}>Baik</option>
                                    <option value="2" {{ $row->kondisi == 2 ? 'selected' : '' }}>Kurang Baik</option>
                                    <option value="3" {{ $row->kondisi == 3 ? 'selected' : '' }}>Rusak Berat</option>
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
                                <label for="example-text-input" class="form-control-label
                                @error('keterangan')
                                is-invalid
                                @enderror"
                                >Keterangan</label>
                                <textarea class="form-control" placeholder="Masukkan Keterangan" name="keterangan">{{ old('keterangan',$row->keterangan) }}</textarea>
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
            @endforeach
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
