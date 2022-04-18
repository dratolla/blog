<?php 

require_once 'header.php'; 

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

<div class="mainContent registration container">
    <div class="card mb-4">
        <form action="" method="post" enctype="multipart/form" class="">
            <h1 class="text-center mt-4">Registrasi</h1>
            <ul>
                <li class="li-label">
                    <label for="nama" class="visually-hidden">
                        Nama
                    </label>
                    <span class="iconify" data-icon="openmoji:european-name-badge" data-width="25" data-height="25"></span>
                    <input type="text" name="nama" id="nama" class="rounded-0" placeholder="Nama" autocomplete="off" required>

                </li>
                <li class="li-label">
                    <label for="username" class="visually-hidden">
                        Username
                    </label>
                    <span class="iconify" data-icon="carbon:user-avatar-filled" style="color: #877dd4;" data-width="25" data-height="25"></span> 
                    <input type="text" name="username" id="username" class="rounded-0" placeholder="Username" autocomplete="off" required>

                </li>
                

                <li class="li-label mt-4 mb-2">
                    <label for="password" class="visually-hidden">Password</label>
                    <span class="iconify" data-icon="fa6-solid:lock" style="color: #877dd4;" data-width="20" data-height="20"></span>
                    <input type="password" name="password" id="password" class="rounded-0" placeholder="Password" required>
                </li>
                <li class="li-label">
                    <label for="password2" class="visually-hidden">
                        Konfirmasi Password
                    </label>
                    <span class="iconify" data-icon="akar-icons:image" style="color: #877dd4;" data-width="25" data-height="25"></span> 
                    <input type="text" name="password-2" id="password-2" class="rounded-0" placeholder="Konfirmasi Password" autocomplete="off" required>

                </li>
                <div class="d-grid">
                    <button type="submit" name="register" class="btn">Registrasi</button>
                </div>
            </ul>
        </form>
    </div>
</div>
<?php require_once 'footer.php'; ?>