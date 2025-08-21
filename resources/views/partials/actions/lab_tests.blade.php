<div class="actions  table-data-feature">
   
    {{ Form::editButton('lab_tests.edit', $lab_test->id) }}
    {{ Form::statusButton('lab_tests.status', $lab_test->id,$lab_test->status) }}
    @if(count($lab_test->patientTests) == 0 )
    {{ Form::deleteLink('lab_tests.destroy', $lab_test->id) }}
    @endif
</div>
