<?php
// Allow Requests From Any Domain
header('Access-Control-Allow-Origin: *');

// Dependencies
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
require 'ezSQL/ez_sql_core.php';
require 'ezSQL/ez_sql_mysql.php';

// Instantiate Slim
$app = new \Slim\Slim();

// Redirect requests with no method call
$app->get('/', function(){ header('Location: google.com');exit(); });

// Call the track method
$app->get('/devices', 'Tracker::devices');

// Go!
$app->run();

// Create ezSQL Database Instance

class Database
{
    private static $instance;

    private function __construct()
    {
    }

    public static function instance()
    {
        return self::$instance ? self::$instance : self::$instance = new ezSQL_mysql('username', 'password', 'db', 'localhost');
    }
}

// Create API Class & Methods

class Tracker
{
    public static function devices() {
        $request = \Slim\Slim::getInstance()->request();
        $device_id = $request->get('id');
        $label = $request->get('label');
        $time = date("Y-m-d H:i:s", strtotime($request->get('reported_time')));
        if($request->isAjax()){
        $query = "SELECT * FROM telematics WHERE device_id='$device_id' AND label='$label' AND reported_time='$time'";
         
         if(!$results = Database::instance()->get_results($query)){
             $results = array('error' => 'No results.');
         }
         foreach ($results as $key => $value) {
          $reportedtime = $value->reported_time;
          if($reportedtime){
           $timediff = strtotime(date('Y-m-d H:i:s')) - strtotime($reportedtime);
           $value->Flag = ($timediff > 86400) ?  0 : 1; 
           //Convert UTC to IST
           $date = new DateTime($reportedtime, new DateTimeZone('UTC'));
           $date->setTimezone(new DateTimeZone('IST'));
           $value->reported_time = $date->format('Y-m-d H:i:s');
          }
         }
        }
        return self::output($results);
    }


    private static function output( $data ) {
        header("Content-Type: application/json; charset=utf-8");

        if(isset(Database::instance()->num_rows) and Database::instance()->num_rows >= 1) {
            $data = array('num_results' => Database::instance()->num_rows, 'results' => $data);
        }

        echo json_encode($data);
        exit();
    }
}