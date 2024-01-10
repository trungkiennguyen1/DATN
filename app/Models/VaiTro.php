<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class VaiTro extends Model
{
    use Sortable;
    protected $table = 'vai_tro';
    protected $fillable = [
        'ten'
    ];

    public function quan_tri_vien()
    {
        return $this->belongsTo(QuanTriVien::class, 'id', 'vai_tro_id')->whereId(1);
    }

    public function nhan_vien()
    {
        return $this->belongsTo(QuanTriVien::class, 'id', 'vai_tro_id')->whereNotIn('id', [1]);
    }

    public function khach_hang()
    {
        return $this->belongsTo(KhachHang::class, 'id', 'vai_tro_id');
    }

    public function demKhSortable($query, $direction) {
        return $query->withCount('khach_hang')
                     ->orderBy('khach_hang_count', $direction);
    }

    public function demQtvSortable($query, $direction) {
        return $query->withCount('quan_tri_vien')
                     ->orderBy('quan_tri_vien_count', $direction);
    }

    public function demNvSortable($query, $direction) {
        return $query->withCount('nhan_vien')
                     ->orderByRaw('nhan_vien_count', $direction);
    }
}
