<?php

namespace App\Repositories;

use App\Models\Regency;
use Illuminate\Support\Facades\Crypt;

class RegencyRepository
{
    public function create(array $data) 
    {
        Regency::create($data);
    }

    public function delete($id) 
    {
        $id = Crypt::decrypt($id);
        Regency::find($id)->delete();
    }

    public function getAllRegency() 
    {
        return Regency::with('province')->get();
    }

    public function getRegencyByFilter($request) 
    {   
        $provinceId = null;
        $search = '';
        if (!empty($request['province'])) {
            $provinceId = Crypt::decrypt($request['province']);
        }
        if (!empty($request['search'])) {
            $search = $request['search'];
        }
        $query = Regency::leftJoin('provinces', 'regencies.province_id', '=', 'provinces.id')
                        ->select('regencies.*', 'provinces.name as province_name');
        if (!empty($provinceId)) {
            $query->where('regencies.province_id', $provinceId);
        }
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('regencies.name', 'like', '%' . $search . '%')
                  ->orWhere('provinces.name', 'like', '%' . $search . '%');
            });
        }
        return $query->get();
    }
}