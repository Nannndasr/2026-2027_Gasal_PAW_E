<?php
$matkul = ["PTI","ALPRO","DPW","STRUKTURDAT","JARKOM","PAW","PSBF","RPL"];
$PRAKTIKUM =["JARKOM","PAW"];

for ($i=0;$i <count($matkul);$i++){
	
	if (in_array($matkul[$i], $PRAKTIKUM)){
		echo "Saya mengambil matkul $matkul[$i] termasuk Praktikumnya ";
		echo "<br>";	

	}
	elseif ($i==6||$i==7)
	 {
		echo "Saya belum mengambil matkul $matkul[$i]";
		echo "<br>";
	}
	else {
		echo "Saya sudah mengambil matkul $matkul[$i] semester lalu";
		echo "<br>";
	}



}