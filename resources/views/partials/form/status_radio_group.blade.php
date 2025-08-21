@stack($name . '_input_start')
<?php
if (!isset($value) || empty($value) || is_null($value)) 
    $value = '1';
?>
<div class="custom-group has-float-label  {{ $col }}">
    <div class="form-control rounded-4 pt-2 h-auto">

        <div class="form-check form-check-inline">
            <input class="m-inline"  type="radio" name="{{ $name }}" id="{{ $name }}-actived"
                value="1" title="{{ trans('m.actived') }}">
            <label for="{{ $name }}-actived" class="form-check-label">{{ trans('m.actived') }}</label>
        </div>
        <div class="form-check form-check-inline">
            <input  class="m-inline" type="radio" name="{{ $name }}" id="{{ $name }}-un_actived"
                value="0" title="{{ trans('m.un_actived') }}">
            <label for="{{ $name }}-un_actived" class="form-check-label">{{ trans('m.un_actived') }}</label>
        </div>


       
    </div>
    <label for="{{ $name }}">{{ trans('m.status') }}<span class="astric">*</span></label>
    <small class="invalid-feedback">{{ (isset($errors)&&$errors!=null&&$errors->has($name)) ? $errors->first($name) : '' }}</small>
</div>
<script>
    $(function() {
        $('input[type="radio"][name="{{ $name }}"][value="{{ $value }}"]').prop('checked',
            'checked')
    });
</script>
@stack($name . '_input_end')
