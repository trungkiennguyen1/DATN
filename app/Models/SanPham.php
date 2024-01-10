<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class SanPham extends Model
{
    use SoftDeletes, Sortable;

    protected $table = 'san_pham';
    protected $appends = ['anh_sp'];
    protected $fillable = [
        'ma_sp',
        'hinh_anh'
    ];

    public function getAnhSpAttribute() {
        if (empty($this->hinh_anh)) {
            return null;
        }

        return request()->getSchemeAndHttpHost(). '/anh_sp/'. $this->hinh_anh;
    }

    public function chi_tiet_sp()
    {
        return $this->hasOne(ChiTietSP::class, 'san_pham_id', 'id');
    }

    public function tenSpSortable($query, $direction) {
        return $query->join('chi_tiet_sp as ctsp', 'san_pham.id', 'ctsp.san_pham_id')
                     ->orderBy('ten_sp', $direction)
                     ->select('san_pham.*');
    }

    public function scopeGetProductByDate($query, $req) {
        if (empty($req->toDate) && !empty($req->fromDate)) {
            $from = date('Y-m-d', strtotime($req->fromDate));
            $query->whereDate('created_at', '>=', $from);
        }

        if (empty($req->fromDate) && !empty($req->toDate)) {
            $to = date('Y-m-d', strtotime($req->toDate));
            $query->whereDate('created_at', '<=', $to);
        }

        if (!empty($req->fromDate) && !empty($req->toDate)) {
            $from = date('Y-m-d', strtotime($req->fromDate));
            $to = date('Y-m-d', strtotime($req->toDate));
            $query->whereDate('created_at', '>=', $from)
                  ->whereDate('created_at', '<=', $to);
        }

        return $query->with(['chi_tiet_sp'  => function($q) {
            $q->with(['loai_sp', 'nha_san_xuat']);
        }])->orderBy('ma_sp');
    }

}
