@section('extra_styles')
    {!! Html::style(
        'public/assets/' . getPageDirection() . '/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
    ) !!}
@endsection
@section('extra_scripts')
    {!! Html::script('public/assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}
    {!! Html::script('public/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') !!}
    {!! Html::script('public/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') !!}
    {!! Html::script('public/assets/plugins/datatables-buttons/js/buttons.html5.min.js') !!}
    {!! Html::script('public/assets/plugins/datatables-buttons/js/buttons.print.min.js') !!}
@stop
