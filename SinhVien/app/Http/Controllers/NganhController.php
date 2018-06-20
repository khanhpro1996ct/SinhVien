<?php

namespace App\Http\Controllers;

use App\LopModel;
use App\SinhVienModel;
use Illuminate\Http\Request;
use App\NganhModel;
use App\KhoaModel;

class NganhController extends Controller
{
    public function index()
    {
        $data = NganhModel::leftjoin('khoa', 'khoa.id', '=', 'nganh.parent')
            ->orderByRaw('nganh.created_at asc')
            ->select([
                'nganh.id as id',
                'nganh.name as name',
                'khoa.name as khoa'
            ])
            ->paginate(20);
        return view('nganh.danhsach', compact('data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $data = new NganhModel();
        $data->id = md5(date('Y-m-d H:i:s'));
        $data->name = $request->get('name');
        $data->parent = $request->get('khoa');
        if ($data->save()) {
            return redirect('nganh/create')->with('message', 'Thêm mới thành công');
        }
    }

    public function create()
    {
        $khoas = KhoaModel::all();
        $nganhs = NganhModel::all();
        return view('nganh.them', compact('khoas', 'nganhs'));

    }


    public function edit($id)
    {
        // dd($id);
        $data = NganhModel::leftjoin('khoa', 'khoa.id', '=', 'nganh.parent')
            ->where('nganh.id', '=', $id)
            ->first([
                'nganh.id as id',
                'nganh.name as name',
                'khoa.id as idkhoa',
                'khoa.name as khoa'
            ]);
        $khoas = KhoaModel::all();
        // return response($data)
        //     ->header('Content-Type', 'application/json');
        return view('nganh.sua', compact('data', 'khoas'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $data = NganhModel::find($id);
        // data : id, name, parent
        $data->name = $request->get('name');
        $data->parent = $request->get('khoa');

        if ($data->save()) {
            return redirect('nganh/edit/' . $id)->with('message', 'Cập nhật thành công');
        }
    }

    public function destroy($id)
    {
        NganhModel::find($id)->delete();
        LopModel::where('parent_nganh', $id)->delete();
        SinhVienModel::where('nganh', $id)->delete();
        return redirect('nganh/index')->with('message', 'Xóa thành công');
    }

    public function search(Request $request)
    {
        $data = NganhModel::leftjoin('khoa', 'khoa.id', '=', 'nganh.parent')
            ->where('nganh.name', 'like', '%' . $request->get('search') . '%')
            ->orwhere('khoa.name', 'like', '%' . $request->get('search') . '%')
            ->orderByRaw('nganh.created_at asc')
            ->select([
                'nganh.id as id',
                'nganh.name as name',
                'khoa.name as khoa'
            ])
            ->paginate(20);
        return view('nganh.danhsach', compact('data'));
    }

}
