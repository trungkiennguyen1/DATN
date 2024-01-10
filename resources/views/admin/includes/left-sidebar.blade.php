<!-- ========== Left Sidebar Start ========== -->
@php
    if (!isset($pageInfo['page'])) {
        $page = "dashboard";
    } else {
        $page = $pageInfo['page'];
    }
@endphp

<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect @if($page == 'dashboard') mm-active @endif">
                        <i class="fas fa-home"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                {{-- @if (Auth::user()->vai_tro_id == 1)
                    <li>
                        <a href="" class="waves-effect @if($page == 'Thống kê') mm-active @endif">
                            <span>Thống kê doanh thu</span>
                        </a>
                    </li>
                    <li>
                        <a href="" class="waves-effect @if($page == 'Báo cáo') mm-active @endif">
                            <span>Báo cáo</span>
                        </a>
                    </li>
                @endif --}}

                <li class="menu-title">Quản lý</li>

                @if (Auth::user()->vai_tro_id == 1)
                    <li>
                        <a href="{{ route('nhan-vien.list') }}" class="waves-effect @if($page == 'Nhân viên') mm-active @endif">
                           <i class="fas fa-user-cog"></i>
                            <span>Nhân viên</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('khach-hang.list') }}" class="waves-effect @if($page == 'Khách hàng') mm-active @endif">
                        <i class="fas fa-user-alt"></i>
                            <span>Khách hàng</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('vai-tro.list') }}" class="waves-effect @if($page == 'role') mm-active @endif">
                            <i class="fas fa-wrench"></i>
                            <span>Vai trò</span>
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ route('nha-san-xuat.list') }}" class="waves-effect @if($page == 'Nhà sản xuất') mm-active @endif">
                       <i class="fas fa-portrait"></i>
                        <span>Nhà sản xuất</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('loai-san-pham.list') }}" class="waves-effect @if($page == 'Loại sản phẩm') mm-active @endif">
                       <i class="fas fa-boxes"></i>
                        <span>Loại sản phẩm</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('san-pham.list') }}" class="waves-effect @if($page == 'Sản phẩm') mm-active @endif">
                       <i class="fas fa-box"></i>
                        <span>Sản phẩm</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('Hoa-don.list') }}" class="waves-effect @if($page == 'Hóa đơn') mm-active @endif">
                        <i class="fas	fa-file-alt"></i>
                        <span>Hóa đơn</span>
                    </a>
                </li>

                {{-- @if (Auth::user()->vai_tro_id == 1)
                    <li>
                        <a href="javascript:void(0);" class="waves-effect @if(in_array($page, ['Lãi suất', 'Trả góp'])) mm-active @endif">
                            <span>Danh mục lãi suất
                                <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
                            </span>
                        </a>
                        <ul class="submenu">
                            <li><a href="" class="waves-effect @if($page == 'Lãi suất') mm-active @endif">Lãi suất</a></li>
                            <li><a href="" class="waves-effect @if($page == 'Trả góp') mm-active @endif">Trả góp</a></li>
                        </ul>
                    </li>
                @endif --}}

            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
