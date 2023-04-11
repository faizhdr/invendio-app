@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Data Barang'])
    @php
        $ar_judul = ['Merek', 'Kategori', 'Kondisi Barang','Keterangan'];
        $no = 1;
    @endphp
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 mb-5">
                        <div class="row">
                            <div class="col-md-10">
                                <a class="btn btn-primary btn-md" href="{{ route('barang.create') }}" role="button">Tambah Barang</a>
                                <a href="{{ url('barangpdf') }}" class="btn btn-danger mx-1"><i class="fas fa-file-pdf"></i> </a>
                                <a href="{{ url('barangcsv') }}" class="btn btn-success"><i class="fas fa-file-csv"></i> </a>
                            </div>
                            <div class="col-md-2">
                                <form action="{{route('barang.index')}}" class="ms-auto mt-1">
                                    <div class="input-group">
                                        <input type="text" name="keyword" value="{{Request::get('keyword')}}" class="form-control h-50" placeholder="Search...">
                                        <div class="input-group-append">
                                        <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                                        @foreach ($ar_judul as $jdl)
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ $jdl }}</th>
                                        @endforeach
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ar_barang as $b)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    @php
                                                    if(!empty($b->foto)){
                                                    @endphp
                                                    <img src="{{ asset('images') }}/{{ $b->foto }}" class="avatar avatar-sm rounded-circle me-2" alt="gambar">
                                                    @php
                                                    }else{
                                                    @endphp
                                                    <img src="{{ asset('images') }}/nophoto.svg" class="avatar avatar-sm rounded-circle me-2" alt="gambar">
                                                    @php
                                                    }
                                                    @endphp
                                                    
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">{{ $b->nama }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $b->merek }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $b->kat }}</p>
                                        </td>
                                        @if($b->kondisi === 1)
                                        <td class=" text-sm">
                                            <span class="badge badge-sm bg-gradient-success">Baik</span>
                                        </td>
                                        @elseif($b->kondisi === 2)
                                        <td class=" text-sm">
                                            <span class="badge badge-sm bg-gradient-warning">Kurang Baik</span>
                                        </td>
                                        @else
                                        <td class=" text-sm">
                                            <span class="badge badge-sm bg-gradient-danger">Rusak Berat</span>
                                        </td>
                                        @endif
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $b->keterangan }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{ route('barang.destroy', $b->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('barang.show',$b->id) }}" class="btn btn-icon btn-info"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('barang.edit',$b->id) }}" class="btn btn-icon btn-success"><i class="fas fa-pen"></i></a>
                                                <button class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                    <div class="m-3">
                        {{ $ar_barang->links() }}
                    </div>  
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
