<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VaiTro;

class VaiTroController extends Controller
{
    private $viewFolder = 'vai-tro';
    private $page = 'Vai trò';

    public function index(Request $req) {
        $pageInfo = [
            'page'  => $this->page
        ];

        $roles = VaiTro::sortable()
                       ->withCount(['quan_tri_vien', 'khach_hang', 'nhan_vien'])
                       ->orderBy('ten')
                       ->paginate($this->limit);

        return view("admin.{$this->viewFolder}.list", compact('pageInfo', 'roles'));
    }
}
