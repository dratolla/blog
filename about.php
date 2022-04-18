<?php 
require_once 'header.php';

if (isset($_POST['submit'])) {

    echo "<script>
            alert('yes udah ditekan!');
            document.location.href = 'index.php';
    </script>";

    // apakah data berhasil diubah

//    if( ubah($_POST) > 0 ) {
//         $success = true;
//    } else {
//         $error = true;
//         echo mysqli_error($conn);
//    }   
}
?>

<div class="mainContent about">
    <div class="container section-one">
        <p class="title">About Us</p>
        <p class="text">Brian Dratolla is Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Molestias totam labore voluptate ratione? 
            Consequuntur laborum tempora alias iste, repellendus repellat consectetur aut amet earum perferendis illum illo suscipit hic necessitatibus enim voluptatem, non impedit nisi voluptatibus consequatur soluta adipisci maiores! 
            In et blanditiis rem illo eaque harum eius numquam inventore.</p>
        <p class="text">Brian Dratolla also Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
            Aut, excepturi pariatur possimus eum adipisci porro dicta aspernatur doloremque facere repudiandae molestias neque mollitia consequuntur, voluptatum exercitationem facilis deserunt ut totam maiores doloribus? 
            Saepe assumenda molestias eius ad sed veniam quibusdam aperiam quaerat dolore, a cum amet ullam soluta voluptatem, iure inventore atque! 
            Dolor sint aliquam voluptatibus unde. Ab deleniti nihil sunt. In esse totam voluptas, officia odit laboriosam qui necessitatibus.</p>
        <p class="text">So, you know that Brian Dratolla is Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet, repudiandae dolores? 
            Quia quaerat officiis asperiores placeat sint libero ea doloribus, totam consectetur dolores ullam reprehenderit molestias molestiae dignissimos debitis voluptas repellat sed. Quasi, ex? 
            Nihil, temporibus! Labore, eaque? Beatae, recusandae.</p>
    </div>
    <div class="container section-two">
        <p class="title">Contact Us</p>
        <p class="text">Our office is Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
            Neque iste, tempora non labore consequuntur officiis odio laborum esse inventore placeat est ad quos a dolorum. </p>
        <p class="text">However, you can contact us online via Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
            Velit eveniet sunt iure quod vel sapiente tempora. Hic eligendi quo officiis!</p>
            <form action="mailto:adamfitriyan666@gmail.com" method="post" class="w-50 mx-auto">
                <label for="email">Email :</label>
                <input type="text" name="email" class="form-control bg-dark text-light rounded" id="email" placehorder="Your email here...">

                <label for="message">Message :</label>
                <textarea class="form-control bg-dark text-light" cols="10" rows="10" name="message" id="message" placehorder="Your text here..."></textarea>

                <button class="btn" type="submit">Send</button>
            </form>
    </div>
</div>



<?php require_once 'footer.php';?>