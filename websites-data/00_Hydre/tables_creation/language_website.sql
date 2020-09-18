/* ---------------------------------------- */
/* Foreign keys: ws_id, group_id			*/
/* ---------------------------------------- */
/*
group_state 	OFFLINE 0	ONLINE 1	SUPPRIME 2
*/

CREATE TABLE !table! ( 
lang_website_id	INTEGER NOT NULL,
ws_id			INTEGER,
lang_id			INTEGER,

PRIMARY KEY (lang_website_id),
KEY idx_!IdxNom!_ws_id (ws_id),
KEY idx_!IdxNom!_lang_id (lang_id)

);