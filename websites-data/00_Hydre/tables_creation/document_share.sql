/* ---------------------------------------- */
/* Foreign keys: 							*/
/* ---------------------------------------- */
/*
part_modification	NON 0	OUI 1
*/

CREATE TABLE !table! (
share_id			INTEGER NOT NULL,
docu_id				INTEGER,
ws_id				INTEGER,
share_modification	INTEGER,

PRIMARY KEY (share_id),
KEY idx_!IdxNom!_docu_id (docu_id),
KEY idx_!IdxNom!_ws_id (ws_id)

);

