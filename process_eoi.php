
<!DOCTYPE html>
<html lang="en">
    <body>
        <?php 
            require_once('settings.php');


            function leaveprocess(){
                header("Location: apply.php");
                exit();
            }

            if (!isset($_POST['referenceNumber'])) {
                leaveprocess();
            } 
            echo isset($_POST['firstName']);
            function validate($value, $type, $arg, $regex) {
                // validate("Jonah", "VARCHAR", 40, "[a-zA-Z]{1,20}")
                echo "<p>" . $value . "</p>";
                // VALIDATION
                $value = trim($value);
                $value = stripslashes($value);
                $value = htmlspecialchars($value);
                // TYPE (int, varchar, phonenum)

                if ($type == "VARCHAR" || $type == "INT" && $arg != 0){
                    $length = strlen($value);

                    if ($length > $arg) { 
                        echo $value . "Is larger than needed";
                        return -1; //leaveprocess(); 
                    }
                } else if ($type == "PHONENUM") {
                    $length = strlen($value);
                    if ($length > 12 && $length < 8) { 
                        echo $value . "Is too long";
                        return -1; //leaveprocess(); 
                    }
                } // else { $correctValues = true; } // TEXT

                // REGEX
                if (@preg_match($regex, $value) == false && $regex != "") { 
                    echo $value . "does not have regex for" . $regex;
                    return -1; //leaveprocess(); 
                }

                // NULL CHECK
                if ($value == "" && $type != "TEXT") { 
                    echo "Null Value";
                    return -1; //leaveprocess();
                }
                
                return $value;
            }
            function concentratestring($array) {
                $value = "";
                for ($i=0; $i < count($array) - 1; $i+=1){
                    $value .= $array[$i];
                }
                echo $value . "Concentrated String";
                return $value;
            }
            echo "<p>Testing123</p>";

            // TODO DOES TABLE EXIST?

            
            $job_ref_num = $_POST['referenceNumber'];
            $first_name = $_POST['firstName'];
            $last_name = $_POST['lastName'];
            $gender = $_POST['gender'];
            $address = $_POST['address'];
            $suburb = $_POST['suburb'];
            $state = $_POST['state'];
            $postcode = $_POST['postcode'];
            $email = $_POST['email'];
            $phone_num = $_POST['number'];
            $skill = array($_POST['skills']);
            $arrayvalue = "";
            foreach($skill as $myskill) {
                $arrayvalue .= $myskill;
            }
            echo $arrayvalue . " Is arrayvalue";
            //
            $other_skill = $_POST['otherskills'];
            
            // TODO CHECK IF JOB_REF_NUM Exists?
            echo "<p>Reading values finished</p>";

            $job_ref_num = validate($job_ref_num, "VARCHAR", 5, "");
            $first_name = validate($first_name, "VARCHAR", 20, "");
            $last_name = validate($last_name, "VARCHAR", 20, "");
            $gender = validate($gender, "VARCHAR", 6, "");
            $address = validate($address, "VARCHAR", 40, "");
            $suburb = validate($suburb, "VARCHAR", 40, "");
            $state = validate($state, "VARCHAR", 3, "");
            $postcode = validate($postcode, "INT", 4, "");
            $email = validate($email, "TEXT", -1, "");
            $phone_num = validate($phone_num, "PHONENUM", -1, "");

            $skill = validate($skill, "TEXT", -1, "");

            $other_skill = validate($other_skill, "TEXT", -1, "");


            function query($job_ref_num, $first_name, $last_name, $gender, $address, $suburb, $state, $postcode, $email, $phone_num, $skill, $other_skill, $host, $user, $pwd, $sql_db) {
                $query = "INSERT INTO eoi (job_reference_number, first_name, last_name, gender, address, suburb, state, postcode, email, phone_number, skill_list, other_skills, status)
                VALUES ('" . $job_ref_num . "', '". $first_name . "', '". $last_name . "', '". $gender . "', '". $address . "', '". $suburb . "', '". $state . "', '". $postcode . "', '". $email . "', '". $phone_num . "', '". $skill . "', '". $other_skill . "', 'New');";
                echo "<p>" . $query . "</p>";

                $conn = mysqli_connect($host, $user, $pwd, $sql_db);
                if ($conn) {
                    $result = mysqli_query($conn, $query);

                    mysqli_close($conn);
                    if ($result) { echo "<p>Something went right</p>"; }
                } else { echo "<p>Could not connect to the Database</p>"; }
            }
        ?>
    </body>
</html>