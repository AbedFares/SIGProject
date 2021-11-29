<?php
	$dsn = "pgsql:host=localhost;dbname=SIGProject;port=5432";
	$opt = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES => false
	];
	$pdo = new PDO($dsn, 'postgres', 'admin', $opt);
	
	//$result = $pdo->query("SELECT *, ST_AsGeoJSON(geom, 5) FROM sig_connexion");
	$result = $pdo->query("SELECT * FROM sig_connexion");
	$features=[];
	$TunGovs=["Ariana","Beja","Ben Arous (Tunis Sud)","Bizerte","Gabes","Gafsa","Jendouba","Kairouan","Kasserine","Kebili","Le Kef","Mahdia","Manubah","Medenine","Monastir","Nabeul","Sfax","Sidi Bou Zid","Siliana","Sousse","Tataouine","Tozeur","Tunis","Zaghouan"];
	$statspart=[
			"fournisseur" =>["Orange" => 0, "Ooredoo"=>0,"Globalnet"=>0, "Tunisie Telecom" =>0],
			"debit" =>["Bas"=>0,"Haut"=>0,"Tres haut"=>0],
			"etat" =>["Rupture"=>0,"Faible"=>0,"Bonne"=>0],
			"satisfait"=>["Oui"=>0,"Non"=>0]
	];
	$statsGovs =[];
	$statstotale=[];
	foreach($TunGovs AS $valeur){
			$statsGovs[$valeur] = $statspart;
			$statstotale[$valeur] = 0;
	}
	foreach($result AS $row){
		$statstotale[$row['ville']] = $statstotale[$row['ville']] + 1;
	}
	
	$result = $pdo->query("SELECT * FROM sig_connexion");

	foreach($result AS $row){
		$statsGovs[$row['ville']]['fournisseur'][$row['fournisseur']] = $statsGovs[$row['ville']]['fournisseur'][$row['fournisseur']] + 1;
		$statsGovs[$row['ville']]['etat'][$row['etat']] = $statsGovs[$row['ville']]['etat'][$row['etat']] + 1;
		$statsGovs[$row['ville']]['debit'][$row['debit']] = $statsGovs[$row['ville']]['debit'][$row['debit']] + 1;
		$statsGovs[$row['ville']]['satisfait'][$row['satisfait']] = $statsGovs[$row['ville']]['satisfait'][$row['satisfait']] + 1;
	}
	foreach($statsGovs AS $Gov => $GovVal){
		foreach($GovVal AS $att=>$attVal){
			foreach($attVal AS $key=>$valeur){
				if ($statstotale[$Gov]!=0){
					$statsGovs[$Gov][$att][$key] = ($statsGovs[$Gov][$att][$key] / $statstotale[$Gov]) * 100;
				}
			}
			
		}
	}
	echo json_encode($statsGovs);
	
?>