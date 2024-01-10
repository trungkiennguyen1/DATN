<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class ChiTietSP extends Model
{
    use SoftDeletes;

    protected $table = 'chi_tiet_sp';
    protected $casts = ['hinh_anh'  => 'json'];
    protected $appends = ['anh_chi_tiet_sp'];
    protected $fillable = [
        'san_pham_id',
        'loai_sp_id',
        'nha_sx_id',
        'ten_sp',
        'gia',
        'mo_ta',
        'mau_sac',
        'so_luong',
        'giam_gia',
        'hinh_anh',
        'chat_lieu',
        'so_ngan',
        'khoi_luong',
        'kich_thuoc',
        'tai_trong',
        'ngan_lap',
        'link_youtube',
        'new',
        'tinh_trang'
    ];

    public function loai_sp()
    {
        return $this->belongsTo(LoaiSP::class, 'loai_sp_id', 'id')
                    ->select('id', 'ten');
    }

    public function nha_san_xuat()
    {
        return $this->belongsTo(NhaSanXuat::class, 'nha_sx_id', 'id')
                    ->select('id', 'ten');
    }

    public function san_pham()
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id', 'id')
                    ->select('id', 'hinh_anh');
    }

    public function getAnhChiTietSpAttribute() {
        if (empty($this->hinh_anh)) {
            return null;
        }
        $arrImgs = [];
        foreach ($this->hinh_anh as $img) {
            $arrImgs[] = request()->getSchemeAndHttpHost(). "/anh_ctsp/{$img}";
        }
        return $arrImgs;
    }

}
