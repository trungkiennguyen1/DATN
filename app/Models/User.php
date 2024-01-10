<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'khach_hang';
    protected $fillable = [
        'email',
        'password',
        'vai_tro_id',
        'google_id',
        'provider',
        'provider_id',
        'ten',
        'sdt',
        'dia_chi',
        'gioi_tinh',
        'hinh_dai_dien',
        'bi_khoa' 
    ];

    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function biKhoaSortable($query, $direction) {
        return $query->orderByRaw("if (bi_khoa = 1, 'Bị khóa', 'Không khóa') {$direction}");
    }
}
