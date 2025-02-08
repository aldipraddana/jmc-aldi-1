<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProvinceRequest;
use App\Repositories\ProvinceRepository;
use Illuminate\Support\Facades\Crypt;

class ProvinceController extends Controller
{  
    protected $provinceRepository;
    public function __construct()
    {
        $this->provinceRepository = new ProvinceRepository();
    }

    public function index()
    {
        return view('province.index', [
            'menu' => 'Master Provinsi',
            'dataProvince' => $this->provinceRepository->getAllProvince(),
        ]);
    }

    public function edit($id)
    {
        return view('province.edit', [
            'id' => $id,
            'menu' => 'Master Provinsi',
            'dataProvince' => $this->provinceRepository->getProvinceById($id),
        ]);
    }

    public function store(ProvinceRequest $request) {
        try {
            $this->provinceRepository->create($request->validated());
            return redirect()->route('province')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->route('province')->with('error', 'Data gagal disimpan');
        }
    }

    public function update(ProvinceRequest $request, $id) {
        try {
            $this->provinceRepository->update($request->validated(), $id);
            return redirect()->route('province')->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route('province.edit', $id)->with('error', 'Data gagal diubah');
        }
    }

    public function destroy($id) {
        try {
            $this->provinceRepository->delete($id);
            return redirect()->route('province')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('province')->with('error', 'Data gagal dihapus');
        }
    }
}
