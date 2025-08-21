<div class="actions  table-data-feature">
    {{ Form::editButton('specification.edit', $specification->id) }}
   
    @if(count($specification->doctors) == 0)
    {{ Form::deleteLink('specification.delete', $specification->id) }}
    @endif
   
</div>