<div class="actions  table-data-feature">
  
    {{ Form::editButton('xrays.edit', $xray->id) }}
    {{ Form::statusButton('xrays.status', $xray->id,$xray->status) }}
    @if(count($xray->patientXrays) == 0 )
    {{ Form::deleteLink('xrays.destroy', $xray->id) }}
    @endif
</div>
