# Version française

## Conversion des fichiers JSON selon le schéma personnel des données

Ce module permet de convertir un fichier JSON vers un autre fichier JSON formaté selon le schéma personnel. Initialement ce module a été créé pour la conversion des fichiers JSON extraits depuis la plateforme TELMA. (La première version de ce module a été proposée par M.Charbonnel). Ce module s'appuie sur le framework Symphony.

Actuellement, ce module peut être utilisé pour la conversion de n'importe quel fichier JSON selon le modèle personnel. Voici les éléments principaux de ce module:

- jsonConverted - les fichiers JSON convertis vers un nouveau modèle des données seront placés ici.
- jsonOriginal - placer ici les fichiers JSON que vous souhaitez convertir.
- templates - placer ici le template (twig) avec le nouveau modèle des données.

## Comment utiliser le module

Si possible, utilisez de préférence le terminal (plus simple avec des fichiers volumineux).

### Avec terminal

(Utilisez le contenu du dossier "run_in_terminal").

(Attention: le fichier doit être moins de 100 Mo. Si le fichier est plus grand, il doit être divisé en plusieurs parties).

Pour les utilisateurs Mac OS: Si le php est déjà installé sur la machine, il n'est pas nécessaire de placer ce module dans le dossier (http) de votre serveur ou dans le répertoire de MAMP (s’il est utilisé).

Quelques explications (pour les utilisateurs Mac OS): Les machines sous Mac OS semblent utiliser les différentes configurations pour les chemins vers les dossiers quand le fichier php est lancé dans le terminal. Dans ces cas, et pour cette raison, quand le fichier index.php est lancé dans le terminal, le framework requis (dossier "vendor") doit être dans le même fichier que le fichier index.php. En même temps, les dossiers avec les fichiers json original et convertis (dossiers “jsonConverted”, “jsonOriginal”) et le dossier avec le template twig ("templates") doit être dans le répertoire principal de l'utilisateur (chemin: "Users/YOUR_CURRENT_USER/" ). S'il y avait une configuration personnalisée de ces différents chemins sur l'ordinateur utilisé, les dossiers en question doivent être placés selon ses chemins personnalisés).

Étapes de conversion (avec terminal):

1) Mettre ces dossier dans votre répertoire de l'utilisateur (chemin: "Users/YOUR_CURRENT_USER/"):

- jsonConverted (pour les fichiers convertis, ne rien mettre à l'intérieur)
- jsonOriginal (pour les fichiers json originaux, mettre ici les fichiers qui doivent être convertis)
- php_to_run (framework "symphony" pour faire fonctionner la transformation)
- templates (template twig avec le nouveau schéma personnel de json)

2) Mettre dans le dossier “jsonOriginal” les fichiers json qui doivent être transformés.

3) Ouvrir le fichier "index.php" (qui se trouve dans le dossier "php_to_run"). Dans ce fichier, en ligne:

	$project = “json_file_name_here”;

mettre le nom du fichier json (nom sans extension .json) que vous souhaitez transformer.

4) Ouvrir le terminal et lancer cette commande:

	php -f /Users/YOUR_CURRENT_USER/php_to_run/index.php

(changer le chemin selon votre propre chemin. Ce chemin doit pointer vers le fichier index.php qui se trouve à l'intérieur du dossier "php_to_run").

5) Le dossier “jsonConverted” contiendra les nouveaux fichiers json convertis vers le schéma personnalisé.

Répétez à partir de l'étape "3" pour chaque fichier json qui doit être converti.

### Avec un navigateur web (Chrome, Firefox, Safari, etc.)

(Utilisez le contenu du dossier "run_in_browser").

(Attention: ne fonctionne pas pour les fichiers avec une taille supérieure à 30-50 Mo, car surpasse la limite de la mémoire allouée par l'ordinateur pour ce type d'opération)

1) Mettre le dossier "run_in_browser" dans le répertoire où doivent être placés les fichiers php pour être exécutés dans votre navigateur web. (Par exemple les dossiers "http" du MAMP ou du XAMP si vous les utilisez).

