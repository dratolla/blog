<?php

$conn = mysqli_connect("localhost","root","","db_blog");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
 }

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}



function tambah($data) {
    global $conn;
    
    $nis = htmlspecialchars($data["nis"]);
    $kode_santri = htmlspecialchars($data["kode_santri"]);
    $nama_santri = htmlspecialchars($data["nama_santri"]);
    $tpt_lahir = htmlspecialchars($data["tpt_lahir"]);
    $tgl_lahir = htmlspecialchars($data["tgl_lahir"]);
    $jalur_masuk = htmlspecialchars($data["jalur_masuk"]);
    $tgl_masuk = htmlspecialchars($data["tgl_masuk"]);
    $status = htmlspecialchars($data["status"]);

    // upload foto
    $foto = upload();
    if( !$foto ) {
        return false;
    }
 

    $query = "INSERT INTO santriwan
    VALUES
    (null,'$nis','$kode_santri','$nama_santri','$tpt_lahir',
     '$tgl_lahir','$jalur_masuk','$tgl_masuk','$status','$foto')
      ";
 

    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);
}

function tambahWali($data) {
    global $conn;
    
    $kode_santri = htmlspecialchars($data["kode_santri"]);
    $nis = htmlspecialchars($data["nis"]);
    $sdr_kndg = htmlspecialchars($data["sdr_kndg"]);
    $sdr_trdkt = htmlspecialchars($data["sdr_trdkt"]);

    $nama_ayah = htmlspecialchars($data["nama_ayah"]);
    $pkrjn_ayah = htmlspecialchars($data["pkrjn_ayah"]);
    $no_ktp_ayah = htmlspecialchars($data["no_ktp_ayah"]);
    $tlp_ayah = htmlspecialchars($data["tlp_ayah"]);
    $almt_ktp_ayah = htmlspecialchars($data["almt_ktp_ayah"]);
    $almt_kini_ayah = htmlspecialchars($data["almt_kini_ayah"]);

    $nama_ibu = htmlspecialchars($data["nama_ibu"]);
    $pkrjn_ibu = htmlspecialchars($data["pkrjn_ibu"]);
    $no_ktp_ibu = htmlspecialchars($data["no_ktp_ibu"]);
    $tlp_ibu = htmlspecialchars($data["tlp_ibu"]);
    $almt_ktp_ibu = htmlspecialchars($data["almt_ktp_ibu"]);
    $almt_kini_ibu = htmlspecialchars($data["almt_kini_ibu"]);
    
    $query= " INSERT INTO wali_santri VALUES 
    (null,'$kode_santri','$nis','$sdr_kndg','$sdr_trdkt',
     '$nama_ayah', '$pkrjn_ayah','$no_ktp_ayah','$tlp_ayah','$almt_ktp_ayah','$almt_kini_ayah',
     '$nama_ibu', '$pkrjn_ibu','$no_ktp_ibu','$tlp_ibu','$almt_ktp_ibu','$almt_kini_ibu')";

    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);
    }

function upload() {
    global $conn;

    $fileName = $_FILES['gambar']['name'];
    $fileSize = $_FILES['gambar']['size'];
    $fileError = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // apakah ada gambar yang diupload?
    if( $fileError === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>
        ";
        return false;
    }

    // apakah yang diupload adalah gambar
    $picValidExtention = ['jpg', 'jpeg', 'png'];
    $picExtention = explode('.', $fileName);
    $picExtention = strtolower(end($picExtention));
    if( !in_array($picExtention, $picValidExtention) ){
      
        echo "<script>
                alert('yang anda upload bukan gambar');
            </script>";

        return false;
    }

    // jika file terlalu besar
    if ($fileSize > 3000000) {
        echo "<script>
                alert('ukuran file yang anda upload terlalu besar, max 3MB');
            </script>";

        return false;
    }

    // jika lolos dan siap diupload
    // var_dump()



    // generate nama baru
    $newFileName = uniqid();
    $newFileName .= '.';
    $newFileName .= $picExtention;

    move_uploaded_file($tmpName, '/opt/lampp/htdocs/blog/assets/img/'.$newFileName); //pindahkan file yg diupload

    return $newFileName;

    
}



function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM santriwan WHERE id = $id");
    return mysqli_affected_rows($conn); 
}

function ubah($data) {
    global $conn;

    $id = $data["id"];
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    $a = htmlspecialchars($data["nama"]);
    $b = htmlspecialchars($data["konten"]);

    // cek apakah user pilih gambar atau tidak
    if( $_FILES['gambar']['error'] === 4 ) {
        $c = $gambarLama;
    } else {
        $c = upload();
    }
    

    mysqli_query($conn, "UPDATE artikel 
                    SET nama = '$a',
                    konten = '$b',
                    gambar = '$c' 
                    WHERE id = $id
        ");


return mysqli_affected_rows($conn);

}

function ubahWali($data) {

    global $conn;
    $id = $data["id"];

    $query= " UPDATE wali_santri SET
    (null)";

    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);
    
}

function cari($keyword) {
    $query = "SELECT * FROM santriwan
                WHERE
                nama_santri LIKE '%$keyword%' OR
                nis LIKE '%$keyword%'
                ";

    return query($query); 
}

function registrate($data) {
    global $conn;
    $namauser = strtolower(stripslashes($data["nama"]));
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $gambar = upload();
    // cek username sudah ada/ belum
    $result = mysqli_query($conn, "SELECT username FROM users 
            WHERE 
            username = '$username'");
    
    if( mysqli_fetch_assoc($result) ) {
        echo "<script>
                alert('user sudah terdaftar');
            </script>
            ";

        return false;
    }


    // cek konfirmasi password
    if ( $password !== $password2 ) {
        echo "<script> 
                alert('konfirmasi password tidak sesuai');
            </script>
        ";
        return false;
    }

    // enkripsi/mengamankan password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO users VALUES(
        null,'$namauser', '$username', '$password', '$gambar')
        ");

    return mysqli_affected_rows($conn);


}



?>

