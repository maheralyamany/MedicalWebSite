
@include('includes.extra_scripts')
@section('pageHeader')
    <div class="page-header row" style="vertical-align: middle;">
        <div class="col-md-9">
            <h5 class="page-title"><i class="menu-icon fa fa-home"></i> {{ trans_title($viewName) }}</h5>
        </div>
        <div class="col-md-3">
            <a class="btn btn-white btn-info btn-sm rounded-5" href="{{ route($routeName) }}">
                <i class="fa fa-plus"></i> {{ trans_add($viewName) }}
            </a>
        </div>
    </div>
@endsection
