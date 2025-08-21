@stack('patients_table_start')
    <div class="table-responsive">
        <table id="dynamic-table" class="table table-striped table-bordered table-hover no-footer" width="100%">
            <thead>
                <tr>
                    <th>{{ trans('m.patientname') }}</th>
                    <th>{{ trans('m.mobile') }}</th>
                    <th>{{ trans('m.gender') }}</th>
                    <th>{{ trans('m.age') }}</th>
                    <th>{{ trans_vname('city') }}</th>
                    <th>{{ trans('m.address') }}</th>
                    <th>{{ trans('m.operations') }}</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($patients) && $patients->count() > 0)
                    @foreach ($patients as $patient)
                        <tr>
                            <td><img src="{{ $patient->getPatientPhoto() }}" alt="maxSoft"
                                    class="avatar image-style p-1 mr-3 item-img col-aka d-md-inline">
                                {{ $patient->patientname }}</td>
                            <td>{{ $patient->mobile }}</td>
                            <td>{{ $patient->gender }}</td>
                            <td>{{ $patient->age }}</td>
                            <td>{{ $patient->city->name_ar }}</td>
                            <td>{{ $patient->address }}</td>
                            <td>
                                @include('partials.actions.patients')
                            </td>
                        </tr>
                    @endforeach
                @else
                <tr class="odd"><td valign="top" colspan="7" class="dataTables_empty">{{ trans('m.filter_dataTables_empty') }}</td></tr>
                @endif
            </tbody>
        </table>
    </div>
    @if (!isset($isSearch)||$isSearch==false)
    {{ Form::tablePagination($patients) }}
    @endif
  
   
@stack('patients_table_end')