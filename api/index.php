<?php

require_once __DIR__ . '/config.php';

class API extends Database{
    public function getUsers(){
        $sql = "SELECT * FROM users";
        $data = $this->connect()->query($sql);
        
        while($row = $data->fetch()){ 
             $users[$row['id']] = [
                'name' => $row['first_name'] , 
                'surname' => $row['last_name'], 
                'dob' => $row['date_of_birth'] 
            ];
        }
        return json_encode($users);
    }
}

$api = new API();
header('Content-Type: application/json');
echo $api->getUsers();



?>