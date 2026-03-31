@echo off
chcp 65001 >nul 

:: ==========================================
:: 1. CONFIGURATION
:: ==========================================
set "PROJET_DIR=C:\Users\59014-18-04\Documents\Big Project"
set "BACKUP_DIR=C:\Users\59014-18-04\Documents\backup Big project"
set "BRANCHE=main"

cd /d "%PROJET_DIR%"

:: ==========================================
:: 2. SAUVEGARDE DES MODIFICATIONS (AUTO-COMMIT)
:: ==========================================
echo [1/4] Validation des modifications en cours...
:: Ajoute toutes tes nouvelles modifications
git add .
:: Crée un nouveau point de restauration Git (indispensable pour que le hash change)
git commit -m "Auto-backup et push"

:: ==========================================
:: 3. CAPTURE DE L'ÉTAT LOCAL (AVANT PUSH)
:: ==========================================
echo [2/4] Preparation des variables...
for /f "delims=" %%i in ('git log -1 --format^="%%cd" --date^=format:"%%Y-%%m-%%d_%%H-%%M-%%S"') do set "TIMESTAMP=%%i"
for /f "delims=" %%j in ('git rev-parse --short HEAD') do set "HASH=%%j"

set "NOM_FICHIER=pre-push_%TIMESTAMP%_%HASH%.zip"
set "CHEMIN_ZIP=%BACKUP_DIR%\%NOM_FICHIER%"

:: ==========================================
:: 4. CRÉATION DU BACKUP HISTORIQUE
:: ==========================================
echo [3/4] Creation de l'archive ZIP...
if not exist "%BACKUP_DIR%" mkdir "%BACKUP_DIR%"

git archive --format=zip --output="%CHEMIN_ZIP%" HEAD
echo - Backup fige : %NOM_FICHIER%

:: ==========================================
:: 5. ENVOI VERS LE DÉPÔT DISTANT (PUSH)
:: ==========================================
echo [4/4] Envoi vers le serveur distant (git push)...
git push origin %BRANCHE%

echo.
echo ===================================================
echo [SUCCES] Modifications detectees, archivees et envoyees !
echo ===================================================
pause