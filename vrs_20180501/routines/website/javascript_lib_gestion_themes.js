// --------------------------------------------------------------------------------------------
//
//	MWM - Multi Web Manager
//	Sous licence Creative common	
//	Under Creative Common licence	CC-by-nc-sa (http://creativecommons.org)
//	CC by = Attribution; CC NC = Non commercial; CC SA = Share Alike
//
//	(c)Faust MARIA DE AREVALO faust@rootwave.com
//
// --------------------------------------------------------------------------------------------
//Fonctions dédiées a la gestion des thèmes.

function JaugeMAJ ( Groupe , ColDeb , ColMil, ColFin , NbrCellules ) {
	var tab = {}

	tab.RougeDeb = h2d( ColDeb[0] + ColDeb[1] );
	tab.VertDeb  = h2d( ColDeb[2] + ColDeb[3] );
	tab.BleuDeb  = h2d( ColDeb[4] + ColDeb[5] );

	tab.RougeMil = h2d( ColMil[0] + ColMil[1] );
	tab.VertMil  = h2d( ColMil[2] + ColMil[3] );
	tab.BleuMil  = h2d( ColMil[4] + ColMil[5] );

	tab.RougeFin = h2d( ColFin[0] + ColFin[1] );
	tab.VertFin  = h2d( ColFin[2] + ColFin[3] );
	tab.BleuFin  = h2d( ColFin[4] + ColFin[5] );

	for (valtab in tab ) { if (isNaN(tab[valtab])) { tab[valtab] = '00';} }

	var RougeCoefA = ( tab.RougeMil - tab.RougeDeb ) / ( Math.floor(NbrCellules/2) );
	var VertCoefA = ( tab.VertMil - tab.VertDeb ) / ( Math.floor(NbrCellules/2) );
	var BleuCoefA = ( tab.BleuMil - tab.BleuDeb ) / ( Math.floor(NbrCellules/2) );

	var RougeCoefB = ( tab.RougeFin - tab.RougeMil ) / ( Math.floor(NbrCellules/2) );
	var VertCoefB = ( tab.VertFin - tab.VertMil ) / ( Math.floor(NbrCellules/2) );
	var BleuCoefB = ( tab.BleuFin - tab.BleuMil ) / ( Math.floor(NbrCellules/2) );

	var Dividx = 1;
	for ( var x = 1 ; x <= Math.floor(NbrCellules/2) ; x++) {
		var RougeX = tab.RougeDeb + ( RougeCoefA * x );
		var VertX  = tab.VertDeb  + ( VertCoefA  * x );
		var BleuX  = tab.BleuDeb  + ( BleuCoefA  * x );
		Gebi( Groupe + Dividx ).style.backgroundColor = '#'+ d2h(parseInt(RougeX)) + d2h(parseInt(VertX)) + d2h(parseInt(BleuX));
		Dividx++;
	}

	for ( var x = 1 ; x <= Math.floor(NbrCellules/2) ; x++) {
		var RougeX = tab.RougeMil + ( RougeCoefB * x );
		var VertX  = tab.VertMil  + ( VertCoefB  * x );
		var BleuX  = tab.BleuMil  + ( BleuCoefB  * x );
		Gebi( Groupe + Dividx ).style.backgroundColor = '#'+ d2h(parseInt(RougeX)) + d2h(parseInt(VertX)) + d2h(parseInt(BleuX));
		Dividx++;
	}
}

function GestionThemeMAJJauge () {
	var Deb = document.formulaire_gds.MS_couleur_jauge_depart.value.replace('#','');
	var Mil = document.formulaire_gds.MS_couleur_jauge_milieu.value.replace('#','');
	var Fin = document.formulaire_gds.MS_couleur_jauge_fin.value.replace('#','');
	JaugeMAJ ( 'jauge_theme_' , Deb , Mil , Fin , 30 );
}

