@extends('admin.layout')
@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-default">
                            <tr>
                                <th scope="col">@sortablelink('ten', 'Tên', '', ['style' => 'color: black'])</th>
                                <th scope="col">@sortablelink('dem_qtv', 'Số lượng quản trị viên', '', ['style' => 'color: black'])</th>
                                <th scope="col">@sortablelink('dem_nv', 'Số lượng nhân viên', '', ['style' => 'color: black'])</th>
                                <th scope="col">@sortablelink('dem_kh', 'Số lượng Khách hàng', '', ['style' => 'color: black'])</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($roles))
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->ten }}</td>
                                    <td>
                                        @if ($role->quan_tri_vien_count > 0)
                                            {{ $role->quan_tri_vien_count }}
                                        @else
                                            -
                                        @endif

                                    </td>
                                    <td>
                                        @if ($role->nhan_vien_count > 0)
                                            {{ $role->nhan_vien_count }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($role->khach_hang_count > 0)
                                            {{ $role->khach_hang_count }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                @include('admin.partials.no-data')f
                            @endif
                        </tbody>
                    </table>
                </div>
                @if (isset($roles))
                <div class="d-flex justify-content-between mt-3">
                    <div style="padding: .5rem .75rem; margin-bottom: 1rem;">
                        Hiển thị @if ($roles->firstItem())
                            {{ $roles->firstItem() }}
                        @else
                            0
                        @endif tới @if ($roles->lastItem())
                            {{ $roles->lastItem() }}
                        @else
                            0
                        @endif trong {{ $roles->total() }} mục
                    </div>
                    <div>
                        {{ $roles->onEachSide(1)->withQueryString()->links() }}
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
</style>
@endsection

@section('page-js')
@endsection

@section('page-custom-js')
<script type="text/javascript">
</script>
@endsection
