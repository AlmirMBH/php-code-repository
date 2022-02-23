<!DOCTYPE html>
<html lang="en">
<head><title>MVC</title>
</head>
<body>
    <h1>MVC</h1>
    <!-- For the sake of simplicity, the classes are placed in one file.  -->
    <!-- Model is the only class allowed to interact with the DB class. If the DB or anything in it -->
    <!-- changes, only UsersModel changes. If the MVC is ok, no other class should require any changes! -->
    
    <?php


        class Database{

            private $host = "localhost";
            private $user = "root";
            private $password = "";
            private $dbName = "php_code_repository";

            protected function connect(){
                $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
                $pdo = new PDO($dsn, $this->user, $this->password);
                // define data type retrieved from db (see fetchAll() below)
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                return $pdo;
            }
        }


        class UsersModel extends Database{

            protected function getUser($name){
                $sql = "SELECT * FROM users WHERE first_name = ?";
                $statement = $this->connect()->prepare($sql);
                $statement->execute([$name]);
                $results = $statement->fetchAll();
                return $results;
            }

            protected function insertUser($name, $surname, $dob){
                $sql = "INSERT INTO users (first_name, last_name, date_of_birth) VALUES(?, ?, ?)";
                $statement = $this->connect()->prepare($sql);
                $success = $statement->execute([$name, $surname, $dob]);
                if($success){
                    echo "Success! User " . $name . " created!";
                }else{ 
                    echo "User not inserted!"; 
                }      
            }
        }


                
        class UsersController extends UsersModel{
            public function showUsers($name){
                $results = $this->getUser($name);
                foreach($results as $result){
                    echo $result['first_name'] . " " . $result['last_name'] . " " . $result['date_of_birth'] . "<br>";
                }
            }
            public function createUser($name, $surname, $dob){
                $this->insertUser($name, $surname, $dob);
            }
        }


        
        class UsersView extends UsersController{
            public function getUsers($name){
                $this->showUsers($name);    
            }

            public function setUser($name, $surname, $dob){
                $this->createUser($name, $surname, $dob);    
            }            
        }



        // RESULTS
        $usersView = new UsersView();
        $usersView->getUsers("Sam");
        echo "<br>";
        // A user would normally be inserted via form, not hard-coded like this
        $usersView->setUser("Sam", "Saq", "1994-04-05");

    ?>

</body>
</html>