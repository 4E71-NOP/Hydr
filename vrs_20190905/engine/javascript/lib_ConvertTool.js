/*
// --------------------------------------------------------------------------------------------
//
//	JnsEng - Janus Engine
//	Sous licence Creative common	
//	Under Creative Common licence	CC-by-nc-sa (http://creativecommons.org)
//	CC by = Attribution; CC NC = Non commercial; CC SA = Share Alike
//
//	(c)Faust MARIA DE AREVALO faust@rootwave.com
//
// --------------------------------------------------------------------------------------------
*/


var TabTexteVersHTML = {
"1":{"s":"\"", "d":"&quot;"	},"2":{"s":"&", "d":"&amp;"	},"3":{"s":"<", "d":"&lt;"	},"4":{"s":">", "d":"&gt;"	},"5":{"s":"€", "d":"&euro;"	},"6":{"s":"†", "d":"&dagger;"	},"7":{"s":"‡", "d":"&Dagger;"	},"8":{"s":"‹", "d":"&lt;"	},"9":{"s":"›", "d":"&gt;"	},"10":{"s":"œ", "d":"&oelig;"	},"11":{"s":"Ÿ", "d":"&Yuml;"	},"12":{"s":"", "d":""	},"13":{"s":"¢", "d":"&cent;"	},"14":{"s":"£", "d":"&pound;"	},"15":{"s":"¤", "d":"&curren;"	},"16":{"s":"¥", "d":"&yen;"	},
"17":{"s":"¦", "d":"&brvbar;"	},"18":{"s":"§", "d":"&sect;"	},"19":{"s":"¨", "d":"&uml;"	},"20":{"s":"©", "d":"&copy;"	},"21":{"s":"ª", "d":"&ordf;"	},"22":{"s":"«", "d":"&laquo;"	},"23":{"s":"¬", "d":"&not;"	},"24":{"s":"­", "d":"&shy;"	},"25":{"s":"®", "d":"&reg;"	},"26":{"s":"¯", "d":"&hibar;"	},"27":{"s":"°", "d":"&deg;"	},"28":{"s":"±", "d":"&plusmn;"	},"29":{"s":"²", "d":"&sup2;"	},"30":{"s":"³", "d":"&sup3;"	},"31":{"s":"´", "d":"&acute;"	},"32":{"s":"µ", "d":"&micro;"	},
"33":{"s":"¶", "d":"&para;"	},"34":{"s":"·", "d":"&middot;"	},"35":{"s":"¸", "d":"&cedil;"	},"36":{"s":"¹", "d":"&sup1;"	},"37":{"s":"º", "d":"&ordm;"	},"38":{"s":"»", "d":"&raquo;"	},"39":{"s":"¼", "d":"&frac14;"	},"40":{"s":"½", "d":"&frac12;"	},"41":{"s":"¾", "d":"&frac34;"	},"42":{"s":"¿", "d":"&iquest;"	},"43":{"s":"À", "d":"&Agrave;"	},"44":{"s":"Á", "d":"&Aacute;"	},"45":{"s":"Â", "d":"&Acirc;"	},"46":{"s":"Ã", "d":"&Atilde;"	},"47":{"s":"Ä", "d":"&Auml;"	},"48":{"s":"Å", "d":"&Aring;"	},
"49":{"s":"Æ", "d":"&AElig;"	},"50":{"s":"Ç", "d":"&Ccedil;"	},"51":{"s":"È", "d":"&Egrave;"	},"52":{"s":"É", "d":"&Eacute;"	},"53":{"s":"Ê", "d":"&Ecirc;"	},"54":{"s":"Ë", "d":"&Euml;"	},"55":{"s":"Ì", "d":"&Igrave;"	},"56":{"s":"Í", "d":"&Iacute;"	},"57":{"s":"Î", "d":"&Icirc;"	},"58":{"s":"Ï", "d":"&Iuml;"	},"59":{"s":"Ð", "d":"&Dstrok;"	},"60":{"s":"Ñ", "d":"&Ntilde;"	},"61":{"s":"Ò", "d":"&Ograve;"	},"62":{"s":"Ó", "d":"&Oacute;"	},"63":{"s":"Ô", "d":"&Ocirc;"	},"64":{"s":"Õ", "d":"&Otilde;"	},
"65":{"s":"Ö", "d":"&Ouml;"	},"66":{"s":"×", "d":"&times;"	},"67":{"s":"Ø", "d":"&Oslash;"	},"68":{"s":"Ù", "d":"&Ugrave;"	},"69":{"s":"Ú", "d":"&Uacute;"	},"70":{"s":"Û", "d":"&Ucirc;"	},"71":{"s":"Ü", "d":"&Uuml;"	},"72":{"s":"Ý", "d":"&Yacute;"	},"73":{"s":"Þ", "d":"&THORN;"	},"74":{"s":"ß", "d":"&szlig;"	},"75":{"s":"à", "d":"&agrave;"	},"76":{"s":"á", "d":"&aacute;"	},"77":{"s":"â", "d":"&acirc;"	},"78":{"s":"ã", "d":"&atilde;"	},"79":{"s":"ä", "d":"&auml;"	},"80":{"s":"å", "d":"&aring;"	},
"81":{"s":"æ", "d":"&aelig;"	},"82":{"s":"ç", "d":"&ccedil;"	},"83":{"s":"è", "d":"&egrave;"	},"84":{"s":"é", "d":"&eacute;"	},"85":{"s":"ê", "d":"&ecirc;"	},"86":{"s":"ë", "d":"&euml;"	},"87":{"s":"ì", "d":"&igrave;"	},"88":{"s":"í", "d":"&iacute;"	},"89":{"s":"î", "d":"&icirc;"	},"90":{"s":"ï", "d":"&iuml;"	},"91":{"s":"ð", "d":"&eth;"	},"92":{"s":"ñ", "d":"&ntilde;"	},"93":{"s":"ò", "d":"&ograve;"	},"94":{"s":"ó", "d":"&oacute;"	},"95":{"s":"ô", "d":"&ocirc;"	},"96":{"s":"õ", "d":"&otilde;"	},
"97":{"s":"ö", "d":"&ouml;"	},"98":{"s":"÷", "d":"&divide;"	},"99":{"s":"ø", "d":"&oslash;"	},"100":{"s":"ù", "d":"&ugrave;"	},"101":{"s":"ú", "d":"&uacute;"	},"102":{"s":"û", "d":"&ucirc;"	},"103":{"s":"ü", "d":"&uuml;"	},"104":{"s":"ý", "d":"&yacute;"	},"105":{"s":"þ", "d":"&thorn;"	},"106":{"s":"ÿ", "d":"&yuml;"	},"107":{"s":"\n", "d":"<br>"	}
};

