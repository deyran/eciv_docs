<?php 
class DataBase
{
    private const SERVER_NAME = "localhost";
    private const DATA_BASE = "eciv_docs_bd";
    private const USER_NAME = "root";
    private const PASSWORD = "";
    private $CONNECTION = null;

    public function getConnecation() { return $this->CONNECTION; }

	public function connection_bd()
	{
		$CONNECTION_EXEC_COMMANDS_OK = true;

        $this->CONNECTION = mysqli_connect(DataBase::SERVER_NAME, DataBase::USER_NAME, DataBase::PASSWORD, DataBase::DATA_BASE);
		
		// Check connection
		if (!$this->CONNECTION) {
			$CONNECTION_EXEC_COMMANDS_OK = false;
            $this->CONNECTION = null;
            
			die("Connection failed: " . mysqli_connect_error());
		} 
        
		return $CONNECTION_EXEC_COMMANDS_OK;
	}
    
    public function disconnect_bd()
	{	
		//$this->CONNECTION->close();
		//mysqli_close($this->CONNECTION);
	}

    public function execSqlCommands($P_SQL)
	{
		$EXEC_COMMANDS_OK = false;
        if (mysqli_query($this->CONNECTION, $P_SQL)) $EXEC_COMMANDS_OK = true;
		
		return $EXEC_COMMANDS_OK;
	}
    
	public function returnNewID($P_SQL)
	{
		$NEW_ID = -1;

        $this->connection_bd();

        mysqli_query($this->CONNECTION, $P_SQL);
        $RESULT_DB = $this->CONNECTION->query($P_SQL);
        $NUM_LINES_DB = mysqli_affected_rows($this->CONNECTION);

        if($NUM_LINES_DB > 0) {
			while($DADOS_ROW = mysqli_fetch_array($RESULT_DB, MYSQLI_NUM)){
				$NEW_ID = $DADOS_ROW[0];
			}
		}

        $this->disconnect_bd();

		return $NEW_ID;
	}
		
}
?>