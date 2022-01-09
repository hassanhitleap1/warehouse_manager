<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

<textarea id="summernote"></textarea>
<script>



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