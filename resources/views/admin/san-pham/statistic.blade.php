@extends('admin.layout')
@section('main-content')
<div class="row">
    <div class="col-12">
        <form id="search" action="{{ route('san-pham.statistic') }}" method="GET">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 form-group">
                                    <label>Từ ngày</label>
                                    <input type="text" id="from" name="fromDate" class="form-control bg-white pointer" readonly @if (!empty($search['from'])) value="{{ $search['from'] }}" @endif>
                                </div>
                                <div class="col-3 form-group">
                                    <label>Đến ngày</label>
                                    <input type="text" id="to" name="toDate" class="form-control bg-white pointer" readonly @if (!empty($search['to'])) value="{{ $search['to'] }}" @endif>
                                </div>
                                <div class="col-6 form-group">
                                    <label></label>
                                    <div class="mt-2">
                                        <a href="{{ route('san-pham.statistic') }}" class="mr-1 btn btn-secondary waves-effect waves-light"><i class="fas fa-redo-alt"></i> Làm mới</a>
                                        <button type="submit" class="btn btn-info waves-effect waves-light">
                                            <i class="fas fa-search"></i> Tìm kiếm
                                        </button>
                                        <button type="button" class="btn btn-success waves-effect waves-light btn-excel">
                                            <i class="fas fa-file-excel"></i> Xuất excel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-default">
                            <tr>
                                <th scope="col">Mã sản phẩm</th>
                                <th scope="col">Tên sản phẩm</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($products) > 0)
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->ma_sp }}</td>
                                    <td>{{ $product->chi_tiet_sp->ten_sp }}</td>
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
                @if (isset($products))
                <div class="d-flex justify-content-between mt-3">
                    <div style="padding: .5rem .75rem; margin-bottom: 1rem;">
                        Hiển thị @if ($products->firstItem())
                            {{ $products->firstItem() }}
                        @else
                            0
                        @endif tới @if ($products->lastItem())
                            {{ $products->lastItem() }}
                        @else
                            0
                        @endif trong {{ $products->total() }} mục
                    </div>
                    <div>
                        {{ $products->onEachSide(1)->withQueryString()->links() }}
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
    .pointer {
        cursor: pointer;
    }
</style>
@endsection

@section('page-js')
@endsection

@section('page-custom-js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#from').datepicker({
            format: 'dd M yyyy',
            todayHighlight: true,
            orientation: 'bottom'
        }).on('changeDate', function() {
            $('.datepicker').hide();
        });

        $('#to').datepicker({
            format: 'dd M yyyy',
            todayHighlight: true,
            orientation: 'bottom'
        }).on('changeDate', function() {
            $('.datepicker').hide();
        });

        $('.btn-excel').click(function() {
            $('#search').attr('action', "{{ route('san-pham.excel') }}");
            $('#search').submit();
        });
    });
</script>
@endsection
