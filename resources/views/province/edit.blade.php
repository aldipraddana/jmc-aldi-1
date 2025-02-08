@extends('template')

@section('section')
    <div class="container-fluid py-3">

        <div class="row">
            <div class="col-12 px-0">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        {{-- edit data area --}}
        <div class="row">
            <div class="col-12 px-0">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <b>Edit Data Provinsi</b>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('province.update', $id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <label for="" class="form-label">Provinsi</label>
                                    <input type="text" name="name" class="form-control" value="{{ $dataProvince->name }}">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-submit text-white">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end input data area --}}
        
    </div>
@endsection
