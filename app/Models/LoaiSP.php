<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class LoaiSP extends Model
{
    use SoftDeletes, Sortable;

    protected $table = 'loai_sp';
    protected $fillable = ['ten'];

    public function chitietsanpham() {
        return $this->hasMany('App\ChiTietSanPham','loai_sp_id','id	');
    }
}
