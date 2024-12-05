<?php
class Connection
{
    const DBHOST = "localhost";
    const DBUSER = "root";
    const DBPASS = "";
    const DBNAME = "dant";

    /**
     * @return mysqli
     */
    public function connectDb()
    {
        $con = new mysqli(self::DBHOST, self::DBUSER, self::DBPASS, self::DBNAME) or die("Connect failed: %s\n" . $con->error);
        return $con;
    }

    /**
     * @var mysqli $con
     */
    public function disconnectDb($con)
    {
        $con->close();
    }
}
