<?php 

require_once 'header.php';


?>
<div class="hellopic container">
    <img src="assets/img/pic1.jpg" alt="pic1">
</div>
<div class="mainContent container-fluid mb-5 homepage">
    <h1 class="text-center pt-4 mb-4">Artikel Terbaru</h1>
    <div class="crossed">
        <?php foreach ($blogs as $blog) : ?>
        <div class="crosscontent mb-0 mt-0">
        <!-- Bagian Kiri -->
            <div class="crossimg d-flex p-0">
                <img src="assets/img/<?= $blog["ag"];?>" alt="<?= $blog["an"]?>" class="blogimg">

            </div>
        <!-- Akhir Bagian Kiri -->


        <!-- Bagian Kanan -->
            <div class="crosstext p-3">
                <div class="bloghl">
                    <h5><?= $blog["an"];?></h5>
                    <div class="author d-flex gap-4">
                        <p class="authorname">Author : <?= $blog["uu"]?></p>
                        <p class="katname">Kategori : <?= $blog['kn']?></p>
                    </div>
                    <p class="maintext"><?= $blog["ak"];?></p>
                    <a href="artikel.php?id=<?= $blog["ai"]?>">Baca Selengkapnya...</a>
                </div>
            </div>
        <!-- Akhir Bagian Kanan -->

        </div>
        <?php endforeach;?>
    </div>
</div>

<?php require_once 'footer.php' ;?>