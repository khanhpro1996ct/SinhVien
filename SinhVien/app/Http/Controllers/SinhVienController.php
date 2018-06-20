<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\SinhVienModel;
use App\KhoaModel;
use App\NganhModel;
use App\LopModel;
use Illuminate\Validation;
use Illuminate\Support\Facades\Auth;


class SinhVienController extends Controller
{
    public function index()
    {
        $data = SinhVienModel::leftjoin('nganh', 'nganh.id', '=', 'sinhvien.nganh')
            ->leftjoin('khoa', 'khoa.id', '=', 'sinhvien.khoa')
            ->leftjoin('lop', 'lop.id', '=', 'sinhvien.lop')
            ->where('sinhvien.isquanly', 0)
            ->orderByRaw('sinhvien.created_at asc')
            ->select([
                'sinhvien.id as id',
                'sinhvien.mssv as mssv',
                'sinhvien.name as name',
                'sinhvien.gioitinh as gioitinh',
                'lop.name as lop',
                'nganh.name as nganh',
                'khoa.name as khoa',
                'sinhvien.email as email',
                'sinhvien.sdt as sdt',
                'sinhvien.anh as anh',
                'sinhvien.password as password'
            ])
            ->paginate(20);
        $khoas = KhoaModel::all();
        $nganhs = NganhModel::all();
        $lops = LopModel::all();
        return view('sinhvien.danhsach', compact('data', 'khoas', 'nganhs', 'lops'));
    }

    public function store(Request $request)
    {
        $data = new SinhVienModel();
        $data->id = md5(date('Y-m-d H:i:s'));
        $data->mssv = $request->get('mssv');
        $data->name = $request->get('name');
        $data->gioitinh = $request->get('gioitinh');
        $data->lop = $request->get('lop');
        $data->khoa = $request->get('khoa');
        $data->nganh = $request->get('nganh');
        $data->email = $request->get('email');
        $data->sdt = $request->get('sdt');
        if (Input::hasFile('file')) {
            $file = Input::file('file');
            $file->move('upload', $file->getClientOriginalName());
            $data->anh = $file->getClientOriginalName();
        } else {
            $data->anh = "";
        }
        $data->password = Hash::make($request->get('password'));
        $data->isquanly = 0;
        if ($data->save()) {
            return redirect('sinhvien/create')->with('message', 'Thêm thành công');
        }
    }

    public function create()
    {
        $lops = LopModel::all();
        $khoas = KhoaModel::all();
        $nganhs = NganhModel::all();
        return view('sinhvien.them', compact('nganhs', 'lops', 'khoas'));

    }

    public function destroy($id)
    {
        SinhVienModel::find($id)->delete();
        return redirect('sinhvien/index')->with('message', 'Xóa thành công');
    }

    public function getKhoaName(Request $request)
    {
        $idlaydc = $request->get('id');
        $idkhoa = NganhModel::where('id', $idlaydc)->first()->parent;
        return $idkhoa;
    }

    public function getNganhName(Request $request)
    {
        $idlaydc = $request->get('id');
        $idNganh = LopModel::where('id', $idlaydc)->first()->parent_nganh;
        return $idNganh;
    }

    public function getListNganh(Request $request)
    {
        $idlaydc = $request->get('id');
        $data = NganhModel::where('parent', $idlaydc)
            ->get([
                'id', 'name'
            ]);
        return $data;
    }

    public function getListLop(Request $request)
    {
        $idlaydc = $request->get('id');
        $data = LopModel::where('parent_nganh', $idlaydc)
            ->get([
                'id', 'name'
            ]);
        return $data;
    }

    public function edit($id)
    {
        $data = SinhVienModel::leftjoin('nganh', 'nganh.id', '=', 'sinhvien.nganh')
            ->leftjoin('khoa', 'khoa.id', '=', 'sinhvien.khoa')
            ->leftjoin('lop', 'lop.id', '=', 'sinhvien.lop')
            ->where('sinhvien.id', '=', $id)
            ->first([
                'sinhvien.id as id',
                'sinhvien.mssv as mssv',
                'sinhvien.name as name',
                'sinhvien.gioitinh as gioitinh',
                'lop.name as lop',
                'nganh.name as nganh',
                'khoa.name as khoa',
                'sinhvien.email as email',
                'sinhvien.sdt as sdt',
                'sinhvien.anh as anh',

            ]);
        $lops = LopModel::all();
        $khoas = KhoaModel::all();
        $nganhs = NganhModel::all();
        return view('sinhvien.sua', compact('data', 'lops', 'nganhs', 'khoas'));
    }

    public function update(Request $request, $id)
    {
        $data = SinhVienModel::find($id);
        $data->mssv = $request->get('mssv');
        $data->name = $request->get('name');
        $data->gioitinh = $request->get('gioitinh');
        $data->khoa = $request->get('khoa');
        $data->nganh = $request->get('nganh');
        $data->lop = $request->get('lop');
        $data->email = $request->get('email');
        $data->sdt = $request->get('sdt');
        if (Input::hasFile('file')) {
            $file = Input::file('file');
            $file->move('upload', $file->getClientOriginalName());
            $data->anh = $file->getClientOriginalName();
        }
        if ($data->save()) {
            return redirect('sinhvien/edit/' . $id)->with('message', 'Cập nhật thành công');
        }
    }

