
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
    $( document ).ready(function() {

    });


    $('#summernote').summernote({
        lang: 'fr-FR', // <= nobody is perfect :)
        height: 300,
        toolbar : [
            ['style',['bold','italic','underline','clear']],
            ['font',['fontsize']],
            ['color',['color']],
            ['para',['ul','ol','paragraph']],
            ['link',['link']],
            ['picture',['picture']]
        ],
        callbacks : {
            onImageUpload: function(image) {
                uploadImage(image[0]);
            }
        }
    });

    function uploadImage(image) {
        var data = new FormData();
        data.append("image",image);
        $.ajax ({
            data: data,
            type: "POST",
            url: `${SITE_URL}/index.php?r=medialibrary/upload`,
                             // returns a chain containing the path
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
                
                var image = SITE_URL + url;
                setTimeout(function(){
                    $('#summernote').summernote("insertImage", image);
                }, 500);

            },
            error: function(data) {
                console.log(data);
            }
        });
    }


















</script>