/* ---------------------------------------- */
/* Foreign keys: 							*/
/* ---------------------------------------- */

CREATE TABLE !table! (
langue_id 				INTEGER NOT NULL,
langue_639_3			VARCHAR(255),
langue_nom_original		VARCHAR(255),
langue_639_2			VARCHAR(255),
langue_639_1			VARCHAR(255),
langue_image			VARCHAR(255),

PRIMARY KEY (langue_id)

);
