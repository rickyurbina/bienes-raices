<?php

require_once ('../models/buscaModel.php');

class PropiedadesAjax {

	public static function ctlBuscaPropiedades ($Tipo) {

		$Resultado = BuscaModel::mdlBuscaPropiedadesAjax("propiedades", $Tipo);
        return $Resultado;
		

	}

    

}

?>