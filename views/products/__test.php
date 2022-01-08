
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
<script
    src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous">
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>


<textarea id="summernote"></textarea>
<script>

        $('textarea#summernote').summernote({
        height: ($(window).height() - 300),
        callbacks: {
            onImageUpload: function(files) {
                uploadFile(files[0]);
            }
        }
    });


    function uploadFile(files) {

        var data = new FormData();
        data.append("files", files);

        $.ajax({
            url: `${SITE_URL}/index.php?r=medialibrary/upload`,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                console.log(data)

            },
            data: data,
            type: "post",
            success: function(id) {
//                    var image = $('<img>').attr('src', 'http://' + url);
//                    $('#summernote').summernote("insertNode", image[0]);
//                 $('#summernote').summernote("insertText", '{{image:'+id+'}}');
            },
            error: function(data) {
                console.log(data);
            }
        });




















        return;
        var fd = new FormData();
        fd.append( 'files', files );
        $.ajax({
            url: `${SITE_URL}/index.php?r=medialibrary/upload`,
            data: fd,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data){
                alert(data);
            }
        });



        return
        data = new FormData();
        data.append('files', files);

        console.log(data)

        $.ajax({
            data: data,
            type: "POST",
            beforeSend: function() {
                console.log(data)

            },
            url:`${SITE_URL}/index.php?r=medialibrary/upload`,
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
                $('#summernote').summernote("insertImage", url);
            }
        });
    }



    function uploadImage(image) {
        var data = new FormData();
        data.append("image", image);
        console.log(data.image);
        $.ajax({
            url: `${SITE_URL}/index.php?r=medialibrary/upload`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "post",
            success: function(url) {

                var image = $('<img>').attr('src', 'https://static.wixstatic.com/media/a45867_b3fedc3730f84151a6aaf6b5dc4d6f8b~mv2.jpg');
                $('#summernote').summernote("insertNode", image[0]);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }




    function base64ToBlob(base64, mime) {
        mime = mime || '';
        var sliceSize = 1024;
        var byteChars = window.atob(base64);
        var byteArrays = [];

        for (var offset = 0, len = byteChars.length; offset < len; offset += sliceSize) {
            var slice = byteChars.slice(offset, offset + sliceSize);

            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }

            var byteArray = new Uint8Array(byteNumbers);

            byteArrays.push(byteArray);
        }

        return new Blob(byteArrays, {
            type: mime
        });
    }



</script>