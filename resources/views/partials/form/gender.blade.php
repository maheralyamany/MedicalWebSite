@stack($name . '_input_start')
<?php
if (!isset($value) || empty($value) || is_null($value)) {
    $value = 'male';
}
?>
<div class="custom-group has-float-label  {{ $col }}">
    <div class="form-control rounded-4 pt-2 h-auto">
        <div class="form-check form-check-inline">
            <input class="m-inline"  type="radio" name="{{ $name }}" id="{{ $name }}-male"
                value="male" title="{{ trans('m.male') }}">
            <label for="{{ $name }}-male" class="form-check-label">{{ trans('m.male') }}</label>
        </div>
        <div class="form-check form-check-inline">
            <input  class="m-inline" type="radio" name="{{ $name }}" id="{{ $name }}-female"
                value="female" title="{{ trans('m.female') }}">
            <label for="{{ $name }}-female" class="form-check-label">{{ trans('m.female') }}</label>
        </div>


    </div>
    <label for="{{ $name }}">{{ trans('m.gender') }}<span class="astric">*</span></label>
    <small
        class="text-danger">{{ isset($errors) && $errors != null && $errors->has($name) ? $errors->first($name) : '' }}</small>
</div>
<script>
    $(function() {
        $('input[type="radio"][name="{{ $name }}"][value="{{ $value }}"]').prop('checked',
            'checked')
    });
</script>
@stack($name . '_input_end')
