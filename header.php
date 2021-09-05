    <?php include "aksi.php"; 
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="shortcut icon" href="img-admin/logo-icon-dark.svg" />
        <script type="text/javascript" src="js/search.js"></script>
        <!-- Bootstrap CSS -->
        <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous"
        />
        <!-- Aos -->
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

        <!-- My Css -->
        <link rel="stylesheet" href="css/style.css" />
        <!-- My Font -->
        <link
        href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet"
        />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<link rel="stylesheet" href="https://fengyuanchen.github.io/cropperjs/css/cropper.css" />
<script src="https://fengyuanchen.github.io/cropperjs/js/cropper.js"></script> 
<script>
    $(document).ready(function(){
        var $modal = $('#modal_crop');
        var crop_image = document.getElementById('sample_image');
        var cropper;
        $('#upload_image').change(function(event){
            var files = event.target.files;
            var done = function(url){
                crop_image.src = url;
                $modal.modal('show');
            };
            if(files && files.length > 0)
            {
                reader = new FileReader();
                reader.onload = function(event)
                {
                    done(reader.result);
                };
                reader.readAsDataURL(files[0]);
            }
        });
        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(crop_image, {
                aspectRatio: 1,
                viewMode: 3,
                preview:'.preview'
            });
        }).on('hidden.bs.modal', function(){
            cropper.destroy();
            cropper = null;
        });
        $('#crop_and_upload').click(function(){
            canvas = cropper.getCroppedCanvas({
                width:400,
                height:400
            });
            canvas.toBlob(function(blob){
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function(){
                    var base64data = reader.result; 
                    document.getElementById("preview").src = base64data
                    $.ajax({
                        url:'aksi.php',
                        method:'POST',
                        data:{crop_image:base64data},
                        success:function(data)
                        {
                            $modal.modal('hide'); 
                        }
                    });
                };
            });
        });
    });
</script>
        <!-- share -->
    <script
        type="text/javascript"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=6108cff0f506cf0019dc20b5&product=inline-share-buttons"
        async="async"
    ></script>
        <title>DATA SALES</title>
    </head>
    <body>
        <!-- Navbar -->

        <nav class="navbar navbar-expand-lg navbar-dark fixed-top nav-wuling shadow-sm">
        <div class="container">
            <a class="navbar-brand nav-logo" href="#">
            <img
                src="img-admin/logo-icon-light.svg"
                style="max-width: 80px"
                alt="logo-header"
                class="d-inline-block align-text-center img-fluid nav-logo"
            />
            <!-- <span> MY ROYAL QUEEN</span> -->
            </a>
            <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown"
            aria-expanded="false"
            aria-label="Toggle navigation"
            >
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <?php if($_SESSION['login'] == "true"){ ?>
                <li class="nav-item">
                <a class="nav-link" href="home">Home</a>
                </li>
                <?php } ?>
                <li class="nav-item">
                <a class="nav-link" href="<?= $log = $_SESSION['login'] == TRUE ? 'logout' : 'index' ?>"><?= $log = $_SESSION['login'] == TRUE ? 'Logout' : 'Login' ?></a>
                </li>
            </ul>
            </div>
        </div>
        </nav>