<?php 
include "koneksi.php";
session_start();
error_reporting(0);
$notif_error = "";

$queryakun = mysqli_query($conn, "SELECT * FROM admin WHERE id_admin = '$_SESSION[user]'");
$rowakun = mysqli_fetch_assoc($queryakun);

// Aut Login
if(isset($_POST['login'])){
    $email_nama = $_POST['emailusername']; // nilai username/email
    $password = $_POST['password']; // nilai password
    // query data untuk cek email
    $querycekemail = "SELECT id_admin,email,password,status FROM admin WHERE email='$email_nama'";
    $resultemail = mysqli_query($conn, $querycekemail); // eksekusi query
    // cek email jika tidak ada cek username
    if(mysqli_num_rows($resultemail) == 1){
        $rowemail = mysqli_fetch_assoc($resultemail); // baris db email
        $dbpass = $rowemail['password']; // nilai password dari db dalam hash
        // cek password hash dengan pass input, jika tidak kirim notif
        if(password_verify($password, $dbpass)){
            // jika akun belum dikonfirmasi
            if($rowemail['status'] == 0){
                $notif_error = "Akun anda belum diaktifkan."; // notif error login konfirmasi
            }else{
                $_SESSION['login'] = TRUE; // session login
                $_SESSION['user'] = $rowemail['id_admin']; // session id user login
                header('Location: home');
            }
        }else{
            $notif_error = "Password Anda salah!"; // noitf error password
        }
    }else{
        // query data untuk cek username
        $queryusername = "SELECT id_admin,username,password,status FROM admin WHERE username='$email_nama'";
        $resultusername = mysqli_query($conn, $queryusername); // eksekusi query
        // cek username jika tidak ada maka kirim pesan error
        if(mysqli_num_rows($resultusername) == 1){
            $rowusername = mysqli_fetch_assoc($resultusername); // baris db username
            $dbpass = $rowusername['password']; // nilai pass dari db dalam hash
            // cek password hash dengan passs input, jika tidak ada kirim notif
            if(password_verify($password, $dbpass)){
                // jika akun belum dikonfirmasi
                if($rowusername['status'] == 0){
                    $notif_error = "Akun anda belum diaktifkan."; // notif error login konfirmasi
                }else{
                    $_SESSION['login'] = "true"; // session login
                    $_SESSION['user'] = $rowusername['id_admin']; // session id user login
                    header('Location: home');
                }
            }else{
                $notif_error = "Password Anda salah!"; // noitf error password
            }
        }else{
            $notif_error = "Email atau Username tidak terdaftar!"; // noitf error email/username tidak terdaftar
        }
    }
}

