<?php 
if(!empty($_POST)){
        $con=new mysqli('localhost','root','','webdev')or die("Could not connect to mysql".mysqli_error($con));
        $button=$_POST['button'];

        if($button=='Create' or $button=='Create Account'){
            echo'<div class="view"><form action="" method="post">
            <h2>Create Account</h2>
            <input type="text" name="uname" placeholder="Enter Username" required> <br>
            <input type="text" name="fname" placeholder="Enter Fullname" required><br> 
            <input type="email" name="email" placeholder="Enter Email" required> <br>
            <input type="password" name="pwd" placeholder="Enter Password" required> <br><br>
            <input name="button" type="submit" value="Create Account">
            </form></div>';
            if($button=='Create Account')
            {
                $uname=$_POST['uname'];
                $fname=$_POST['fname'];
                $email=$_POST['email'];
                $pwd=$_POST['pwd'];
                $sql="insert into users set Username='$uname',Fullname='$fname',Email='$email',password='$pwd'";

                if(mysqli_query($con,$sql))
                {
                    echo"<div id='create'><h3>Congratulations! $fname, Your account has been sucessfully registered</h3></div>";
                }
            }
        }
        if($button=='Delete' or $button=='Delete Account')
        {
            $show_query=mysqli_query($con,'select * from users');
            echo'<div class="view"><form action="" method="post"><select name="userid" id="combo">';
            while($row=mysqli_fetch_array($show_query))
            {
                $uname=$row['Username'];
                echo'<option>'.$uname.'</option>';
            }
            echo'<input type="submit" name="button" value="Delete Account"></form></div>';
            if($button=='Delete Account')
            {
                $userid=$_POST['userid'];
                $mysql="delete from users where Username='$userid'";
                if(mysqli_query($con,$mysql))
                {
                    echo"<div id='create'><h3>Account is successfully Deleted</h3></div>";
                }
            }
        }
        if($button=='View')
        {
            $show_query=mysqli_query($con,'select * from users');
            echo'<div>
            <table>
            <tr>
                <th>Username</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Registration Date</th>
            </tr>';
            while($row=mysqli_fetch_array($show_query))
            {
                $uname=$row['Username'];
                $fname=$row['Fullname'];
                $email=$row['Email'];
                $date=$row['Registration Date'];
                // $pwd=$row['Password'];
                echo'<tr><td>'.$uname.'</td><td>'.$fname.'</td><td>'.$email.'</td><td>'.$date.'</td>';
            }
            echo'</div>';
        }
    }
?>