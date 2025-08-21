@stack($name . '_input_start')
<div class="form-group has-float-label {{ $col }}">
    {{ Form::password($name, ['autocomplete' => 'new-password', 'id' => $name, 'class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : '')]) }}
    <label for="{{$name}}"> {{ $title }} 
    @if ($required) <span class="astric">*</span> @endif    
    </label>
    <small class="invalid-feedback">{{ (isset($errors)&&$errors!=null&&$errors->has($name)) ? $errors->first($name) : '' }}</small>
</div>

<script>
    $(function() {
        setTimeout(() => {
              $('input[type="password"][name="{{ $name }}"]').val(null);
              $('input[type="password"][name="{{ $name }}"]').removeAttr('value');
        }, 200);
    });
</script>
@stack($name . '_input_end')
