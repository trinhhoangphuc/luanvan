<header class="main-header">

    <a href="../../index2.html" class="logo">

      <span class="logo-mini"><i class="glyphicon glyphicon-shopping-cart"></i></span>

      <span class="logo-lg"><b><i class="glyphicon glyphicon-shopping-cart"></i> Red</b>shop.vn</span>
    </a>
   
    <nav class="navbar navbar-static-top">

      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('public/images/avatar/staff/' .Session::get('admin_img')) }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Session::get("admin_name")}}</span>
            </a>
            <ul class="dropdown-menu">
            
              <li class="user-header">
                <img src="{{asset('public/images/avatar/staff/' .Session::get('admin_img')) }}" class="img-circle" alt="User Image">

                <p>
                  {{Session::get("admin_name")}}
                  <small>
                  </small>
                </p>
              </li>

              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('info')}}" class="btn btn-default btn-flat">Thông tin</a>
                </div>
                <div class="pull-right">
                  <a href="{{route('postLogout')}}" class="btn btn-default btn-flat">Đăng xuất</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <aside class="main-sidebar">

    <section class="sidebar">

      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('public/images/avatar/staff/' .Session::get('admin_img')) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Session::get('admin_name') }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

    
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"></li>

        <li class="@yield('trangchu')">
          <a href="{{route('Indexadmin')}}">
            <i class="fa fa-dashboard"></i> <span>Trang chủ</span>
          </a>
        </li>

        @if(in_array(15, Session::get("admin_q")) || in_array(12, Session::get("admin_q")))
        <li class="@yield('banner')">
            <a href="{{route('QLbanner')}}"><i class="fa fa-picture-o" aria-hidden="true"></i> <span>Ảnh Quảng cáo</span></a>
        </li>
        @endif

         @if(in_array(11, Session::get("admin_q")))
         <li class="@yield('khuyemai')">
          <a href="{{ route('QLkhuyenmai') }}">
            <i class="fa fa-gift" aria-hidden="true"></i> <span>Khuyến mãi</span>
          </a>
        </li>
        @endif

        @if(in_array(9, Session::get("admin_q")))
        <li class="@yield('donhang')">
          <a href="{{ route('QLdonhang') }}">
            <i class="glyphicon glyphicon-file"></i> <span>Đơn hàng</span> <span id="totalOrder"></span>
          </a>
        </li>
        @endif

        @if(in_array(8, Session::get("admin_q")) || in_array(12, Session::get("admin_q")))
        <li class="treeview @yield('khachhang')">
          <a href="#">
            <i class="glyphicon glyphicon-user"></i> 
            <span>Khách hàng - Đanh giá</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if(in_array(8, Session::get("admin_q")) || in_array(6, Session::get("admin_q")))
            <li class="@yield('kh')"><a href="{{route('QLkhachhang')}}"><i class="fa fa-circle-o"></i> Khách hàng</a></li>
            @endif            
            @if(in_array(12, Session::get("admin_q")) || in_array(6, Session::get("admin_q")))
            <li class="@yield('dg')"><a href="{{route('QLdanhgia')}}"><i class="fa fa-circle-o"></i> Đánh giá</a></li>
            @endif
          </ul>
        </li>
        @endif

         
        @if(in_array(1, Session::get("admin_q")) || in_array(2, Session::get("admin_q")) || in_array(3, Session::get("admin_q")) || in_array(4, Session::get("admin_q")) || in_array(5, Session::get("admin_q")) || in_array(14, Session::get("admin_q")))
        <li class="treeview @yield('hanghoa')">
          <a href="">
            <i class="glyphicon glyphicon-shopping-cart"></i>
            <span>Hàng hóa</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if(in_array(1, Session::get("admin_q")))
            <li class="@yield('sanpham')"><a href="{{route('QLsanpham')}}"><i class="fa fa-circle-o"></i> Sản phẩm</a></li>
            @endif
            @if(in_array(2, Session::get("admin_q")))
            <li class="@yield('loai')"><a href="{{route('QLloaisanpham')}}"><i class="fa fa-circle-o"></i> Loại sản phẩm</a></li>
            @endif
            @if(in_array(14, Session::get("admin_q")))
            <li class="@yield('hv')"><a href="{{route('QLhuongvi')}}"><i class="fa fa-circle-o"></i> Hương vị</a></li>
            @endif
            @if(in_array(5, Session::get("admin_q")))
            <li class="@yield('nsx')"><a href="{{route('QLnhasanxuat')}}"><i class="fa fa-circle-o"></i> Nhà sản xuất</a></li>
            @endif
            @if(in_array(4, Session::get("admin_q")))
            <li class="@yield('vc')"><a href="{{route('QLvanchuyen')}}"><i class="fa fa-circle-o"></i> Vận chuyển</a></li>
            @endif
            @if(in_array(3, Session::get("admin_q")))
            <li class="@yield('tt')"><a href="{{route('QLthanhtoan')}}"><i class="fa fa-circle-o"></i> Thanh toán</a></li>
            @endif

          </ul>
        </li>
        @endif

        @if(in_array(7, Session::get("admin_q")) || in_array(6, Session::get("admin_q")))
        <li class="treeview @yield('nhansu')">
          <a href="">
            <i class="glyphicon glyphicon-folder-open"></i>
            <span>Nhân viên - Chức vụ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if(in_array(7, Session::get("admin_q")))
            <li class="@yield('chucvu')"><a href="{{route('QLchucvu')}}"><i class="fa fa-circle-o"></i> Chức vụ</a></li>
            @endif
            @if(in_array(6, Session::get("admin_q")))
            <li class="@yield('nhanvien')"><a href="{{route('QLnhanvien')}}"><i class="fa fa-circle-o"></i> Nhân viên</a></li>
            @endif
          </ul>
        </li>
        @endif

        @if(in_array(10, Session::get("admin_q")))
        <li class="treeview @yield('thongke')">
          <a href="#">
            <i class="fa fa-area-chart"></i> 
            <span>Thống kê</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@yield('tknam')"><a href="{{ route('TKnam') }}"><i class="fa fa-circle-o"></i> Doanh thu</a></li>
            <li class="@yield('tkloai')"><a href="{{ route('TKloai') }}" ><i class="fa fa-circle-o"></i> Loại bán chạy</a></li>
            <li class="@yield('tksp')"><a href="{{ route('TKsanpham') }}"><i class="fa fa-circle-o"></i> Sản phẩm bán chạy</a></li>
            <li class="@yield('tonkho')"><a href="{{ route('TKsanphamTK') }}"><i class="fa fa-circle-o"></i> Số lượng trong kho</a></li>
          </ul>
        </li>
        @endif

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

