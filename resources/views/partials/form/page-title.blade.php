@section('styles')
    {!! Html::style('public/assets/css/form.css') !!}
@stop
@section('pageHeader')
    <div class="page-header">
        <h6 class="page-title mb-0"><i class="menu-icon {{ isset($icon) ? $icon : '' }}"></i> {{ $text }} </h6>
    </div>
@endsection
