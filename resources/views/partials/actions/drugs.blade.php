<div class="actions  table-data-feature">
    {{ Form::detailsLink('drugs.show', $drug->id) }}
    {{ Form::editButton('drugs.edit', $drug->id) }}
    {{ Form::statusButton('drugs.status', $drug->id,$drug->status) }}
    @if(count($drug->prescriptions) == 0 )
    {{ Form::deleteLink('drugs.destroy', $drug->id) }}
    @endif
</div>
