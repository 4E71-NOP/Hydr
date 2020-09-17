/* ---------------------------------------- */
/* Foreign keys: extension_id							*/
/* ---------------------------------------- */

CREATE TABLE !table! ( 
file_id					INTEGER NOT NULL, 
extension_id			INTEGER,
extension_nom			VARCHAR(255), 
file_nom				VARCHAR(255), 
file_nom_generique		VARCHAR(255), 
file_type				INTEGER, 

PRIMARY KEY (file_id),
KEY idx_!IdxNom!_extension_id (extension_id)

);
