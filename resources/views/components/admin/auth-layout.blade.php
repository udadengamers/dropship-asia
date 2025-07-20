<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard</title>

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    @stack('before-styles')
        <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
    @stack('after-styles')
    <style>
        .badge-corner {
            position: absolute;
            top: 25px;
            right: 125px;
            transform: translate(50%, -50%);
            padding: 3px 6px;
            font-size: 12px;
            border-radius: 50%;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('administrator.dashboard.index') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ str_contains(url()->current(), 'superuseradminlacj5ub3lqwysaj9rik5/dashboard') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('administrator.dashboard.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Order Management
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ str_contains(url()->current(), 'superuseradminlacj5ub3lqwysaj9rik5/order') && (!str_contains(url()->current(), 'payment'))  ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('administrator.order.index') }}">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Order</span></a>
            </li>

            {{-- <li class="nav-item {{ str_contains(url()->current(), 'administrator/shipping') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('administrator.shipping.index') }}">
                    <i class="fa fa-truck"></i>
                    <span>Shipping</span></a>
            </li> --}}

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Product Management
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item {{ str_contains(url()->current(), 'superuseradminlacj5ub3lqwysaj9rik5/product') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('administrator.product.index') }}">
                    <i class="fa fa-archive"></i>
                    <span>Product</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                User Management
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ str_contains(url()->current(), 'superuseradminlacj5ub3lqwysaj9rik5/admin') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('administrator.admin.index') }}">
                    <i class="fa fa-user-secret"></i>
                    <span>Admin</span></a>
            </li>

            <li class="nav-item {{ str_contains(url()->current(), 'superuseradminlacj5ub3lqwysaj9rik5/seller') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('administrator.seller.index') }}">
                    <i class="fa fa-users"></i>
                    <span>Seller</span></a>
            </li>

            <li class="nav-item {{ str_contains(url()->current(), 'superuseradminlacj5ub3lqwysaj9rik5/user') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('administrator.user.index') }}">
                    <i class="fa fa-users"></i>
                    <span>User</span></a>                    
            </li>

            {{-- <li class="nav-item {{ str_contains(url()->current(), 'superuseradminlacj5ub3lqwysaj9rik5/service-chat') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('administrator.service-chat') }}">
                    <i class="fas fa-headset"></i>
                    <span>Service Chat</span></a>
            </li> --}}

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Payment Management
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item {{ str_contains(url()->current(), 'superuseradminlacj5ub3lqwysaj9rik5/withdraw') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('administrator.withdraw.index') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Withdraw</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item {{ str_contains(url()->current(), 'superuseradminlacj5ub3lqwysaj9rik5/topup') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('administrator.topup.index') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Topup</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item {{ str_contains(url()->current(), 'superuseradminlacj5ub3lqwysaj9rik5/order-payment') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('administrator.order-payment.index') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Order</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block"><!-- Heading -->
            <div class="sidebar-heading">
                System
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item {{ str_contains(url()->current(), 'superuseradminlacj5ub3lqwysaj9rik5/logs') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('administrator.logs.index') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Logs</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('administrator.message.index') }}">
                                <i class="fas fa-envelope"></i>
                            </a>
                            @if ($count > 0)
                                <span id="badgeMessage" class="badge badge-danger badge-corner">{{ $count }}</span>
                            @endif
                        </li>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <form action="/superuseradminlacj5ub3lqwysaj9rik5/logout" method="POST">
                                    @csrf
                                    <button class="dropdown-item">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid pb-4">

                    <x-general.flash></x-general.flash>
                    
                    {{ $slot }}

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a id="showSidebarScroll" class="show-sidebar rounded" href="javascript:void(0);">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </a>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    
                    <form action="/seller/logout" method="POST">
                        @csrf
                        <button class="btn btn-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @stack('before-scripts')
        <script src="{{ mix('js/admin.js') }}"></script>
    @stack('after-scripts')
</body>

</html>