if(isset($_POST['regis'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $no_tlp = $_POST['no_tlp'];
    $password = $_POST['password'];
    // query data untuk cek username
    $queryusername = "SELECT username FROM admin WHERE username='$username'";
    $resultusername = mysqli_query($conn, $queryusername); // eksekusi query
    // query data untuk cek username
    $queryemail = "SELECT email FROM admin WHERE email='$email'";
    $resultemail = mysqli_query($conn, $queryusername); // eksekusi query
    // cek username jika ada maka kirim pesan error
    if(mysqli_num_rows($resultusername) == 1){
        $notif_error = "Username Sudah terdaftar";    
    }
    // cek email jika ada maka kirim pesan error
    elseif(mysqli_num_rows($resultemail)){
        $notif_error = "Email Sudah terdaftar";
    }
    else{
        $password = password_hash($password, PASSWORD_DEFAULT);
        $queryregis = "INSERT INTO admin (username,email,no_tlp,password,status) VALUES('$username','$email',$no_tlp,'$password','0')";
        $resultregis = mysqli_query($conn, $queryregis);
        if($resultregis){
            header('Location: https://api.whatsapp.com/send?phone=6282189000701&text=Hai%20Admin%20GALERIIDE%20Saya%20tertarik%20untuk%20membuat%20websiteAppSales%20ini%20Mohon%20info%20lebih%20lanjut');
        }
    }
}

// edit akun
if(isset($_POST['editakun'])){
    $email = $_POST['email'];
    $emaillama = $_POST['emaillama'];
    $password = $_POST['password'];
    $hast_past = password_hash($password, PASSWORD_DEFAULT);
    $querycekemail = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email'");
    if($email == $emaillama){
        $queryeditakun = mysqli_query($conn, "UPDATE admin SET password = '$hast_past' WHERE id_admin='$_SESSION[user]'");
    }elseif(mysqli_fetch_assoc($querycekemail) > 0){
        $notif_error = "email sudah terdaftar";
    }else{
        $queryeditakun = mysqli_query($conn, "UPDATE admin SET email = '$email', password = '$hast_past' WHERE id_admin='$_SESSION[user]'");
    }
}


// simpan merek mobil
if(isset($_POST['aksimerekmobil'])){
    // resize file ori dengan lokasi file dan di ubah ke nama baru
    // function compressImage($lokasi_file, $nama_file_baru){
    //     $informasi_image = getimagesize($lokasi_file); // menggambil informasi file ori yang berada pada folder

    //     // jika file dalam folder adalah jpeg
    //     if($informasi_image['mime']=='image/jpeg'){
    //         $img_baru = imagecreatefromjpeg($lokasi_file); // buat file baru jpeg dari file sebelumnya
    //         imagejpeg($img_baru,$nama_file_baru,30); // memberi nama baru dan ukuran baru jpeg
    //     }
    //     // jika file dalam folder adalah png
    //     elseif($informasi_image['mime']=='image/png'){
    //         $img_baru = imagecreatefrompng($lokasi_file); // buat file baru png dari file sebelumnya
    //         imagepng($img_baru, $nama_file_baru, 6); // memberi nama baru dan ukuran baru file png
    //     }
    //     return $nama_file_baru; // mengembalikan nama file baru
    // }

    // nama
    $nama_mobil = $_POST['namamobil']; // nama merek
    $desk = $_POST['desk'];
    $yt = $_POST['yt'];
    $fotonew = md5(rand()); // nama merek untuk foto

    // image
    $nama_image = $_FILES['fotomobil']['name'];  // nama file di upload
    $file_image = $_FILES['fotomobil']['tmp_name']; // temporary file upload
    $nama_image = end(explode(".", $_FILES['fotomobil']['name']));

    $folder_nama = $rowakun['domain']."/img/produk/"; // nama folder
    $lokasi_file_nama_file = $folder_nama.$fotonew.".".$nama_image; // lokasi file/nama file upload
    $movefile = move_uploaded_file($file_image, $lokasi_file_nama_file); // memindahkan temporary file

    // $nama_resize = $fotonew.$nama_image; // ubah nama file ori
    // $lokasi_file_nama_kompress = $folder_nama.$nama_resize; // lokasi file dengan rename file
    // $resize_file = compressImage($lokasi_file_nama_file, $lokasi_file_nama_kompress); // function compressImage
    
    // jika berhasil memindahkan file, save ke dbmysql
    $fotodb = $fotodb = "img/produk/".$fotonew.".".$nama_image;;
    if($movefile){
        $fotodb = "img/produk/".$fotonew.".".$nama_image;
        $querymenyimpanmerek = "INSERT INTO merek_mobil (nama_merek,foto_merek,desk_merek,link_yt,id_admin) VALUES ('$nama_mobil','$fotodb','$desk','$yt','$_SESSION[user]')"; // query sql menyimpan ke db
        $resultmenyimpanmerek = mysqli_query($conn, $querymenyimpanmerek); // eksekusi query
        if($resultmenyimpanmerek){
                header('Location: edit-merek');
            
        }
    }
    
}

// edit merek
if(isset($_POST['aksieditmerek'])){
    $id = $_POST['id'];
    $desk = $_POST['desk'];
    $nama_mobil = $_POST['namamobil']; // nama merek
    $yt = $_POST['yt'];
    // jika foto di ganti
    if($_FILES['fotomobil']['name'] != ""){
        // nama
        $fotonew = md5(rand()); // nama merek untuk foto
        $fotolama = $_POST['editfoto'];

        // image
        $nama_image = $_FILES['fotomobil']['name'];  // nama file di upload
        $file_image = $_FILES['fotomobil']['tmp_name']; // temporary file upload
        $nama_image = end(explode(".", $_FILES['fotomobil']['name']));

        $folder_nama = $rowakun['domain']."/img/produk/"; // nama folder
        $lokasi_file_nama_file = $folder_nama.$fotonew.".".$nama_image; // lokasi file/nama file upload
        $movefile = move_uploaded_file($file_image, $lokasi_file_nama_file); // memindahkan temporary file
        
        // $nama_resize = $fotonew.$nama_image; // ubah nama file ori
        // $lokasi_file_nama_kompress = $folder_nama.$nama_resize; // lokasi file dengan rename file
        // $resize_file = compressImage($lokasi_file_nama_file, $lokasi_file_nama_kompress); // function compressImage
        
        // jika berhasil memindahkan file, save ke dbmysql
        $fotodb = "img/produk/".$fotonew.".".$nama_image;
        if($movefile){
            if(file_exists($rowakun['domain']."/".$fotolama)){
                unlink($rowakun['domain']."/".$fotolama); // hapus foto lama
            }
            $fotodb = "img/produk/".$fotonew.".".$nama_image;
            $querymenyimpanmerek = "UPDATE merek_mobil SET nama_merek = '$nama_mobil', foto_merek = '$fotodb', desk_merek='$desk', link_yt = '$yt' WHERE id_admin='$_SESSION[user]' AND id_merek='$id'"; // query sql menyimpan ke db
            $resultmenyimpanmerek = mysqli_query($conn, $querymenyimpanmerek); // eksekusi query
            if($resultmenyimpanmerek){
                
                    header('Location: edit-merek');
            }
        }
    }else{
        $querymenyimpanmerek = "UPDATE merek_mobil SET nama_merek = '$nama_mobil', desk_merek='$desk', link_yt = '$yt' WHERE id_merek='$id' AND id_admin='$_SESSION[user]'"; // query sql menyimpan ke db
            $resultmenyimpanmerek = mysqli_query($conn, $querymenyimpanmerek); // eksekusi query
            if($resultmenyimpanmerek){
                header('Location: edit-merek');
            }
    }
}

if(isset($_POST['hapusmerek'])){
    $id = $_POST['idmerek'];
    $query = "SELECT * FROM merek_mobil WHERE id_merek = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if(file_exists($rowakun['domain']."/".$row['foto_merek'])){
        unlink($rowakun['domain']."/".$row['foto_merek']);
    }
    $deletemerek = "DELETE FROM merek_mobil WHERE id_merek = '$id'";
    $aksimerek = mysqli_query($conn, $deletemerek);
    if($aksimerek){
        $deletetype = "DELETE FROM type_mobil WHERE id_merek = '$id'";
        $aksitype = mysqli_query($conn, $deletetype);
        $querywarna = mysqli_query($conn, "SELECT foto_warna FROM warna_merek WHERE id_merek='$id'");
        while($rowwarna = mysqli_fetch_assoc($querywarna)){
            if(file_exists($rowakun['domain']."/".$rowwarna['foto_warna'])){
                unlink($rowakun['domain']."/".$rowwarna['foto_warna']);
            }
        }
        $deletewarna = "DELETE FROM warna_merek WHERE id_merek = '$id'";
        $aksiwarna = mysqli_query($conn, $deletewarna);
        header('Location: edit-merek');
    }
}
// simpan type mobil dan harga
if(isset($_POST['aksitypemobil'])){
    $merek_mobil = $_POST['merekmobil']; // id merek mobil
    $type_mobil = $_POST['typemobil']; // type mobil
    $harga_mobil = $_POST['harga']; // harga type mobil

    $querymenyimpantype = "INSERT INTO type_mobil (nama_type,harga_type,id_merek,id_admin) VALUES ('$type_mobil','$harga_mobil','$merek_mobil','$_SESSION[user]')"; // query sql menyimpan ke db
    $resultmenyimpantype = mysqli_query($conn, $querymenyimpantype); // eksekusi query
    if($resultmenyimpantype){
        header('Location: list-type?page='.$merek_mobil);
    }
}

if(isset($_POST['aksitypeedit'])){
    $id = $_POST['id'];
    $merek_mobil = $_POST['merekmobil']; // id merek mobil
    $type_mobil = $_POST['typemobil']; // type mobil
    $harga_mobil = $_POST['harga']; // harga type mobil

    $querymenyimpantype = "UPDATE type_mobil SET nama_type = '$type_mobil', harga_type='$harga_mobil', id_merek = '$merek_mobil', id_admin = '$_SESSION[user]' WHERE id_type = '$id'"; // query sql menyimpan ke db
    $resultmenyimpantype = mysqli_query($conn, $querymenyimpantype); // eksekusi query
    if($resultmenyimpantype){
        header('Location: list-type?page='.$merek_mobil);
    }
}

if(isset($_POST['hapustype'])){
    $id = $_POST['idtype'];
    $deletetype = "DELETE FROM type_mobil WHERE id_type = '$id'";
    $resultype = mysqli_query($conn, $deletetype);
    if($resultype){
        header('Location: list-type?page='.$_SESSION['merek_id']);
    }
}



if(isset($_POST['aksipromo2'])){
    // detail
    $desk = $_POST['desk'];
    $nama_event = $_POST['promo'];
    $fotonew = md5(rand()); // nama untuk foto

    // image
    $file_image = $_FILES['bannerpromo']['tmp_name']; // temporary file upload

    $nama_image = end(explode(".", $_FILES['bannerpromo']['name']));
    $folder_nama = $rowakun['domain']."/img/banner/";
    $nama_resize = $fotonew.".".$nama_image; // ubah nama file ori
    $lokasi_file_nama_file = $folder_nama.$nama_resize; // lokasi file/nama file upload
    $movefile = move_uploaded_file($file_image, $lokasi_file_nama_file); // memindahkan 
    if($movefile){
        $dbfoto = "img/banner/".$fotonew.".".$nama_image;
        $querypromo = "INSERT INTO promo_mobil (foto_promo,nama_event,desk,id_admin) VALUES ('$dbfoto','$nama_event','$desk','$_SESSION[user]')";
        $resultpromo = mysqli_query($conn, $querypromo);
    }
}

if(isset($_POST['aksipromo'])){
    // detail
    $promo = $_POST['promo'];
    $desk = $_POST['desk'];
    $fotonew = md5(rand()); // nama untuk foto

    // image
    $file_image = $_FILES['bannerpromo']['tmp_name']; // temporary file upload

    $nama_image = end(explode(".", $_FILES['bannerpromo']['name']));
    $folder_nama = $rowakun['domain']."/img/banner/";
    $nama_resize = $fotonew.".".$nama_image; // ubah nama file ori
    $lokasi_file_nama_file = $folder_nama.$nama_resize; // lokasi file/nama file upload
    $movefile = move_uploaded_file($file_image, $lokasi_file_nama_file); // memindahkan 
        $dbfoto = "img/banner/".$fotonew.".".$nama_image;
        $querypromo = "INSERT INTO promo_mobil (foto_promo,nama_event,desk,id_admin) VALUES ('$dbfoto','$promo','$desk','$_SESSION[user]')";
        $resultpromo = mysqli_query($conn, $querypromo);
        if($resultpromo){
            header('Location: list-promo');
        }
}

if(isset($_POST['aksieditpromo'])){
    $id = $_POST['id'];
    $promo = $_POST['promo'];
    $desk = $_POST['desk'];
    $namafotolama = $_POST['fotolama'];
    if($_FILES['bannerpromo']['name'] != ""){
        $fotonew = md5(rand()); // nama untuk foto
    
        // image
        $file_image = $_FILES['bannerpromo']['tmp_name']; // temporary file upload
    
        $nama_image = end(explode(".", $_FILES['bannerpromo']['name']));
        $folder_nama = $rowakun['domain']."/img/banner/";
        $nama_resize = $fotonew.".".$nama_image; // ubah nama file ori
        $lokasi_file_nama_file = $folder_nama.$nama_resize; // lokasi file/nama file upload
        $movefile = move_uploaded_file($file_image, $lokasi_file_nama_file); // memindahkan 
        if($movefile){
            if(file_exists($rowakun['domain']."/".$namafotolama)){
                unlink($rowakun['domain']."/".$namafotolama);
            }
            $dbfoto = "img/banner/".$fotonew.".".$nama_image;
            $querypromo = "UPDATE promo_mobil SET foto_promo = '$dbfoto', nama_event='$promo', desk = '$desk' WHERE id_promo='$id' AND id_admin='$_SESSION[user]'";
            $resultpromo = mysqli_query($conn, $querypromo);
            if($resultpromo){
                header('Location: list-promo');
            }
        }
    }else{
        $querypromo = "UPDATE promo_mobil SET desk = '$desk', nama_event='$promo' WHERE id_promo='$id'";
        $resultpromo = mysqli_query($conn, $querypromo);
            if($resultpromo){
                header('Location: list-promo');
            }
    }
}

if(isset($_POST['hapuspromo'])){
    $id = $_POST['idpromo'];
    $query = "SELECT foto_promo FROM promo_mobil WHERE id_promo='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if(file_exists($rowakun['domain']."/".$row['foto_promo'])){
        unlink($rowakun['domain']."/".$row['foto_promo']);
    }
    $querydelpromo = "DELETE FROM promo_mobil WHERE id_promo='$id'";
    $resultdelpromo = mysqli_query($conn, $querydelpromo);
    if($resultdelpromo){
        header('Location: list-promo');
    }
}

