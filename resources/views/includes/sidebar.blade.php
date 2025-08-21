

@stack('main_sidebar_start')
<aside class="main-sidebar  elevation-3 sidebar-light-primary text-sm">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image border-2   border-gray rounded-circle p-0">
                <img src="{{ getBranchTitle()->logo }}" class="img-circle" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('home') }}" class="d-block text-white">{{ getBranchTitle()->title }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" id="sidebar-nav" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item" >
                    <a href="{{ route('home') }}" class="nav-link" r="{{ app()->getLocale() }}">
                        <i class="fa fa-dashboard fa-fw nav-icon"></i>
                        <p >الرئيسية</p>
                    </a>
                </li>
                @foreach ($navbars as $it)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route(@$it->route . '.index') }}" r="{{ $it->route }}">
                            <i class="{{ sidebar_icon($it->icon) }} nav-icon"></i>
                            <p > {{ sidebar_title($it->name) }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
@stack('main_sidebar_end')
