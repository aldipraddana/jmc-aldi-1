<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegencyRequest;
use App\Repositories\ProvinceRepository;
use App\Repositories\RegencyRepository;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
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

    public function export() {
        $regencyData = $this->regencyRepository->getAllPopulationByProvince();
        $view = 'pdf.export-province';
        $request = request()->input();
        if (!empty($request)) {
            $province = $this->provinceRepository->getProvinceById($request['province']);
            $regencyData = $this->regencyRepository->getRegencyByProvince($request['province']);
            $view = 'pdf.export-regency';
        }
        $pdf = FacadePdf::loadView($view, [
            'data' => $regencyData,
            'province' => $province ?? null,
        ]);
        return $pdf->stream('laporan-jumlah-penduduk.pdf');
    }
}
