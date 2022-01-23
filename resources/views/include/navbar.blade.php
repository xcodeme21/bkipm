<!-- Main navbar -->
<div class="navbar navbar-expand-lg navbar-dark bg-indigo navbar-static">
    <div class="d-flex flex-1 d-lg-none">
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>

    </div>

    <div class="navbar-brand text-center text-lg-left">
        <a href="{{ route('dashboard') }}" class="d-inline-block">
            <img src="{{ asset('public/uploads/logo/'.@$logo->logo) }}" class="d-none d-sm-block" alt="">
            <img src="{{ asset('public/uploads/logo/'.@$logo->logo) }}" class="d-sm-none" alt="">
        </a>
    </div>

    <div class="navbar-collapse collapse flex-lg-1 mx-lg-3 order-2 order-lg-1" id="navbar-search">
        <div class="navbar-search d-flex align-items-center py-2 py-lg-0">
            <div class="form-group-feedback form-group-feedback-left flex-grow-1">
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end align-items-center flex-1 flex-lg-0 order-1 order-lg-2">
        <ul class="navbar-nav flex-row">
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="navbar-nav-link navbar-nav-link-toggler" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="icon-switch2"></i>
                </a>
                <form id="logout-form" class="link_mimic" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->