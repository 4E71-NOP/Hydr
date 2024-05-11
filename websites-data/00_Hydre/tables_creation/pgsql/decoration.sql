/* ---------------------------------------- */
/* Foreign keys: 							*/
/* ---------------------------------------- */

/*
deco_state	OFFLINE:0	ONLINE:1	SUPPRIME:2
deco_type
fk_deco_id				INTEGER,
*/

CREATE TABLE !table! (
deco_id		    		BIGINT NOT NULL UNIQUE, 
deco_name				VARCHAR(255),
deco_state				INTEGER,
deco_type				INTEGER,

PRIMARY KEY (deco_id)

);
