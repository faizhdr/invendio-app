@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Detail Barang'])
    @php
        $rs1 = App\Models\Merek::all();
        $rs2 = App\Models\Kategori::all();
    @endphp
    <div class="container-fluid py-5">
        <div class="col-md-4">
            @foreach ($ar_barang as $b)
            <div class="card card-profile">
                <div class="row justify-content-center">
                    <div class="col-4 col-lg-4 order-lg-2">
                        <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                            @php
                                if(!empty($b->foto)){
                                @endphp
                                <img src="{{ asset('images')}}/{{ $b->foto }}" width="800px" class="rounded-circle img-fluid"/>
                                @php
                                }else{
                                @endphp
                                <img src="{{ asset('images')}}/nophoto.svg"
                                class="rounded-circle img-fluid border border-2 border-white"/>
                                @php
                                }
                            @endphp
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                    <div class="d-flex justify-content-between">
                        <a href="{{ url('barang') }}" class="btn btn-sm btn-secondary mb-0 d-lg-block">Back</a>
                        <div class="text-sm mt-2">
                            @if($b->kondisi === 1)
                                <span class="badge badge-sm bg-gradient-success">Baik</span>
                            @elseif($b->kondisi === 2)
                                <span class="badge badge-sm bg-gradient-warning">Kurang Baik</span>
                            @else
                                <span class="badge badge-sm bg-gradient-danger">Rusak Berat</span>
                            @endif
                        </div>
                        <a href="{{ route('barang.edit',$b->id) }}"
                            class="btn btn-sm btn-info float-right mb-0 d-lg-block">Edit</a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-center">
                                <div class="d-grid text-center">
                                    <span class="text-lg font-weight-bolder">{{ $b->created_at }}</span>
                                    <span class="text-sm opacity-8">Ditambahkan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <h5>
                            {{ $b->nama }} ({{ $b->merek }})
                        </h5>
                        <div class="h6 opacity-8">
                            {{ $b->kat }}
                        </div>
                        <div class="h6 opacity-8">
                            Stok: {{ $b->stok }}
                        </div>
                        <div class="h6 mt-4">
                            {{ $b->keterangan }}
                        </div>
                        <div class="text-sm mt-4">
                            Diupdate : {{ $b->updated_at }}
                        </div>
                        
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
