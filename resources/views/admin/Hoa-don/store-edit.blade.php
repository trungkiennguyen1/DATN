@extends('admin.layout')
@section('main-content')
<form
    @if (isset($hoadon))
        action="{{ route('Hoa-don.update', ['id' => $hoadon->id]) }}"
    @else
        
    @endif method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 form-group">
                            <label>Mã hoa đơn @if (!isset($hoadon)) <span style="color: red">*</span> @endif </label>
                            <input type="text" name="ma_hd" id="ma_hd" class="form-control" required maxlength="50" placeholder="Nhập Mã hoa đơn" @isset($hoadon) value="{{ $hoadon->ma_hd }}" @endisset/>
                        </div>
                        <div class="col-4 form-group">
                            <label>	Tổng tiền @if (!isset($hoadon)) <span style="color: red">*</span> @endif </label>
                            <input type="text" name="tong_tien" id="tong_tien" class="form-control" required maxlength="50" placeholder="Nhập Tổng tiền" @isset($hoadon) value="{{ $hoadon->tong_tien }}" @endisset/>
                        </div>
                  
                        <div class="col-4 form-group">
                            <label>Địa chỉ nhận   @if (!isset($hoadon)) <span style="color: red">*</span> @endif </label>
                            <input type="text" name="dia_chi_nhan" id="dia_chi_nhan" class="form-control" required maxlength="50" placeholder="Nhập Địa chỉ nhận " @isset($hoadon) value="{{ $hoadon->dia_chi_nhan }}" @endisset/>
                        </div>

                        <div class="col-4 form-group">
                            <label>Tình trạng   @if (!isset($hoadon)) <span style="color: red">*</span> @endif </label>
                            <select class="form-control" name="tinh_trang">
                                <option value="Đang duyệt"{{(($hoadon->tinh_trang=='Đang duyệt')? 'selected' : '')}}>Đang duyệt</option>
                                <option value="Đã duyệt"{{(($hoadon->tinh_trang=='Đã duyệt')? 'selected' : '')}}>Đã duyệt</option>
                                <option value="Đã hủy"{{(($hoadon->tinh_trang=='Đã hủy')? 'selected' : '')}}>Đã hủy</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-2" style="margin-left: auto">
                            <button type="submit" class="btn btn-primary waves-effect waves-light btn-block">Lưu</button>
                        </div>
                        <div class="col-2">
                            <a href="{{ route('Hoa-don.list') }}" class="btn btn-secondary waves-effect waves-light btn-block">Hủy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('page-css')
<style>

</style>
@endsection

@section('page-js')
<script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>
@endsection

@section('page-custom-js')
<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();

        const Toast = Swal.mixin({
            toast: true,
            width: "20rem",
            position: 'bottom-start',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                Toast.fire({
                    icon: 'error',
                    title: "{!! $error  !!}"
                });
            @endforeach
        @endif
    });
</script>
@endsection