if(isset($_POST['aksigaleri2'])){
    // detail
    $desk = $_POST['galeri'];
    $fotonew = md5(rand()); // nama untuk foto

    // image
    $file_image = $_FILES['bannergaleri']['tmp_name']; // temporary file upload

    $nama_image = end(explode(".", $_FILES['bannergaleri']['name']));
    $folder_nama = $rowakun['domain']."/img/galeri/";
    $nama_resize = $fotonew.".".$nama_image; // ubah nama file ori
    $lokasi_file_nama_file = $folder_nama.$nama_resize; // lokasi file/nama file upload
    $movefile = move_uploaded_file($file_image, $lokasi_file_nama_file); // memindahkan 
    if($movefile){
        $dbfoto = "/img/galeri/".$fotonew.".".$nama_image;
        $querygaleri = "INSERT INTO galeri_sales (foto_galeri,desk,id_admin) VALUES ('$dbfoto','$desk','$_SESSION[user]')";
        $resultgaleri = mysqli_query($conn, $querygaleri);
    }
}
if(isset($_POST['aksigaleri'])){
    // detail
    $desk = $_POST['galeri'];
    $fotonew = md5(rand()); // nama untuk foto

    // image
    $file_image = $_FILES['bannergaleri']['tmp_name']; // temporary file upload

    $nama_image = end(explode(".", $_FILES['bannergaleri']['name']));
    $folder_nama = $rowakun['domain']."/img/galeri/";
    $nama_resize = $fotonew.".".$nama_image; // ubah nama file ori
    $lokasi_file_nama_file = $folder_nama.$nama_resize; // lokasi file/nama file upload
    $movefile = move_uploaded_file($file_image, $lokasi_file_nama_file); // memindahkan 
    if($movefile){
        $dbfoto = "img/galeri/".$fotonew.".".$nama_image;
        $querygaleri = "INSERT INTO galeri_sales (foto_galeri,desk,id_admin) VALUES ('$dbfoto','$desk','$_SESSION[user]')";
        if(mysqli_query($conn, $querygaleri)){
            header('Location: list-galeri');
        }

    }
}

if(isset($_POST['aksieditgaleri'])){
    $id = $_POST['id'];
    $desk = $_POST['galeri'];
    $namafotolama = $_POST['fotolama'];
    if($_FILES['bannergaleri']['name'] != ""){
        $fotonew = md5(rand()); // nama untuk foto
    
        // image
        $file_image = $_FILES['bannergaleri']['tmp_name']; // temporary file upload
    
        $nama_image = end(explode(".", $_FILES['bannergaleri']['name']));
        $folder_nama = $rowakun['domain']."/img/galeri/";
        $nama_resize = $fotonew.".".$nama_image; // ubah nama file ori
        $lokasi_file_nama_file = $folder_nama.$nama_resize; // lokasi file/nama file upload
        $movefile = move_uploaded_file($file_image, $lokasi_file_nama_file); // memindahkan 
        if($movefile){
            if(file_exists($rowakun['domain']."/".$namafotolama)){
                unlink($rowakun['domain']."/".$namafotolama);
            }
            $dbfoto = "img/galeri/".$fotonew.".".$nama_image;;
            $querygaleri = "UPDATE galeri_sales SET foto_galeri = '$dbfoto', desk = '$desk' WHERE id_galeri='$id' AND id_admin='$_SESSION[user]'";
            $resultgaleri = mysqli_query($conn, $querygaleri);
            if($resultgaleri){
                header('Location: list-galeri');
            }
        }
    }else{
        $querygaleri = "UPDATE galeri_sales SET desk = '$desk' WHERE id_galeri='$id'";
        $resultgaleri = mysqli_query($conn, $querygaleri);
            if($resultgaleri){
                header('Location: list-galeri');
            }
    }
}

