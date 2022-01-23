<!-- Sidebar content -->
<div class="sidebar-content">
<div class="text-right" style="margin-top:10px;margin-right:10px;">
    <button type="button" class="btn btn-info btn-icon rounded-pill btn-sm sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
        <i class="icon-transmission"></i>
    </button>

</div>
    <!-- Main navigation -->
    <div class="sidebar-section">
        <ul class="nav nav-sidebar" data-nav-type="accordion">
        
            <!-- Main -->
            <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs mt-1">{{ auth()->user()->name }}</div> <i class="icon-menu" title="Main"></i></li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link @if(Route::current()->getName() == 'dashboard') active @endif">
                    <i class="icon-home4"></i>
                    <span>
                        Dashboard
                    </span>
                </a>
            </li>

            <li class="nav-item nav-item-submenu @if(Route::current()->getName() == 'brands' || Route::current()->getName() == 'size' || Route::current()->getName() == 'stock-in' || Route::current()->getName() == 'stock-out' || Route::current()->getName() == 'stock-list' || Route::current()->getName() == 'stock-opname') nav-item-expanded @endif">
                <a href="#" class="nav-link"><i class="icon-stack"></i> <span>Masterisasi</span></a>
                <ul class="nav nav-group-sub" data-submenu-title="Stock">
                    <li class="nav-item"><a href="{{ route('jenis-usaha') }}" class="nav-link @if(Route::current()->getName() == 'jenis-usaha') active @endif"><i class="icon-color-sampler"></i> Jenis Usaha</a></li>
                    <li class="nav-item"><a href="{{ route('provinsi') }}" class="nav-link @if(Route::current()->getName() == 'provinsi') active @endif"><i class="icon-sphere"></i> Provinsi</a></li>
                    <li class="nav-item"><a href="{{ route('jenis-ikan') }}" class="nav-link @if(Route::current()->getName() == 'jenis-ikan') active @endif"><i class="icon-cart"></i> Jenis Ikan</a></li>
                </ul>
            </li>

            <li class="nav-item nav-item-submenu @if(Route::current()->getName() == 'pp.provinsi') nav-item-expanded @endif">
                <a href="#" class="nav-link"><i class="icon-stack"></i> <span>Produksi Perikanan</span></a>
                <ul class="nav nav-group-sub" data-submenu-title="Produksi Perikanan">
                    <li class="nav-item"><a href="{{ route('pp.provinsi') }}" class="nav-link @if(Route::current()->getName() == 'pp.provinsi') active @endif"><i class="icon-color-sampler"></i> Provinsi</a></li>
                </ul>
            </li>

            <li class="nav-item nav-item-submenu @if(Route::current()->getName() == 'impor.volume' || Route::current()->getName() == 'impor.frekuensi') nav-item-expanded @endif">
                <a href="#" class="nav-link"><i class="icon-stack"></i> <span>Import</span></a>
                <ul class="nav nav-group-sub" data-submenu-title="Import">
                    <li class="nav-item"><a href="{{ route('impor.volume') }}" class="nav-link @if(Route::current()->getName() == 'impor.volume') active @endif"><i class="icon-color-sampler"></i> Volume</a></li>
                    <li class="nav-item"><a href="{{ route('impor.frekuensi') }}" class="nav-link @if(Route::current()->getName() == 'impor.frekuensi') active @endif"><i class="icon-color-sampler"></i> Frekuensi</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('users') }}" class="nav-link @if(Route::current()->getName() == 'users') active @endif">
                    <i class="icon-people"></i>
                    <span>
                        Users
                    </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('profile') }}" class="nav-link @if(Route::current()->getName() == 'profile') active @endif">
                    <i class="icon-profile"></i>
                    <span>
                        Profile
                    </span>
                </a>
            </li>


        </ul>
    </div>
    <!-- /main navigation -->

</div>
<!-- /sidebar content -->