@if (isset($status)&&$status==1)
   
        <a class="{{$col}} btn-warning" href="{{route($routeName, [$id, 0]) }}"
            title="{{ trans('m.un_active') }}">
            <i class="fa fa-pause"></i>
        </a>
   
@else
    
        <a class="{{$col}} btn-success" href="{{route($routeName, [$id, 1])  }}"
            title="{{ trans('m.active') }}">
            <i class="fa fa-play"></i>
        </a>
   
@endif