if(isset($_POST['hapusgaleri'])){
    $id = $_POST['idgaleri'];
    $query = "SELECT foto_galeri FROM galeri_sales WHERE id_galeri='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if(file_exists($rowakun['domain']."/".$row['foto_galeri'])){
        unlink(($rowakun['domain']."/".$row['foto_galeri']));
    }
    $querydelgaleri = "DELETE FROM galeri_sales WHERE id_galeri='$id'";
    $resultdelgaleri = mysqli_query($conn, $querydelgaleri);
    if($resultdelgaleri){
        header('Location: list-galeri');
    }
}

if(isset($_POST['aksislider'])){
    // detail
    $desk = $_POST['slider'];
    $fotonew = md5(rand()); // nama untuk foto

    // image
    $file_image = $_FILES['bannerslider']['tmp_name']; // temporary file upload

    $nama_image = end(explode(".", $_FILES['bannerslider']['name']));
    $folder_nama = $rowakun['domain']."/img/slider/";
    $nama_resize = $fotonew.".".$nama_image; // ubah nama file ori
    $lokasi_file_nama_file = $folder_nama.$nama_resize; // lokasi file/nama file upload
    $movefile = move_uploaded_file($file_image, $lokasi_file_nama_file); // memindahkan 
    if($movefile){
        $dbfoto = "/img/slider/".$fotonew.".".$nama_image;
        $queryslider = "INSERT INTO slider_home (foto_slider,desk,id_admin) VALUES ('$dbfoto','$desk','$_SESSION[user]')";
        if(mysqli_query($conn, $queryslider)){
            header('Location: slider-home');
        }

    }
}

if(isset($_POST['aksislider2'])){
    // detail
    $desk = $_POST['slider'];
    $fotonew = md5(rand()); // nama untuk foto

    // image
    $file_image = $_FILES['bannerslider']['tmp_name']; // temporary file upload

    $nama_image = end(explode(".", $_FILES['bannerslider']['name']));
    $folder_nama = $rowakun['domain']."/img/slider/";
    $nama_resize = $fotonew.".".$nama_image; // ubah nama file ori
    $lokasi_file_nama_file = $folder_nama.$nama_resize; // lokasi file/nama file upload
    $movefile = move_uploaded_file($file_image, $lokasi_file_nama_file); // memindahkan 
    if($movefile){
        $dbfoto = "/img/slider/".$fotonew.".".$nama_image;
        $queryslider = "INSERT INTO slider_home (foto_slider,desk,id_admin) VALUES ('$dbfoto','$desk','$_SESSION[user]')";
        mysqli_query($conn, $queryslider);

    }
}

if(isset($_POST['aksieditslider'])){
    $id = $_POST['id'];
    $desk = $_POST['slider'];
    $namafotolama = $_POST['fotolama'];
    if($_FILES['bannerslider']['name'] != ""){
        $fotonew = md5(rand()); // nama untuk foto
    
        // image
        $file_image = $_FILES['bannerslider']['tmp_name']; // temporary file upload
    
        $nama_image = end(explode(".", $_FILES['bannerslider']['name']));
        $folder_nama = $rowakun['domain']."/img/slider/";
        $nama_resize = $fotonew.".".$nama_image; // ubah nama file ori
        $lokasi_file_nama_file = $folder_nama.$nama_resize; // lokasi file/nama file upload
        $movefile = move_uploaded_file($file_image, $lokasi_file_nama_file); // memindahkan 
        if($movefile){
            if(file_exists($rowakun['domain'].$namafotolama)){
                unlink($rowakun['domain']."/".$namafotolama);
            }
            $dbfoto = "img/slider/".$fotonew.".".$nama_image;
            $queryslider = "UPDATE slider_home SET foto_slider = '$dbfoto', desk = '$desk' WHERE id_slider='$id' AND id_admin='$_SESSION[user]'";
            $resultslider = mysqli_query($conn, $queryslider);
            if($resultslider){
                header('Location: slider-home');
            }
        }
    }else{
        $queryslider = "UPDATE slider_home SET desk = '$desk' WHERE id_slider='$id'";
        $resultslider = mysqli_query($conn, $queryslider);
            if($resultslider){
                header('Location: slider-home');
            }
    }
}

if(isset($_POST['hapusslider'])){
    $id = $_POST['idslider'];
    $query = "SELECT foto_slider FROM slider_home WHERE id_slider='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if(file_exists($rowakun['domain']."/".$row['foto_slider'])){
        unlink($rowakun['domain']."/".$row['foto_slider']);
    }
    $querydelslider = "DELETE FROM slider_home WHERE id_slider='$id'";
    $resultdelslider = mysqli_query($conn, $querydelslider);
    if($resultdelslider){
        header('Location: slider-home');
    }
}
// foto profil
if(isset($_POST['crop_image'])){
    $data = $_POST['crop_image'];
    $image_array_1 = explode(";", $data);
    $image_array_2 = explode(",", $image_array_1[1]);
    $base64_decode = base64_decode($image_array_2[1]);
    $ran = md5(rand());
    $path_img = $rowakun['domain'].'/img/profile/'.$ran.'.png';
    file_put_contents($path_img, $base64_decode);
    $cekfotoquery = "SELECT foto_profil FROM profil_admin WHERE id_admin='$_SESSION[user]'";
    $resultfoto = mysqli_query($conn, $cekfotoquery);
    $namaimg = 'img/profile/'.$ran.'.png';
    if(mysqli_num_rows($resultfoto) > 0){
        $row = mysqli_fetch_assoc($resultfoto);
        if(file_exists($rowakun['domain']."/".$row['foto_profil'])){
            unlink($rowakun['domain']."/".$row['foto_profil']) ;
        }
        $updatequery = "UPDATE profil_admin SET foto_profil='$namaimg' WHERE id_admin='$_SESSION[user]'";
        $resultquery = mysqli_query($conn, $updatequery);
        
    }else{
        $updatequery = "INSERT INTO profil_admin (id_admin,foto_profil) VALUES ('$_SESSION[user]','$namaimg')";
        $resultquery = mysqli_query($conn, $updatequery);
    }
}