var TabTexteVersMWM = {
"1":{"s":"\t", "d":"[TAB]"	},"2":{"s":"\n", "d":"[BR]"	},"3":{"s":"\"", "d":"&quot;"	},"4":{"s":"&", "d":"&amp;"	},"5":{"s":"<", "d":"&lt;"	},"6":{"s":">", "d":"&gt;"	},"7":{"s":"€", "d":"&euro;"	},"8":{"s":"†", "d":"&dagger;"	},"9":{"s":"‡", "d":"&Dagger;"	},"10":{"s":"‹", "d":"&lt;"	},"11":{"s":"›", "d":"&gt;"	},"12":{"s":"œ", "d":"&oelig;"	},"13":{"s":"Ÿ", "d":"&Yuml;"	},"14":{"s":"¡", "d":"&iexcl;"	},"15":{"s":"¢", "d":"&cent;"	},"16":{"s":"£", "d":"&pound;"	},
"17":{"s":"¤", "d":"&curren;"	},"18":{"s":"¥", "d":"&yen;"	},"19":{"s":"¦", "d":"&brvbar;"	},"20":{"s":"§", "d":"&sect;"	},"21":{"s":"¨", "d":"&uml;"	},"22":{"s":"©", "d":"&copy;"	},"23":{"s":"ª", "d":"&ordf;"	},"24":{"s":"«", "d":"&laquo;"	},"25":{"s":"¬", "d":"&not;"	},"26":{"s":"­", "d":"&shy;"	},"27":{"s":"®", "d":"&reg;"	},"28":{"s":"¯", "d":"&hibar;"	},"29":{"s":"°", "d":"&deg;"	},"30":{"s":"±", "d":"&plusmn;"	},"31":{"s":"²", "d":"&sup2;"	},"32":{"s":"³", "d":"&sup3;"	},
"33":{"s":"´", "d":"&acute;"	},"34":{"s":"µ", "d":"&micro;"	},"35":{"s":"¶", "d":"&para;"	},"36":{"s":"·", "d":"&middot;"	},"37":{"s":"¸", "d":"&cedil;"	},"38":{"s":"¹", "d":"&sup1;"	},"39":{"s":"º", "d":"&ordm;"	},"40":{"s":"»", "d":"&raquo;"	},"41":{"s":"¼", "d":"&frac14;"	},"42":{"s":"½", "d":"&frac12;"	},"43":{"s":"¾", "d":"&frac34;"	},"44":{"s":"¿", "d":"&iquest;"	},"45":{"s":"À", "d":"&Agrave;"	},"46":{"s":"Á", "d":"&Aacute;"	},"47":{"s":"Â", "d":"&Acirc;"	},"48":{"s":"Ã", "d":"&Atilde;"	},
"49":{"s":"Ä", "d":"&Auml;"	},"50":{"s":"Å", "d":"&Aring;"	},"51":{"s":"Æ", "d":"&AElig;"	},"52":{"s":"Ç", "d":"&Ccedil;"	},"53":{"s":"È", "d":"&Egrave;"	},"54":{"s":"É", "d":"&Eacute;"	},"55":{"s":"Ê", "d":"&Ecirc;"	},"56":{"s":"Ë", "d":"&Euml;"	},"57":{"s":"Ì", "d":"&Igrave;"	},"58":{"s":"Í", "d":"&Iacute;"	},"59":{"s":"Î", "d":"&Icirc;"	},"60":{"s":"Ï", "d":"&Iuml;"	},"61":{"s":"Ð", "d":"&Dstrok;"	},"62":{"s":"Ñ", "d":"&Ntilde;"	},"63":{"s":"Ò", "d":"&Ograve;"	},"64":{"s":"Ó", "d":"&Oacute;"	},
"65":{"s":"Ô", "d":"&Ocirc;"	},"66":{"s":"Õ", "d":"&Otilde;"	},"67":{"s":"Ö", "d":"&Ouml;"	},"68":{"s":"×", "d":"&times;"	},"69":{"s":"Ø", "d":"&Oslash;"	},"70":{"s":"Ù", "d":"&Ugrave;"	},"71":{"s":"Ú", "d":"&Uacute;"	},"72":{"s":"Û", "d":"&Ucirc;"	},"73":{"s":"Ü", "d":"&Uuml;"	},"74":{"s":"Ý", "d":"&Yacute;"	},"75":{"s":"Þ", "d":"&THORN;"	},"76":{"s":"ß", "d":"&szlig;"	},"77":{"s":"à", "d":"&agrave;"	},"78":{"s":"á", "d":"&aacute;"	},"79":{"s":"â", "d":"&acirc;"	},"80":{"s":"ã", "d":"&atilde;"	},
"81":{"s":"ä", "d":"&auml;"	},"82":{"s":"å", "d":"&aring;"	},"83":{"s":"æ", "d":"&aelig;"	},"84":{"s":"ç", "d":"&ccedil;"	},"85":{"s":"è", "d":"&egrave;"	},"86":{"s":"é", "d":"&eacute;"	},"87":{"s":"ê", "d":"&ecirc;"	},"88":{"s":"ë", "d":"&euml;"	},"89":{"s":"ì", "d":"&igrave;"	},"90":{"s":"í", "d":"&iacute;"	},"91":{"s":"î", "d":"&icirc;"	},"92":{"s":"ï", "d":"&iuml;"	},"93":{"s":"ð", "d":"&eth;"	},"94":{"s":"ñ", "d":"&ntilde;"	},"95":{"s":"ò", "d":"&ograve;"	},"96":{"s":"ó", "d":"&oacute;"	},
"97":{"s":"ô", "d":"&ocirc;"	},"98":{"s":"õ", "d":"&otilde;"	},"99":{"s":"ö", "d":"&ouml;"	},"100":{"s":"÷", "d":"&divide;"	},"101":{"s":"ø", "d":"&oslash;"	},"102":{"s":"ù", "d":"&ugrave;"	},"103":{"s":"ú", "d":"&uacute;"	},"104":{"s":"û", "d":"&ucirc;"	},"105":{"s":"ü", "d":"&uuml;"	},"106":{"s":"ý", "d":"&yacute;"	},"107":{"s":"þ", "d":"&thorn;"	},"108":{"s":"ÿ", "d":"&yuml;"	}
};

