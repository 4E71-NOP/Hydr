/*----------------------------------------------------------------------------------------------------------------------------------*/
/*	Defninit la table des tags																										*/
/*----------------------------------------------------------------------------------------------------------------------------------*/
/* Clefs etrangeres : 																												*/ 
/*----------------------------------------------------------------------------------------------------------------------------------*/

CREATE TABLE !table! (
tag_id		INTEGER NOT NULL, 
tag_nom		VARCHAR(64), 
tag_html	VARCHAR(64), 
site_id		INTEGER, 
PRIMARY KEY (tag_id)
);
