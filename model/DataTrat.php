<?php
class DataTrat
{
    public function SequenceRandom() 
	{
		$caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$tamanho_caracteres = strlen($caracteres);
		$sequencia_aleatoria = '';

		for ($i = 0; $i < 40; $i++) {
			$sequencia_aleatoria .= $caracteres[random_int(0, $tamanho_caracteres - 1)];
		}

		return strtoupper($sequencia_aleatoria);
	}

    public function ValorPorExt($valor) 
    {		
        $v = filter_var($valor, FILTER_SANITIZE_NUMBER_INT);
   
        $sin = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
        $plu = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");

        $c = array("", "cem", "duzentos", "trezentos", "quatrocentos","quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
        $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
        $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezesete", "dezoito", "dezenove");
        $u = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");

        $z = 0;
 
        $v = number_format( $v, 2, ".", "." );
        $int = explode( ".", $v );
 
        for ( $i = 0; $i < count( $int ); $i++ ) 
        {
            for ( $ii = mb_strlen( $int[$i] ); $ii < 3; $ii++ ) 
            {
                $int[$i] = "0" . $int[$i];
            }
        }

        $rt = null;
        $fim = count( $int ) - ($int[count( $int ) - 1] > 0 ? 1 : 2);
        for ( $i = 0; $i < count( $int ); $i++ )
        {
            $v = $int[$i];
            $rc = (($v > 100) && ($v < 200)) ? "cento" : $c[$v[0]];
            $rd = ($v[1] < 2) ? "" : $d[$v[1]];
            $ru = ($v > 0) ? (($v[1] == 1) ? $d10[$v[2]] : $u[$v[2]]) : "";
 
            $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd && $ru) ? " e " : "") . $ru;
            $t = count( $int ) - 1 - $i;
            $r .= $r ? " " . ($v > 1 ? $plu[$t] : $sin[$t]) : "";
            if ( $v == "000")
                $z++;
            elseif ( $z > 0 )
                $z--;
                
            if ( ($t == 1) && ($z > 0) && ($int[0] > 0) )
                $r .= ( ($z > 1) ? " de " : "") . $plu[$t];
                
            if ( $r )
                $rt = $rt . ((($i > 0) && ($i <= $fim) && ($int[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
        }
 
        $rt = mb_substr( $rt, 1 );

        $returnExt = ucwords(($rt ? trim( $rt ) : "zero"));
        $returnExt = str_replace(" E ", " e ", $returnExt);
        $returnExt = "R$ ". number_format($valor, 2, ".", "") . "($returnExt)";
 
        return $returnExt;
    }
    
	public function encoding($P_TEXT)
	{
		return mb_convert_encoding($P_TEXT, "ISO-8859-1", "UTF-8");
	}	

    public function returnDataExt()
    {
        date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário para São Paulo
        $data = new DateTime(); // Cria um objeto DateTime com a data atual
        $formatter = new IntlDateFormatter('pt_BR',  IntlDateFormatter::FULL,  IntlDateFormatter::NONE,  'America/Sao_Paulo', IntlDateFormatter::GREGORIAN); // Cria um objeto IntlDateFormatter com o locale, o formato da data, o formato da hora, o fuso horário e o tipo de calendário desejados
        
        $DataAtual = ucwords($this->encoding($formatter->format($data)));
        $DataAtual = str_replace(" De ", " de ", $DataAtual);

        return $DataAtual;
    }

}
?>