var TabHTMLVersTexte = {
"1":{"s":"<br>", "d":"\n"	},"2":{"s":"<center>", "d":""	},"3":{"s":"</center>", "d":""	},"4":{"s":"<b>", "d":""	},"5":{"s":"</b>", "d":""	},"6":{"s":"<p>", "d":""	},"7":{"s":"</p>", "d":""	},"8":{"s":"&quot;", "d":"\""	},"9":{"s":"&amp;", "d":"&"	},"10":{"s":"&lt;", "d":"<"	},"11":{"s":"&gt;", "d":">"	},"12":{"s":"&euro;", "d":"€"	},"13":{"s":"&dagger;", "d":"†"	},"14":{"s":"&Dagger;", "d":"‡"	},"15":{"s":"&lt;", "d":"‹"	},"16":{"s":"&gt;", "d":"›"	},
"17":{"s":"&oelig;", "d":"œ"	},"18":{"s":"&Yuml;", "d":"Ÿ"	},"19":{"s":"&nbsp;", "d":" "	},"20":{"s":"&iexcl;", "d":"¡"	},"21":{"s":"&cent;", "d":"¢"	},"22":{"s":"&pound;", "d":"£"	},"23":{"s":"&curren;", "d":"¤"	},"24":{"s":"&yen;", "d":"¥"	},"25":{"s":"&brvbar;", "d":"¦"	},"26":{"s":"&sect;", "d":"§"	},"27":{"s":"&uml;", "d":"¨"	},"28":{"s":"&copy;", "d":"©"	},"29":{"s":"&ordf;", "d":"ª"	},"30":{"s":"&laquo;", "d":"«"	},"31":{"s":"&not;", "d":"¬"	},"32":{"s":"&shy;", "d":"­"	},
"33":{"s":"&reg;", "d":"®"	},"34":{"s":"&hibar;", "d":"¯"	},"35":{"s":"&deg;", "d":"°"	},"36":{"s":"&plusmn;", "d":"±"	},"37":{"s":"&sup2;", "d":"²"	},"38":{"s":"&sup3;", "d":"³"	},"39":{"s":"&acute;", "d":"´"	},"40":{"s":"&micro;", "d":"µ"	},"41":{"s":"&para;", "d":"¶"	},"42":{"s":"&middot;", "d":"·"	},"43":{"s":"&cedil;", "d":"¸"	},"44":{"s":"&sup1;", "d":"¹"	},"45":{"s":"&ordm;", "d":"º"	},"46":{"s":"&raquo;", "d":"»"	},"47":{"s":"&frac14;", "d":"¼"	},"48":{"s":"&frac12;", "d":"½"	},
"49":{"s":"&frac34;", "d":"¾"	},"50":{"s":"&iquest;", "d":"¿"	},"51":{"s":"&Agrave;", "d":"À"	},"52":{"s":"&Aacute;", "d":"Á"	},"53":{"s":"&Acirc;", "d":"Â"	},"54":{"s":"&Atilde;", "d":"Ã"	},"55":{"s":"&Auml;", "d":"Ä"	},"56":{"s":"&Aring;", "d":"Å"	},"57":{"s":"&AElig;", "d":"Æ"	},"58":{"s":"&Ccedil;", "d":"Ç"	},"59":{"s":"&Egrave;", "d":"È"	},"60":{"s":"&Eacute;", "d":"É"	},"61":{"s":"&Ecirc;", "d":"Ê"	},"62":{"s":"&Euml;", "d":"Ë"	},"63":{"s":"&Igrave;", "d":"Ì"	},"64":{"s":"&Iacute;", "d":"Í"	},
"65":{"s":"&Icirc;", "d":"Î"	},"66":{"s":"&Iuml;", "d":"Ï"	},"67":{"s":"&Dstrok;", "d":"Ð"	},"68":{"s":"&Ntilde;", "d":"Ñ"	},"69":{"s":"&Ograve;", "d":"Ò"	},"70":{"s":"&Oacute;", "d":"Ó"	},"71":{"s":"&Ocirc;", "d":"Ô"	},"72":{"s":"&Otilde;", "d":"Õ"	},"73":{"s":"&Ouml;", "d":"Ö"	},"74":{"s":"&times;", "d":"×"	},"75":{"s":"&Oslash;", "d":"Ø"	},"76":{"s":"&Ugrave;", "d":"Ù"	},"77":{"s":"&Uacute;", "d":"Ú"	},"78":{"s":"&Ucirc;", "d":"Û"	},"79":{"s":"&Uuml;", "d":"Ü"	},"80":{"s":"&Yacute;", "d":"Ý"	},
"81":{"s":"&THORN;", "d":"Þ"	},"82":{"s":"&szlig;", "d":"ß"	},"83":{"s":"&agrave;", "d":"à"	},"84":{"s":"&aacute;", "d":"á"	},"85":{"s":"&acirc;", "d":"â"	},"86":{"s":"&atilde;", "d":"ã"	},"87":{"s":"&auml;", "d":"ä"	},"88":{"s":"&aring;", "d":"å"	},"89":{"s":"&aelig;", "d":"æ"	},"90":{"s":"&ccedil;", "d":"ç"	},"91":{"s":"&egrave;", "d":"è"	},"92":{"s":"&eacute;", "d":"é"	},"93":{"s":"&ecirc;", "d":"ê"	},"94":{"s":"&euml;", "d":"ë"	},"95":{"s":"&igrave;", "d":"ì"	},"96":{"s":"&iacute;", "d":"í"	},
"97":{"s":"&icirc;", "d":"î"	},"98":{"s":"&iuml;", "d":"ï"	},"99":{"s":"&eth;", "d":"ð"	},"100":{"s":"&ntilde;", "d":"ñ"	},"101":{"s":"&ograve;", "d":"ò"	},"102":{"s":"&oacute;", "d":"ó"	},"103":{"s":"&ocirc;", "d":"ô"	},"104":{"s":"&otilde;", "d":"õ"	},"105":{"s":"&ouml;", "d":"ö"	},"106":{"s":"&divide;", "d":"÷"	},"107":{"s":"&oslash;", "d":"ø"	},"108":{"s":"&ugrave;", "d":"ù"	},"109":{"s":"&uacute;", "d":"ú"	},"110":{"s":"&ucirc;", "d":"û"	},"111":{"s":"&uuml;", "d":"ü"	},"112":{"s":"&yacute;", "d":"ý"	},
"113":{"s":"&thorn;", "d":"þ"	},"114":{"s":"&yuml;", "d":"ÿ"	}
};


