<?php
require_once 'header.php';
// tangkap data di URL
$id = $_GET['id'];
// query data santri berdasarkan id
$artikel = query("SELECT artikel.nama AS an, artikel.konten AS ak, artikel.gambar AS ag, kategori.nama AS kn, artikel.id AS ai, users.id, users.nama AS un, users.username AS uu, users.icon AS ui FROM blog INNER JOIN artikel ON blog.id_artikel = artikel.id INNER JOIN kategori ON blog.id_kategori = kategori.id INNER JOIN users ON blog.id_user = users.id WHERE artikel.id = $id")[0];       

?>
<div class="mainContent artikel container">
    <div class="imgcontent">
        <img src="assets/img/<?= $artikel['ag']?>" alt="<?= $artikel['an']?>">
    </div>

    <div class="titlecontent mx-5 mt-3">
        <h2><?= $artikel["an"];?></h2>
        <div class="author">
            <p class="name">Author : <?= $artikel["uu"]?></p>
            <?php 
            if ($_SESSION["username"] == $artikel['uu']) :
            ?>   
            <p class="edit">Edit artikel <a href="editartikel.php?id=<?= $artikel["ai"]?>">disini</a></p>
            <?php
            endif;
            ?>
        </div>
        <p>Kategori : <?= $artikel["kn"]?></p>
        
    </div>
    <div class="textcontent mx-3">
        <p class="maintext"><?= stripslashes(nl2br($artikel["ak"]))?></p>

        
            </div>
    </div>

    
<?php 
require_once 'footer.php';
?>