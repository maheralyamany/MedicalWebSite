<div class="actions  table-data-feature">
   
    {{ Form::detailsLink('doctor.view', $doctor->id) }}
    {{ Form::editButton('doctor.edit', $doctor->id) }}
    {{ Form::statusButton('doctor.status', $doctor->id,$doctor->user->status) }}
    @if(count($doctor->services) == 0||count($doctor->doctorTimes) == 0)
    {{ Form::deleteLink('doctor.delete', $doctor->id) }}
    @endif
</div>