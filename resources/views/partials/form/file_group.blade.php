@stack($name . '_input_start')

<div class="file_group {{ $col }}" >
    <div id="fileContainer" class="form-group"></div>
    <small id="{{ $name }}-error" class="text-danger">{{ $error }}</small>
</div>
<script>
    $(function() {
        new FileUploader($('#fileContainer'), {
            title: "{{ $title }}",
            attrs: {
                name: "{{ $name }}"
            },
            acceptedFiles: "{{ $acceptedFiles }}",
            errorId: "{{ $name }}-error",
        }, "{{ $filePath }}");
    });
</script>

@stack($name . '_input_end')