// simpan profil
if(isset($_POST['aksiprofil'])){
    // detail
    $bio = $_POST['bio'];
    $fb = $_POST['fb'];
    $wa = $_POST['wa'];
    $link = $_POST['link'];
    $ig = $_POST['ig'];
    $nama_sales = $_POST['namasales']; // nama sales
    $cabang = $_POST['cabang'];
    $alamat = $_POST['alamat'];
    $jabatan = $_POST['jabatan'];
    
    $querycek = "SELECT * FROM profil_admin WHERE id_admin='$_SESSION[user]'";
    $resultcek = mysqli_query($conn, $querycek);
    if(mysqli_num_rows($resultcek) > 0){
        $querymenyimpan = "UPDATE profil_admin SET nama_sales='$nama_sales',jabatan_sales='$jabatan',cabang='$cabang',alamat='$alamat',bio='$bio',fb='$fb',wa='$wa',ig='$ig',link='$link' WHERE id_admin='$_SESSION[user]'";
        $resultmenyimpan = mysqli_query($conn, $querymenyimpan); // eksekusi query
    }else{
        $querymenyimpan = "INSERT INTO profil_admin (nama_sales,jabatan_sales,cabang,alamat,bio,fb,wa,ig,link,id_admin) VALUES ('$nama_sales','$jabatan','$cabang','$alamat','$bio','$fb','$wa','$ig','$link','$_SESSION[user]')"; // query sql menyimpan ke db
        $resultmenyimpan = mysqli_query($conn, $querymenyimpan); // eksekusi query
    }
}

// simpan teks home
if(isset($_POST['aksiteks'])){
    //kata
    $perkenalan = $_POST['perkenalan'];
    $keunggulan = $_POST['keunggulan'];
    $pengantar = $_POST['pengantar'];

    //warna
    $warna = $_POST['warna'];

    //logo
    $fotonew = md5(rand()); // nama untuk foto
    $file_image = $_FILES['logo']['tmp_name']; // temporary file upload

    $nama_image = end(explode(".", $_FILES['logo']['name']));
    $folder_nama = $rowakun['domain']."/img/profile/";
    $nama_resize = $fotonew.".".$nama_image; // ubah nama file ori
    $lokasi_file_nama_file = $folder_nama.$nama_resize; // lokasi file/nama file upload
    $movefile = move_uploaded_file($file_image, $lokasi_file_nama_file); // memindahkan 
    $dbfoto = "img/profile/".$fotonew.".".$nama_image;
    //cek
    $querycek = "SELECT * FROM profil_admin WHERE id_admin='$_SESSION[user]'";
    $resultcek = mysqli_query($conn, $querycek);
    if(mysqli_num_rows($resultcek) > 0){
        if($_FILES['logo']['name'] != "" && $movefile){
            if(file_exists($rowakun['domain']."/".$_POST['editfoto'])){
                unlink($rowakun['domain']."/".$_POST['editfoto']);
            }
            $querymenyimpan = "UPDATE profil_admin SET kata_sambutan='$pengantar',perkenalan='$perkenalan',keunggulan='$keunggulan', logo='$dbfoto', tema_webside='$warna' WHERE id_admin='$_SESSION[user]'";
            $resultmenyimpan = mysqli_query($conn, $querymenyimpan); // eksekusi query
        }else{
            $querymenyimpan = "UPDATE profil_admin SET kata_sambutan='$pengantar',perkenalan='$perkenalan',keunggulan='$keunggulan', tema_webside='$warna' WHERE id_admin='$_SESSION[user]'";
            $resultmenyimpan = mysqli_query($conn, $querymenyimpan); // eksekusi query
        }
    }else{
        if($_FILES['logo']['name'] != "" && $movefile ){
            $querymenyimpan = "INSERT INTO profil_admin (kata_sambutan,perkenalan,keunggulan,id_admin,logo,tema_webside) VALUES ('$pengantar','$perkenalan','$keunggulan','$_SESSION[user]','$dbfoto','$warna')"; // query sql menyimpan ke db
            $resultmenyimpan = mysqli_query($conn, $querymenyimpan); // eksekusi query
        }else{
            $querymenyimpan = "INSERT INTO profil_admin (kata_sambutan,perkenalan,keunggulan,id_admin,tema_webside) VALUES ('$pengantar','$perkenalan','$keunggulan','$_SESSION[user]','$warna')"; // query sql menyimpan ke db
            $resultmenyimpan = mysqli_query($conn, $querymenyimpan); // eksekusi query
        }
    }

}

// resetpas
if(isset($_POST['aksiemail'])){
    require_once 'function.php';
    $email = $_POST['email'];
    $querycekemail = mysqli_query($conn, "SELECT email FROM admin WHERE email='$email'");
    if(mysqli_num_rows($querycekemail) > 0){
        $angka = rand(1000,9999);
        $to = $email;
        $subject = "Reset Password";
        $txt = "Kode Untuk Reset Password $angka!";
        $headers = "From: sales@galeriide.net" . "\r\n" .
        "CC: sales@galeriide.net";

        if(mail($to,$subject,$txt,$headers)){
            $querysavekode = mysqli_query($conn, "UPDATE admin SET kode_verif='$angka' WHERE email='$email'");
            if($querysavekode){
                $_SESSION['email'] = $email;
                echo "<script type='text/javascript'>document.location.href = 'reset-kode';</script>";
            }
        }


    }else{
        $notif_error = "Email Tidak terdaftar.";
    }
}

if(isset($_POST['aksikode'])){
    $kode = $_POST['kode'];
    $querycekemail = mysqli_query($conn, "SELECT kode_verif FROM admin WHERE email = '$_SESSION[email]'");
    $rowkode = mysqli_fetch_assoc($querycekemail);
    $koedb = $rowkode['kode_verif'];
    if($kode == $koedb){
        $_SESSION['status'] = TRUE;
        echo "<script type='text/javascript'>document.location.href = 'new-password';</script>";
    }else{
        $notif_error = "Kode yang Anda masukkan Salah";
    }
}

if(isset($_POST['lupapass'])){
    $password = $_POST['pass'];
    $passwordkonfir = $_POST['pass2'];
    if($password != $passwordkonfir){
        $notif_error = "Password Konfirmasih tidak sama";
    }else{
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        $savenewpass = mysqli_query($conn, "UPDATE admin SET password = '$pass_hash', kode_verif = '0' WHERE email='$_SESSION[email]'");
        if($savenewpass){
            session_unset();
            echo "<script type='text/javascript'>document.location.href = 'index';</script>";
        }
    }
}

if(isset($_POST['aksisimpanwarna'])){
    // detail
    $merek_mobil = $_POST['merek'];
    $warna = $_POST['warna'];

    // foto
    $file_image = $_FILES['warnamerek']['tmp_name']; // temporary file upload
    $fotonew = md5(rand());
    $nama_image = end(explode(".", $_FILES['warnamerek']['name']));
    $folder_nama = $rowakun['domain']."/img/warnamerek/";
    $nama_resize = $fotonew.".".$nama_image; // ubah nama file ori
    $lokasi_file_nama_file = $folder_nama.$nama_resize; // lokasi file/nama file upload
    $movefile = move_uploaded_file($file_image, $lokasi_file_nama_file); // memindahkan 
    if($movefile){
        $dbfoto = "img/warnamerek/".$fotonew.".".$nama_image;
        $querywarna = "INSERT INTO warna_merek (foto_warna,ket_warna,id_merek,id_admin) VALUES ('$dbfoto','$warna','$merek_mobil','$_SESSION[user]') ";
        $resultwarna = mysqli_query($conn, $querywarna);
        if($resultwarna){
            header('Location: list-warna?page='.$merek_mobil);
        }
    }
}

