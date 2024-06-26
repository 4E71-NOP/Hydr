/* ---------------------------------------- */
/* Foreign keys: ws_id					*/
/* ---------------------------------------- */
CREATE TABLE !table! ( 
layout_id				BIGINT NOT NULL UNIQUE, 
layout_name				VARCHAR(255),
layout_title			VARCHAR(255),
layout_generic_name 	VARCHAR(255),
layout_desc 			VARCHAR(255),
fk_layout_file_id	    BIGINT,

PRIMARY KEY (layout_id)

);
