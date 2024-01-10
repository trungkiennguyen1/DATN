@extends('admin.layout')
@section('main-content')
<div class="row">
    <div class="col-12">
        <form id="search" action="{{ route('Hoa-don.search.order') }}" method="GET">
            @csrf
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
                                        <a href="{{ route('Hoa-don.statistic') }}" class="mr-1 btn btn-secondary waves-effect waves-light"><i class="fas fa-redo-alt"></i> Làm mới</a>
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
            $('#search').attr('action', "{{ route('Hoa-don.excel') }}");
            $('#search').submit();
        });
    });
</script>
@endsection
