$('#dnd').fileapi({
   paramName: 'filedata',
   autoUpload: true,
   elements: {
      list: '.js-files',
      file: {
         tpl: '.js-file-tpl',
         preview: {
            el: '.b-thumb__preview',
            width: 180,
            height: 180
         },
         upload: { show: '.progress' },
         complete: { hide: '.progress' },
         progress: '.progress .bar'
      },
      dnd: {
         el: '.b-upload__dnd',
         hover: 'b-upload__dnd_hover',
         fallback: '.b-upload__dnd-not-supported'
      }
   }
});

$(function () {
    $(":file").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
});

function imageIsLoaded(e) {
    $('#myImg').attr('src', e.target.result);
};