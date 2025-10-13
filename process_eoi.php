
<!DOCTYPE html>
<html lang="en">
    <body>
        <?php 
            require_once('settings.php');

            function validate($value, $type, $arg, $regex) {
                // validate("Jonah", "VARCHAR", 40, "[a-zA-Z]{1,20}")

                // VALIDATION
                $value = trim($value);
                $value = stripslashes($value);
                $value = htmlspecialchars($value);

                // TYPE (int, varchar, phonenum)
                $correctValues = false;

                if ($type == "VARCHAR" || $type == "INT" && $arg != 0){
                    $length = strlen($value);
                    if ($length <= $arg) { $correctValues = true; }
                } else if ($type == "PHONENUM") {
                    $length = strlen($value);
                    if ($length <= 12 && $length >= 8) { $correctValues = true; }
                } else { $correctValues = true; } // TEXT

                // REGEX
                if (@preg_match($regex, $value) == true && $regex != "") { $correctValues = true; }

                // NULL CHECK
                if ($value == "" && $type != "TEXT") { $correctValues = false; }

                if ($type == "TEXT") { $correctValues = true; }

                if (!$correctValues){
                    //header("Location: apply.php");
                    //exit();
                    //return -1;
                }
                echo "<p>". $value . "</p>";
                return $value;
            }

            echo "<p>Testing123</p>";

            // DOES TABLE EXIST?


            // VALIDATE SERVER-SIDE
            $job_ref_num = validate($POST['referenceNumber'], "VARCHAR", 5, "");
            $first_name = validate($POST['firstName'], "VARCHAR", 20, "[a-zA-Z]{1,20}");
            $last_name = validate($POST['lastName'], "VARCHAR", 20, "[a-zA-Z]{1,20}");
            $gender = validate($POST['gender'], "VARCHAR", 6, "");
            $address = validate($POST['address'], "VARCHAR", 40, ".{1,40}");
            $suburb = validate($POST['suburb'], "VARCHAR", 40, ".{1,40}");
            $state = validate($POST['state'], "VARCHAR", 3, "");
            $postcode = validate($POST['postcode'], "INT", 4, "[0-9]{4}");
            $email = validate($POST['email'], "TEXT" -1, "", "");
            $phone_num = validate($POST['number'], "INT", 12, "[0-9]{8,12}");
            $skill = validate($POST['skills'], "TEXT", -1, "");
            $other_skill = validate($POST['otherskills'], "TEXT", -1, "");
            

            echo "<p>Validation Finished</p>";
            // CHECK IF JOB_REF_NUM Exists?



            $query = "INSERT INTO eoi (job_reference_number, first_name, last_name, gender, address, suburb, state, postcode, email, phone_number, skill_list, other_skills, status)
            VALUES ('" . $job_ref_num . "', '". $first_name . "', '". $last_name . "', '". $gender . "', '". $address . "', '". $suburb . "', '". $state . "', '". $postcode . "', '". $email . "', '". $phone_num . "', '". $skill . "', '". $other_skill . "', 'New');";
            echo "<p>" . $query . "</p>";

            $conn = mysqli_connect($host, $user, $pwd, $sql_db);
            if ($conn) {
                $result = mysqli_query($conn, $query);

                mysqli_close($conn);
                if ($result) { echo "<p>Something went right</p>"; }
            } else { echo "<p>Could not connect to the Database</p>"; }
        ?>
    </body>
</html>