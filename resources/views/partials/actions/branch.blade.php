<div class="actions  table-data-feature">
    {{ Form::detailsLink('branch.show', $branch->id) }}
    {{ Form::editButton('branch.edit', $branch->id) }}

    @if(count($branch->departments) == 0||count($branch->users) == 0  )
    {{ Form::deleteLink('branch.destroy', $branch->id) }}
    @endif
</div>