2) Mettre en marche votre moteur php (par exemple MAMP).

3) Mettre dans le dossier "jsonOriginal" les fichiers json qui doivent être transformés.

4) Ouvrir le fichier "index.php" (qui se trouve dans le dossier "php_to_run"). Dans ce fichier, en ligne:

	$project = “json_file_name_here”;

mettre le nom du fichier json (nom sans extension .json) que vous souhaitez transformer.

5) Dans votre navigateur web ouvrir votre espace local (localhost) et naviguer vers le dossier "run_in_browser". Le fichier "index.php" s'ouvrira automatiquement et la transformation commencera. Si la transformation est réussie, la phrase "Le fichier JSON a été transformé avec succès" s'affichera dans le navigateur. 

6) Le dossier “jsonConverted” contiendra les nouveaux fichiers json convertis vers le schéma personnalisé.

Répétez à partir de l'étape "4" pour chaque fichier json qui doit être converti.

---

# English version

## JSON file conversion according to personal data schema

This module allows to convert a JSON file to another JSON file formatted according to the personal schema. Initially this module was created for the conversion of JSON files extracted from the TELMA platform. (The first version of this module was proposed by M.Charbonnel). This module is based on the Symphony framework.

Currently, this module can be used for converting any JSON file according to the personal model. Here are the main elements of this module:

- jsonConverted - JSON files converted to a new data model will be put here.
- jsonOriginal - put here the JSON files you want to convert.
- templates - put here the template (twig) with the new data model.

## How to use this module

If possible, give preference to working with the Terminal (simpler for large files).

### In Terminal

(Caution: file must be less than 100MB. If file is bigger, split it into two or more files).

For Mac users: If you have php installed on your machine, no need to put folder “php_to_run” into MAMP directory.

Some short explanations (for Mac users): Mac machines seem to use some different configuration for a path to a folder when run php file in Terminal. For this reason, in this case, when you run index.php file, required framework files (folder “vendor”) must be in the same folder as “index.php” file. But, at the same time, the folder with json original and converted files (folders “jsonConverted”, “jsonOriginal”) and the folder with twig template (“templates”) must be in the global user main folder (path “"Users/YOUR_CURRENT_USER/“). If need, you can look into your local php configuration to set up your personal paths).

1) Put these folders in path "Users/YOUR_CURRENT_USER/"

 - jsonConverted (for transformed json files, put nothing here)
 - jsonOriginal (for original json files, put here json files you want to transform)
 - php_to_run (symphony framework to run transformation)
 - templates (twig template with a new personal json schema)

2) Put in “jsonOriginal” json files you want to transform.

3) Open file “index.php” from folder “php_to_run”. In this file, on the line:

	$project = “json_file_name_here”;

put the name of json file (without extension .json) you want to transform

4) Open terminal and run this command:

	php -f /Users/YOUR_CURRENT_USER/php_to_run/index.php

(change path according to your personal path. This path must to point to index.php file from folder “php_to_run”.)

5) In the folder “jsonConverted” you will find converted json file.

Repeat since step “3” for each json file you want to convert.

### In browser

(Caution: not work for large files - more than 30-50 MB, overpass browser memory allocation limit)

1) Put folder “run_in_browser” in the directory from where you run php files or your websites in your browser. (For example, MAMP http directory).

2) Turn on your php engine (for example, MAMP).

3) Put in “jsonOriginal” json files you want to transform.

4) Open file “index.php” from folder “run_in_browser”. In this file, on the line:
	
	$project = "json_file_name_here";

put the name of json file (without extension .json) you want to transform.

5) Open “run_in_browser” in your browser. The file “index.php” will automatically load and transformation will begin. If transformation is successful, the phrase “Le fichier JSON a été transformé avec succès” will be shown.

6) In the folder “jsonConverted” you will find converted json file.

Repeat since step “4” for each json file you want to convert.
