@section('tablePagination')
    @if (isset($table))
        <div class="card-footer clearfix">
            {!! $table->links() !!}
        </div>
    @endif
@endsection
