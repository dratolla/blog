<?php 

require_once 'functions.php'; 

if( isset($_POST["register"]) ) {

    if( registrate($_POST) > 0 ) {
        echo "<script>
                alert('user baru berhasil ditambahkan');
                document.location.href = 'index.php';
            </script>
                ";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<form action="" method="post" enctype="multipart/form" class="mt-5">

    <ul>
        <li>
            <label for="nama" class=" d-block p-2">nama</label>
            <input type="text" name="nama" id="nama">
        </li>
        <li>
            <label for="username" class=" d-block p-2"> username:</label>
            <input type="text" name="username" id="username">
        </li>
        <li>
            <label for="password" class=" d-block p-2"> password</label>
            <input type="password" name="password" id="password">
        </li>
        <li>
            <label for="password2" class=" d-block p-2"> konfirmasi password:</label>
            <input type="password" name="password2" id="password2">
        </li>
        <li>
            <label for="gambar" class=" d-block p-2">gambar: </label>
            <input type="file" name="gambar" id="gambar">
        </li>
        <li>
            <button type="submit" name="register" class="mt-2 d-block p-2">registrasi</button>
        </li>
    </ul>
</form>
<?php require_once 'footer.php'; ?>