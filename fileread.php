<html><head>
	<title>LANCAMENTO AUXILIAR</title>
	
</head>
<body style="margin: 0px; padding: 0px; font-family: 'Lucida Console', 'Courier New', monospace;
">
<div style="padding: 10px"><?php 
    $NUM_CUT = 0;
    $INDEX_AUX  = 1;
    $SET_OF_NUM = [3, 12, 15, 20, 37, 44, 43, 45];
    $SET_OF_MONTH = array("", "JANEIRO", "FEVEREIRO", "MARCO", "ABRIL", "MAIO", "JUNHO", "JULHO", "AGOSTO", "SETEMBRO", "OUTUBRO", "NOVEMBRO", "DEZEMBRO");

    $myfile = fopen("filebank.txt", "r") or die("Unable to open file!");


    while(!feof($myfile)) 
    {
        //$LINE_AUX = $INDEX_AUX . " --> " . fgets($myfile) . "<br>"; 
        $LINE_AUX = fgets($myfile); 

        if (in_array($INDEX_AUX, $SET_OF_NUM)) 
        {
            $NUM_CUT = 0;
            $LABEL_AUX = "";

            if($INDEX_AUX == 3)
            {   //NOME
                $NUM_CUT    = 5;  
                $LABEL_AUX  = "NOME -> ";
                $LINE_AUX   = $LINE_AUX . "<br /><br />";
                
            } else 
            if($INDEX_AUX == 12) 
            {
                //NUM BOLETO
                $NUM_CUT = 14;  
                $LABEL_AUX = "NUM BOLETO -> "; 

            } else 
            if($INDEX_AUX == 15) 
            {
                // CONTROLE
                $NUM_CUT = 26; 
                $LABEL_AUX = "CONTROLE -> "; 
            } else 
            if($INDEX_AUX == 20) 
            {
                //MÊS
                $NUM_CUT = 19;//16 
                $LABEL_AUX = "PARCELA -> ";
                $LINE_AUX = substr($LINE_AUX, $NUM_CUT);
                $LINE_AUX = $SET_OF_MONTH[intval(substr($LINE_AUX, 0, 2))];
                $NUM_CUT = 0; 

            } else 
            if($INDEX_AUX == 37) 
            {
                //JUROS
                $NUM_CUT = 6; 
                $LABEL_AUX = "JUROS -> ";
            } else 
            if($INDEX_AUX == 44) 
            {
                //VALOR PG
                $NUM_CUT = 24; 
                $LABEL_AUX = "VALOR PG -> ";
            } else 
            if($INDEX_AUX == 43) 
            {
                // DESCONTO
                $NUM_CUT = 25;
                $LABEL_AUX = "DESCONTO -> ";
            } else 
            if($INDEX_AUX == 45) 
            {
                // DATA PG
                $NUM_CUT = 29;
                $LABEL_AUX = "DATA PG -> ";
            }

            $LINE_AUX = $LABEL_AUX . substr($LINE_AUX, $NUM_CUT);

            echo $LINE_AUX . "<br>";
        }

        $INDEX_AUX++;
    }

    fclose($myfile)?>
</div>

</body></hmtl>