<?php

//  ....................................
//  minhaBiblioteca App - Aplicacao exemplo em PHP
//  ....................................

	function conectaDB()
	{
		$con  =  mysqli_connect( 
			$host="localhost",
			$user= "root",
			$password= "",
			$database= "minha_biblioteca");
		
		if(!$con){
			echo "<h2>Erro na conexao com a base dados...</h2>"; 
			echo "<h2> Erro " . mysqli_connect_errno() . ".</h2>";
			die();
		}

		$con->set_charset("utf8");
		return $con;
	}

	function mostraTabelaPosts($qtdeColunas, $consulta)
	{
		$i = 0;
		$tab = "";

		while( $row = mysqli_fetch_array($consulta, MYSQLI_NUM) ) 
		{
			$tab .=  "<tr valign = center>";
			$tab .=  "<td class=tabv><img src=img/sp.gif width=10 height=8></td>";

			for($j = 0; $j < $qtdeColunas; $j++){
				$tab .=  "<td class = tabv width = 180 height = 6>".htmlspecialchars($row[$j])."&nbsp;</td>"; 
			}
			$tab .=  "<td class = tabv></td>";
			$tab .=  "</tr>";
			$i++;
		}
		$tab .=  "<p></p>";
		echo $tab;
	}

	if ( @$_REQUEST['action'] == 'S') // S = Search
	{
		$con = conectaDB();

		$titulo = $con->real_escape_string($_REQUEST['titulo']);
		$autor = $con->real_escape_string($_REQUEST['autor']);
		$ano = $con->real_escape_string($_REQUEST['ano']);
		
		$query = "SELECT `titulo`, `ano_publicacao`, `local_publicacao`, `editora`, `reservado` FROM livros WHERE livros.titulo like '%$titulo%'";
		
		$result = mysqli_query($con, $query);
		$con->close();

		mostraTabelaPosts(5, $result);
	}


?>

