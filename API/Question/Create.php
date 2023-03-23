<?php
   header('Access-Control-Allow-Origin:*');
   header('Content-Type: application/json');
   header('Access-Control-Allow-Methods: POST');
   header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
   include_once '../../config/db.php';
   include_once '../../models/Question.php';

   $db   = new db();
   $conn = $db->connect();
   $question = new Question($conn);
   
   $data = json_decode(file_get_contents('php://input'));
   $question->title = $data->title;
   $question->cau_a = $data->cau_a;
   $question->cau_b = $data->cau_b;
   $question->cau_c = $data->cau_c;
   $question->cau_d = $data->cau_d;
   $question->caudung = $data->caudung;

   if($question->Create())
   {
    echo json_encode(array('message', 'Question Created Successfully!!!'));
   }
   else
   {
    echo json_encode(array('message', 'Question Not Create!!!'));
   }
   
?>