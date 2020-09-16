<?php
    require "header.php";
    require "includes/connect_db.php";
?>

    <main>
        <div>
            <section>
                <h2>Team Info</h2>
                <?php
                    $sql = 'SELECT team_name, team_description, leader_email FROM teams WHERE team_id=?';
                    $stmt = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        
                        mysqli_stmt_bind_param($stmt, "s", $_GET['team-id']);
                        mysqli_stmt_execute($stmt);
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            $row = mysqli_fetch_assoc($result);
                            echo "Team name: " . $row['team_name'] . "</br>"
                                . "Team description: " . $row['team_description'] . "</br>"
                                . "Team leader: " . $row['leader_email']  . "</br>";
                        } 
                        else {
                            echo "No info!";
                        }
                    }
                ?>
                    
            </section>

            <section>
                <h2>Team Members</h2>
                <?php
                    $sql = 'SELECT first_name, last_name, email FROM users, belongs_to WHERE email=user_email AND team_id=?';
                    $stmt = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        
                        mysqli_stmt_bind_param($stmt, "s", $_GET['team-id']);
                        mysqli_stmt_execute($stmt);
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "
                                <form action=\"includes/team-info.inc.php\" method=\"post\">
                                    <label>Member name: ". $row['first_name']. " ". $row['last_name'] ." - Email:". $row['email'] ."</label>
                                    <input name=\"member-email\" value=\"". $row['email'] ."\"hidden/>
                                    <input name=\"team-id\" value=\"". $_GET['team-id'] ."\"hidden/>
                                    <input type=\"submit\" name=\"remove-member\" value=\"Remove Member\" />
                                </form>";
                            }
                        } 
                        else {
                            echo "No members in this team yet!";
                        }
                    }
                ?>

            </section>


            <section>
                <h2>Add a member to this team:</h2>
                <form action="includes/team-info.inc.php" method="post">
                    <label for="member-email">Email</label>
                    <br>
                    <input type="text" name="member-email" placeholder="a@b.com">
                    <input name="team-id" value= <?php echo '"'. $_GET['team-id'] .'"'; ?>hidden/>
                    <br><br>
                    <button type="submit" name="add-member" class="btn">Add Member</button>
                </form>
            </section>
        </div>
    </main>
<?php
    require "footer.php";
?>