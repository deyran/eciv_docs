<?php
class DataTrat
{
    function SequenceRandom() 
	{
		$caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$tamanho_caracteres = strlen($caracteres);
		$sequencia_aleatoria = '';

		for ($i = 0; $i < 40; $i++) {
			$sequencia_aleatoria .= $caracteres[random_int(0, $tamanho_caracteres - 1)];
		}

		return strtoupper($sequencia_aleatoria);
	}

    function ValorPorExt($valor) 
    {
        $singular = array("real", "centavo");
        $plural = array("reais", "centavos");
    
        $valor = number_format($valor, 2, ".", ".");
        $inteiro = explode(".", $valor);
        for($i = 0; $i < count($inteiro); $i++)
            $inteiro[$i] = strrev($inteiro[$i]);
        $retorno = "";
        if($inteiro[0] > 0) {
            $unidade = "";
            if($inteiro[0] > 1)
                $unidade = " {$plural[0]}";
            else
                $unidade = " {$singular[0]}";
            $retorno = $inteiro[0].$unidade;
        }
        if($inteiro[1] > 0) {
            $unidade = "";
            if($inteiro[1] > 1)
                $unidade = " {$plural[1]}";
            else
                $unidade = " {$singular[1]}";
            $retorno .= " e ".$inteiro[1].$unidade;
        }
        if($retorno == "")
            return "zero {$plural[0]}";
        if($retorno == " e ")
            $retorno = "";

        return trim(strrev($retorno));
    }
    
	public function encoding($P_TEXT)
	{
		return mb_convert_encoding($P_TEXT, "ISO-8859-1", "UTF-8");
	}	

}
?>