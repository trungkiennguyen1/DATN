@extends('admin.layout')
@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <a href="{{ route('nha-san-xuat.create') }}" class="btn btn-success waves-effect waves-light mb-4"><i class="fas fa-plus-square"></i> Thêm mới</a>
                    </div>
                    <div class="col-4 form-search">
                        <form action="{{ route('nha-san-xuat.list') }}" method="GET" id="formSearch" class="app-search mt-0">
                            <div class="form-group mb-0">
                                <input type="text" name="keyword" id="keyword" class="input-search form-control mr-0" placeholder="Tìm kiếm..." style="position: absolute; right: 0;" @if (isset($keyword)) value="{{ $keyword }}" @endif>
                                <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-default">
                            <tr>
                                <th scope="col">@sortablelink('ten', 'Tên', '', ['style' => 'color: black'])</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($manufactures) > 0)
                                @foreach ($manufactures as $manufacture)
                                <tr>
                                    <td>{{ $manufacture->ten }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('nha-san-xuat.edit', ['id' => $manufacture->id]) }}" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-secondary btn-sm waves-effect waves-light btn-delete" data-id="{{ $manufacture->id }}" data-title="{{ $manufacture->ten }}" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                @if (!empty($keyword))
                                    @include('admin.partials.no-data-search')
                                @else
                                    @include('admin.partials.no-data')
                                @endif
                            @endif
                        </tbody>
                    </table>
                </div>
                @if (isset($manufactures))
                <div class="d-flex justify-content-between mt-3">
                    <div style="padding: .5rem .75rem; margin-bottom: 1rem;">
                        Hiển thị @if ($manufactures->firstItem())
                            {{ $manufactures->firstItem() }}
                        @else
                            0
                        @endif tới @if ($manufactures->lastItem())
                            {{ $manufactures->lastItem() }}
                        @else
                            0
                        @endif trong {{ $manufactures->total() }} mục
                    </div>
                    <div>
                        {{ $manufactures->onEachSide(1)->withQueryString()->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-css')
<style>
    .form-search .close {
        display: none;
        position: absolute;
        top: 0;
        right: 0;
        font-size: 18px;
        padding: 0.45rem 0.8rem;
        color: inherit;
    }
</style>
@endsection

@section('page-js')
@endsection

@section('page-custom-js')
<script type="text/javascript">
    $(document).ready(function() {
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

        @if (session('status'))
            @if (session('status') == 'success')
                Toast.fire({
                    icon: 'success',
                    title: "{!! session('message') !!}"
                });
            @else
                Toast.fire({
                    icon: 'error',
                    title: "{!! session('message') !!}"
                });
            @endif
        @endif

        var inputSearch = $('.input-search');
        var btnClose = $('.close');

        if (inputSearch.val()) {
            btnClose.show();
            inputSearch.blur();
        } else {
            inputSearch.focus();
        }

        inputSearch.keydown(function() {
            btnClose.show();
        });

        btnClose.click(function() {
            inputSearch.val('');
            $(this).hide();
            document.forms['formSearch'].submit();
        });

        var timeout;
        var delay = 1000;

        inputSearch.keyup(function() {
            if (timeout) {
                clearTimeout(timeout);
            }

            timeout = setTimeout(function() {
                document.forms['formSearch'].submit();
            }, delay);
        });

        $('.btn-delete').click(function() {
            var mId = $(this).data("id");
            var mTitle = $(this).data("title");
            Swal.fire({
                title: `Bạn có chắc xóa "${mTitle}" ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có',
                cancelButtonText: 'Không',
                reverseButtons: true,
                confirmButtonColor: "#02c58d",
                cancelButtonColor: "#fc3b3b",
                preConfirm: () => {
                    return new Promise(function (resolve) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url : "{!! route('nha-san-xuat.delete') !!}",
                            type: "DELETE",
                            data: { id : mId }
                        }).done(function (response) {
                            Swal.fire(
                                `${response.title}`,
                                `${response.msg}`,
                                `${response.status}`,
                            ).then(() => {
                                location.reload();
                            });
                        })
                    })
                }
            });
        });
    });
</script>
@endsection
