<?php
class RegisterController
{


    public function Register()
    {

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fname = test_input($_POST['fname']);
            $lname = test_input($_POST['lname']);
            $email = test_input($_POST['email']);
            $password = test_input($_POST['password']);
            $role = $_POST['role'];

            $errors = array();

            // Check first name
            if (empty($fname)) {
                $errors[] = "First name is required.";
            }elseif (!preg_match("/^[a-zA-Z'-]+$/", $fname)) {
                $errors[] = "Invalid first name format.";
            }


            // Check last name
            if (empty($lname)) {
                $errors[] = "Last name is required.";
            }
            elseif (!preg_match("/^[a-zA-Z'-]+$/", $fname)) {
                $errors[] = "Invalid first name format.";
            }


            // Check email
            if (empty($email)) {
                $errors[] = "Email is required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            }

            // Check password
            if (empty($password)) {
                $errors[] = "Password is required.";
            }
            elseif (!preg_match("/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])[A-Za-z\d!@#^_&*()-]+$/", $password)) {
                $errors[] = "Invalid password format.";
            }

          if(empty ($errors)) {
                // Validation passed; proceed with registration
                $password = password_hash($password, PASSWORD_BCRYPT);

                $data = array(
                    'fname' => $fname,
                    'lname' => $lname,
                    'email' => $email,
                    'password' => $password,
                    'role' => $role,
                );

                if ($role === 'Searcher') {
                    $user = new Searcher();
                } elseif ($role === 'Employer') {
                    $user = new Manager();
                } else {
                    // Handle invalid role
                    echo "Invalid role.";
                }

                $result = $user->save($data);

                if ($result) {
                    Redirect::to('login');
                    Session::set('success', "You have registered with success.");
                }

            }

            return $errors;

        }
    }
}
?>
