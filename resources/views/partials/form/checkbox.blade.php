<?php
if (isset($attributes['disabled'])&&!empty($attributes['disabled'])) {
    if ($checked && !isset($attributes['readonly'])) {
        $attributes['readonly'] = 'readonly';
    }
}
if (!isset($attributes['id'])) {
    $attributes['id'] = 'checkbox-'.$name;
}

?>

<div
    class="{{ $col }} {{ isset($attributes['required']) ? ' required' : '' }} {{ isset($attributes['readonly']) ?$attributes['readonly'] : '' }} {{ isset($attributes['disabled']) ? $attributes['disabled'] : '' }}">

    <?php
    if (isset($attributes['disabled'])) {
        unset($attributes['disabled']);
    }
    if (isset($attributes['readonly'])) {
        $attributes['onclick'] = 'return false;';
    }
    
    ?>


    {{ Form::checkbox($name, $value, $checked, $attributes) }}
    @if (!empty($title))
        {!! Form::label($attributes['id'], $title, ['class' => 'user-select-none']) !!}
    @endif
</div>
