<ul class="tbl-actions  m-0">
    <li class="action-item">
        {{ Form::detailsLink('patients.show', $patient->id,"action-link") }}
    </li>
    <li class="action-item">
        {{ Form::editButton('patients.edit', $patient->id,"action-link") }}
    </li>
    @if (count($patient->appointments) == 0)
        <li class="action-item">
            {{ Form::deleteLink('patients.destroy', $patient->id,"action-link") }}
        </li>
    @endif
</ul>
