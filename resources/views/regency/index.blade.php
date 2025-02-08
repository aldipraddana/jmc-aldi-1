@extends('template')

@section('section')
    <div class="container-fluid py-2">

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
        
        {{-- input data area --}}
        <div class="row">
            <div class="col-12 px-0">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <b>Input Data Kabupaten</b>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('regency.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    <label for="" class="form-label">Pilih Provinsi</label>
                                    <select class="form-select" name="province" aria-label="Default select example">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach ($dataProvince as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="" class="form-label">Kabupaten</label>
                                    <input type="text" name="regency_name" class="form-control" id="">
                                </div>
                                <div class="col-4">
                                    <label for="" class="form-label">Jumlah Penduduk</label>
                                    <input type="number" min="0" name="total_population" class="form-control" id="">
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
        
        {{-- list data regency area --}}
        <div class="row mt-3">
            <div class="col-12 px-0">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <b>Data Penduduk Kabupaten</b>
                    </div>
                    <div class="card-body">
                        
                        {{-- area filter data --}}
                        <div>
                            <form action="{{ route('regency') }}" method="GET">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <label class="form-label">Filter Provinsi</label>
                                        <select class="form-select" name="province" aria-label="Default select example">
                                            <option value="">Semua Provinsi</option>
                                            @foreach ($dataProvince as $item)
                                                <option value="{{ Crypt::encrypt($item->id) }}" {{ $provinceSelected === $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Cari dengan spesifik keyword</label>
                                        <input type="text" name="search" class="form-control" id="" placeholder="Cari disini" value="{{ $search }}">
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-primary" style="margin-top:32px">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        {{-- end area filter data --}}

                        <table class="table table-bordered text-center mt-4">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten</th>
                                    <th>Jumlah Penduduk</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($dataRegency) == 0)
                                    <tr>
                                        <td colspan="5">Data tidak ditemukan</td>
                                    </tr>
                                @endif
                                @foreach ($dataRegency as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->province->name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->total_population }}</td>
                                        <td>
                                            <form action="{{ route('regency.destroy', Crypt::encrypt($item->id)) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
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
@endsection
