@stack('navbar_start')
<nav class="main-header navbar navbar-expand-md navbar-dark navbar-primary">
    <div class="navbar-collapse order-1 collapse show" id="navbarCollapse">
        <ul class="order-1 order-md-1 navbar-nav mm-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"> <span
                        class="navbar-toggler-icon"></span></a>
            </li>
        </ul>
        <ul class="order-2 order-md-2 navbar-nav navbar-no-expand ml-auto mm-nav float-left">
            <li class="nav-item text-center" id="dark-container">
            </li>

            <?php echo getLanguageMenu() ?>
            @if (Auth::user())
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ Auth::user()->getUserPhoto() }}"
                            class="user-image img-circle border-2 border-gray" alt="User Image">
                        <span class="d-md-inline">{{ Auth::user()->getFullName() }}
                        </span> </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left" style="border-radius: 0.50rem;">
                        <div class="card card-widget widget-user" style="margin-bottom: 0rem;">
                            <div class="widget-user-header bg-info">
                                <h3 class="widget-user-username">{{ Auth::user()->getFullName() }}</h3>
                                <h5 class="widget-user-desc"></h5>
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle elevation-2"
                                    src="{{ Auth::user()->getUserPhoto() }}"
                                    alt="User Avatar">
                            </div>
                            <div class="card-footer"> <a href="{{ route('users.edit', Auth::user()->id) }}"
                                    class="btn btn-default btn-flat">{{ trans('m.edit_profile') }}</a> <a
                                    href="{{ route('logout.perform') }}"
                                    class="btn btn-default btn-flat">{{ trans('m.Logout') }}</a>
                            </div>
                        </div>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>
@stack('navbar_end')
