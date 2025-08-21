@stack('status-' . $id . '_input_start')
<?php
$attributes = ['url' => route($url)];
if (isset($disabled) && $disabled == true) {
    $attributes['disabled'] = 'disabled';
}
?>
{{ Form::customToggleButton('status-' . $id, $value, $checked, trans('m.actived'), trans('m.un_actived'), $attributes, 'onToggleChange(this,' . $id . ')') }}
<script>
    if (typeof(onToggleChange) == 'undefined') {
        onToggleChange = function(v, id) {
            var isChecked = $(v).is(':checked');
            var url = $(v).attr('url');
            if (!url || url.length == 0)
                return;
            var formData = {
                id: id,
                status: isChecked ? 1 : 0,
            }
            $.ajax({
                url: url,
                type: 'POST',
                dataType: "json",
                data: formData,
                success: function(data) {
                    if (data.status == true) {
                        ShowToastrSuccess(data.msg);
                        $('#status-' + data.id).val(formData.status);
                    } else {
                        ShowToastrError(data.msg);
                        $('#status-' + data.id).attr('checked', !isChecked);
                    }
                }
            });
        }
    }
</script>
@stack('status-' . $id . '_input_end')
