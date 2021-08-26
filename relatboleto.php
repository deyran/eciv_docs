<html><head>
	<title>BOLETO TREATMENTS</title>
	
</head>
<body style="margin: 0px; padding: 0px; font-family: 'Lucida Console', 'Courier New', monospace;">
    <div style="padding: 10px"><?php 
        $myfile = fopen("relatboleto.txt", "r") or die("Unable to open file!");

        // Output one line until end-of-file
        while(!feof($myfile)) 
        {
            $LINE = "";
            $LINE_ARRAY = explode(" ", fgets($myfile));
            $LINE_COUNT = count($LINE_ARRAY);

           // echo "count->" . $LINE_COUNT . "<BR />";
            $COUNT_POSITION = 0;    
            foreach($LINE_ARRAY as $VALUE)
            {
                $COUNT_POSITION++;

                if($LINE != "") $LINE = $LINE . "|";
                if($LINE_COUNT == 6 && $COUNT_POSITION == 6) $LINE = $LINE . "|";
                $LINE = $LINE . $VALUE;

                //echo $VALUE . "<BR />";
            }

            echo $LINE . "<br />";
            //echo fgets($myfile) . "<br>";
        }

        fclose($myfile);?>
    </div>

</body></hmtl>