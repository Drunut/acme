<?php
// Create a database connection using PDO (Php Data Object)
function acmeConnect(){
    //First we assign variables for use in PDO connection
    $server = 'localhost';                                          //Specifies the location of server we are connecting to with PDO
    $database= 'acme';                                                //Name of the database we want
    $username = 'iClient';                                          //user to connect with
    $password = '82ZpmK9Dqhv8FZTN';                                 //password for the above user
    $dsn = "mysql:host=$server;dbname=$database";                     //Data Source Name, the type of database we're connecting to. Double-                                                                       quotes allows for variable expansion within the string.
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);  //This option will give us error handling options
                                                                    //Double colon (::) lets us access a method in the PDO object. Arrow (=>) establishes key-value relationship in the options array

    //////////////////////////////////////////////////////////////////
    // Create the actual connection object and assign it to a variable, in a try-catch block
    try {
        //Assign connection object to a variable and return it
        $link = new PDO($dsn, $username, $password, $options);
        return $link;
    } catch(PDOException $e) {
        //Error handling of error $e
        header('Location: view/500.php');  //Point this to whatever error message page
        exit;
    }
}
