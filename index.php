<?php
    require "header.php";
?>

    <main>
        <div>
            <section>
                <?php
                    if (isset($_SESSION['userid'])) {
                        echo '<p>You are logged in!</p>';
                    }
                
                    else{
                        echo '<p>You are logged out!</p>';
                    }
                ?>
                
   
            </section>
        </div>
    </main>
<?php
    require "footer.php";
?>