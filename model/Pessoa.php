<?php
include("DataBase.php");

class Pessoa
{   
    private $IdPes = "";
    private $Descricao = "";

    private $NumRegQuery = 0;
    private $SQL_QUERY_GER = "";
    private $RETURN_PES_JSON = false;

    public function setIdPes($P_IdPes) { $this->IdPes = $P_IdPes;}
    private function setPesJson($P_VAL) { $this->RETURN_PES_JSON = $P_VAL;}
    public function setDescricao($P_Descricao) { $this->Descricao = $P_Descricao;}

    public function getIdPes() { return $this->IdPes; }
    public function getDescricao() { return $this->Descricao; }
    public function getNumRegQuery() { return $this->NumRegQuery; }    

    public function insertPessoa()
    {
        $EXEC_COMMANDS_MENS = $this->crudPessoa("INSERT");
        return $EXEC_COMMANDS_MENS;
    }

    public function updatePessoa()
    {
        $EXEC_COMMANDS_MENS = $this->crudPessoa("UPDATE");
        return $EXEC_COMMANDS_MENS;
    }

    public function deltePessoa()
    {
        $EXEC_COMMANDS_MENS = $this->crudPessoa("DELETE");
        return $EXEC_COMMANDS_MENS;
    }

    public function selectPessoaJson()
    {
        $this->setPesJson(true);
        $Result = $this->selectPessoa();
        $this->setPesJson(false);

        return $Result;

    }
    public function selectPessoa()
    {
        $SQL_QUERY = "";

        if(strlen(trim($this->getIdPes())) > 0)
        {
            $SQL_QUERY = $this->sqlQueryPes(0);
        }
        elseif(strlen(trim($this->getDescricao())) > 0)
        {
            $SQL_QUERY = $this->sqlQueryPes(1);
        }
        else    
        {
            $SQL_QUERY = $this->sqlQueryPes(-1);
        }
        //---------------------------------------------------------------------------

        $DataBaseObj = new DataBase(); 
        $DataBaseObj->connection_bd();
        
        $ALL_DATA           = Array();
        $RESULT_DB          = $DataBaseObj->getConnecation()->query($SQL_QUERY);
        $NUM_LINES_DB       = mysqli_affected_rows($DataBaseObj->getConnecation());
        $this->NumRegQuery  = $NUM_LINES_DB;

        if($NUM_LINES_DB > 0) 
        {
            while($DADOS_ROW = mysqli_fetch_array($RESULT_DB, MYSQLI_NUM))
            {
                if($this->RETURN_PES_JSON)
                {
                    $ALL_DATA[] = array(
                        "value"=>$DADOS_ROW[0],
                        "label"=>$DADOS_ROW[1]);
                } 
                else
                {
                    array_push
                    (
                        $ALL_DATA, 
                        array(
                            $DADOS_ROW[0],
                            $DADOS_ROW[1]
                        )
                    );                    
                }
            }  
		}

        $DataBaseObj->disconnect_bd();
        //---------------------------------------------------------------------------

        return $ALL_DATA;
    }

