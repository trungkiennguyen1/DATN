<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $limit = 20;

    protected $add = 'Thêm mới';
    protected $edit = 'Cập nhật';

    protected $msgNotFound = 'Không tìm thấy thông tin';

    protected $msgStoreErr = 'Có lỗi trong khi tạo mới';
    protected $msgStoreSuc = 'Tạo mới thành công';

    protected $msgUpdateErr = 'Có lỗi trong khi cập nhật';
    protected $msgUpdateSuc = 'Cập nhật thành công';

    protected $msgDeleteErr = 'Có lỗi trong khi xóa';
    protected $msgDeleteCant = 'Không thể xóa';
    protected $msgDeleteSuc = 'Thành công';

    protected $msgChangePassErr = 'Có lỗi trong khi đổi mật khẩu';
    protected $msgChangePassSuc = 'Đổi mật khẩu thành công';
}
