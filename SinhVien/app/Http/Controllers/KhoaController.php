<?php

namespace App\Http\Controllers;

use App\LopModel;
use App\NganhModel;
use App\SinhVienModel;
use Illuminate\Http\Request;
use App\KhoaModel;

class KhoaController extends Controller
{
    // xu ly nut
    public function luu(Request $request)
    {
        $data = new KhoaModel();
        $data->id = md5(date('Y-m-d H:i:s'));
        $data->name = $request->get('name');
        if ($data->save()) {
            return redirect('khoa/them')->with('message', 'Thêm mới thành công');
        }

    }

    public function giaodien()
    {
        $data = KhoaModel::orderByRaw('created_at asc')
            ->paginate(5);
        return view('khoa.danhsach', compact('data'));
    }

    public function them()
    {
        return view('khoa.them');

    }

    public function sua($id)
    {
        $data = KhoaModel::find($id);
        return view('khoa.sua', compact('data'));
    }

    public function xoa($id)
    {
        KhoaModel::find($id)->delete();
        NganhModel::where('parent', $id)->delete();
        LopModel::where('parent_khoa', $id)->delete();
        SinhVienModel::where('khoa', $id)->delete();
        return redirect('khoa/giaodien')->with('message', 'Xóa thành công');
        // chay di
        // cai bang sinvien co het khoa nganh lop luon ko lay sao
        // xoa 1 khoa la xoa het nganh lop sinh vien cua khoa do
        // do xong roi
        // o`
        // nganh voi lop tuong tung ha
        #dung roi/ //
    }

    public function capnhat(Request $request, $id)
    {
        $data = KhoaModel::find($id);
        $data->name = $request->get('name');
        if ($data->save()) {
            return redirect('khoa/sua/' . $id)->with('message', 'Cập nhật thành công');
        }
    }

    public function search(Request $request)
    {
        $data = KhoaModel::where('khoa.name', 'like', '%' . $request->get('search') . '%')
            ->orderByRaw('created_at asc')
            ->select([
                'khoa.id as id',
                'khoa.name as name'
            ])
            ->paginate(5);
        return view('khoa.danhsach', compact('data'));
    }
}
