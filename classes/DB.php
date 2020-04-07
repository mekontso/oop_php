<?php
//This is the database wrapper

/**
 * Class DB
 * We will use the singleton pattern to have a main static instance
 *
 * Sample of how the class works $users = DB::getInstance()->get('users' , array('username' , '=' , 'alex'))
 */
class DB
{
    //Store instance of the database
    //The _ is to indicate the variables are private
    private static $_instance = null;
    //pdo object
    private $_pdo,
        //Last query executed
        $_query,
        //Error status
        $_error = false,
        //Result set
        $_result,
        //Count for results
        $_count = 0;

    /**
     * DB constructor.
     * Connects to the Database
     */
    private function __construct()
    {
        try {

            //Creating PDO object for connexion using data from the GLOBAL variable

            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
            //echo 'Connexion avec success a la base de donnees';
        } catch (PDOException $e) {

            die("Error connecting to database: " . $e->getMessage());

        }
    }

    /**
     * This function will check if the object is instantiated if it has, the instance is returned
     * @return DB|null
     */

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new DB();
        }

        return self::$_instance;
    }


    /**
     * @param $sql is the sql query that we want to execute
     * @param array $params are the parameters we add for our query
     * Execute query and bind parameters for security
     */
    public function query($sql, $params = array())
    {
        //Set error to false to net get the result of precedent query
        $this->_error = false;

        //Check the kind of query

        if ($this->_query = $this->_pdo->prepare($sql)) {
            //Check if the parameters exist
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {

                    $this->_query->bindParam($x, $param);
                    $x++;
                }
            }

            //Execute de query if there are no parameters

            if ($this->_query->execute()) {
                //If success save result to variable and count results
                $this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }


    }
}