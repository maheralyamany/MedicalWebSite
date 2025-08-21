<div class="actions  table-data-feature">
    {{ Form::editButton('city.edit', $item->id) }}
    @if(count($item->patients) == 0 )
    {{ Form::deleteLink('city.delete', $item->id) }}
    @endif
</div>
