@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Merek Barang'])
    @php
        $no = 1;
    @endphp
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <h6>Merek Barang</h6>
                            <a href="{{ route('merek.create') }}" type="submit" class="btn btn-primary btn-icon btn-sm ms-auto mt-3"><i class="ni ni-fat-add"></i><span> Merek Barang</span></a>

                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Merek Barang</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ar_merek as $m)
                                    <tr>
                                        <td>
                                            <div class="px-3">
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">{{ $no++ }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $m->merek }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{ route('merek.destroy', $m->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('merek.edit',$m->id) }}" class="btn btn-icon btn-success"><i class="fas fa-pen"></i></a>
                                                <button class="btn btn-icon btn-danger delete"  ><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