if(isset($_POST['aksieditwarna'])){
    // detail
    $merek_mobil = $_POST['merek'];
    $warna = $_POST['warna'];
    $fotolama = $_POST['fotolama'];

    // foto
    if($_FILES['warnamerek']['name'] != ""){
        $file_image = $_FILES['warnamerek']['tmp_name']; // temporary file upload
        $fotonew = md5(rand());
        $nama_image = end(explode(".", $_FILES['warnamerek']['name']));
        $folder_nama = $rowakun['domain']."/img/warnamerek/";
        $nama_resize = $fotonew.".".$nama_image; // ubah nama file ori
        $lokasi_file_nama_file = $folder_nama.$nama_resize; // lokasi file/nama file upload
        $movefile = move_uploaded_file($file_image, $lokasi_file_nama_file); // memindahkan 
        if(file_exists($rowakun['domain'].'/'.$fotolama)){
            unlink($rowakun['domain'].'/'.$fotolama);
        }
        if($movefile){
            $dbfoto = "img/warnamerek/".$fotonew.".".$nama_image;
            $querywarna = "UPDATE warna_merek SET foto_warna='$dbfoto',ket_warna='$warna' WHERE id_warna='$_POST[id]' ";
            $resultwarna = mysqli_query($conn, $querywarna);
            if($resultwarna){
                header('Location: list-warna?page='.$merek_mobil);
            }
        }
    }else{
        $querywarna = "UPDATE warna_merek SET ket_warna='$warna' WHERE id_warna='$_POST[id]' ";
        $resultwarna = mysqli_query($conn, $querywarna);
            if($resultwarna){
                header('Location: list-warna?page='.$merek_mobil);
            }
    }
}

if(isset($_POST['hapuswarna'])){
    $id = $_POST['idwarna'];
    $queryselectwarna = mysqli_query($conn, "SELECT id_merek,foto_warna FROM warna_merek WHERE id_warna='$id'");
    $rowwarna = mysqli_fetch_assoc($queryselectwarna);
    if(file_exists($rowakun['domain']."/".$rowwarna['foto_warna'])){
        unlink($rowakun['domain']."/".$rowwarna['foto_warna']);
    }
    $querydelete = mysqli_query($conn, "DELETE FROM warna_merek WHERE id_warna='$id'");
    if($querydelete){
        header('Location: list-warna?page='.$_SESSION['merek_id']);
    }
}

if(isset($_POST['hapuscostumer'])){
    $id = $_POST['idcostumer'];
    $querycostumer = mysqli_query($conn, "DELETE FROM costumer WHERE id_costumer='$id'");
    if($querycostumer){
        header('Location: data-followup');
    }
}

if(isset($_POST['aksisimpanhighlight'])){
    // Detail
    $nama = $_POST['desk'];
    $merek = $_POST['merek'];

    // file foto
    $file_image = $_FILES['foto']['tmp_name']; // temporary file upload
    $fotonew = md5(rand());
    $nama_image = end(explode(".", $_FILES['foto']['name']));
    $folder_nama = $rowakun['domain']."/img/highlight/";
    $nama_resize = $fotonew.".".$nama_image; // ubah nama file ori
    $lokasi_file_nama_file = $folder_nama.$nama_resize; // lokasi file/nama file upload
    $movefile = move_uploaded_file($file_image, $lokasi_file_nama_file); // memindahkan 
    if($movefile){
        $dbfoto = "img/highlight/".$fotonew.".".$nama_image;
        $querysavefoto = mysqli_query($conn, "INSERT INTO highlight_mobil (foto_highlight,nama_highlight,id_merek,id_admin) VALUES ('$dbfoto','$nama','$merek','$_SESSION[user]')");
        if($querysavefoto){
            header('Location: list-highlight?page='.$merek);
        }
    }
}

if(isset($_POST['aksiedithighlight'])){
    // Detail
    $nama = $_POST['desk'];
    $merek = $_POST['merek'];
    $fotolama = $_POST['fotolama'];

    // foto
    if($_FILES['foto']['name'] != ""){
        $file_image = $_FILES['foto']['tmp_name']; // temporary file upload
        $fotonew = md5(rand());
        $nama_image = end(explode(".", $_FILES['foto']['name']));
        $folder_nama = $rowakun['domain']."/img/highlight/";
        $nama_resize = $fotonew.".".$nama_image; // ubah nama file ori
        $lokasi_file_nama_file = $folder_nama.$nama_resize; // lokasi file/nama file upload
        $movefile = move_uploaded_file($file_image, $lokasi_file_nama_file); // memindahkan 
        if(file_exists($rowakun['domain'].'/'.$fotolama)){
            unlink($rowakun['domain'].'/'.$fotolama);
        }
        if($movefile){
            $dbfoto = "img/highlight/".$fotonew.".".$nama_image;
            $queryhighlight = "UPDATE highlight_mobil SET foto_highlight='$dbfoto',nama_highlight='$nama' WHERE id_highlight='$_POST[id]' ";
            $resulthighlight = mysqli_query($conn, $queryhighlight);
            if($resulthighlight){
                header('Location: list-highlight?page='.$merek);
            }
        }
    }else{
        $queryhighlight = "UPDATE highlight_mobil SET nama_highlight='$nama' WHERE id_highlight='$_POST[id]' ";
            $resulthighlight = mysqli_query($conn, $queryhighlight);
            if($resulthighlight){
                header('Location: list-highlight?page='.$merek);
            }
    }
}

if(isset($_POST['hapushighlight'])){
    $id = $_POST['idhighlight'];
    $queryselecthighlight = mysqli_query($conn, "SELECT foto_highlight FROM highlight_mobil WHERE id_highlight='$id'");
    $rowhighlight = mysqli_fetch_assoc($queryselecthighlight);
    if(file_exists($rowakun['domain']."/".$rowhighlight['foto_highlight'])){
        unlink($rowakun['domain']."/".$rowhighlight['foto_highlight']);
    }
    $queryhighlight = "DELETE FROM highlight_mobil WHERE id_highlight='$id'";
    $resulthighlight = mysqli_query($conn, $queryhighlight);
    if($resulthighlight){
        header('Location: list-highlight?page='.$_SESSION['merek_id']);
    }
}

