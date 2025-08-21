var uploadeFileSrc = `<svg class="border border-gray img-corn p-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="file-upload" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><defs><style>.cls-1{fill:#dde5e8;}.cls-2{fill:#9bbdc6;}.cls-3{fill:#afc3c9;}.cls-4{fill:#48b753;}.cls-5{fill:#2e8234;}</style></defs><title>document-upload-flat</title><path class="cls-1" d="M422.4,153.6V448a64,64,0,0,1-64,64H76.8a64,64,0,0,1-64-64V64a64,64,0,0,1,64-64H268.93Z"/><path class="cls-2" d="M422.4,153.6H332.8a64,64,0,0,1-64-64V0h.13Z"/><path class="cls-3" d="M217.6,256a12.8,12.8,0,0,1-12.8,12.8H128A12.8,12.8,0,0,1,115.2,256h0A12.8,12.8,0,0,1,128,243.2h76.8A12.8,12.8,0,0,1,217.6,256Z"/><path class="cls-3" d="M294.4,307.2A12.8,12.8,0,0,1,281.6,320H128a12.8,12.8,0,0,1-12.8-12.8h0A12.8,12.8,0,0,1,128,294.4H281.6a12.8,12.8,0,0,1,12.8,12.8Z"/><path class="cls-3" d="M294,358.4a12.8,12.8,0,0,1-12.8,12.8H128a12.8,12.8,0,0,1-12.8-12.8h0A12.8,12.8,0,0,1,128,345.6H281.22A12.8,12.8,0,0,1,294,358.4Z"/><circle class="cls-4" cx="409.6" cy="422.4" r="89.6"/><path class="cls-5" d="M444.25,413.35l-25.6-25.6-.07-.06c-.28-.28-.57-.55-.88-.8l-.13-.1q-.38-.3-.79-.58l-.33-.21-.66-.39-.35-.19c-.31-.16-.62-.31-.95-.44h0l-.35-.13-.72-.25-.39-.11-.78-.19-.29-.06a12.74,12.74,0,0,0-2.29-.22h-.13q-.53,0-1,.05h-.16a12.75,12.75,0,0,0-2.29.45l-.18.06q-.46.14-.9.32l-.25.1c-.33.14-.66.29-1,.45l-.06,0c-.34.18-.67.38-1,.59l-.24.16q-.37.25-.73.53l-.25.2c-.3.25-.6.51-.88.79l-25.6,25.6a12.8,12.8,0,0,0,18.1,18.1l3.75-3.75V448a12.8,12.8,0,1,0,25.6,0V427.7l3.75,3.75a12.8,12.8,0,1,0,18.1-18.1Z"/></svg>`;
var filesizeBase = 1e3,
    dictFileSizeUnits = {
        tb: "TB",
        gb: "GB",
        mb: "MB",
        kb: "KB",
        b: "b"
    };
var uploadeFileDefaults = {
    width: 12,
    title: "حدد الملف",
    spacerClass: "mt-3",
    acceptedFiles: '',
    attrs: {},
    hasError: true,
    errorId: 'upfile_error',
}
const ImageMimesTypes = [
    'image/avif',
    'image/apng',
    'image/bmp',
    'image/gif',
    'image/jpeg',
    'image/pjpeg',
    'image/png',
    'image/svg+xml',
    'image/tiff',
    'image/webp',
    `image/x-icon`,
];
const AudioMimesTypes = [
    'audio/aac',
    'audio/midi',
    'audio/x-midi',
    'audio/mpeg',
    'audio/ogg',
    'audio/opus',
    'audio/wav',
    'audio/webm',
    'audio/3gpp',
    'audio/3gpp2',
];
const VideoMimesTypes = [
    'video/x-flv',
    'video/mp4',
    'application/x-mpegURL',
    'video/MP2T',
    'video/3gpp',
    'video/quicktime',
    'video/x-msvideo',
    'video/x-ms-wmv',
    'video/mpeg',
    'video/ogg',
    'video/webm',
    'video/3gpp2',
];
const MicrosoftOfficeMimeTypes = [
    "application/msword",
    "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    "application/vnd.openxmlformats-officedocument.wordprocessingml.template",
    "application/vnd.ms-word.document.macroEnabled.12",
    "application/vnd.ms-word.template.macroEnabled.12",
    "application/vnd.ms-excel",
    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
    "application/vnd.openxmlformats-officedocument.spreadsheetml.template",
    "application/vnd.ms-excel.sheet.macroEnabled.12",
    "application/vnd.ms-excel.template.macroEnabled.12",
    "application/vnd.ms-excel.addin.macroEnabled.12",
    "application/vnd.ms-excel.sheet.binary.macroEnabled.12",
    "application/vnd.ms-powerpoint",
    "application/vnd.openxmlformats-officedocument.presentationml.presentation",
    "application/vnd.openxmlformats-officedocument.presentationml.template",
    "application/vnd.openxmlformats-officedocument.presentationml.slideshow",
    "application/vnd.ms-powerpoint.addin.macroEnabled.12",
    "application/vnd.ms-powerpoint.presentation.macroEnabled.12",
    "application/vnd.ms-powerpoint.template.macroEnabled.12",
    "application/vnd.ms-powerpoint.slideshow.macroEnabled.12",
    'application/vnd.ms-project',
    'application/vnd.visio',
];
class MFileList {
    constructor(...items) {
        // flatten rest parameter
        items = [].concat(...items);
        // check if every element of array is an instance of `File`
        if (items.length && !items.every(file => file instanceof File)) {
            throw new TypeError("expected argument to MFileList is File or array of File objects");
        }
        // use `ClipboardEvent("").clipboardData` for Firefox, which returns `null` at Chromium
        // we just need the `DataTransfer` instance referenced by `.clipboardData`
        const dt = new ClipboardEvent("").clipboardData || new DataTransfer();
        // add `File` objects to `DataTransfer` `.items`
        for (let file of items) {
            dt.items.add(file)
        }
        return dt.files;
    }
}

