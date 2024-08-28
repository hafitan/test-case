<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Models\Accounts;
use App\Models\Cities;
use App\Models\Districts;
use App\Models\Jobs;
use App\Models\Provinces;
use App\Models\Subdistricts;
use App\Models\ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDO;

class AccountsController extends Controller
{
    public function index()
    {
        $jobs = Jobs::all();
        $provinces = Provinces::all();
        $accounts = Accounts::orderBy('account_id', 'desc')->paginate(10);
        return view('home', ['jobs' => $jobs, 'provinces' => $provinces, 'accounts' => $accounts]);
    }

    public function store(Request $request)
    {
        $pdo = DB::getPdo();
        $sql = 'INSERT INTO accounts (name_account, birth_place, birth_date, gender, ref_job_id, ref_province_id,  ref_district_id, ref_subdistrict_id, ref_ward_id, street_name, rt, rw, deposit_amount, status, created_by, created_at)
                VALUES(:name_account, :birth_place, :birth_date, :gender, :job_id, :province_id, :district_id, :subdistrict_id, :ward_id, :street_name, :rt, :rw, :deposit_amount, :status, :created_by, now()) RETURNING *';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name_account', $request['name_account']);
        $stmt->bindValue(':birth_place', $request['birth_place']);
        $stmt->bindValue(':birth_date', $request['birth_date']);
        $stmt->bindValue(':gender', $request['gender']);
        $stmt->bindValue(':job_id', $request['job_id']);
        $stmt->bindValue(':province_id', $request['province_id']);
        $stmt->bindValue(':district_id', $request['district_id']);
        $stmt->bindValue(':subdistrict_id', $request['subdistrict_id']);
        $stmt->bindValue(':ward_id', $request['ward_id']);
        $stmt->bindValue(':street_name', $request['street_name']);
        $stmt->bindValue(':rt', $request['rt']);
        $stmt->bindValue(':rw', $request['rw']);
        $stmt->bindValue(':deposit_amount', $request['deposit_amount']);
        $stmt->bindValue(':status', 'menunggu');
        $stmt->bindValue(':created_by', 1);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
       
        return redirect()->route('index');
    }
    


    public function getDistricts($provinceId)
    {
        $pdo = DB::getPdo();

        $sql = 'SELECT district_id AS id, district_name AS name
                FROM districts a
                JOIN provinces b ON a.ref_province_id = b.province_id
                WHERE b.province_id = :province_id';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':province_id', $provinceId);
        $stmt->execute();

        $districts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return response()->json($districts);
    }

    
    public function getSubdistricts($districtId)
    {
        $pdo = DB::getPdo();

        $sql = 'SELECT subdistrict_id AS id, subdistrict_name AS name
                FROM subdistricts a
                JOIN districts b ON a.ref_district_id = b.district_id
                WHERE b.district_id = :district_id';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':district_id', $districtId);
        $stmt->execute();

        $subdistricts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return response()->json($subdistricts);
    }
    
    public function getWards($subdistrictId)
    {
        $pdo = DB::getPdo();

        $sql = 'SELECT ward_id AS id, ward_name AS name
                FROM wards a
                JOIN subdistricts b ON a.ref_subdistrict_id = b.subdistrict_id
                WHERE b.subdistrict_id = :subdistrict_id';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':subdistrict_id', $subdistrictId);
        $stmt->execute();

        $subdistricts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return response()->json($subdistricts);
    }

    public function updateApproval($account_id)
    {
        $pdo = DB::getPdo();

        $sql = 'UPDATE accounts SET status = '."'disetujui'".', updated_at = now() WHERE account_id = :account_id RETURNING *';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':account_id', $account_id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return redirect()->route('index');
    }

}