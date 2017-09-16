<?php
    $error = "";
    $mascot = $_POST["mascot"];
    $location = $_POST["location"];
    
    // Check to ensure that the post data is not empty
    if( $mascot != "" && $location != "" ) {
    
        // Create the sample request
        $request = '{
          "endpoint":{
            "method":"GET",
            "url":"http://sample_domain_endpoint.com/data?title={mascot}&image={location}&foo={bar}"
          },
          "data":[
            {
              "mascot" : "'.$mascot.'",
              "location" : "'.$location.'"
            }
          ]
        }';
        
        $redis = new Redis();
        $redis->pconnect( '127.0.0.1', 9787 );
        
        $connected = $redis->auth( "Boogy*Man225" );
        
        if( $connected ) {
            $totalJobs = $redis->llen( "jobs" );
            
            //$jobs = $redis->lrange( "jobs", 0, -1 );
            //var_dump( $jobs );
            
            $numJobs = $redis->lpush( "jobs", $request );
            
            if( $numJobs == $totalJobs ) {
                $error = "Could not add the new job to the list";
            }
        } else {
            $error = "Could not connect to the redis server. Check your configurations.";
        }
    } else {
        $error = "You must provide the mascot data";
    }
    
    echo $error;
?>