if(isset($_POST['aksispesifikasi'])){
    // dimensi
    $iddimensi = $_POST['iddimensi'];
    $fielddimensi = $_POST['fielddimensi'];
    $valuedimensi = $_POST['valuedimensi'];
    for($i = 0; $i < count($fielddimensi); $i++){
        if($fielddimensi[$i] == "" || $valuedimensi[$i] == "" ){
            continue;
        }elseif($iddimensi[$i] != ""){
            $querysavedimensi = mysqli_query($conn, "UPDATE detail SET nama_field='$fielddimensi[$i]', value_field='$valuedimensi[$i]' WHERE id_detail='$iddimensi[$i]'");
        }else{
            $querysavedimensi = mysqli_query($conn, "INSERT INTO detail (nama_field, value_field, id_kategori, id_merek, id_admin) VALUES ('$fielddimensi[$i]', '$valuedimensi[$i]', '1', '$_SESSION[merek_id]', '$_SESSION[user]')");
        }
    }
    // mesin
    $idmesin = $_POST['idmesin'];
    $fieldmesin = $_POST['fieldmesin'];
    $valuemesin= $_POST['valuemesin'];
    for($i = 0; $i < count($fieldmesin); $i++){
        if($fieldmesin[$i] == "" || $valuemesin[$i] == "" ){
            continue;
        }elseif($idmesin[$i] != ""){
            $querysavemesin = mysqli_query($conn, "UPDATE detail SET nama_field='$fieldmesin[$i]', value_field='$valuemesin[$i] WHERE id_detail='$idmesin[$i]'");
        }else{
            $querysavemesin = mysqli_query($conn, "INSERT INTO detail (nama_field, value_field, id_kategori, id_merek, id_admin) VALUES ('$fieldmesin[$i]', '$valuemesin[$i]', '2', '$_SESSION[merek_id]', '$_SESSION[user]')");
        }
    }
    // kaki
    $idkaki = $_POST['idkaki'];
    $fieldkaki = $_POST['fieldkaki'];
    $valuekaki = $_POST['valuekaki'];
    for($i = 0; $i < count($fieldkaki); $i++){
        if($fieldkaki[$i] == "" || $valuekaki[$i] == "" ){
            continue;
        }elseif($idkaki[$i] != ""){
            $querysavekaki = mysqli_query($conn, "UPDATE detail SET nama_field='$fieldkaki[$i]', value_field='$valuekaki[$i] WHERE id_detail='$idkaki[$i]'");
        }else{
            $querysavekaki = mysqli_query($conn, "INSERT INTO detail (nama_field, value_field, id_kategori, id_merek, id_admin) VALUES ('$fieldkaki[$i]', '$valuekaki[$i]', '3', '$_SESSION[merek_id]', '$_SESSION[user]')");
        }
    }
    // rem
    $idrem = $_POST['idrem'];
    $fieldrem = $_POST['fieldrem'];
    $valuerem = $_POST['valuerem'];
    for($i = 0; $i < count($fieldrem); $i++){
        if($fieldrem[$i] == "" || $valuerem[$i] == "" ){
            continue;
        }elseif($idrem[$i] != ""){
            $querysaverem = mysqli_query($conn, "UPDATE detail SET nama_field='$fieldrem[$i]', value_field='$valuerem[$i] WHERE id_detail='$idrem[$i]'");
        }else{
            $querysaverem = mysqli_query($conn, "INSERT INTO detail (nama_field, value_field, id_kategori, id_merek, id_admin) VALUES ('$fieldrem[$i]', '$valuerem[$i]', '4', '$_SESSION[merek_id]', '$_SESSION[user]')");
        }
    }
}

if($_GET['deletespek'] != ""){
    $deletespek =  $_GET['deletespek'];
    $querydeletespek = mysqli_query($conn, "DELETE FROM detail WHERE id_detail='$deletespek'");
    if($querydeletespek){
        header('Location: list-type?page='.$_SESSION['merek_id']);
    }
}

if(isset($_POST['aksisimpanteks'])){
    $judul = $_POST['judulteks'];
    $teks = $_POST['desk'];
    $queryteks = mysqli_query($conn, "INSERT INTO teks_whatsapp (judul_teks,teks,id_admin) VALUES ('$judul','$teks','$_SESSION[user]')");
    if($queryteks){
        header('Location: data-costumer');
    }
}

if(isset($_POST['aksieditteks'])){
    $id = $_POST['id'];
    $judul = $_POST['judulteks'];
    $teks = $_POST['desk'];
    $queryteks = mysqli_query($conn, "UPDATE teks_whatsapp SET judul_teks='$judul', teks='$teks' WHERE id_teks='$id'");
    if($queryteks){
        header('Location: data-costumer');
    }
}

if(isset($_POST['aksihapusteks'])){
    $id = $_POST['id'];
    $query = mysqli_query($conn, "DELETE FROM teks_whatsapp WHERE id_teks='$id'");
    if($query){
        header('Location: data-costumer');
    }
}

if(isset($_POST['kirimwa'])){
    $idcos = $_POST['id'];
    $hariini = date("Y-m-d");
    $querycoss = mysqli_query($conn, "UPDATE costumer SET waktu_send='$hariini' WHERE id_costumer='$idcos'");
    $kontak = $_POST['namakontak'];
    $id = $_POST['teksinput'];
    $queryteks = mysqli_query($conn, "SELECT teks FROM teks_whatsapp WHERE id_teks='$id'");
    $rowteks = mysqli_fetch_assoc($queryteks);
    $teks = $rowteks['teks'];
    $no = $_POST['no'];
    $arrayteks = preg_split('/\r\n|\r|\n/', $teks);
    $tekswa = '';
    for ($i=0;$i<count($arrayteks);$i++){
        $tekswa .=$arrayteks[$i].'%0A';
    } 
    $dengannama = explode("#nama",$tekswa);
    $mystring = $tekswa;
    $findme   = '#nama';
    if(strpos($mystring, $findme)){
        $tekswa = $dengannama[0].$kontak.$dengannama[1];
    }
    header('Location :https://api.whatsapp.com/send?phone=62'.$no.'&text='.$tekswa);
    
    // die(); 
}

if(isset($_POST['aksisimpankostumer'])){
    $nama = $_POST['nama'];
    $wa = $_POST['wa'];
    $kota = $_POST['kota'];
    $query = mysqli_query($conn, "INSERT INTO costumer (nama_costumer,no_costumer,kota_costumer,id_admin,kategori) VALUES ('$nama','$wa','$kota','$_SESSION[user]','1')");
    if($query){
        header('Location: data-client');
    }
}

if(isset($_POST['aksicostumeredit'])){
    $nama = $_POST['nama'];
    $wa = $_POST['wa'];
    $kota = $_POST['kota'];
    $id = $_POST['id'];
    $query = mysqli_query($conn, "UPDATE costumer SET nama_costumer='$nama',no_costumer='$wa',kota_costumer='$kota' WHERE id_costumer='$id'");
}

if(isset($_POST['hapuscostumer2'])){
    $id = $_POST['idcostumer'];
    $querycostumer = mysqli_query($conn, "DELETE FROM costumer WHERE id_costumer='$id'");
    if($querycostumer){
        header('Location: data-client');
    }
}

include "excel_reader2.php"; // library
if(isset($_POST['uplaodfileexcel'])){
    // upload file xls
    $fotonew = md5(rand());
    $nama_file = $fotonew.".".end(explode(".", $_FILES['dataexcel']['name']));
    $folder_nama = "file/";
    $target =  $folder_nama.$nama_file;
    move_uploaded_file($_FILES['dataexcel']['tmp_name'], $target);
    
    // beri permisi agar file xls dapat di baca
    chmod($target,0777);
    
    // mengambil isi file xls
    $data = new Spreadsheet_Excel_Reader($target,false);
    // menghitung jumlah baris data yang ada
    $jumlah_baris = $data->rowcount($sheet_index=0);
    
    // jumlah default data yang berhasil di import
    $berhasil = 0;
    for ($i=2; $i<=$jumlah_baris; $i++){
    
        // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
        $nama = $data->val($i, 1);
        $wa = $data->val($i, 2);
        $kota = $data->val($i, 3);
    
        if($nama != "" && $wa != "" && $kota != ""){
            // input data ke database (table data_pegawai)
            mysqli_query($conn, "INSERT INTO costumer (nama_costumer,no_costumer,kota_costumer,id_admin,kategori) VALUES('$nama','$wa','$kota','$_SESSION[user]','1')");
            $berhasil++;
        }
    }
    
    // hapus kembali file .xls yang di upload tadi
    unlink($target);
    
    if($berhasil != 0){
        header('Location: data-client');
    }
}

