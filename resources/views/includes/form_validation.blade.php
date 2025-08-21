@section('validation_scripts')
    {!! Html::script('public/assets/plugins/jquery-validation/jquery.validate.min.js') !!}
    @if (isArabicLanguage())
        {!! Html::script('public/assets/plugins/jquery-validation/localization/messages_ar.min.js') !!}
    @endif
    <script>
        function validateForm(formId, params, submitHandler) {
            var $frm = $('#' + formId);
            var options = {
                submitHandler: function() {
                    if (submitHandler)
                        submitHandler($frm);
                },
                ignore: "",
                rules: params.rules,
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    var $prnt = element.closest('.has-float-label');
                    if (!$prnt || $prnt.length == 0)
                        $prnt = element.closest('.form-group');
                    //
                    $prnt.append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            };
            if (('messages' in params) && params.messages.length > 0)
                options['messages'] = params.messages;
            $frm.validate(options);
        }
    </script>
@endsection
