
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Template · Bootstrap v5.1</title>
    <link rel="stylesheet" href="CSS/leaflet.css" />

  </head>
  <body>
    
<style >
	  body {
            margin: 0;
            padding: 0;
        }
	#map { height: 650px; }
	.info {
  padding: 1px 10px;
  background: #E5E7E9;
  border-radius: 5px;
}

.legend {
  line-height: 25px;
  color: #000000;
}

.legend i {
  width: 20px;
  height: 20px;
  float: right;
  margin-right: 10px;
  opacity: 0.75;
}
</style>
<script src="Libs/leaflet.js"></script>
<script src="Libs/leaflet.ajax.min.js"></script>
<script src="Libs/jquery-3.3.1.min.js"></script>
<script src="Plugins/leaflet.shpfile.js"></script>
<script src="Plugins/shp.js"></script>
<div>
	<div id="map" style="float:left;width:70%;">
	</div>
	<div id="RightDiv" style="float:right;width:25%;">
		<h2> Cliquer sur une governorat pour voir ses statistiques!</h2>
	</div>
	<div style="clear:both; font-size:1px;"></div>
</div>
</body>
</html>
	<script >
				//map initialization
			var mymap;
			var legend;
			//osm layer
			var osm;
			//  Layer controller
			var baseMaps;

			var overlayMaps;
			var CyclOSM;
			var shpfile;
			var LayerSatisfait;
			var LayerEtat;
			var LayerFourn;
			var LayerType;
			
			var Stats;
			//var DataFromDB;
			$(document).ready(function(){
				//map initialisation
				mymap = L.map("map").setView([34.747847, 10.766163], 6.5);
				//shpfile = new L.Shapefile('Data/tun_adm1.zip'); shpfile.addTo(mymap);
				shpfile = new L.Shapefile('Data/TUN_adm1.zip',{onEachFeature:function(feature, layer) {
					layer.bindPopup(feature.properties.NAME_1);
					layer.on({
						mouseover: highlightFeature,
						mouseout: resetHighlight,
						click: updatestats
					});
					}
				});
				shpfile.addTo(mymap);
				CyclOSM = L.tileLayer('https://{s}.tile-cyclosm.openstreetmap.fr/cyclosm/{z}/{x}/{y}.png', {
					maxZoom: 20,
					attribution: '<a href="https://github.com/cyclosm/cyclosm-cartocss-style/releases" title="CyclOSM - Open Bicycle render">CyclOSM</a> | Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
				});
				CyclOSM.addTo(mymap);
				//osmlayer
				osm = L.tileLayer('https://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png', {
					maxZoom: 18,
					attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
				});
				osm.addTo(mymap);
				//googlemaps
				googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
					maxZoom: 20,
					subdomains:['mt0','mt1','mt2','mt3']
				});
				googleStreets.addTo(mymap);
				baseMaps = {
					"osm": osm,
					"google Streets": googleStreets,
					"CyclOSM": CyclOSM
				};
				$.ajax({
					//url:"http://localhost/SIGProject/LoadData.php",
					url:"LoadData.php",
					dataType: "json",
					success: function(DataFromDB){
						//DataFromDB = JSON.parse(response);
						LayerSatisfait = L.geoJSON(DataFromDB, {
							pointToLayer: returnMarkerSatisfait
						});
						LayerEtat = L.geoJSON(DataFromDB, {
							pointToLayer: returnMarkerEtat
						});
						LayerType = L.geoJSON(DataFromDB, {
							pointToLayer: returnMarkerType
						});
						LayerFourn = L.geoJSON(DataFromDB, {
							pointToLayer: returnMarkerFourn
						}).addTo(mymap);
						overlayMaps = {
							"Satisfait": LayerSatisfait,
							"Etat": LayerEtat,
							"Type de connection": LayerType,
							"Fournisseur": LayerFourn
						};
						L.control.layers(baseMaps, overlayMaps).addTo(mymap);
					},
					error: function(xhr, status, error){
						console.log("ERROR: "+error);
					}
				});
				$.ajax({
					url:'CalculStats.php',
					dataType:"json",
					success: function(reponse){
						Stats = reponse;
						console.log(Stats["Sousse"]["fournisseur"]["Orange"]);
					},
					error: function(xhr,status, error){
						console.log("ERROR: "+error);
					}
				});
				legend = L.control({ position: "bottomright" });
				legend.onAdd = function() {
					var div = L.DomUtil.create("div", "info legend"), 
					Fournisseurs = ["Orange", "Ooredoo", "Globalnet","Topnet"];
					div.innerHTML += "<h3>Fournisseur</h3>";
					for (var i = 0; i < Fournisseurs.length; i++) {
						div.innerHTML +='<i style="background: ' + ChooseColorFourn(Fournisseurs[i]) + '"></i> ' +
						Fournisseurs[i] + '<br>';
					}
					return div;
				};
				// Add Legend to the Map
				legend.addTo(mymap);
			});
			function returnMarkerSatisfait(json, latlng){
				var att = json.properties;
				return L.circleMarker(latlng, {radius: 2, color:ChooseColorSatisfait(att.satisfait)});;
			}
			function returnMarkerEtat(json, latlng){
				var att = json.properties;
				return L.circleMarker(latlng, {radius: 2, color:ChooseColorEtat(att.etat)});
			}
			function returnMarkerType(json, latlng){
				var att = json.properties;
				return L.circleMarker(latlng, {radius: 2, color:ChooseColorType(att.type)}).bindTooltip("<h4>Type: "+att.type+"</h4>");;
			}
			function returnMarkerFourn(json, latlng){
				var att = json.properties;
				return L.circleMarker(latlng, {radius: 2, color:ChooseColorFourn(att.fournisseur)}).bindTooltip("<h4>Fournisseur: "+att.fournisseur+"</h4>");
			}
			function ChooseColorSatisfait(string){
				if (string == 'Oui'){
					return 'blue';
				}
				else{
					return 'red';
				}
			}
			function ChooseColorEtat(string){
				if (string == 'Faible'){
					return 'blue';
				}
				else if (string == 'Rupture'){
					return 'red';
				}
			}
			function ChooseColorType(string){
				if (string == 'Données mobiles'){
					return 'purple';
				}
				else if (string == 'ADSL'){
					return 'deeppink';
				}
			}
			function ChooseColorFourn(string){
				if (string == 'Orange'){
					return "#FFA500";
				}else if (string == 'Topnet'){
					return "#0000FF";
				}else if (string == 'Ooredoo'){
					return "#FF0000";
				}else if (string == 'Globalnet'){
					return "#000000";
				}
			}
			function ChooseColorDebit(string){
				if (string == 'Bas'){
					return 'black';
				}else if (string == 'Haut'){
					return 'gray';
				}else if (string == 'Très Haut'){
					return 'white';
				}
			}
			function highlightFeature(e) {
				var layer = e.target;

				layer.setStyle({
					weight: 5,
					color: '#666',
					dashArray: '',
					fillOpacity: 0.7
				});
			}
			function updatestats(e){
				var layer = e.target;
				var name = layer.feature.properties.NAME_1;
				document.getElementById("RightDiv").innerHTML = 
				"<h2><b>" + name +  " Statistiques:</b></h2>" +
				"<br />" + 
				"<h3> Fournisseur de l'internet: </h3>" +
				"<ul>" +
					"<li>Orange: " + Stats[name]["fournisseur"]["Orange"] +"%</li>" +
					"<li>Ooredoo: "+ Stats[name]["fournisseur"]["Ooredoo"] +"%</li>" +
					"<li>Tunisie Telecom: " + Stats[name]["fournisseur"]["Tunisie Telecom"] +"%</li>" +
					"<li>Globalnet: "+ Stats[name]["fournisseur"]["Globalnet"] +"%</li>" +
				"</ul>"+
				"<h3> Debit de l'internet: </h3>"+
				"<ul>"+
					"<li>Bas: "+ Stats[name]["debit"]["Bas"] +"%</li>"+
					"<li>Haut: "+ Stats[name]["debit"]["Haut"] +"%</li>" +
					"<li>Tres Haut: "+ Stats[name]["debit"]["Tres haut"] +"%</li>" +
				"</ul>"+
				"<h3> Etat de l'internet: </h3>"+
				"<ul>"+
					"<li>Rupture: "+ Stats[name]["etat"]["Rupture"] +"%</li>"+
					"<li>Faible: "+ Stats[name]["etat"]["Faible"] +"%</li>" +
					"<li>Bonne: "+ Stats[name]["etat"]["Bonne"] +"%</li>" +
				"</ul>"+
				"<h3> Satisfait: </h3>"+
				"<ul>"+
					"<li>Oui: "+ Stats[name]["satisfait"]["Oui"] + "%</li>"+
					"<li>Non: "+ Stats[name]["satisfait"]["Non"] + "%</li>"+
				"</ul>"
				; 
			}
			function resetHighlight(e) {
				shpfile.resetStyle(e.target);
				//info.update();
			}
		</script>

