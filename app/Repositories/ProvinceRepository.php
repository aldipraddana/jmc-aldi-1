<?php

namespace App\Repositories;

use App\Models\Province;
use Illuminate\Support\Facades\Crypt;

class ProvinceRepository
{
    public function create(array $data) 
    {
        Province::create($data);
    }

    public function update(array $data, $id) 
    {
        $id = Crypt::decrypt($id);
        Province::find($id)->update($data);
    }

    public function delete($id) 
    {
        $id = Crypt::decrypt($id);
        Province::find($id)->delete();
    }

    public function getAllProvince() 
    {
        return Province::orderBy('name', 'asc')->get();
    }

    public function getProvinceById($id) 
    {
        $id = Crypt::decrypt($id);
        return Province::find($id);
    }
}