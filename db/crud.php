<?php
    class crud{
        private $db;

        function __construct($conn){
            $this->db = $conn;
        }

        public function insertAttendees($fname, $lname, $dob, $email,$contact,$avatar_path){
            try {
                // define sql statement to be executed
                $sql = "INSERT INTO attendee (firstname,lastname,dateofbirth,emailaddress,contactnumber,avatar_path) VALUES (:fname,:lname,:dob,:email,:contact,:avatar_path)";
                //prepare the sql statement for execution
                $stmt = $this->db->prepare($sql);
                // bind all placeholders to the actual values
                $stmt->bindparam(':fname',$fname);
                $stmt->bindparam(':lname',$lname);
                $stmt->bindparam(':dob',$dob);
                $stmt->bindparam(':email',$email);
                $stmt->bindparam(':contact',$contact);
                $stmt->bindparam(':avatar_path',$avatar_path);

                // execute statement
                $stmt->execute();
                return true;
        
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        
        public function editAttendee($id,$fname, $lname, $dob, $email,$contact){
            try{ 
                 $sql = "UPDATE `attendee` SET `firstname`=:fname,`lastname`=:lname,`dateofbirth`=:dob,`emailaddress`=:email,`contactnumber`=:contact WHERE attendee_id = :id ";
                 $stmt = $this->db->prepare($sql);
                 // bind all placeholders to the actual values
                 $stmt->bindparam(':id',$id);
                 $stmt->bindparam(':fname',$fname);
                 $stmt->bindparam(':lname',$lname);
                 $stmt->bindparam(':dob',$dob);
                 $stmt->bindparam(':email',$email);
                 $stmt->bindparam(':contact',$contact);
 
                 // execute statement
                 $stmt->execute();
                 return true;
            }catch (PDOException $e) {
             echo $e->getMessage();
             return false;
            }
             
         }

        public function getAttendees(){
            try{
                $sql = "SELECT * FROM `attendee`";
                $result = $this->db->query($sql);
                return $result;
            }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
           }
           
        }

        public function getAttendeeDetails($id){
            try{
                 $sql = "select * from attendee where attendee_id = :id";
                 $stmt = $this->db->prepare($sql);
                 $stmt->bindparam(':id', $id);
                 $stmt->execute();
                 $result = $stmt->fetch();
                 return $result;
            }catch (PDOException $e) {
                 echo $e->getMessage();
                 return false;
             }
         }
         
         public function deleteAttendee($id){
            try{
                 $sql = "delete from attendee where attendee_id = :id";
                 $stmt = $this->db->prepare($sql);
                 $stmt->bindparam(':id', $id);
                 $stmt->execute();
                 return true;
             }catch (PDOException $e) {
                 echo $e->getMessage();
                 return false;
             }
         }
 
    }
    
?>