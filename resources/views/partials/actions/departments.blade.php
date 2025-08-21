<div class="actions table-data-feature">
    {{ Form::editButton('departments.edit', $item->id) }}
    {{ Form::statusButton('departments.status', $item->id,$item->status) }}
    @if(count($item->services) == 0 )
    {{ Form::deleteLink('departments.destroy', $item->id) }}
    @endif
</div>
