@extends('admin.layout')
@section('main-content')
<form
    @if (isset($manufacture))
        action="{{ route('nha-san-xuat.update', ['id' => $manufacture->id]) }}"
    @else
        action="{{ route('nha-san-xuat.store') }}"
    @endif method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 form-group">
                            <label>Tên @if (!isset($manufacture)) <span style="color: red">*</span> @endif </label>
                            <input type="text" name="ten" id="ten" class="form-control" required maxlength="50" placeholder="Nhập tên" @isset($manufacture) value="{{ $manufacture->ten }}" @endisset/>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-2" style="margin-left: auto">
                            <button type="submit" class="btn btn-primary waves-effect waves-light btn-block">Lưu</button>
                        </div>
                        <div class="col-2">
                            <a href="{{ route('nha-san-xuat.list') }}" class="btn btn-secondary waves-effect waves-light btn-block">Hủy</a>
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
