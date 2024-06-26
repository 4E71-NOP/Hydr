/* ---------------------------------------- */
/* Foreign keys: ws_id					*/
/* ---------------------------------------- */
/*
log_signal	ERR 0	OK 1	WARN 2	INFO 3	AUTRE 4
*/

CREATE TABLE !table! (
log_id			BIGINT NOT NULL UNIQUE, 
fk_ws_id		BIGINT,
log_date		INTEGER,
log_initiator	VARCHAR(255),
log_action		TEXT,
log_signal		INTEGER,
log_msgid		VARCHAR(255),
log_contenu		TEXT,

PRIMARY KEY (log_id)

);
