/* ---------------------------------------- */
/* Foreign keys: site_id, theme_id			*/
/* ---------------------------------------- */
/*
theme_etat	OFFLINE 0	ONLINE 1	SUPPRIME 2
*/

CREATE TABLE !table! (
site_theme_id		INTEGER NOT NULL,
site_id 			INTEGER,
theme_id			INTEGER,
theme_etat	 		INTEGER,

PRIMARY KEY (site_theme_id),
KEY idx_!IdxNom!_site_id (site_id),
KEY idx_!IdxNom!_theme_id (theme_id)

);
