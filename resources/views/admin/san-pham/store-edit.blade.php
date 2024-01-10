@extends('admin.layout')
@section('main-content')
<form
    @if (isset($product))
        action="{{ route('san-pham.update', ['id' => $product->id]) }}"
    @else
        action="{{ route('san-pham.store') }}"
    @endif method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 form-group">
                            <label>Mã sản phẩm @if (!isset($product)) <span style="color: red">*</span> @endif </label>
                            <input type="text" name="ma_sp" id="ma_sp" class="form-control" required maxlength="10" placeholder="Nhập mã sản phẩm" @isset($product) value="{{ $product->ma_sp }}" @endisset/>
                        </div>

                        <div class="col-3 form-group">
                            <label>Tên sản phẩm @if (!isset($product_detail)) <span style="color: red">*</span> @endif </label>
                            <input type="text" name="ten_sp" id="ten_sp" class="form-control" required maxlength="50" placeholder="Nhập tên sản phẩm" @isset($product_detail) value="{{ $product_detail->ten_sp }}" @endisset/>
                        </div>

                        <div class="col-3 form-group">
                            <label>Loại sản phẩm @if (!isset($product_detail)) <span style="color: red">*</span> @endif </label>
                            <select class="form-control" id="loai_sp_id" name="loai_sp_id" required>
                                @if (!isset($product_detail))
                                    <option selected disabled>Chọn loại sản phẩm</option>
                                @endif
                                @if (isset($product_types))
                                    @foreach ($product_types as $product_type)
                                        <option @if (isset($product_detail) && $product_type->id == $product_detail->loai_sp_id) selected @endif value="{{ $product_type->id }}"> {{ $product_type->ten }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-3 form-group">
                            <label>Nhà sản xuất @if (!isset($product_detail)) <span style="color: red">*</span> @endif </label>
                            <select class="form-control" id="nha_sx_id" name="nha_sx_id" required>
                                @if (!isset($product_detail))
                                    <option selected disabled>Chọn nhà sản xuất</option>
                                @endif
                                @if (isset($manufactures))
                                    @foreach ($manufactures as $manufacture)
                                        <option @if (isset($product_detail) && $manufacture->id == $product_detail->nha_sx_id) selected @endif value="{{ $manufacture->id }}"> {{ $manufacture->ten }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2 form-group">
                            <label>Giá @if (!isset($product_detail)) <span style="color: red">*</span> @endif </label>
                            <input type="text" name="gia" id="gia" class="form-control" required maxlength="20" placeholder="Nhập giá" @isset($product_detail) value="{{ $product_detail->gia }}" @endisset/>
                        </div>

                        <div class="col-3 form-group">
                            <label>Chất liệu @if (!isset($product_detail)) <span style="color: red">*</span> @endif </label>
                            <input type="text" name="chat_lieu" id="chat_lieu" class="form-control" required maxlength="100" placeholder="Nhập chất liệu" @isset($product_detail) value="{{ $product_detail->chat_lieu }}" @endisset/>
                        </div>

                        <div class="col-3 form-group">
                            <label>Số ngăn @if (!isset($product_detail)) <span style="color: red">*</span> @endif</label>
                            <input type="text" name="so_ngan" id="so_ngan" class="form-control" required maxlength="100" placeholder="Nhập số ngăn" @isset($product_detail) value="{{ $product_detail->so_ngan }}" @endisset/>
                        </div>

                        <div class="col-2 form-group">
                            <label>Khối lượng<span class="text-secondary font-12">(kg)</span> @if (!isset($product_detail)) <span style="color: red">*</span> @endif </label>
                            <input type="text" name="khoi_luong" id="khoi_luong" class="form-control" required maxlength="5" placeholder="Nhập khối lượng" @isset($product_detail) value="{{ $product_detail->khoi_luong }}" @endisset/>
                        </div>

                        <div class="col-2 form-group">
                            <label>Kích thước<span class="text-secondary font-12">(cm)</span> @if (!isset($product_detail)) <span style="color: red">*</span> @endif </label>
                            <input type="text" name="kich_thuoc" id="kich_thuoc" class="form-control" required maxlength="20" placeholder="Nhập kich thước" @isset($product_detail) value="{{ $product_detail->kich_thuoc }}" @endisset/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2 form-group">
                            <label>Tải trọng<span class="text-secondary font-12">(kg)</span> @if (!isset($product_detail)) <span style="color: red">*</span> @endif </label>
                            <input type="text" name="tai_trong" id="tai_trong" class="form-control" required maxlength="3" placeholder="Nhập tải trọng" @isset($product_detail) value="{{ $product_detail->tai_trong }}" @endisset/>
                        </div>

                        <div class="col-2 form-group">
                            <label>Số lượng @if (!isset($product_detail)) <span style="color: red">*</span> @endif </label>
                            <input type="text" name="so_luong" id="so_luong" class="form-control" required maxlength="4" placeholder="Nhập số lượng" @isset($product_detail) value="{{ $product_detail->so_luong }}" @endisset/>
                        </div>

                        <div class="col-2 form-group">
                            <label>Giảm giá</label>
                            <input type="text" name="giam_gia" id="giam_gia" class="form-control" maxlength="5" placeholder="Nhập giảm giá" @isset($product_detail) value="{{ $product_detail->giam_gia }}" @endisset/>
                        </div>

                        <div class="col-2 form-group">
                            <label>Màu sắc @if (!isset($product_detail)) <span style="color: red">*</span> @endif </label>
                            <input type="text" name="mau_sac" id="mau_sac" class="form-control" required maxlength="20" placeholder="Nhập màu" @isset($product_detail) value="{{ $product_detail->mau_sac }}" @endisset/>
                        </div>

                        <div class="col-2 form-group">
                            <label>Ngăn laptop<span class="text-secondary font-12">(inch)</span> @if (!isset($product_detail)) <span style="color: red">*</span> @endif </label>
                            <input type="text" name="ngan_lap" id="ngan_lap" class="form-control" required maxlength="5" placeholder="Nhập ngăn laptop" @isset($product_detail) value="{{ $product_detail->ngan_lap }}" @endisset/>
                        </div>

                        <div class="col-2 form-group">
                            <label>Link youtube<span class="text-secondary font-12"></span></label>
                            <input type="text" name="link_youtube" id="link_youtube" class="form-control" maxlength="100" placeholder="Nhập link youtube" @isset($product_detail) value="{{ $product_detail->link_youtube }}" @endisset/>
                        </div>

                        <div class="col-2 form-group">
                            <label>Sản phẩm @if (!isset($product_detail)) <span style="color: red">*</span> @endif </label>
                            <select name="tinh_trang" id="tinh_trang" class="form-control" required>
                                @if (!isset($product_detail))
                                    <option disabled selected>Chọn sản phẩm</option>
                                @endif
                                <option @if (isset($product_detail) && $product_detail->new == 0) selected @endif value="0">Sản phẩm mới</option>
                                <option @if (isset($product_detail) && $product_detail->new == 1) selected @endif value="1">Sản phẩm cũ</option>
                            </select>
                        </div>
                        
                        <div class="col-2 form-group">
                            <label>Tình trạng @if (!isset($product_detail)) <span style="color: red">*</span> @endif </label>
                            <select name="tinh_trang" id="tinh_trang" class="form-control" required>
                                @if (!isset($product_detail))
                                    <option disabled selected>Chọn tình trạng</option>
                                @endif
                                <option @if (isset($product_detail) && $product_detail->tinh_trang == 0) selected @endif value="0">Còn hàng</option>
                                <option @if (isset($product_detail) && $product_detail->tinh_trang == 1) selected @endif value="1">Hết hàng</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 form-group">
                            <label>Mô tả @if (!isset($product_detail)) <span style="color: red">*</span> @endif </label>
                            <textarea name="mo_ta" id="mo_ta" class="form-control" rows="7" required maxlength="191" placeholder="Nhập mô tả">@isset($product_detail) {{ $product_detail->mo_ta }} @endisset</textarea>
                        </div>

                        <div class="col-6 form-group">
                            <label>Hình ảnh @if (!isset($product_detail)) <span style="color: red">*</span> @endif </label>
                            <div class="col-12 row">

                                <div class="col-3">
                                    <label for="files" class="btn btn-primary waves-effect waves-light btn-block">Tải hình</label>

                                </div>

                                <div class="col-3">
                                    <button type="button" class="btn btn-secondary waves-effect waves-light btn-block btn-remove">Xóa hình</button>
                                </div>

                                <div class="col-5">
                                    @if (isset($product_detail))
                                        <input type="hidden" name="is_remove" id="is_remove">
                                    @endif
                                    <input type="file" id="files" @if (!isset($product_detail)) required @endif class="d-none" name="hinh_anh[]" accept=".png, .jpg, .jpeg" multiple/>
                                </div>
                            </div>
                            <div id="image_preview">
                                @if (isset($product_detail->anh_chi_tiet_sp))
                                    @foreach ($product_detail->anh_chi_tiet_sp as $img)
                                        <div class="file-thumb position-relative d-inline-flex mx-2 my-2" style="width: 6rem">
                                            <img style="width:100%" src="{{ $img }}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2" style="margin-left: auto">
                            <button type="submit" class="btn btn-primary waves-effect waves-light btn-block">Lưu</button>
                        </div>
                        <div class="col-2">
                            <a href="{{ route('san-pham.list') }}" class="btn btn-secondary waves-effect waves-light btn-block">Hủy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

</div>
@endsection

@section('page-css')
<style>
    #image_preview button {
        position: absolute;
        right: 0;
        top: 0;
    }

    .close {
        line-height: 0;
    }
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

        $('#files').change(function() {
            $('#image_preview').empty();
            var fileInput = document.getElementById("files");
            for (var i = 0; i < fileInput.files.length; i++) {
                var img = `<div class="file-thumb position-relative d-inline-flex mx-2 my-2" style="width: 6rem">
                    <img style="width:100%" src="${URL.createObjectURL(event.target.files[i])}">
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true" class="btn-close font-15 fa fa-times" onclick="click_close()"></span>
                    </button>
                </div>`;
                $('#image_preview').append(img);
            }
        });

        $('.btn-remove').click(function() {
            $('#image_preview').empty();
            $('#is_remove').val('removed');
        });

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                Toast.fire({
                    icon: 'error',
                    title: "{!! $error !!}"
                });
            @endforeach
        @endif
    });

    function click_close() {
        var node = event.srcElement.parentElement.parentElement;
        var preview_image = document.getElementById("image_preview");
        preview_image.removeChild(node);
    }
</script>
@endsection