function FileUploader(container, options, filesPath) {
    var
        fileType, $template, settings = {},
        pcontainer, selectedFiles = null,
        elements = {},
        acceptedFiles = new Array(),
        validationFiles;
    Object.defineProperty(this, 'acceptedFiles', {
        get: function() {
            return acceptedFiles;
        },
        set: function(value) {
            acceptedFiles = value;
        }
    });
    Object.defineProperty(this, 'validationFiles', {
        get: function() {
            return validationFiles;
        },
        set: function(value) {
            validationFiles = value;
        }
    });
    Object.defineProperty(this, 'elements', {
        get: function() {
            return elements;
        },
        set: function(value) {
            elements = value;
        }
    });
    Object.defineProperty(this, 'selectedFiles', {
        get: function() {
            return selectedFiles;
        },
        set: function(value) {
            selectedFiles = value;
        }
    });
    Object.defineProperty(this, 'fileType', {
        get: function() {
            return fileType;
        },
        set: function(value) {
            fileType = value;
        }
    });
    Object.defineProperty(this, '$template', {
        get: function() {
            return $template;
        },
        set: function(value) {
            $template = value;
        }
    });
    Object.defineProperty(this, 'settings', {
        get: function() {
            return settings;
        },
        set: function(value) {
            settings = value;
        }
    });
    Object.defineProperty(this, 'pcontainer', {
        get: function() {
            return pcontainer;
        },
        set: function(value) {
            pcontainer = value;
        }
    });
    this.pcontainer = container;
    this._initSettings(options);
    this._buildHtml();
    this._initElements();
    this._bindEvents();
    this.setFilePath(filesPath);
}
FileUploader.prototype._initSettings = function(options) {
    options = options || {};
    this.settings = $.extend(true, {}, uploadeFileDefaults, options);
    if (!('id' in this.settings.attrs))
        this.settings.attrs.id = this.uploaderDesignId();
    if (!('errorId' in this.settings))
        this.settings.errorId = this.getId() + "-error";
    var aaa = (this.settings.acceptedFiles.trim() !== '') ? this.settings.acceptedFiles.split(',') : new Array();
    this.acceptedFiles = new Array();
    this.validationFiles = new Array();
    aaa.forEach(ac => {
        if (ac !== '') {
            if (ac === 'image/*') {
                ImageMimesTypes.forEach(m => {
                    this.validationFiles.push(m);
                });
            } else if (ac === 'video/*') {
                VideoMimesTypes.forEach(m => {
                    this.validationFiles.push(m);
                });
            } else if (ac === 'audio/*') {
                AudioMimesTypes.forEach(m => {
                    this.validationFiles.push(m);
                });
            } else if (ac === 'application/vnd') {
                MicrosoftOfficeMimeTypes.forEach(m => {
                    this.validationFiles.push(m);
                    this.acceptedFiles.push(m);
                });
            } else {
                this.validationFiles.push(ac);
            }
            if (ac !== 'application/vnd')
                this.acceptedFiles.push(ac);
        }
    });
};
FileUploader.prototype._buildHtml = function() {
    this.$template = $('<div class="custom-file h-auto"></div>');
    this.settings.attrs.class = 'd-none';
    this.settings.attrs.type = 'file';
    if (('isDesignTime' in this.settings))
        this.settings.attrs.disabled = 'disabled';
    if ('accept' in this.settings.attrs)
        delete this.settings.attrs['accept'];
    if (this.acceptedFiles.length > 0)
        this.settings.attrs.accept = this.acceptedFiles.join(',');
    var $input = $('<input/>', this.settings.attrs);
    if (!('title' in this.settings))
        this.settings.title = '';
    //accept='image/*'
    //accept='jpg;gif;' Accept:"text/html, application/xhtml+xml" "application/json"    'Accept': 'text/html, application/xhtml+xml',  {Accept:"application/json, text/plain, */*"}  t.setAttribute("accept", "image/png, image/gif, image/jpeg, image/bmp, image/x-icon")
    //  $input.attr("accept", "image/png, image/gif, image/jpeg, image/bmp, image/x-icon");
    this.$template.append($input);
    var disabled = (('isDesignTime' in this.settings)) ? ' disabled ' : '';
    this.$template.append(`<label class='border-0 mb-0 cursor col' ` + disabled + `  for='` + this.getId() + `'><div class="row text-center">  <div class="col-auto">
    <span id='` + this.getId() + `-content' class='d-none'></span> <span id='` + this.getId() + `-cover' class='d-inline-block border border-gray rounded-circle p-4'> <i class='fa fa-plus fa-fw fa-lg text-gray' aria-d-none='true'></i> </span>
    </div>
    <div class="col text-center m-0" id='` + this.getId() + `-title'>
    <p class="text-justify mt-3" >` + this.settings.title + `</p>  </div>
    <div class="col-auto mt-3 d-none" id='` + this.getId() + `-c-remove'><button remove="true" class="btn btn-danger btn-sm rounded-circle"><i class="fa fa-trash"></i></button></div>
    </div></label>`);
    var $block = $('<div class="dz-message"></div>');
    $block.append(this.$template)
    this.pcontainer.append($block)
};
FileUploader.prototype._initElements = function() {
    this.elements = {
        content: $("#" + this.getId() + "-content", this.$template),
        cover: $("#" + this.getId() + "-cover", this.$template),
        title: $("#" + this.getId() + "-title", this.$template),
        removBtn: $("#" + this.getId() + "-c-remove", this.$template),
        error: $("#" + this.getId() + "-error", this.$template),
        input: $("#" + this.getId(), this.$template),
    };
};
FileUploader.prototype._bindEvents = function() {
    this.elements.input.on({
        change: (ev) => {
            this.setSelectedFiles(ev.target.files[0]);
        }
    })
    this.elements.removBtn.on({
        click: (ev) => {
            ev.preventDefault();
            ev.stopPropagation();
            // this.setSelectedFiles();
            $('#inp', this.$template).remove();
            $('<input type="file" id="inp"  class="d-none">', this.$template).insertBefore(this.elements.input);
            inp.files = null;
            var form = this.elements.input.form;
            var event = new CustomEvent('onchange');
            inp.addEventListener("onchange", ev => {
                var oldAttr = this.getOldAttributes(this.elements.input);
                var $cl = $(ev.target).clone();
                $.each(oldAttr, (k, v) => {
                    $cl.attr(k, v);
                })
                this.elements.input.remove();
                $cl.insertAfter($(inp));
                $cl.form = form;
                this.initElementsInput();
                this.setSelectedFiles(ev.target.files[0]);
                $(inp).remove();
            });
            inp.dispatchEvent(event);
        }
    })
};
FileUploader.prototype.uploaderDesignId = function() {
    return (!('name' in this.settings.attrs)) ? 'uploadfile_' + Math.random().toString(36).substring(3, 3) + Number(("" + (Date.now()))).toString(36) : this.settings.attrs.name;
};
FileUploader.prototype.getId = function() {
    return this.settings.attrs.id;
};
FileUploader.prototype.initElementsInput = function() {
    this.elements.input = $("#" + this.getId(), this.$template);
    this.elements.input.on({
        change: (ev) => {
            this.setSelectedFiles(ev.target.files[0]);
        }
    });
    return this.elements.input;
};
FileUploader.prototype.setFilePath = function(filePath = null) {
    if (filePath && filePath.length > 0 && (typeof filePath === 'string')) {
        this.loadURLToInputFiled(filePath);
    } else
        this.setSelectedFiles(filePath);
};
FileUploader.prototype.getOldAttributes = function($node) {
    var attrs = {};
    $.each($node[0].attributes, function(index, attribute) {
        attrs[attribute.name] = attribute.value;
    });
    return attrs;
};
FileUploader.prototype.onFileCallback = function(imgBlob, url) {
    var fileName = url.split('/');
    fileName = fileName[fileName.length - 1];

    function getAttributes($node) {
        var attrs = {};
        $.each($node[0].attributes, function(index, attribute) {
            attrs[attribute.name] = attribute.value;
        });
        return attrs;
    }
    imgBlob.lastModifiedDate = new Date();
    imgBlob.name = fileName;
    const dT = new DataTransfer();
    dT.items.add(new File([imgBlob], fileName, {
        type: imgBlob.type,
        lastModified: new Date(),
        webkitRelativePath: url
    }));
    $('#inp', this.$template).remove();
    $('<input type="file" id="inp"  class="d-none">', this.$template).insertBefore(this.elements.input);
    inp.files = dT.files;
    var form = this.elements.input.form;
    var event = new CustomEvent('onchange');
    inp.addEventListener("onchange", ev => {
        var oldAttr = this.getOldAttributes(this.elements.input);
        var $cl = $(ev.target).clone();
        $.each(oldAttr, (k, v) => {
            $cl.attr(k, v);
        })
        this.elements.input.remove();
        $cl.insertAfter($(inp));
        $cl.form = form;
        this.initElementsInput();
        this.setSelectedFiles(ev.target.files[0]);
        $(inp).remove();
    });
    inp.dispatchEvent(event);
};
FileUploader.prototype.loadURLToInputFiled = function(url) {
    try {
        var xhr = new XMLHttpRequest();
        xhr.onloadend = () => {
            this.onFileCallback(xhr.response, url)
        };
        xhr.responseType = 'blob';
        xhr.open('GET', url);
        xhr.send();
    } catch (error) {
        this.removeFile();
    }
};
FileUploader.prototype.setTitle = function(title = null) {
    if (!title || !title.length)
        title = `<p class="text-justify mt-3">` + this.settings.title + `</p>`;
    this.elements.title.empty().append(title);
};
FileUploader.prototype.removeFile = function() {
    this.resetError();
    this.selectedFiles = null;
    this.fileType = null;
    this.elements.cover.removeClass("d-none");
    this.elements.content.addClass("d-none");
    this.elements.content.empty();
    this.setTitle();
    this.elements.removBtn.addClass("d-none");
};
FileUploader.prototype.resetError = function() {
    if (this.settings.hasError)
        this.elements.error.css('display', 'none');
};
FileUploader.prototype.setSelectedFiles = function(files = null) {
    this.removeFile();
    if (!files || files.length == 0)
        return;
    this.selectedFiles = files;
    this.fileType = this.selectedFiles.type;
    if (this.validFileType()) {
        this._getInputFileName(this.selectedFiles)
            // this.elements.input.attr('value', this.selectedFiles);
        var src = URL.createObjectURL(this.selectedFiles);
        var isImage = (this.fileType.startsWith("image/"));
        this.displayProviderLogo(src, isImage);
    } else {
        this.selectedFiles = null;
        this.fileType = null;
    }
};
FileUploader.prototype.validFileType = function() {
    if (this.validationFiles.length == 0) {
        return true;
    }
    return this.validationFiles.includes(this.fileType);
};
FileUploader.prototype._getInputFileName = function(file) {
    var fileName = file.name,
        fileSize = file.size;
    if (fileName === undefined && file.fileName) {
        fileName = file.fileName;
        fileSize = file.fileSize;
    }
    var name = (fileName) ? `<p  class="text-justify mt-1 mb-1">` + fileName + "</p>" : '',
        size = this.getFileSize(fileSize);
    var title = name + ` <p  class="small text-muted text-justify  mb-0"> ` + size + `</p>`
    this.setTitle(title);
};
FileUploader.prototype.getFileSize = function(a) {
    var b = 0,
        c = "b";
    if (a > 0) {
        var d = ["tb", "gb", "mb", "kb", "b"];
        for (var e = 0; e < d.length; e++) {
            var f = d[e];
            if (a >= Math.pow(filesizeBase, 4 - e) / 10) {
                b = a / Math.pow(filesizeBase, 4 - e), c = f;
                break
            }
        }
        b = Math.round(10 * b) / 10
    }
    return `<strong> ${b}  ${dictFileSizeUnits[c]}</strong> `;
}
FileUploader.prototype.displayProviderLogo = function(src, isImage) {
    this.elements.removBtn.removeClass("d-none");
    this.elements.cover.addClass("d-none");
    this.elements.content.removeClass("d-none");
    this.elements.content.empty();
    if (isImage)
        this.elements.content.append($('<img/>', {
            src: src,
            class: 'border border-gray img-corn p-1'
        }));
    else
        this.elements.content.append(uploadeFileSrc);
};