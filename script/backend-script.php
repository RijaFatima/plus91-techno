<?php
require_once('database.php'); 

$db= $conn; // update with your database connection

//======Get Single Records ====//

if(!empty($_GET['id']) && $_GET['type']== "get_record")
{

    $id= legal_input($_GET['id']);
    $resultSet = $db->executeQuery('SELECT * FROM manage_patients WHERE id = ?', array($id));
    $user = $resultSet->fetchAssociative();
    if(!empty($user)){
      $result_data=array("status" => true, "result" =>$user);
    }else{
      $result_data=array("status" => false, "result" =>$user);
    }
    echo json_encode($result_data);
   
}



//======Get all Records ====//


if(!empty($_GET['type']) && $_GET['type'] == 'get_data')
{
      $html ="";
      $sql1="SELECT * FROM manage_patients";
      $stmt= $conn->query($sql1); 
     
         $i=1;
         while($result_data = $stmt->fetchAssociative())
         {
              $html .=" <tr>
                <td>".$result_data['name']."</td>
                <td>".$result_data['age']."</td>
                <td>".$result_data['city']."</td>
                <td>".$result_data['state']."</td>
                <td>".$result_data['country']."</td>
                <td>".$result_data['date_of_brith']."</td>
                <td>".$result_data['blood_group']."</td>
                <td>
                <a href='javascript:void(0)' class='text-danger edit' id='".$result_data['id']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a> &nbsp; | &nbsp;
                <a href='javascript:void(0)' class='text-danger delete' id='".$result_data['id']."'><i class='fa fa-trash' aria-hidden='true'></i></a>
                </td>
              </tr>";
                $i++;
         }
      
      echo $html;
}

//======add and update ====//

// operations database
if(!empty($_GET['type']) && ($_GET['type']=='add' || $_GET['type']=='update')){
  extract($_POST);

  if(!empty($name) && !empty($age) && !empty($city) && !empty($state) && !empty($country) && !empty($date_of_brith) && !empty($date_of_brith)  ){
    $data= [
      'name' =>legal_input($name),
      'age' =>legal_input($age),
      'city' =>legal_input($city),
      'state' =>legal_input($state),
      'country' =>legal_input($country),
      'date_of_brith' =>legal_input($date_of_brith),
      'blood_group' =>legal_input($blood_group)
    ];

    $tableName='manage_patients'; 
    if(!empty($data) && !empty($tableName)){
      if ($_GET['type'] == "add") {
        $result = insert_data($data,$tableName);
        if($result){
            $result_data=array("status" => true, "message" => "New Patient added successfully.");
        }else{
            $result_data=array("status" => false, "message" => "Something went wrong,please try again!"); 
        }
      }else if ($_GET['type'] == "update") {
        $result = update_data($data, $tableName, $id);
        if($result){
            $result_data=array("status" => true, "message" => "Patient detail updated successfully.");
        }else{
            $result_data=array("status" => false, "message" => "Something went wrong,please try again!"); 
        }
      }
    }  
  }else{
    $result_data=array("status" => false, "message" => "please send all required fileds!");
  }
  echo json_encode($result_data);
}


// MySQL Query for database operation 

function insert_data(array $data, string $tableName){
     global $db;
     $tableColumns = $userValues = ''; 
     $num = 0; 
     foreach($data as $column=>$value){ 
          $comma = ($num > 0)?', ':''; 
          $tableColumns .= $comma.$column; 
           $userValues  .= $comma."'".$value."'"; 
          $num++; 
      } 
   $insertQuery="INSERT INTO ".$tableName."  (".$tableColumns.") VALUES (".$userValues.")";
    $insertResult=$db->query($insertQuery);
    if($insertResult){
       return true;
    }else{
       return "Error: " . $insertQuery . "<br>" . $db->error;
    }

}

// MySQL Query for database operation 

function update_data($data, $tableName, $id){
     global $db;
     $columnsValues = ''; 
     $num = 0; 
     foreach($data as $column=>$value){         
         $comma = ($num > 0)?', ':''; 
         $columnsValues.=$comma.$column." = "."'".$value."'"; 
         $num++; 
      } 
      $updateQuery="UPDATE ".$tableName." SET ".$columnsValues." WHERE id=".$id;
      $updateResult=$db->query($updateQuery);
      if($updateResult){
        return true;
      }else{
        echo "Error: " . $updateResult . "<br>" . $db->error;
      }
}

// ======= delete data from database ============//

if(!empty($_GET['deleteId']) && !empty($_GET['deleteData']))
{

   $id= legal_input($_GET['deleteId']);
   $deleteData=legal_input($_GET['deleteData']);
   $tableName= $deleteData;
  
   $deleteData=delete_data($tableName, $id);
 
    if($deleteData){
      echo "<span class='success'>".$tableName." data was deleted</span>";
    }else{
      echo  "<span class='fail'>Error...Check your query</span>";
    }
   
}

// Delete record

function delete_data($tableName, $id){
  global $db;
  $query="DELETE FROM ".$tableName." WHERE id=".$id;
  $result= $db->query($query);
  if($result){
     return true;
  }else{
     echo "Error found in ".$db->error;
  }
}

// convert illegal input value to ligal value formate
function legal_input($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}


?>