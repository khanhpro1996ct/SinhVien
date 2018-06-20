<?php

namespace App\Http\Controllers;

use App\SinhVienModel;
use Illuminate\Http\Request;
use App\LopModel;
use App\NganhModel;
use App\KhoaModel;

class LopController extends Controller
{
    public function index()
    {
        $data = LopModel::leftjoin('nganh', 'nganh.id', '=', 'lop.parent_nganh')
            ->leftjoin('khoa', 'khoa.id', '=', 'lop.parent_khoa')
            ->orderByRaw('lop.created_at asc')
            ->select([
                'lop.id as id',
                'lop.name as name',
                'nganh.name as nganh',
                'khoa.name as khoa'
            ])
            ->paginate(20);
        return view('lop.danhsach', compact('data'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $data = new LopModel();
        $data->id = md5(date('Y-m-d H:i:s'));
        $data->name = $request->get('name');
        $data->parent_nganh = $request->get('nganh');
        $data->parent_khoa = $request->get('khoa');
        if ($data->save()) {
            return redirect('lop/create')->with('message', 'Thêm thành công');
        }
    }

    public function create()
    {
        $khoas = KhoaModel::all();
        $nganhs = NganhModel::all();
        return view('lop.them', compact('khoas', 'nganhs'));
    }

    public function destroy($id)
    {
        LopModel::find($id)->delete();
        SinhVienModel::where('lop',$id)->delete();
        return redirect('lop/index')->with('message', 'Xóa thành công');
    }

    public function getKhoaName(Request $request)
    {
        $idlaydc = $request->get('id');
        $idkhoa = NganhModel::where('id', $idlaydc)->first()->parent;
        return $idkhoa;
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


    public function edit($id)
    {
        // dd($id);
        $data = LopModel::leftjoin('nganh', 'nganh.id', '=', 'lop.parent_nganh')
            ->leftjoin('khoa', 'khoa.id', '=', 'lop.parent_khoa')
            ->where('lop.id', '=', $id)
            ->first([
                'lop.id as id',
                'lop.name as name',
                'nganh.name as nganh',
                'khoa.name as khoa'
            ]);
        $nganhs = NganhModel::all();
        $khoas = KhoaModel::all();
        return view('lop.sua', compact('data', 'nganhs', 'khoas'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $data = LopModel::find($id);
        // data : id, name, parent
        $data->name = $request->get('name');
        $data->parent_nganh = $request->get('nganh');
        $data->parent_khoa = $request->get('khoa');

        if ($data->save()) {
            return redirect('lop/edit/' . $id)->with('message', 'Cập nhật thành công');
        }
    }

    public function search(Request $request)
    {
        $data = LopModel::leftjoin('nganh', 'nganh.id', '=', 'lop.parent_nganh')
            ->join('khoa', 'khoa.id', '=', 'lop.parent_khoa')
            ->where('lop.name', 'like', '%' . $request->get('search') . '%')
            ->orwhere('nganh.name', 'like', '%' . $request->get('search') . '%')
            ->orwhere('khoa.name', 'like', '%' . $request->get('search') . '%')
            ->orderByRaw('lop.created_at asc')
            ->select([
                'lop.id as id',
                'lop.name as name',
                'nganh.name as nganh',
                'khoa.name as khoa'
            ])
            ->paginate(20);
        return view('lop.danhsach', compact('data'));
    }
}