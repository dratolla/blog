<?php
require_once 'header.php';

$id = $_GET['id'];

$artikel = query("SELECT artikel.nama AS an, artikel.konten AS ak, artikel.gambar AS ag, kategori.nama AS kn, artikel.id AS ai, users.id, users.nama AS un, users.username AS uu, users.icon AS ui FROM blog INNER JOIN artikel ON blog.id_artikel = artikel.id INNER JOIN kategori ON blog.id_kategori = kategori.id INNER JOIN users ON blog.id_user = users.id WHERE artikel.id = $id")[0];       

//apakah tombol submit sudah ditekan
if (isset($_POST['submit'])) {

    // apakah data berhasil diubah

   if( ubah($_POST) > 0 ) {
        $success = true;
   } else {
        $error = true;
        echo mysqli_error($conn);
   }   
}
?>

<div class="mainContent editartikel container">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $artikel['ai']?>">
        <input type="hidden" name="gambarLama" value="<?= $artikel['ag']?>">

        <?php if( isset($success) ) :?>
            <div class="success">
                <div class="alert alert-primary" role="alert"><span class="text-dark">Artikel berhasil diubah.</span> <a href="artikel.php?id=<?= $artikel['ai']?>" >Lihat artikel</a> </div>
                
            </div>
        <?php elseif( isset($error) ) :?>
            <div class="alert alert-alert text-alert" role="alert">Artikel gagal diubah</div>
        <?php endif; ?>
        <ul>
            <li class="mb-2">
                <label class="visually-hidden text-light" for="nama" >Nama Artikel</label>
                <input type="text" name="nama" class="form-control bg-dark text-light rounded" id="nama" placehorder="Title Artikel" required value="<?= $artikel['an']; ?>">
            </li>
            <li class="mb-2">
                <label class="visually-hidden" for="username">Username</label>
                <input type="text" disabled name="username" class="form-control bg-dark text-light rounded" id="username" placehorder="Username" required value="<?= $artikel['uu']; ?>">
            </li>
            <li class="mb-2">
                <label class="visually-hidden text-light" for="konten" >Isi Konten</label>
                <textarea class="form-control bg-dark text-light" name="konten" id="konten" cols="30" rows="20" placehorder="Isi Artikel" required value=""><?= $artikel['ak'];?></textarea>
            </li>
            <li class="mb-3">
                <label class="visually-hidden" for="gambar">Gambar</label>
                <img src="assets/img/<?= $artikel['ag']?>" alt="Gambar dari <?= $artikel['an']?>">
                <input type="file" name="gambar" class="form-control bg-dark text-light rounded" id="gambar" placehorder="Gambar Artikel" value="<?= $artikel['ag']; ?>">
            </li>
            <li class="subbutton d-flex">
                <button type="submit" name="submit" class="btn btn-dark justify-content-center">Ubah</button>
            </li>
        </ul>
    </form>
    
</div>
<?php 
require_once 'footer.php';
?>