@echo off
:: Force l'affichage en UTF-8 pour les accents
chcp 65001 >nul 

:: ==========================================
:: 1. CONFIGURATION (À MODIFIER SELON TES DOSSIERS)
:: ==========================================
set "PROJET_DIR=C:\Users\59014-18-04\Documents\Big Project"
set "BACKUP_DIR=C:\Users\59014-18-04\Documents\backup Big project"
set "BRANCHE=main"

:: ==========================================
:: 2. MISE À JOUR DU PROJET (GIT PULL)
:: ==========================================
echo [1/3] Mise a jour du repertoire projet...
cd /d "%PROJET_DIR%"
git pull origin %BRANCHE%

:: ==========================================
:: 3. GÉNÉRATION DES VARIABLES DE NOMMAGE
:: ==========================================
echo [2/3] Preparation du snapshot...
:: Récupère la date formatée et le hash du dernier commit via Git
for /f "delims=" %%i in ('git log -1 --format^="%%cd" --date^=format:"%%Y-%%m-%%d_%%H-%%M-%%S"') do set "TIMESTAMP=%%i"
for /f "delims=" %%j in ('git rev-parse --short HEAD') do set "HASH=%%j"

set "NOM_FICHIER=snapshot_%TIMESTAMP%_%HASH%.zip"
set "CHEMIN_ZIP=%BACKUP_DIR%\%NOM_FICHIER%"

:: ==========================================
:: 4. CRÉATION DU BACKUP HISTORIQUE
:: ==========================================
echo [3/3] Creation de l'archive de sauvegarde...
if not exist "%BACKUP_DIR%" mkdir "%BACKUP_DIR%"

:: Git archive crée un zip parfait de l'état actuel sans le dossier caché .git
git archive --format=zip --output="%CHEMIN_ZIP%" HEAD

echo.
echo ===================================================
echo [SUCCES] Historique fige dans : %CHEMIN_ZIP%
echo ===================================================
pause