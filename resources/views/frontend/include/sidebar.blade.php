<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">
<!-- Nav Item - Dashboard -->
<li class="nav-item @if(Request::is('/')) active @endif">
    <a class="nav-link" href="{{ url('/') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Operasional
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item @if(Request::is('pp/*')) active @endif">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Produksi Perikanan</span>
    </a>
    <div id="collapseTwo" class="collapse @if(Request::is('pp/provinsi')) show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item @if(Request::is('pp/provinsi')) active @endif" href="{{ route('fe.pp.provinsi') }}">Provinsi</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Impor
</div>

<li class="nav-item @if(Request::is('impor/*')) active @endif">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
        aria-expanded="true" aria-controls="collapseThree">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Impor</span>
    </a>
    <div id="collapseThree" class="collapse @if(Request::is('impor/volume') || Request::is('impor/frekuensi')) show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item @if(Request::is('impor/volume')) active @endif" href="{{ route('fe.impor.volume') }}">Volume</a>
            <a class="collapse-item @if(Request::is('impor/frekuensi')) active @endif" href="{{ route('fe.impor.frekuensi') }}">Frekuensi</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Ekspor
</div>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->