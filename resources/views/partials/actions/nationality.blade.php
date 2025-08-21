<div class="actions  table-data-feature">
    {{ Form::editButton('nationality.edit', $item->id) }}
    @if(count($item->doctors) == 0)
    {{ Form::deleteLink('nationality.delete', $item->id) }}
    @endif
</div>