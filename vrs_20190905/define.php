<?php
// --------------------------------------------------------------------------------------------
// THE DEFINE SECTION IS SET HERE AND IT IS FINE.
// If you're slow : Meaning don't 'define' anyhere else!
define ( "DEFAULT_SITE_ID", 2 );

define ( "USER_ACTION_SIGN_IN", "singIn" );
define ( "USER_ACTION_DISCONNECT", "disconnect" );
define ( "ANONYMOUS_USER_NAME", "anonymous" );

// --------------------------------------------------------------------------------------------
// Logs
define ( "LOGLEVEL_BREAKPOINT",		5 ); // You definitely like to read or you're a crappy programmer
define ( "LOGLEVEL_STATEMENT",		4 ); // Every statements like i'm the <class::method> and i recieved this data
define ( "LOGLEVEL_INFORMATION",	3 ); // Moaar
define ( "LOGLEVEL_WARNING",		2 ); // More
define ( "LOGLEVEL_ERROR",			1 ); // Usual level
define ( "LOGLEVEL_NO_LOG",			0 ); // You don't like to read. Or you don't wanna polute your server.

define ( "LOG_TARGET", "both" ); // none, both, internal, system
define ( "INSTALL_LOG_TARGET", "system" );

// log dedicated to debug and users
// define ("INTERNAL_LOG_LEVEL" , LOGLEVEL_ERROR);
$ll = 0;
switch ($application) {
	case 'install' :
	case 'monitor' :
		$ll = LOGLEVEL_WARNING;
// 		$ll = LOGLEVEL_STATEMENT;
		break;
	case 'website':
		$ll = LOGLEVEL_STATEMENT;
		break;
	default :
		$ll = LOGLEVEL_INFORMATION;
// 		$ll = LOGLEVEL_BREAKPOINT;
		break;
}
define ( "INTERNAL_LOG_LEVEL", $ll ) ;
error_log("Log level is set to : ". INTERNAL_LOG_LEVEL);
unset ($ll);


// --------------------------------------------------------------------------------------------
// Class names
define ( "CLASS_Table01",			"_Table01");
define ( "CLASS_TableStd",		"_TableStd");
define ( "CLASS_Txt_Ok",			"_ok");
define ( "CLASS_Txt_Warning",		"_warning");
define ( "CLASS_Txt_Error",		"_error");
define ( "CLASS_Txt_Fade",		"_fade");
define ( "CLASS_Txt_Highlight",	"_highlight");
define ( "CLASS_TblLgnd_Top",		"_TblLgndTop"); 
define ( "CLASS_TblLgnd_Bottom",	"_TblLgndBottom"); 
define ( "CLASS_TblLgnd_Left",	"_TblLgndLeft"); 
define ( "CLASS_TblLgnd_Right",	"_TblLgndRight"); 

define ( "CLASS_ADM_Ctrl_Switch", "div_AdminControlSwitch");
define ( "CLASS_ADM_Ctrl_Panel", "div_AdminControlPanel");
define ( "CLASS_File_Selector_Container", "FileSelectorContainer");
define ( "CLASS_File_Selector", "FileSelector");





?>
