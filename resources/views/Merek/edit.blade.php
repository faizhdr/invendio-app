@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Merek Barang'])
    <div class="container-fluid py-4">
        <div class="card">
            @foreach ($data as $row)
            <form method="POST" action="{{ route('merek.update', $row->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <a href="{{ url('merek') }}" class=""><i class="fas fa-chevron-left"></i> Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <hr class="horizontal dark">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Merek Barang</label>
                                <input class="form-control
                                @error('merek')
                                is-invalid
                                @enderror" 
                                type="text" value="{{ old('merek',$row->merek) }}" name="merek" placeholder="Masukkan Merek Barang">
                                {{-- pesan error --}}
                                @error('Merek')
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
