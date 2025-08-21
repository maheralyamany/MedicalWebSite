<div class="actions  table-data-feature">
    {{ Form::editButton('nickname.edit', $nickname->id) }}
    @if(count($nickname->doctors) == 0)
    {{ Form::deleteLink('nickname.delete', $nickname->id) }}
    @endif
   
</div>