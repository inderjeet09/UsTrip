<?php
$message = "";

if(isset($_POST['user-name'])){
    $server= "localhost";
    $username= "root"; 
    $password= "";

    $con=mysqli_connect($server,$username,$password);

    if(!$con){
        die("Connection to the database failed due to: " . mysqli_connect_error());
    }

    $name = $_POST['user-name'];
    $gender = $_POST['user-gender'];
    $age = $_POST['user-age'];
    $email = $_POST['user-email']; 
    $phone = $_POST['user-phone'];
    $other = $_POST['user-message'];
    $sql = "INSERT INTO `US_trip`.`trip` (`name`, `email`, `phone`, `age`, `gender`, `other`, `datetime`) VALUES
     ('$name', '$email', '$phone', '$age', '$gender', '$other', current_timestamp());";

    if($con->query($sql) === true){
        $message = "Successfully Inserted";
    }else{
        $message = "Error: " . $sql . "<br>" . $con->error;
    }
    
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Travel Form</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .confirmation-message {
            background-color: #e2f0ff;
            border: 1px solid #a6c6ff;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <img class="bg" src="bg.jpeg" alt="Chandigarh University">
    <div class="container">
        <?php if(!empty($message)): ?>
        <div class="confirmation-message">
            <?php echo $message; ?>
        </div>
        <?php endif; ?>
        
        <h1>Welcome to Chandigarh University US Trip form</h1>
        <p>Enter your details and submit this form to confirm your participation in the trip</p>
        <form action="index.php" method="POST">
            <section>
                <h2>Your personal details</h2>
                <ul>
                    <li> 
                        <label for="username">Enter your name:</label>
                        <input type="text" name="user-name" id="username" required placeholder="name">
                    </li>
                    <li>  
                        <label for="useremail">Your Email address</label>
                        <input type="email" name="user-email" id="useremail">
                    </li>
                    <li>  
                        <label for="userphone">Your Phone number</label>
                        <input type="phone" name="user-phone" id="userphone">
                    </li>
                </ul>
            </section>
            
            <section>
                <h2>More details</h2>
                <ul>
                    <li>
                        <label for="userage">Your age</label>
                        <input type="number" step="1" name="user-age" id="userage" required min="18" max="100">      
                    </li>   
                    <li>
                        <label for="usergender">Your Gender</label>
                        <select name="user-gender" id="usergender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </li>
                </ul>
            </section>

            <section>
                <label for="usermessage">Other Info</label>
                <textarea name="user-message" id="usermessage"></textarea>
            </section>
            <hr/>
            <section>
                <div class="form-control-inline">
                    <input type="checkbox"  name="terms" id="agree-tems" required/>
                    <label for="agree-terms">Agree to terms?</label>
                </div>
            </section>
          
            <section>
                <button type="submit">Submit</button>
            </section>
        </form>
    </div>
</body>
</html>
