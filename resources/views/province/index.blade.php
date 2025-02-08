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
                        <b>Input Data Provinsi</b>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('province.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <label for="" class="form-label">Provinsi</label>
                                    <input type="text" name="name" class="form-control" id="">
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
        
        {{-- list data province area --}}
        <div class="row mt-4">
            <div class="col-12 px-0">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <b>Data Provinsi</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center mt-3">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataProvince as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td style="display: flex;justify-content: center;">
                                            <div>
                                                <a href="{{ route('province.edit', Crypt::encrypt($item->id)) }}" class="btn btn-primary">Edit</a> 
                                            </div>
                                            <div style="margin-left: 10px;">
                                                <form action="{{ route('province.destroy', Crypt::encrypt($item->id)) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- end list data province area --}}
    </div>
@endsection
