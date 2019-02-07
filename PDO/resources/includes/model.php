<?php
$host = 'localhost';
$dbname = 'blogg';
$user = 'Admin';
 $password = 'missan123';
// define varible for host, dbname
$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_ASSOC);

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

$pdo = new PDO($dsn, $user, $password, $attr);

if($pdo) {
    //define my sql-vvar
    $sql = "SELECT p.Slug,  p.Headline, u.Username, p.Creation_time, p.Text FROM posts AS p JOIN users AS u ON p.User_ID = u.ID ORDER BY Creation_time DESC";
    //Define $model-array.
    $model= array();
        //Fill our predifend $model-array.
    foreach($pdo->query($sql) as $row){
        $model += array(
            $row['Slug'] => array(
                'title' => $row ['Headline'],
                'author' => $row['Username'],
                'date' => $row['Creation_time'],
                'text' => $row['Text']
            )
        );
    }
}
else {
    print_r($pdo->errorinfo());
}
?>