var TabHTMLVersMWM = {
"1":{"s":"<hr>", "d":"[HR]"	},"2":{"s":"<justify>", "d":"[J]"	},"3":{"s":"</justify>", "d":"[/J]"	},"4":{"s":"<center>", "d":"[CENTER]"	},"5":{"s":"</center>", "d":"[/CENTER]"	},"6":{"s":"<b>", "d":"[B]"	},"7":{"s":"</b>", "d":"[/B]"	},"8":{"s":"<p>", "d":"[P]"	},"9":{"s":"</p>", "d":"[/P]"	},"10":{"s":"<br>", "d":"[BR]"	},"11":{"s":"\"", "d":"&quot;"	},"12":{"s":"<", "d":"&lt;"	},"13":{"s":">", "d":"&gt;"	},"14":{"s":"€", "d":"&euro;"	},"15":{"s":"†", "d":"&dagger;"	},"16":{"s":"‡", "d":"&Dagger;"	},
"17":{"s":"‹", "d":"&lt;"	},"18":{"s":"›", "d":"&gt;"	},"19":{"s":"œ", "d":"&oelig;"	},"20":{"s":"Ÿ", "d":"&Yuml;"	},"21":{"s":"¡", "d":"&iexcl;"	},"22":{"s":"¢", "d":"&cent;"	},"23":{"s":"£", "d":"&pound;"	},"24":{"s":"¤", "d":"&curren;"	},"25":{"s":"¥", "d":"&yen;"	},"26":{"s":"¦", "d":"&brvbar;"	},"27":{"s":"§", "d":"&sect;"	},"28":{"s":"¨", "d":"&uml;"	},"29":{"s":"©", "d":"&copy;"	},"30":{"s":"ª", "d":"&ordf;"	},"31":{"s":"«", "d":"&laquo;"	},"32":{"s":"¬", "d":"&not;"	},
"33":{"s":"­", "d":"&shy;"	},"34":{"s":"®", "d":"&reg;"	},"35":{"s":"¯", "d":"&hibar;"	},"36":{"s":"°", "d":"&deg;"	},"37":{"s":"±", "d":"&plusmn;"	},"38":{"s":"²", "d":"&sup2;"	},"39":{"s":"³", "d":"&sup3;"	},"40":{"s":"´", "d":"&acute;"	},"41":{"s":"µ", "d":"&micro;"	},"42":{"s":"¶", "d":"&para;"	},"43":{"s":"·", "d":"&middot;"	},"44":{"s":"¸", "d":"&cedil;"	},"45":{"s":"¹", "d":"&sup1;"	},"46":{"s":"º", "d":"&ordm;"	},"47":{"s":"»", "d":"&raquo;"	},"48":{"s":"¼", "d":"&frac14;"	},
"49":{"s":"½", "d":"&frac12;"	},"50":{"s":"¾", "d":"&frac34;"	},"51":{"s":"¿", "d":"&iquest;"	},"52":{"s":"À", "d":"&Agrave;"	},"53":{"s":"Á", "d":"&Aacute;"	},"54":{"s":"Â", "d":"&Acirc;"	},"55":{"s":"Ã", "d":"&Atilde;"	},"56":{"s":"Ä", "d":"&Auml;"	},"57":{"s":"Å", "d":"&Aring;"	},"58":{"s":"Æ", "d":"&AElig;"	},"59":{"s":"Ç", "d":"&Ccedil;"	},"60":{"s":"È", "d":"&Egrave;"	},"61":{"s":"É", "d":"&Eacute;"	},"62":{"s":"Ê", "d":"&Ecirc;"	},"63":{"s":"Ë", "d":"&Euml;"	},"64":{"s":"Ì", "d":"&Igrave;"	},
"65":{"s":"Í", "d":"&Iacute;"	},"66":{"s":"Î", "d":"&Icirc;"	},"67":{"s":"Ï", "d":"&Iuml;"	},"68":{"s":"Ð", "d":"&Dstrok;"	},"69":{"s":"Ñ", "d":"&Ntilde;"	},"70":{"s":"Ò", "d":"&Ograve;"	},"71":{"s":"Ó", "d":"&Oacute;"	},"72":{"s":"Ô", "d":"&Ocirc;"	},"73":{"s":"Õ", "d":"&Otilde;"	},"74":{"s":"Ö", "d":"&Ouml;"	},"75":{"s":"×", "d":"&times;"	},"76":{"s":"Ø", "d":"&Oslash;"	},"77":{"s":"Ù", "d":"&Ugrave;"	},"78":{"s":"Ú", "d":"&Uacute;"	},"79":{"s":"Û", "d":"&Ucirc;"	},"80":{"s":"Ü", "d":"&Uuml;"	},
"81":{"s":"Ý", "d":"&Yacute;"	},"82":{"s":"Þ", "d":"&THORN;"	},"83":{"s":"ß", "d":"&szlig;"	},"84":{"s":"à", "d":"&agrave;"	},"85":{"s":"á", "d":"&aacute;"	},"86":{"s":"â", "d":"&acirc;"	},"87":{"s":"ã", "d":"&atilde;"	},"88":{"s":"ä", "d":"&auml;"	},"89":{"s":"å", "d":"&aring;"	},"90":{"s":"æ", "d":"&aelig;"	},"91":{"s":"ç", "d":"&ccedil;"	},"92":{"s":"è", "d":"&egrave;"	},"93":{"s":"é", "d":"&eacute;"	},"94":{"s":"ê", "d":"&ecirc;"	},"95":{"s":"ë", "d":"&euml;"	},"96":{"s":"ì", "d":"&igrave;"	},
"97":{"s":"í", "d":"&iacute;"	},"98":{"s":"î", "d":"&icirc;"	},"99":{"s":"ï", "d":"&iuml;"	},"100":{"s":"ð", "d":"&eth;"	},"101":{"s":"ñ", "d":"&ntilde;"	},"102":{"s":"ò", "d":"&ograve;"	},"103":{"s":"ó", "d":"&oacute;"	},"104":{"s":"ô", "d":"&ocirc;"	},"105":{"s":"õ", "d":"&otilde;"	},"106":{"s":"ö", "d":"&ouml;"	},"107":{"s":"÷", "d":"&divide;"	},"108":{"s":"ø", "d":"&oslash;"	},"109":{"s":"ù", "d":"&ugrave;"	},"110":{"s":"ú", "d":"&uacute;"	},"111":{"s":"û", "d":"&ucirc;"	},"112":{"s":"ü", "d":"&uuml;"	},
"113":{"s":"ý", "d":"&yacute;"	},"114":{"s":"þ", "d":"&thorn;"	},"115":{"s":"ÿ", "d":"&yuml;"	}
};

