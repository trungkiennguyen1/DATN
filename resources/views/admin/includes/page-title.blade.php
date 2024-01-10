<div class="page-title-box">
    <div class="row align-items-center">
        @php
            $title = $pageInfo['page'];
        @endphp

        <div class="col-sm-6">
            <ol class="breadcrumb">
                @if(isset( $pageInfo['subtitle']))
                    <li class="breadcrumb-item" style="font-size: 15px;"><a href="{{ route("{$pageInfo['route']}.list") }}">{{ $title }}</a></li>
                    <li class="breadcrumb-item active" style="font-size: 15px;">{{ $pageInfo['subtitle'] }}</li>
                @else
                    <li class="breadcrumb-item active" style="font-size: 15px;">{{ $title }}</li>
                @endif
            </ol>
        </div>
    </div> <!-- end row -->
</div>
<!-- end page-title -->
