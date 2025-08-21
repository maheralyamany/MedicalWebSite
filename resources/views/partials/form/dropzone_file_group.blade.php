@stack($name . '_input_start')
<div
    class="form-group {{ $col }}{{ isset($attributes['required']) ? ' required' : '' }}{{ isset($attributes['readonly']) ? ' readonly' : '' }}{{ isset($attributes['disabled']) ? ' disabled' : '' }}">
    @if (!empty($text))
        {!! Form::label($name, $text, ['class' => 'form-control-label']) !!}
    @endif
    <div class="input-group input-group-merge">
        <div id="dropzone" class="dropzone mb-3 dz-clickable form-file dropzone-single">
            <div class="dz-preview dz-preview-single"></div>
            <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files here to upload</button>
            </div>
        </div>
    </div>


    @if (isset($attributes['v-error']))
        <div class="invalid-feedback d-block">
            {{ $attributes['v-error'] }}
        </div>
    @endif

</div>
<script>
    Dropzone.options.dropzone = {
        maxFiles: 1,
        maxFilesize: 4,
        /*  renameFile: function(file) {
             var dt = new Date();
             var time = dt.getTime();
             return time + "-" + file
             .name; // to rename file name but i didn't use it. i renamed file with php in controller.
         }, */
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 50000,
        init: function() {

            // Get images
            var myDropzone = this;
            $.ajax({
                url: gallery,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
                    $.each(data, function(key, value) {

                        var file = {
                            name: value.name,
                            size: value.size
                        };
                        myDropzone.options.addedfile.call(myDropzone, file);
                        myDropzone.options.thumbnail.call(myDropzone, file, value.path);
                        myDropzone.emit("complete", file);
                    });
                }
            });
        },
        removedfile: function(file) {
            if (this.options.dictRemoveFile) {
                return Dropzone.confirm("Are You Sure to " + this.options.dictRemoveFile, function() {
                    if (file.previewElement.id != "") {
                        var name = file.previewElement.id;
                    } else {
                        var name = file.name;
                    }
                    //console.log(name);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: delete_url,
                        data: {
                            filename: name
                        },
                        success: function(data) {
                            alert(data.success + " File has been successfully removed!");
                        },
                        error: function(e) {
                            console.log(e);
                        }
                    });
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                });
            }
        },

        success: function(file, response) {
            file.previewElement.id = response.success;
            //console.log(file); 
            // set new images names in dropzone’s preview box.
            var olddatadzname = file.previewElement.querySelector("[data-dz-name]");
            file.previewElement.querySelector("img").alt = response.success;
            olddatadzname.innerHTML = response.success;
        },
        error: function(file, response) {
            if ($.type(response) === "string")
                var message = response; //dropzone sends it's own error messages in string
            else
                var message = response.message;
            file.previewElement.classList.add("dz-error");
            _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i];
                _results.push(node.textContent = message);
            }
            return _results;
        }

    };
</script>

@stack($name . '_input_end')