var TabMWMVersTexte = {
"1":{"s":"[\[BR\]\]", "d":"\n"	},"2":{"s":"[\[TAB\]]", "d":"\t"	},"3":{"s":"[\[HR\]]", "d":""	},"4":{"s":"[\[J\]]", "d":""	},"5":{"s":"[\[CENTER\]]", "d":""	},"6":{"s":"[\[B\]]", "d":""	},"7":{"s":"[\[P\]]", "d":"\n"	},"8":{"s":"[\[/J\]]", "d":""	},"9":{"s":"[\[/CENTER\]]", "d":""	},"10":{"s":"[\[/B\]]", "d":""	},"11":{"s":"[\[/P\]]", "d":"\n"	},"12":{"s":"&quot;", "d":"\""	},"13":{"s":"&amp;", "d":"&"	},"14":{"s":"&lt;", "d":"<"	},"15":{"s":"&gt;", "d":">"	},"16":{"s":"&euro;", "d":"€"	},
"17":{"s":"&dagger;", "d":"†"	},"18":{"s":"&Dagger;", "d":"‡"	},"19":{"s":"&lt;", "d":"‹"	},"20":{"s":"&gt;", "d":"›"	},"21":{"s":"&oelig;", "d":"œ"	},"22":{"s":"&Yuml;", "d":"Ÿ"	},"23":{"s":"&iexcl;", "d":"¡"	},"24":{"s":"&cent;", "d":"¢"	},"25":{"s":"&pound;", "d":"£"	},"26":{"s":"&curren;", "d":"¤"	},"27":{"s":"&yen;", "d":"¥"	},"28":{"s":"&brvbar;", "d":"¦"	},"29":{"s":"&sect;", "d":"§"	},"30":{"s":"&uml;", "d":"¨"	},"31":{"s":"&copy;", "d":"©"	},"32":{"s":"&ordf;", "d":"ª"	},
"33":{"s":"&laquo;", "d":"«"	},"34":{"s":"&not;", "d":"¬"	},"35":{"s":"&shy;", "d":"­"	},"36":{"s":"&reg;", "d":"®"	},"37":{"s":"&hibar;", "d":"¯"	},"38":{"s":"&deg;", "d":"°"	},"39":{"s":"&plusmn;", "d":"±"	},"40":{"s":"&sup2;", "d":"²"	},"41":{"s":"&sup3;", "d":"³"	},"42":{"s":"&acute;", "d":"´"	},"43":{"s":"&micro;", "d":"µ"	},"44":{"s":"&para;", "d":"¶"	},"45":{"s":"&middot;", "d":"·"	},"46":{"s":"&cedil;", "d":"¸"	},"47":{"s":"&sup1;", "d":"¹"	},"48":{"s":"&ordm;", "d":"º"	},
"49":{"s":"&raquo;", "d":"»"	},"50":{"s":"&frac14;", "d":"¼"	},"51":{"s":"&frac12;", "d":"½"	},"52":{"s":"&frac34;", "d":"¾"	},"53":{"s":"&iquest;", "d":"¿"	},"54":{"s":"&Agrave;", "d":"À"	},"55":{"s":"&Aacute;", "d":"Á"	},"56":{"s":"&Acirc;", "d":"Â"	},"57":{"s":"&Atilde;", "d":"Ã"	},"58":{"s":"&Auml;", "d":"Ä"	},"59":{"s":"&Aring;", "d":"Å"	},"60":{"s":"&AElig;", "d":"Æ"	},"61":{"s":"&Ccedil;", "d":"Ç"	},"62":{"s":"&Egrave;", "d":"È"	},"63":{"s":"&Eacute;", "d":"É"	},"64":{"s":"&Ecirc;", "d":"Ê"	},
"65":{"s":"&Euml;", "d":"Ë"	},"66":{"s":"&Igrave;", "d":"Ì"	},"67":{"s":"&Iacute;", "d":"Í"	},"68":{"s":"&Icirc;", "d":"Î"	},"69":{"s":"&Iuml;", "d":"Ï"	},"70":{"s":"&Dstrok;", "d":"Ð"	},"71":{"s":"&Ntilde;", "d":"Ñ"	},"72":{"s":"&Ograve;", "d":"Ò"	},"73":{"s":"&Oacute;", "d":"Ó"	},"74":{"s":"&Ocirc;", "d":"Ô"	},"75":{"s":"&Otilde;", "d":"Õ"	},"76":{"s":"&Ouml;", "d":"Ö"	},"77":{"s":"&times;", "d":"×"	},"78":{"s":"&Oslash;", "d":"Ø"	},"79":{"s":"&Ugrave;", "d":"Ù"	},"80":{"s":"&Uacute;", "d":"Ú"	},
"81":{"s":"&Ucirc;", "d":"Û"	},"82":{"s":"&Uuml;", "d":"Ü"	},"83":{"s":"&Yacute;", "d":"Ý"	},"84":{"s":"&THORN;", "d":"Þ"	},"85":{"s":"&szlig;", "d":"ß"	},"86":{"s":"&agrave;", "d":"à"	},"87":{"s":"&aacute;", "d":"á"	},"88":{"s":"&acirc;", "d":"â"	},"89":{"s":"&atilde;", "d":"ã"	},"90":{"s":"&auml;", "d":"ä"	},"91":{"s":"&aring;", "d":"å"	},"92":{"s":"&aelig;", "d":"æ"	},"93":{"s":"&ccedil;", "d":"ç"	},"94":{"s":"&egrave;", "d":"è"	},"95":{"s":"&eacute;", "d":"é"	},"96":{"s":"&ecirc;", "d":"ê"	},
"97":{"s":"&euml;", "d":"ë"	},"98":{"s":"&igrave;", "d":"ì"	},"99":{"s":"&iacute;", "d":"í"	},"100":{"s":"&icirc;", "d":"î"	},"101":{"s":"&iuml;", "d":"ï"	},"102":{"s":"&eth;", "d":"ð"	},"103":{"s":"&ntilde;", "d":"ñ"	},"104":{"s":"&ograve;", "d":"ò"	},"105":{"s":"&oacute;", "d":"ó"	},"106":{"s":"&ocirc;", "d":"ô"	},"107":{"s":"&otilde;", "d":"õ"	},"108":{"s":"&ouml;", "d":"ö"	},"109":{"s":"&divide;", "d":"÷"	},"110":{"s":"&oslash;", "d":"ø"	},"111":{"s":"&ugrave;", "d":"ù"	},"112":{"s":"&uacute;", "d":"ú"	},
"113":{"s":"&ucirc;", "d":"û"	},"114":{"s":"&uuml;", "d":"ü"	},"115":{"s":"&yacute;", "d":"ý"	},"116":{"s":"&thorn;", "d":"þ"	},"117":{"s":"&yuml;", "d":"ÿ"	}
}


