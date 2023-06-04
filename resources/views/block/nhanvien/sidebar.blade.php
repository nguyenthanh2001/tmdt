
<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="loai-haisan">
            <div class="sidebar-icon ">
                <i class="fas fa-store-alt"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Nhân viên hải sản Vĩnh Long</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="loai-haisan">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Quản trị dành cho nhân viên</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Quản lý</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <!-- <a class="collapse-item" href="{{ route('admin.getbanh') }}">Quản lý hải sản</a>
                    <a class="collapse-item" href="{{ route('admin.getkhuyenmai') }}">Quản lý khuyến mãi</a> -->
                    <a class="collapse-item" href="{{ route('nhanvien.getloaibanh_nhanvien') }}">Quản lý loại hải sản</a>
                    <!-- <a class="collapse-item" href="{{ route('admin.getSize') }}">Quản lý size hải sản</a> -->
                    <!-- <a class="collapse-item" href="{{ route('admin.getTk') }}">Quản lý tài khoản</a> -->
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fa fa-commenting"></i>
                <span>Đơn hàng</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Đơn hàng:</h6>
                    <a class="collapse-item" href="{{route('admin.Qlbill')}}">Chờ xác nhận</a>
                    <a class="collapse-item" href="{{route('admin.Qlbill1')}}">Đã xác nhận</a>
                    <a class="collapse-item" href="{{route('admin.Qlbill2')}}">Đã nhận hàng</a>
                </div>
            </div>
        </li> -->

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Addons
        </div>

        <!-- Nav Item - Charts -->
        <!-- <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.Thongke') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Thống kê</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.Showemail') }}">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>Email</span></a>
        </li> -->

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

      

    </ul>
    <!-- End of Sidebar -->