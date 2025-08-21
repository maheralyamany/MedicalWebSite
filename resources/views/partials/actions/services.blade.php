<div class="actions  table-data-feature">
    {{ Form::editButton('services.edit', $item->id) }}
    {{ Form::statusButton('services.status', $item->id,$item->status) }}
    @if(count($item->appointments) == 0&&count($item->doctors) == 0&&count($item->serviceTimes) == 0 )
    {{ Form::deleteLink('services.destroy', $item->id) }}
    @endif
</div>
