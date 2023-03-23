<?php
   header('Access-Control-Allow-Origin:*');
   header('Content-Type: application/json');
   header('Access-Control-Allow-Methods: DELETE');
   header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
   include_once '../../config/db.php';
   include_once '../../models/Question.php';

   $db   = new db();
   $conn = $db->connect();
   $question = new Question($conn);
   
   $data = json_decode(file_get_contents('php://input'));
   $question->id_cauhoi = $data->id_cauhoi;

   if($question->Delete())
   {
    echo json_encode(array('message', 'Question Deleted Successfully!!!'));
   }
   else
   {
    echo json_encode(array('message', 'Question Not Delete!!!'));
   }
   
?>