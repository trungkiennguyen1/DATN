<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class KhachHang extends Model
{
    use SoftDeletes, Sortable;

    protected $table = 'khach_hang';
    protected $fillable = [
        'email',
        'password',
        'vai_tro_id',
        'google_id',
        'ten',
        'sdt',
        'dia_chi',
        'gioi_tinh',
        'hinh_dai_dien',
        'bi_khoa'
    ];
    public function hoadon() {
        return $this->hasMany(HoaDon::class,'khach_hang_id','id');
    }
    protected $hidden = ['mat_khau'];

    public function biKhoaSortable($query, $direction) {
        return $query->orderByRaw("if (bi_khoa = 1, 'Bị khóa', 'Không khóa') {$direction}");
    }
}