    // searach

    public function seacrhNganh(Request $request)
    {
        $idlaydc = $request->get('id');
        $data = NganhModel::where('parent', $idlaydc)
            ->get([
                'id', 'name'
            ]);
        if($data)
        {

        }
        return $data;
    }

    public function search(Request $request)
    {

        /*
         * 1. Tim kiem theo Khoa
         * 2. Tim kiem theo Khoa va Nganh
         * 3. Tim kiem theo Khoa va Nganh va Lop (done)
         * 4. Khi chon lai gia tri cho select cha thi select con phai load lai value
         * 5. Tim kiem ten cung luc voi tim kiem khoa nganh lop
         *
         * */


        // search khoa nganh lop
        $data = SinhVienModel::join('khoa', 'khoa.id', '=', 'sinhvien.khoa')
            ->join('nganh', 'nganh.id', '=', 'sinhvien.nganh')
            ->join('lop', 'lop.id', '=', 'sinhvien.lop')
            ->where('sinhvien.isquanly', 0)
            ->orderByRaw('sinhvien.created_at asc');
        $seacrhkhoa = $request->get('khoa');
        $seacrhnganh = $request->get('nganh');
        $seacrhlop = $request->get('lop');
        $seacrhsinhvien = $request->get('search');
        if ($seacrhsinhvien != null && !empty($seacrhsinhvien)) {
            $data = $data->where('sinhvien.mssv', 'like', '%' . $request->get('search') . '%')
                ->orwhere('sinhvien.name', 'like', '%' . $request->get('search') . '%');
        }
        if (!empty($seacrhkhoa)) {
            $data = $data->where('sinhvien.khoa', $request->get('khoa'));
        }
        if (!empty($seacrhnganh)) {
            $data = $data->where('sinhvien.nganh', $request->get('nganh'));
        }
        if (!empty($seacrhlop)) {
            $data = $data->where('sinhvien.lop', $request->get('lop'));
        }
        $data = $data->select([
            'sinhvien.id as id',
            'sinhvien.mssv as mssv',
            'sinhvien.name as name',
            'sinhvien.gioitinh as gioitinh',
            'lop.name as lop',
            'nganh.name as nganh',
            'khoa.name as khoa',
            'sinhvien.email as email',
            'sinhvien.sdt as sdt',
            'sinhvien.anh as anh',
            'sinhvien.password as password'
        ])
            ->paginate(20);
        $khoas = KhoaModel::all();
        $nganhs = NganhModel::all();
        $lops = LopModel::all();
        return view('sinhvien.danhsach', compact('data', 'khoas', 'nganhs', 'lops'));
    }

    public function getLogin()
    {
        return view('Login');
    }

    public function show($id)
    {
        $data = SinhVienModel::leftjoin('nganh', 'nganh.id', '=', 'sinhvien.nganh')
            ->leftjoin('khoa', 'khoa.id', '=', 'sinhvien.khoa')
            ->leftjoin('lop', 'lop.id', '=', 'sinhvien.lop')
            ->where('sinhvien.id', $id)
            ->where('sinhvien.isquanly', 0)
            ->first([
                'sinhvien.id as id',
                'sinhvien.mssv as mssv',
                'sinhvien.name as name',
                'sinhvien.gioitinh as gioitinh',
                'lop.name as lop',
                'nganh.name as nganh',
                'khoa.name as khoa',
                'sinhvien.email as email',
                'sinhvien.sdt as sdt',
                'sinhvien.anh as anh'
            ]);
        return view('user.index', compact('data'));
    }

    public function postLogin(Request $request)
    {
        $mssv = $request->get('mssv');
        $pass = $request->get('password');
        $user = SinhVienModel::where('mssv', '=', $mssv)->first();
        if ($user == null) {
            return redirect()->back();
        } else {
            if (Hash::check($pass, $user->password)) {
                if ($user->isquanly == 1) {
                    return redirect('/admin/index')->with('message', 'Đăng nhập thành công');
                } else {
                    return redirect('user/' . $user->id . '/index')->with('message', 'Đăng nhập thành công');
                }
            }
            return redirect('admin/login');
        }
    }

    public function doimatkhau($id)
    {
        $data = SinhVienModel::find($id);
        return view('doimatkhau', compact('data'));
    }

    public function resetPasswd(Request $request, $id)
    {
        $oldpass = $request->get('oldpass');
        $newpass = $request->get('newpass');
        $repass = $request->get('repass');
        $data = SinhVienModel::find($id);
//        dd($oldpass.'_'.$data->password);
        if (Hash::check($oldpass, $data->password)) {
            if ($newpass == $repass) {
                $newpass = Hash::make($newpass);
                $data->password = $newpass;
                $data->save();
                return redirect('user/' . $id . '/index')->with('message', 'doi mat khau thành công');
            } else {
                return redirect('user/' . $id . '/doi-mat-khau')->with('error', 'nhap lai mat khau moi ko chinh xac');
            }
        } else {
            return redirect('user/' . $id . '/doi-mat-khau')->with('error2', 'doi mat khau that bai22');
        }
    }
}
