<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\Cities;
use App\Models\Districts;
use App\Models\Jobs;
use App\Models\Provinces;
use App\Models\Subdistricts;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function index()
    {
        $jobs = Jobs::all();
        $provinces = Provinces::all();
        return view('home', ['jobs' => $jobs, 'provinces' => $provinces]);
    }

    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'name' => 'required|string|unique:accounts,name',
            'birth_place' => 'required|string',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Laki-laki,Wanita',
            'job_id' => 'required|exists:jobs,id',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id',
            'subdistrict_id' => 'required|exists:subdistricts,id',
            'street_name' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'deposit_amount' => 'required|numeric',
        ]);

        // Simpan data pendaftaran rekening
        Accounts::create([
            'name' => $request->name,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'job_id' => $request->job_id,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'subdistrict_id' => $request->subdistrict_id,
            'street_name' => $request->street_name,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'deposit_amount' => $request->deposit_amount,
        ]);

        return redirect()->route('accounts.index')->with('success', 'Rekening berhasil didaftarkan.');
    }

    public function getCities($provinceId)
    {
        $cities = Cities::where('province_id', $provinceId)->pluck('city_name', 'city_id');
        return response()->json($cities);
    }

    public function getDistricts($cityId)
    {
        $districts = Districts::where('city_id', $cityId)->pluck('district_name', 'district_id');
        return response()->json($districts);
    }

    public function getSubdistricts($districtId)
    {
        $subdistricts = Subdistricts::where('district_id', $districtId)->pluck('subdistrict_name', 'subdistrict_id');
        return response()->json($subdistricts);
    }
}
