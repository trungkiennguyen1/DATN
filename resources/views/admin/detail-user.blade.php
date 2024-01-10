@extends('admin.layout')
@section('main-content')
<form>
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 form-group">
                            <label>Tên</label>
                            <input type="text" name="ten" id="ten" class="form-control" value="{{ $admin->ten }}"/>
                        </div>

                        <div class="col-3 form-group">
                            <label>Số Điện Thoại</label>
                            <input type="text" name="sdt" id="sdt" class="form-control" maxlength="10" value="{{ $admin->sdt }}"/>
                        </div>

                        <div class="col-3 form-group">
                            <label>Email</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{ $admin->email }}"/>
                        </div>

                        <div class="col-3 form-group">
                            <label>Vai trò</label>
                            <input type="text" id="vai_tro" class="form-control" readonly value="{{ $admin->vai_tro->ten }}"/>
                            <input type="hidden" name="vai_tro_id" value="{{ $admin->vai_tro->id }}">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 6px">
                        <div class="col-2" style="margin-left: auto">
                            <button type="button" class="btn btn-primary waves-effect waves-light btn-block btn-update">
                                Cập nhật
                            </button>
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

        $('.file-logo').bind('change', function() {
            var file = this.files[0],
            reader = new FileReader();
            reader.onload = function(e) {
                $('.img-logo').attr('src', e.target.result);
            };

            reader.readAsDataURL(file);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imageUpload").change(function() {
            readURL(this);
        });

        $('.avatar-remove a').click(function() {
            $('#imagePreview').css('background-image', 'url()');
            $('#is_remove').val('removed');
        });

        $('.btn-update').click(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url : "{!! route('detail.update', ['id' => $admin->id]) !!}",
                type: "POST",
                data: $('form').serialize()
            }).done(function(response) {
                if (response.status == 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: response.msg
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: response.msg
                    });
                }

                location.reload();
            });
        });
    });
</script>
@endsection