var TabMWMVersHTML = {
		"HR":				{	"s":"\\[HR\\]"			,		"d":"<hr>",										},
		"J":				{	"s":"\\[\J\\]"			,		"d":"<justify>",								},
		"JE":				{	"s":"\\[\\/\J\\]"		,		"d":"</justify>",								},
		"CENTER":			{	"s":"\\[CENTER\\]"		,		"d":"<center>",									},
		"CENTERE":			{	"s":"\\[\\/CENTER\\]"	,		"d":"</center>",								},
		"B":				{	"s":"\\[B\\]"			,		"d":"<b>",									},
		"BE":				{	"s":"\\[\\/B\\]"		,		"d":"</b>",									},
		"P":				{	"s":"\\[P\\]"			,		"d":"<p>",										},
		"PE":				{	"s":"\\[\\/P\\]"		,		"d":"</p>",										},
		"TABLE":			{	"s":"\\[TABLE\\]"		,		"d":"<table>",									},
		"TR":				{	"s":"\\[TR\\]"			,		"d":"<tr>",										},
		"TD":				{	"s":"\\[TD\\]"			,		"d":"<td>",										},
		"TABLEE":			{	"s":"\\[\\/TABLE\\]"	,		"d":"</table>",									},
		"TRE":				{	"s":"\\[\\/TR\\]"		,		"d":"</tr>",									},
		"TDE":				{	"s":"\\[\\/TD\\]"		,		"d":"</td>",									},
		"FE":				{	"s":"\\[FE\\]"			,		"d":"'>",										},
		"F":				{	"s":"\\[F\\]"			,		"d":">",										},
		"FEND":				{	"s":"\\[\\/F\\]"		,		"d":"</span>",									},
		"TAB_STD":			{	"s":"\\[TAB_STD\\]"		,		"d":"<table ",									},
		"POPIMG_L":			{	"s":"\\[POPIMG_L\\]"	,		"d":"<a href=' ",								},
		"POPIMG_LE":		{	"s":"\\[\\/POPIMG_L\\]"	,		"d":"'> ",										},
		"POPIMG_I":			{	"s":"\\[POPIMG_I\\]"	,		"d":"<img src=' ",								},
		"POPIMG_IE":		{	"s":"\\[\\/POPIMG_I\\]"	,		"d":"> ",										},
		"LE":				{	"s":"\\[\\/L\\]"	,			"d":"</a>",										},
		"Lx":				{	"s":"\\[L[1-9]\\]"	,			"d":"</a href='",								},
		"L_T":				{	"s":"\\[L_T\\]"	,				"d":"'>",										},
		"Tx":				{	"s":"\\[T[1-9]\\]"	,			"d":"",											},
		"TxB":				{	"s":"\\[T[1-9]B\\]"	,			"d":"<span style='text-weigh:bold;'>",			},
		"TxE":				{	"s":"\\[\\/T[1-9]\\]"	,		"d":"",											},
		"TBxE":				{	"s":"\\[\\/TB[1-9]\\]"	,		"d":"</span>",									},
		"TW_MLI":			{	"s":"\\[TW_MLI\\]"	,			"d":"",											},
		"POPIMG_S10":		{	"s":"\\[POPIMG_S10\\]"	,		"d":"' width='10'"								},
		"POPIMG_S20":		{	"s":"\\[POPIMG_S20\\]"	,		"d":"' width='20'"								},
		"POPIMG_S30":		{	"s":"\\[POPIMG_S30\\]"	,		"d":"' width='30'"								},
		"POPIMG_S40":		{	"s":"\\[POPIMG_S40\\]"	,		"d":"' width='40'"								},
		"POPIMG_S50":		{	"s":"\\[POPIMG_S50\\]"	,		"d":"' width='50'"								},
		"POPIMG_S60":		{	"s":"\\[POPIMG_S60\\]"	,		"d":"' width='60'"								},
		"POPIMG_S70":		{	"s":"\\[POPIMG_S70\\]"	,		"d":"' width='70'"								},
		"POPIMG_S80":		{	"s":"\\[POPIMG_S80\\]"	,		"d":"' width='80'"								},
		"POPIMG_S90":		{	"s":"\\[POPIMG_S90\\]"	,		"d":"' width='90'"								},
		"POPIMG_S100":		{	"s":"\\[POPIMG_S100\\]"	,		"d":"' width='100'"								},
		"99":				{	"s":"\\[BR\\]"			,		"d":"<br>"										},
		"TDFC":				{	"s":"\\[TDFC[1-9]\\]"	,		"d":"<td "										},
		"TDFCT":			{	"s":"\\[TDFCT[1-9]\\]"	,		"d":"<td "										},
		"TDFCA":			{	"s":"\\[TDFCA[1-9]\\]"	,		"d":"<td "										},
		"TDFCAB":			{	"s":"\\[TDFCAB[1-9]\\]"	,		"d":"<td "										},
		"TDFCB":			{	"s":"\\[TDFCB[1-9]\\]"	,		"d":"<td "										},
		"TDFCBB":			{	"s":"\\[TDFCBB[1-9]\\]"	,		"d":"<td "										},
		"TDFCC":			{	"s":"\\[TDFCC[1-9]\\]"	,		"d":"<td "										},
		"TDFCCB":			{	"s":"\\[TDFCCB[1-9]\\]"	,		"d":"<td "										},
		"TDFCD":			{	"s":"\\[TDFCD[1-9]\\]"	,		"d":"<td "										},
		"TDFCDB":			{	"s":"\\[TDFCDB[1-9]\\]"	,		"d":"<td "										},
		"TDFCTA":			{	"s":"\\[TDFCTA[1-9]\\]"	,		"d":"<td "										},
		"TDFCTAB":			{	"s":"\\[TDFCTAB[1-9]\\]",		"d":"<td "										},
		"TDFCTB":			{	"s":"\\[TDFCTB[1-9]\\]"	,		"d":"<td "										},
		"TDFCTBB":			{	"s":"\\[TDFCTBB[1-9]\\]",		"d":"<td "										},
		"TDFCTC":			{	"s":"\\[TDFCTC[1-9]\\]"	,		"d":"<td "										},
		"TDFCTD":			{	"s":"\\[TDFCTD[1-9]\\]"	,		"d":"<td "										},
		"COLSP"	:			{	"s":"\\[COLSP\\]"	,			"d":"colspan='"									},
		"ROWSP"	:			{	"s":"\\[ROWSP\\]"	,			"d":"rowspan='"									},
		"CODE"	:			{	"s":"\\[CODE\\]"	,			"d":"<code>"									},
		"CODEx"	:			{	"s":"\\[CODE[1-9]\\]",			"d":"<code>"									},
		"CODEE"	:			{	"s":"\\[\\/CODE\\]"	,			"d":"</code>"									},
		"IMGSRC":			{	"s":"\\[IMGSRC\\]"	,			"d":"<img src='"								},
		"IMGALT":			{	"s":"\\[IMGALT\\]"	,			"d":"' alt='"									},
		"IMGBRD":			{	"s":"\\[IMGBRD\\]"	,			"d":"'>"										},
		"100":				{	"s":"&quot;"			,		"d":"\"",										},
		"101":				{	"s":"&lt;"				,		"d":"<",										},
		"102":				{	"s":"&gt;"				,		"d":">",										},
		"103":				{	"s":"&euro;"			,		"d":"€",										},
		"104":				{	"s":"&dagger;"			,		"d":"†",										},
		"105":				{	"s":"&Dagger;"			,		"d":"‡",										},
		"106":				{	"s":"&lt;"				,		"d":"‹",										},
		"107":				{	"s":"&gt;"				,		"d":"›",										},
		"108":				{	"s":"&oelig;"			,		"d":"œ",										},
		"109":				{	"s":"&Yuml;"			,		"d":"Ÿ",										},
		"110":				{	"s":"&iexcl;"			,		"d":"¡",										},
		"111":				{	"s":"&cent;"			,		"d":"¢",										},
		"112":				{	"s":"&pound;"			,		"d":"£",										},
		"113":				{	"s":"&curren;"			,		"d":"¤",										},
		"114":				{	"s":"&yen;"				,		"d":"¥",										},
		"115":				{	"s":"&brvbar;"			,		"d":"¦",										},
		"116":				{	"s":"&sect;"			,		"d":"§",										},
		"117":				{	"s":"&uml;"				,		"d":"¨",										},
		"118":				{	"s":"&copy;"			,		"d":"©",										},
		"119":				{	"s":"&ordf;"			,		"d":"ª",										},
		"120":				{	"s":"&laquo;"			,		"d":"«",										},
		"121":				{	"s":"&not;"				,		"d":"¬",										},
		"122":				{	"s":"&shy;"				,		"d":"­",											},
		"123":				{	"s":"&reg;"				,		"d":"®",										},
		"124":				{	"s":"&hibar;"			,		"d":"¯",										},
		"125":				{	"s":"&deg;"				,		"d":"°",										},
		"126":				{	"s":"&plusmn;"			,		"d":"±",										},
		"127":				{	"s":"&sup2;"			,		"d":"²",										},
		"128":				{	"s":"&sup3;"			,		"d":"³",										},
		"129":				{	"s":"&acute;"			,		"d":"´",										},
		"130":				{	"s":"&micro;"			,		"d":"µ",										},
		"131":				{	"s":"&para;"			,		"d":"¶",										},
		"132":				{	"s":"&middot;"			,		"d":"·",										},
		"133":				{	"s":"&cedil;"			,		"d":"¸",										},
		"134":				{	"s":"&sup1;"			,		"d":"¹",										},
		"135":				{	"s":"&ordm;"			,		"d":"º",										},
		"136":				{	"s":"&raquo;"			,		"d":"»",										},
		"137":				{	"s":"&frac14;"			,		"d":"¼",										},
		"138":				{	"s":"&frac12;"			,		"d":"½",										},
		"139":				{	"s":"&frac34;"			,		"d":"¾",										},
		"140":				{	"s":"&iquest;"			,		"d":"¿",										},
		"141":				{	"s":"&Agrave;"			,		"d":"À",										},
		"142":				{	"s":"&Aacute;"			,		"d":"Á",										},
		"143":				{	"s":"&Acirc;"			,		"d":"Â",										},
		"144":				{	"s":"&Atilde;"			,		"d":"Ã",										},
		"145":				{	"s":"&Auml;"			,		"d":"Ä",										},
		"146":				{	"s":"&Aring;"			,		"d":"Å",										},
		"147":				{	"s":"&AElig;"			,		"d":"Æ",										},
		"148":				{	"s":"&Ccedil;"			,		"d":"Ç",										},
		"149":				{	"s":"&Egrave;"			,		"d":"È",										},
		"150":				{	"s":"&Eacute;"			,		"d":"É",										},
		"151":				{	"s":"&Ecirc;"			,		"d":"Ê",										},
		"152":				{	"s":"&Euml;"			,		"d":"Ë",										},
		"153":				{	"s":"&Igrave;"			,		"d":"Ì",										},
		"154":				{	"s":"&Iacute;"			,		"d":"Í",										},
		"155":				{	"s":"&Icirc;"			,		"d":"Î",										},
		"156":				{	"s":"&Iuml;"			,		"d":"Ï",										},
		"157":				{	"s":"&Dstrok;"			,		"d":"Ð",										},
		"158":				{	"s":"&Ntilde;"			,		"d":"Ñ",										},
		"159":				{	"s":"&Ograve;"			,		"d":"Ò",										},
		"160":				{	"s":"&Oacute;"			,		"d":"Ó",										},
		"161":				{	"s":"&Ocirc;"			,		"d":"Ô",										},
		"162":				{	"s":"&Otilde;"			,		"d":"Õ",										},
		"163":				{	"s":"&Ouml;"			,		"d":"Ö",										},
		"164":				{	"s":"&times;"			,		"d":"×",										},
		"165":				{	"s":"&Oslash;"			,		"d":"Ø",										},
		"166":				{	"s":"&Ugrave;"			,		"d":"Ù",										},
		"167":				{	"s":"&Uacute;"			,		"d":"Ú",										},
		"168":				{	"s":"&Ucirc;"			,		"d":"Û",										},
		"169":				{	"s":"&Uuml;"			,		"d":"Ü",										},
		"170":				{	"s":"&Yacute;"			,		"d":"Ý",										},
		"171":				{	"s":"&THORN;"			,		"d":"Þ",										},
		"172":				{	"s":"&szlig;"			,		"d":"ß",										},
		"173":				{	"s":"&agrave;"			,		"d":"à",										},
		"174":				{	"s":"&aacute;"			,		"d":"á",										},
		"175":				{	"s":"&acirc;"			,		"d":"â",										},
		"176":				{	"s":"&atilde;"			,		"d":"ã",										},
		"177":				{	"s":"&auml;"			,		"d":"ä",										},
		"178":				{	"s":"&aring;"			,		"d":"å",										},
		"179":				{	"s":"&aelig;"			,		"d":"æ",										},
		"180":				{	"s":"&ccedil;"			,		"d":"ç",										},
		"181":				{	"s":"&egrave;"			,		"d":"è",										},
		"182":				{	"s":"&eacute;"			,		"d":"é",										},
		"183":				{	"s":"&ecirc;"			,		"d":"ê",										},
		"184":				{	"s":"&euml;"			,		"d":"ë",										},
		"185":				{	"s":"&igrave;"			,		"d":"ì",										},
		"186":				{	"s":"&iacute;"			,		"d":"í",										},
		"187":				{	"s":"&icirc;"			,		"d":"î",										},
		"188":				{	"s":"&iuml;"			,		"d":"ï",										},
		"189":				{	"s":"&eth;"				,		"d":"ð",										},
		"190":				{	"s":"&ntilde;"			,		"d":"ñ",										},
		"191":				{	"s":"&ograve;"			,		"d":"ò",										},
		"192":				{	"s":"&oacute;"			,		"d":"ó",										},
		"193":				{	"s":"&ocirc;"			,		"d":"ô",										},
		"194":				{	"s":"&otilde;"			,		"d":"õ",										},
		"195":				{	"s":"&ouml;"			,		"d":"ö",										},
		"196":				{	"s":"&divide;"			,		"d":"÷",										},
		"197":				{	"s":"&oslash;"			,		"d":"ø",										},
		"198":				{	"s":"&ugrave;"			,		"d":"ù",										},
		"199":				{	"s":"&uacute;"			,		"d":"ú",										},
		"200":				{	"s":"&ucirc;"			,		"d":"û",										},
		"201":				{	"s":"&uuml;"			,		"d":"ü",										},
		"202":				{	"s":"&yacute;"			,		"d":"ý",										},
		"203":				{	"s":"&thorn;"			,		"d":"þ",										},
		"204":				{	"s":"&yuml;"			,		"d":"ÿ",										}
	
}

