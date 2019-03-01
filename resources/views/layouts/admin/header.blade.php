<header class="main-header">
    <!-- Logo -->
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
              <img src="{{asset('public/images/layouts/users/5.jpg')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Session::get("admin_name")}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('public/images/layouts/users/5.jpg')}}" class="img-circle" alt="User Image">

                <p>
                  Trịnh Hoàng Phúc - Web Developer
                  <small>
                   @if(Session::has("admin_q"))
                     <?php 
                       $test = Session::get("admin_q"); 
                       $dem = count($test);
                     ?>
                     @for($i=0; $i<$dem; $i++ )
                        {{ $test[$i] }}
                     @endfor
                   @endif
                  </small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Thông tin</a>
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
          <img src="{{asset('public/images/layouts/users/5.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Trịnh Hoàng Phúc</p>
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

        <li class="treeview @yield('ttch')">
          <a href="#">
            <i class="glyphicon glyphicon-tower"></i> 
            <span>Thông tin cửa hàng</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href=""><i class="fa fa-circle-o"></i> Giới Thiệu</a></li>
            <li class="@yield('banner')"><a href=""><i class="fa fa-circle-o"></i> Ảnh Quảng cáo</a></li>
          </ul>
        </li>

        <li class="treeview @yield('khachhang')">
          <a href="#">
            <i class="glyphicon glyphicon-user"></i> 
            <span>Khách hàng - Đanh giá</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@yield('kh')"><a href="{{route('QLkhachhang')}}"><i class="fa fa-circle-o"></i> Khách hàng</a></li>
            <li class="@yield('dg')"><a href="{{route('QLdanhgia')}}"><i class="fa fa-circle-o"></i> Đánh giá</a></li>
          </ul>
        </li>

         

        <li class="treeview @yield('hanghoa')">
          <a href="">
            <i class="glyphicon glyphicon-shopping-cart"></i>
            <span>Hàng hóa</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@yield('sanpham')"><a href="{{route('QLsanpham')}}"><i class="fa fa-circle-o"></i> Sản phẩm</a></li>
            <li class="@yield('loai')"><a href="{{route('QLloaisanpham')}}"><i class="fa fa-circle-o"></i> Loại sản phẩm</a></li>
            <li class="@yield('hv')"><a href="{{route('QLhuongvi')}}"><i class="fa fa-circle-o"></i> Hương vị</a></li>
            <li class="@yield('nsx')"><a href="{{route('QLnhasanxuat')}}"><i class="fa fa-circle-o"></i> Nhà sản xuất</a></li>
            <li class="@yield('vc')"><a href="{{route('QLvanchuyen')}}"><i class="fa fa-circle-o"></i> Vận chuyển</a></li>
            <li class="@yield('tt')"><a href="{{route('QLthanhtoan')}}"><i class="fa fa-circle-o"></i> Thanh toán</a></li>
            <li class="@yield('ncc')"><a href="{{route('QLnhacungcap')}}"><i class="fa fa-circle-o"></i> Nhà cung cấp</a></li>
          </ul>
        </li>

        <li class="treeview @yield('dontu')">
          <a href="#">
            <i class="glyphicon glyphicon-file"></i>
            <span>Đơn hàng - phiếu nhập</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@yield('donhang')"><a href=""><i class="fa fa-circle-o"></i> Đơn hàng</a></li>
            <li class="@yield('phieunhap')"><a href="{{route('QLphieunhap')}}"><i class="fa fa-circle-o"></i> Phiếu nhập hàng</a></li>
          </ul>
        </li>

        <li class="treeview @yield('nhansu')">
          <a href="">
            <i class="glyphicon glyphicon-folder-open"></i>
            <span>Nhân viên - Chức vụ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@yield('chucvu')"><a href="{{route('QLchucvu')}}"><i class="fa fa-circle-o"></i> Chức vụ</a></li>
            <li class="@yield('nhanvien')"><a href="{{route('QLnhanvien')}}"><i class="fa fa-circle-o"></i> Nhân viên</a></li>
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-area-chart"></i> 
            <span>Thống kê</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Theo năm</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Theo quý</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Theo tháng</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Theo loại</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Theo hạn sản phẩm</a></li>
          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>