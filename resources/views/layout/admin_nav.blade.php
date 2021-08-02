<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Laravel8 購物後台</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/admin/orders">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>首頁</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        管理功能
    </div>

    <!-- Admin Orders -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>訂單</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">清單</h6>
                <a class="collapse-item" href="/admin/orders">清單管理</a>
                <a class="collapse-item" href="/admin/orders/datatable">訂單管理</a>
            </div>
        </div>
    </li>

       <!-- Admin Products -->
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#headingThree"
            aria-expanded="true" aria-controls="headingThree">
            <i class="fas fa-fw fa-cog"></i>
            <span>產品</span>
        </a>
        <div id="headingThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">清單</h6>
                <a class="collapse-item" href="/admin/products">產品管理</a>
            </div>
        </div>
    </li>
</ul>

@include('layout.admin_model')
