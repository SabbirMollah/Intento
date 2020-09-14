<?php include('header.php'); ?>

<h2>Entry Form</h2>

	<form action="insert.php" method="post">
    	
        <table class="entry-form" cellpadding="10">
        	<tr>
            	<td><label>ID:</label></td>
                <td><input type="text" name="sid" required></td>
            </tr>
            
            <tr>
            	<td><label>Name:</label></td>
                <td><input type="text" name="sname" required></td>
            </tr>
            
            <tr>
            	<td><label>Mobile:</label></td>
                <td><input type="text" name="smobile" required></td>
            </tr>
            
            <tr>
            	<td><label>Email:</label></td>
                <td><input type="text" name="semail" required></td>
            </tr>
            
            <tr>
            	<td><label>Profession:</label></td>
                <td>
                	<select name="sprofession">
                    	<option>Service</option>
                        <option selected>Student</option>
                        <option>Buisness</option>
                        <option>Others</option>
                    </select>
                </td>
            </tr>
            
            <tr>
            	<td><label>Address:</label></td>
                <td><input type="text" name="sadress" required></td>
            </tr>
            
            <tr>
            	<td></td>
                <td><input type="submit" class="btn" value="Submit">
                <input type="reset" class="btn" value="Reset"></td>
            </tr>
         </table>
       </form>
       
<?php include('footer.php'); ?>