    private function sqlQueryPes($P_INDEX)
    {
        $SQL_AUX   = "SELECT P.* FROM PESSOA AS P ";

        switch ($P_INDEX) 
        {   
            case 0: 
            {
                $this->SQL_QUERY_GER = $SQL_AUX . " WHERE P.ID_PES IN (" . $this->getIdPes() . ") ";
                break;
            }
            case 1: 
            {
                $this->SQL_QUERY_GER = $SQL_AUX . " WHERE P.DESCRICAO = '" . $this->getDescricao() . "' ";
                $this->sqlQueryPes(2);

                break;
            }
            case 2: 
            {
                $this->SQL_QUERY_GER = $this->SQL_QUERY_GER . 
                " UNION " .
                $SQL_AUX . " WHERE P.DESCRICAO LIKE '%" . $this->getDescricao() . "%' ";

                $this->sqlQueryPes(3);
                break;
            }
            case 3: 
            {
                $DescAux = str_replace(" ", "%", trim($this->getDescricao()));

                $this->SQL_QUERY_GER = $this->SQL_QUERY_GER . 
                " UNION " .
                $SQL_AUX . " WHERE P.DESCRICAO LIKE '%" . $DescAux . "%' ";

                $this->sqlQueryPes(4);
                break;
            }
            case 4: 
            {
                $WhereAux   = "";
                $OrAux      = "";
                $Index      = 0;
                $DescAux    = trim($this->getDescricao());
                $DescAuxArr = explode(" ", $DescAux);

                foreach ($DescAuxArr as $value) 
                {
                    if($Index > 0) $OrAux = " OR ";
                    $WhereAux = $WhereAux . " $OrAux P.DESCRICAO LIKE '%" . $value . "%' ";

                    $Index++;
                }

                $this->SQL_QUERY_GER = $this->SQL_QUERY_GER . 
                " UNION " .
                $SQL_AUX . " WHERE $WhereAux";


                $this->sqlQueryPes(5);
                break;
            }
            case 5: 
            {
                $this->SQL_QUERY_GER = 
                "SELECT R.* FROM (" .
                    $this->SQL_QUERY_GER . 
                ") AS R 
                ORDER BY R.DESCRICAO 
                LIMIT 0, 20 ";

                break;
            }
            default:
            {
                $this->SQL_QUERY_GER = $SQL_AUX . " LIMIT 0, 20";
            }
        }

        if(strlen(trim($this->SQL_QUERY_GER)) == 0) $this->SQL_QUERY_GER = $SQL_AUX . " LIMIT 0, 20";

        return $this->SQL_QUERY_GER;
    }

    private function crudPessoa($KIND_OF)
    {   
        $SQL_COMMANDS = "";
        $EXEC_COMMANDS_MENS = "";

        $DataBaseObj = new DataBase(); 
        $DataBaseObj->connection_bd();
        $EXEC_COMMANDS_OK = false;

        switch ($KIND_OF) 
        {
            case "INSERT": 
            {
                //VALIDATION
                if(strlen(trim($this->getDescricao())) == 0) $EXEC_COMMANDS_MENS = "Informe o nome!";
                //---------------------------------------------------------------------------------------------

                //INSERT
                if(strlen(trim($EXEC_COMMANDS_MENS)) == 0)
                {
                    //NEW ID    
                    $this->setIdPes($DataBaseObj->returnNewID(
                        "SELECT (MAX(P.ID_PES) + 1) AS ID FROM PESSOA AS P")
                    );

                    $SQL_COMMANDS = 
                    "INSERT INTO PESSOA (ID_PES, DESCRICAO) VALUES (" .
                    $this->getIdPes() . ", '" . 
                    $this->getDescricao() . "')";
                }
                //---------------------------------------------------------------------------------------------

                break;
            }    
            case "UPDATE":
            {
                //VALIDATION
                if(strlen(trim($this->getIdPes())) == 0) $EXEC_COMMANDS_MENS = "Informe o código da pessoa!";
                if(strlen(trim($this->getDescricao())) == 0) $EXEC_COMMANDS_MENS = "Informe o nome da pessoa!";
                //---------------------------------------------------------------------------------------------

                //UPDATE
                if(strlen(trim($EXEC_COMMANDS_MENS)) == 0)
                {            
                    $EXEC_COMMANDS_OK = false;

                    $SQL_COMMANDS = 
                    "UPDATE PESSOA SET " .
                    "   DESCRICAO='" . $this->getDescricao() . "' " . 
                    "WHERE (ID_PES = " . $this->getIdPes() . ")";
                }
                //---------------------------------------------------------------------------------------------

                break;  
            } 
            case "DELETE": 
            {
                //VALIDATION
                if(strlen(trim($this->getIdPes())) == 0) $EXEC_COMMANDS_MENS = "Informe o código da pessoa!";
                //---------------------------------------------------------------------------------------------

                //DELETE
                if(strlen(trim($EXEC_COMMANDS_MENS)) == 0)
                {            
                    $SQL_COMMANDS = "DELETE FROM PESSOA WHERE (ID_PES = " . $this->getIdPes() . ")";
                }
                //---------------------------------------------------------------------------------------------

                break;
            }
        }

        $EXEC_COMMANDS_OK = $DataBaseObj->execSqlCommands($SQL_COMMANDS);
        if(!$EXEC_COMMANDS_OK) $EXEC_COMMANDS_MENS = "Falha técnica! Informe o suporte";
        $DataBaseObj->disconnect_bd();

        return $EXEC_COMMANDS_MENS;
    }
}?>