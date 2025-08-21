@if (isset($errors) && count($errors) > 0)
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        @foreach ($errors->all() as $error)
            <p> {{ $error }}</p>
        @endforeach
    </div>
@endif