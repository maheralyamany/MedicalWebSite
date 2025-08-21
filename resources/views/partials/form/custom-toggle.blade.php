@stack($name . '_input_start')
<?php
if (!isset($checked)) {
    $checked = false;
}
if (!is_bool($checked)) {
    $checked = boolval($checked);
}

if (!isset($attributes['id'])) {
    $attributes['id'] = 'toggle-'.$name;
}
if (isset($onChange) && !is_null($onChange))
$attributes['onchange'] = $onChange;
?>


<div  name="toggle-cover-{{ $name }}" c="0" off_label="{{ $off_label }}" on_label="{{ $on_label }}">
    <label class="custom-toggle  d-inline-block">
        
        {{ Form::checkbox($name, $value, $checked, $attributes) }}
        <span
            data-label-off="{{ $off_label }}" data-label-on="{{ $on_label }}"
            class="custom-toggle-slider rounded-circle status-green"></span></label>
</div>
<script>
   
   
    $(function() {
        $.each($('#toggle-cover-{{ $name }}'),(i,e)=>{
            var off_label = $(e).attr('off_label');
            var on_label = $(e).attr('on_label');
          
            var $dd = $('<label></label>');
            $dd.addClass('custom-toggle-def');
            $(e).append($dd);
            $dd.text(on_label);
            var onSize = $dd.outerWidth();
            $dd.text(off_label);
            var offSize = $dd.outerWidth();

            $dd.remove();
            var siz = ((onSize > offSize) ? onSize : offSize) + 22;
           
            $(e).find('label.custom-toggle').css('width', siz + 'px');
            $(e).attr('c','1');
        });
      
    });
</script>
@stack($name . '_input_end')
