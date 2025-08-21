<div class="row">
    @include('user.form_input')
    @include('user.form_input_footer')

    <div class="col-md-12" style="overflow-x:auto;">
        <table id='permissions' class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="col-4">{{ trans('m.form') }} </th>
                    <th class="col">
                        {{ trans('m.permissions') }}
                    </th>
                    <!--   <label class="non-float"> <input type="checkbox" value="" action="add"> اضافة</label> -->
                </tr>
            </thead>
            <tbody>
                @include('user.permissions')
            </tbody>
        </table>
    </div>
    @include('partials.portal.save_btn')
</div>
@section('scripts')
    <script>
        $(function() {

            $('#permissions input[type="checkbox"][action="role"]').on('change', function() {
                var role = $(this).attr('role');
                var $childs = $('#permissions input[type="checkbox"][action="perm"][role="' + role + '"]');
                $childs.prop('checked', $(this).is(':checked'))
                $childs.prop('disabled', !$(this).is(':checked'))
            }).trigger('change');
        });
    </script>
@stop