function ConversionType ( Form , src , dst , MStypeSrc, MStypeDst ) {
	var ChaineSource = document.forms[Form].elements[src].value;
	var ChaineSourceBis = "";
	var ChaineDst = "";

	var MenuTypeSrc = document.forms[Form].elements[MStypeSrc];
	var TypeSrc = MenuTypeSrc.options[MenuTypeSrc.selectedIndex].value;
	var MenuTypeDst = document.forms[Form].elements[MStypeDst];
	var TypeDst = MenuTypeDst.options[MenuTypeDst.selectedIndex].value;
	TypeDst = Number ( TypeSrc * 5 ) + Number(TypeDst);

	switch ( TypeDst ) {
	case 0:		alert( "Src = Dst ???!!!");	break;
	case 1:		var TabConv = TabTexteVersHTML;		var SelectionRoutine = 1;	break;
	case 2:		var TabConv = TabTexteVersHTML;		var SelectionRoutine = 1;	break;
	case 3:		var TabConv = TabTexteVersHTML;		var SelectionRoutine = 1;	break;
	case 4:		var TabConv = TabTexteVersMWM;		var SelectionRoutine = 1;	break;

	case 5:		var TabConv = TabHTMLVersTexte;		var SelectionRoutine = 1;	break;
	case 6:		alert( "Src = Dst ???!!!");	break;
	case 7:		alert( "HTML Mix");		break;
	case 8:		alert( "HTML PHP");		break;
	case 9:		var TabConv = TabHTMLVersMWM;		var SelectionRoutine = 1;	break;

	case 10:	alert( "Mix Texte");	break;
	case 11:	alert( "Mix HTML");		break;
	case 12:	alert( "Mix Mix");		break;
	case 13:	alert( "Mix PHP");		break;
	case 14:	alert( "Mix MWM");		break;

	case 15:	alert( "PHP Texte");	break;
	case 16:	alert( "PHP HTML");		break;
	case 17:	alert( "PHP Mix");		break;
	case 18:	alert( "PHP PHP");		break;
	case 19:	alert( "PHP MWM");		break;

	case 20:	var TabConv = TabMWMVersTexte;		var SelectionRoutine = 1;	break;
	case 21:	var TabConv = TabMWMVersHTML;		var SelectionRoutine = 1;	break;
	case 22:	alert( "MWM Mix");		break;
	case 23:	alert( "MWM PHP");		break;
	case 24:	alert( "Src = Dst ???!!!");	break;
	}

	switch ( SelectionRoutine ) {
	case 1:	
		
		for ( let ptr in TabConv ) {
			console.log ( "processing: `" + TabConv[ptr].s + "`");
			ChaineSourceBis = ChaineSource.replace( RegExp (TabConv[ptr].s, "g") , TabConv[ptr].d );
			ChaineSource = ChaineSourceBis;
		}
		ChaineDst = String(ChaineSource);
	break;
	case 2:
	/*
		for ( var ptr in ChaineSource ) {
			if ( TabConv[ChaineSource[ptr]] ) { ChaineDst += TabConv[ChaineSource[ptr]]; }
			else { ChaineDst += ChaineSource[ptr]; }
		}
		ChaineDst = ChaineDst.replace(/\n/g, "<br>");
	*/
	break;	
	}
	document.forms[Form].elements[dst].value = 	ChaineDst;
}
/*
La petite fraülein dans la forêt de l'enchantée.<br>&amp&lt&gt
*/
