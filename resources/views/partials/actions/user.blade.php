<div class="actions  table-data-feature">

    {{ Form::detailsLink('users.view', $user->id) }}
    {{ Form::editButton('users.edit', $user->id) }}
   
   
    @if(!isset($user->doctor)&&$user->id!=1)
    {{ Form::deleteLink('users.delete', $user->id) }}
    @endif

   
</div>
