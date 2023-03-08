<?php

/**
 * Database Class - Very simple abstraction layer for pdo connection
 *
 */

namespace tiggomark\core;

use PDO;
use PDOException;
use tiggomark\core\eventhelpers;

class db
{
    use eventhelpers;

    /**
     * @access private
     * @var    string database host default: localhost
     */
    private $host = '';

    /**
     * @access private
     * @var    string username for db
     */
    private $user = '';

    /**
     * @access private
     * @var    string password for db
     */
    private $password = '';


    /**
     * @access private
     * @var    string database port default: 3306
     */
    private $port = '3306';


    /**
     * @access private
     * @var    pdo object
     */
    private static $instance = null;

    /**
     * __construct - connect to database and select db
     *
     * @return object
     */
    private function __construct()
    {



            //Get configuration-object for connection-details
            $config = \tiggomark\core\environment::getInstance();
            $host = $_SERVER['HTTP_HOST'];
            $host_parts = explode('.', $host);
            $this->tenant =  '';
            $this->user = $config->dbUser;
            $this->password = $config->dbPassword;
            $this->host = $config->dbHost ?? "localhost";
            $this->port = $config->dbPort ?? "3306";

            if(count($host_parts) > 1){
             $this->tenant =  ';dbname='.$host_parts[0];
            }



         if (strpos($host, "127.0.0.1") !== false) {

           $this->tenant = "tiggomark";

         }


        try {
            $driver_options = array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4,sql_mode="NO_ENGINE_SUBSTITUTION"' );
            $this->database = new PDO('mysql:host=' . $this->host . ';port=' . $this->port .''. $this->tenant . '', $this->user, $this->password, $driver_options);
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->database->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
        } catch (PDOException $e) {
            echo "No database connection, check your database credentials in your configuration file.<br />\n";
            echo "Checking common issues:<br />\n";
            echo "host: ".$host."\n";
            echo "tenant: ".$this->tenant."\n";


            if (!extension_loaded('PDO')) {
                echo "- php-PDO is required, but not installed<br />\n";
            }

            if (!extension_loaded('pdo_mysql')) {
                echo "- php-pdo_mysql is required, but not installed<br />\n";
            }

            error_log($e);

            exit();
        }
    }

    public static function getInstance()
    {

        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * This function will generate a pdo binding string (":editors0,:editors1,:editors2,:editors3") to be used in a PDO
     * query that uses the IN() clause, to assist in proper PDO array bindings to avoid SQL injection.
     *
     * A counted for loop is user rather than foreach with a key to avoid issues if the array passed has any
     * arbitrary keys
     *
     * @param $name string
     * @param $count int
     * @return string
     */
    public static function arrayToPdoBindingString($name, $count)
    {
        $bindingStatement = "";
        for ($i = 0; $i < $count; $i++) {
            $bindingStatement .= ":" . $name . $i;
            if ($i != $count - 1) {
                $bindingStatement .= ",";
            }
        }

        return $bindingStatement;
    }

    /**
     * Sanitizes a string to only contain letters, numbers and underscore.
     * Used for patch statements with variable column keys values
     *
     *
     * @param $name string
     * @return string
     */
    public static function sanitizeToColumnString($string)
    {
        return preg_replace("/[^a-zA-Z0-9_]/", "", $string);
    }
}
