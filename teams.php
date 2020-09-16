<?php
    require "header.php";
?>

    <main>
        <div>
            <section>
            <form action="includes/teams.inc.php" method="post">
                <label for="title">Title</label>
                <br>
                <input type="text" name="title" placeholder="Team Title">
                <br><br>
                <label for="description">Description</label>
                <br>
                <input type="text" name="description" placeholder="Last Name">
                <br><br>
                
                <button type="submit" name="team-create" class="btn">Create New Team</button>
            </form>
                
   
            </section>
            <section>
                <h2>Teams I lead</h2>
                <?php
                    require "includes/connect_db.php";

                    $sql = 'SELECT team_name, team_description FROM teams WHERE leader_email="'. $_SESSION['email'] .'"';
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                    echo "Team Name: " . $row["team_name"]. " - Description: " . $row["team_description"] . "<br>";
                        }
                    } 
                    else {
                            echo "You lead no teams!";
                        }
                ?>

            </section>
            <section>
                <h2>Teams I belong to</h2>
                <?php
                    require "includes/connect_db.php";

                    $sql = 'SELECT team_name, team_description, leader_email FROM teams, belongs_to WHERE teams.team_id = belongs_to.team_id AND user_email="'. $_SESSION['email'] .'"';
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                    echo "Team Name: " . $row["team_name"]. " - Description: " . $row["team_description"] . " -Team leader: ". $row["leader_email"]. "<br>";
                        }
                    } 
                    else {
                            echo "You don't belong to any teams!";
                        }
                ?>

            </section>
        </div>
    </main>
<?php
    require "footer.php";
?>