if(isset($_POST['googleaksi'])){
    $script = $_POST['google'];
    $querygoogle = mysqli_query($conn, "SELECT id_analysis FROM google_analysis WHERE id_admin='$_SESSION[user]'");
    if(mysqli_num_rows($querygoogle) > 0){
        mysqli_query($conn, "UPDATE google_analysis SET script_analysis='$script' WHERE id_admin='$_SESSION[user]'");
    }else{
        mysqli_query($conn, "INSERT INTO google_analysis (script_analysis,id_admin) VALUES('$script','$_SESSION[user]')");
    }
}

if(isset($_POST['fbaksi'])){
    $script = $_POST['fb'];
    $queryfb = mysqli_query($conn, "SELECT id_pixel FROM fb_pixel WHERE id_admin='$_SESSION[user]'");
    if(mysqli_num_rows($queryfb) > 0){
        mysqli_query($conn, "UPDATE fb_pixel SET script_pixel='$script' WHERE id_admin='$_SESSION[user]'");
    }else{
        mysqli_query($conn, "INSERT INTO fb_pixel (script_pixel,id_admin) VALUES('$script','$_SESSION[user]')");
    }
}

// hanya untuk developer
if(isset($_POST['aksiuseredit'])){
    $id = $_POST['id'];
    $status = $_POST['status'];
    $domain = $_POST['domain'];
    $edit = mysqli_query($conn,"UPDATE admin SET domain='$domain', status='$status' WHERE id_admin='$id'");
}

if(isset($_POST['hapusadmin'])){
    $id = $_POST['idadmin'];
    $delete = mysqli_query($conn,"DELETE FROM admin WHERE id_admin='$id'");
}

if(isset($_POST['aksisimpanvideo'])){
    //detail
    $judul = $_POST['judulvideo'];
    $link = $_POST['link'];
    $kategori = $_POST['kategori'];
    $desk = $_POST['desk'];
    
    //file
    if($_FILES['nail']['name'] != ""){
        $file_image = $_FILES['nail']['tmp_name']; // temporary file upload
        $fotonew = md5(rand());
        $nama_image = end(explode(".", $_FILES['nail']['name']));
        $folder_nama = "img-admin/thumbnail/";
        $nama_resize = $fotonew.".".$nama_image; // ubah nama file ori
        $lokasi_file_nama_file = $folder_nama.$nama_resize; // lokasi file/nama file upload
        $movefile = move_uploaded_file($file_image, $lokasi_file_nama_file); // memindahkan 
        if($movefile){
            $dbfoto = "img-admin/thumbnail/".$fotonew.".".$nama_image;
            $querynail = "INSERT INTO video_tutorial (thumnail_video,judul_video,file_video,desk_video,kategori_video,id_admin) VALUES('$dbfoto','$judul','$link','$desk','$kategori','$_SESSION[user]')";
            $resultnail = mysqli_query($conn, $querynail);
            if($resulnail){
                header('Location: halaman-admin');
            }
        }
    }
}

if(isset($_POST['aksieditvideo'])){
    //detail
    $id = $_POST['id'];
    $judul = $_POST['judulvideo'];
    $link = $_POST['link'];
    $kategori = $_POST['kategori'];
    $desk = $_POST['desk'];

    //file
    if($_FILES['nail']['name'] != ""){
        $file_image = $_FILES['nail']['tmp_name']; // temporary file upload
        $fotonew = md5(rand());
        $nama_image = end(explode(".", $_FILES['nail']['name']));
        $folder_nama = "img-admin/thumbnail/";
        $nama_resize = $fotonew.".".$nama_image; // ubah nama file ori
        $lokasi_file_nama_file = $folder_nama.$nama_resize; // lokasi file/nama file upload
        $movefile = move_uploaded_file($file_image, $lokasi_file_nama_file); // memindahkan 
        if($movefile){
            if(file_exists($_POST['filelama'])){
                unlink($_POST['filelama']);
            }
            $dbfoto = "img-admin/thumbnail/".$fotonew.".".$nama_image;
            $querynail = "UPDATE video_tutorial SET thumnail_video='$dbfoto',judul_video='$judul',file_video='$link',desk_video='$desk',kategori_video='$kategori' WHERE id_video='$id'";
            $resultnail = mysqli_query($conn, $querynail);
            if($resulnail){
                header('Location: halaman-admin');
            }
        }
    }else{
        $querynail = "UPDATE video_tutorial SET judul_video='$judul',file_video='$link',desk_video='$desk',kategori_video='$kategori'  WHERE id_video='$id'";
            $resultnail = mysqli_query($conn, $querynail);
            if($resulnail){
                header('Location: halaman-admin');
            }
    }
}

if(isset($_POST['hapusvideo'])){
    $id = $_POST['idvideo'];
    $querythumbnail = mysqli_query($conn, "SELECT thumnail_video FROM video_tutorial WHERE id_video='$id'");
    $rownail = mysqli_fetch_assoc($querythumbnail);
    if(file_exists($rownail['thumnail_video'])){
        unlink($rownail['thumnail_video']);
    }
    $querydelete = mysqli_query($conn, "DELETE FROM video_tutorial WHERE id_video='$id'");
}

if(isset($_POST['aksisimpankategori'])){
    $kategori = $_POST['kategori'];
    $querykategori = mysqli_query($conn, "INSERT INTO kategori_video (nama_kategori,id_admin) VALUES('$kategori','$_SESSION[user]')");
}

if(isset($_POST['aksieditkategori'])){
    $id = $_POST['id'];
    $kategori = $_POST['kategori'];
    $querykategori = mysqli_query($conn, "UPDATE kategori_video SET nama_kategori='$kategori' WHERE id_kategori='$id'");
}

if(isset($_POST['aksihapuskategori'])){
    $id = $_POST['id'];
    $querydeletekat = mysqli_query($conn, "DELETE FROM kategori_video WHERE id_kategori='$id'");
    if($querydeletekat){
        $querythumbnail = mysqli_query($conn, "SELECT thumnail_video FROM video_tutorial WHERE kategori_video='$id'");
        while($rownail = mysqli_fetch_assoc($querythumbnail)){
            if(file_exists($rownail['thumnail_video'])){
                unlink($rownail['thumnail_video']);
            }
        }
        $querydelete = mysqli_query($conn, "DELETE FROM video_tutorial WHERE kategori_video='$id'");
    }
}


?>