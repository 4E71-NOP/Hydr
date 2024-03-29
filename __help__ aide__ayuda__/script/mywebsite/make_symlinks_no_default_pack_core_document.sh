# --------------------------------------------------------------------------------------------
#
#	MWM - Multi Web Manager
#	Sous licence Creative common	
#	Under Creative Common licence	CC-by-nc-sa (http:#creativecommons.org)
#	CC by = Attribution; CC NC = Non commercial; CC SA = Share Alike
#
#	(c)Faust MARIA DE AREVALO faust@multiweb-manager.net
#
# --------------------------------------------------------------------------------------------

echo "Document de coeur/n"
cd document
rm -rf core_documents
ln -s ../../00_mwm_base/document/ core_documents

echo "Suppression des fichiers/n"
cd ../script/
rm -rf 05m00_groupes.scr
rm -rf 07m00_assignement_utilisateurs.scr
rm -rf 08m00_bouclage.scr
rm -rf 09m00_article_config.scr
rm -rf 10m00_modules.scr
rm -rf 12m00_articles_01_fra_pack_critique.scr
rm -rf 12m00_articles_02_eng_pack_critique.scr
rm -rf 12m01_articles_01_eng_pack_outils.scr
rm -rf 12m01_articles_01_fra_pack_outils.scr

echo "Creation des symlinks/n"
ln -s ../../00_Hydre/script/05m00_groupes.scr						05m00_groupes.scr
ln -s ../../00_Hydre/script/07m00_assignement_utilisateurs.scr		07m00_assignement_utilisateurs.scr
ln -s ../../00_Hydre/script/08m00_bouclage.scr						08m00_bouclage.scr
ln -s ../../00_Hydre/script/09m00_article_config.scr				09m00_article_config.scr
ln -s ../../00_Hydre/script/10m00_modules.scr						10m00_modules.scr
ln -s ../../00_Hydre/script/12m00_articles_01_fra_pack_critique.scr 12m00_articles_01_fra_pack_critique.scr
ln -s ../../00_Hydre/script/12m00_articles_02_eng_pack_critique.scr 12m00_articles_02_eng_pack_critique.scr
ln -s ../../00_Hydre/script/12m01_articles_01_eng_pack_outils.scr	12m01_articles_01_eng_pack_outils.scr
ln -s ../../00_Hydre/script/12m01_articles_01_fra_pack_outils.scr	12m01_articles_01_fra_pack_outils.scr

ln -s ../../00_Hydre/script/13m00_menus_admin.scr					13m00_menus_admin.scr

