<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegencyRequest;
use App\Repositories\ProvinceRepository;
use App\Repositories\RegencyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RegencyController extends Controller
{
    protected $regencyRepository;
    protected $provinceRepository;

    public function __construct()
    {
        $this->regencyRepository = new RegencyRepository();
        $this->provinceRepository = new ProvinceRepository();
    }

    public function index()
    {   
        $regencyData = $this->regencyRepository->getAllRegency();
        $request = request()->input();
        if (!empty($request)) {
            $regencyData = $this->regencyRepository->getRegencyByFilter($request);
        }
        return view('regency.index', [
            'menu' => 'Master Kabupaten',
            'search' => empty($request['search']) ? '' : $request['search'],
            'provinceSelected' => empty($request['province']) ? '' : Crypt::decrypt($request['province']),
            'dataRegency' => $regencyData,
            'dataProvince' => $this->provinceRepository->getAllProvince(),
        ]);
    }

    public function store(RegencyRequest $request)
    {
        try {
            $this->regencyRepository->create($request->validated());
            return redirect()->route('regency')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->route('regency')->with('error', 'Data gagal disimpan');
        }
    }

    public function destroy($id)
    {
        try {
            $this->regencyRepository->delete($id);
            return redirect()->route('regency')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('regency')->with('error', 'Data gagal dihapus');
        }
    }
}
