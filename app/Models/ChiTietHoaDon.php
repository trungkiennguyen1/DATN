<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class ChiTietHoaDon extends Model
{
 
    use Sortable;
    protected $table = "chi_tiet_hoa_don";

    public function sanpham() {
        return $this->belongsTo(SanPham::class,'san_pham_id','id');
    }
    
    public function hoadon() {
        return $this->belongsTo(HoaDon::class,'hoa_don_id','id');
    }

}
