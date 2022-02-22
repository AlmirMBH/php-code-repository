<!DOCTYPE html>
<html lang="en">
<head>
    <title>PDO</title>
    <style>
        .form{ margin-bottom: 30px; }
        .input-form{ display: block; margin-bottom: 5px; }
    </style>
</head>
<body>

    <h1>PDO</h1>
    <h3>Input for prepared statement to find a user</h3>
    <form action="#" method="POST" class="form">
        <input type="text" name="name" placeholder="first name" class="input-form">
        <input type="text" name="surname" placeholder="last name" class="input-form">        
        <button>Submit</button>
    </form>

    <h3>Input for prepared statement to insert a user</h3>
    <form action="#" method="POST" class="form">
        <input type="text" name="user_name" placeholder="first name" class="input-form">
        <input type="text" name="user_surname" placeholder="last name" class="input-form">        
        <input type="date" name="dob" class="input-form">
        <button>Submit</button>
    </form>


    <?php
    
        class Database{

            private $host = "localhost";
            private $user = "root";
            private $password = "";
            private $dbName = "php_code_repository";

            protected function connect(){
                $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
                $pdo = new PDO($dsn, $this->user, $this->password);
                // define data type retrieved from db (see fetch() below)
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // PDO::FETCH_OBJ
                return $pdo;
            }
        }
    
        // RAW QUERY
        class RawQuery extends Database{

            public function getUsers(){
                $sql = "SELECT * FROM users";
                $data = $this->connect()->query($sql);            

                while($row = $data->fetch()){ // data type set in setAttribute() above
                    echo $row['first_name'] . " " . $row['last_name'] . " " . $row['date_of_birth'] . "<br>"; 
                    // echo $row->first_name . " " . $row->last_name . " " . $row->date_of_birth . "<br>"; // PDO::FETCH_OBJ
                }
            }
        }
        echo "RAW QUERY <br>";
        $rawQuery = new RawQuery();
        $rawQuery->getUsers();
        

        // PREPARED STATEMENT
        class PreparedStatement extends Database{

            // Fetch users
            public function getUsers($name, $surname){
                $sql = "SELECT * FROM users WHERE first_name = ? AND last_name = ?";
                $data = $this->connect()->prepare($sql);
                $data->execute([$name, $surname]);
                $users = $data->fetchAll();

                foreach($users as $user){
                    echo $user['first_name'] . " " . $user['last_name'];
                }
            }

            // Insert user
            public function insertUser($name, $surname, $birth){
                $sql = "INSERT INTO users(first_name, last_name, date_of_birth) VALUES (?, ?, ?)";
                $data = $this->connect()->prepare($sql);
                $success = $data->execute([$name, $surname, $birth]);
                if($success){
                    echo "Success!";
                }else{ 
                    echo "User not inserted!"; 
                }                
            }
        }

        echo "<br>PREPARED STATEMENT (FIND USER)<br>";
        $name = $_POST['name'];
        $surname = $_POST['surname'];        
        $preparedStatement = new PreparedStatement();
        $preparedStatement->getUsers($name, $surname);

        echo "<br>PREPARED STATEMENT (INSERT USER)<br>";
        $name = $_POST['user_name'];
        $surname = $_POST['user_surname'];
        $birth = $_POST['dob'];        
        $preparedStatement = new PreparedStatement();
        $preparedStatement->insertUser($name, $surname, $birth);       
        

    ?>
    
</body>
</html>