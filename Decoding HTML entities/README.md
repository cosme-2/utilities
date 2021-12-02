# Version française

## Encodage des entités HTML dans les jeux de données JSON

Les données dans la base de données TELMA ne possèdent pas un système encodage standardisé. Ainsi, dans la même notice il peut exister les données encodées en “entité HTML" (par exemple `&eacute;`) et les données qui ne le sont pas (par exemple “é”, “à”, etc.). 

Ce problème semble être le plus flagrant dans le corpus “Cartulaires wallons”. De fait, il semble que les données de ce corpus peuvent faire recours à deux ou trois systèmes d'encodage différents et avoir même des erreurs dans l'encodage. Par exemple, dans la même notice le champ "analyse" peut contenir le caractère spécial “é” et le champ "description" peut contenir le signe `&amp;eacute;` (qui est, de fait, une entité HTML pour le signe "é"). On note alors que ce dernier signe `&amp;eacute;` à son tour semble être un fruit d'un double encodage. De fait, `&amp;` est la référence de caractère pour le signe "&" tandis que `&eacute;` est une entité HTML pour le caractère spécial "é". Autrement dit, le caractère spécial "é" a été d'abord encodé en entité HTML `&eacute;` dans laquelle le signe "&" a été par la suite remplacé par le caractère de référence `&amp;`. De surcroît, la même notice peut contenir l'entité `&#039;` qui n'est qu'une coquille de l'entité HTML `&#39;` pour le signe d'apostrophe (').

Pour résoudre ce type de problème, il a fallu uniformiser l'encodage de toutes les notices.

1) Pour cela la première étape a consisté dans le remplacement de toutes les références de caractère `&amp;` par "&". Cela a permis de ramener toutes les références "complexes" de type `&amp;eacute;` aux entités HTML standardisées de type `&eacute;`. 

2) Deuxième étape, a consisté dans la transformation de toutes les entités HTML en leurs caractères spéciaux respectifs. (C'est-à-dire, l'entité HTML `&eacute;`, par exemple, devient le signe spécial de la langue française "é"). À noter également que lors de ce processus de la transformation des entités HTML en leurs signes spéciaux respectifs, toutes les entités qui représentent les balises HTML ont été également transformées; par exemple, les entités `&lt;` deviennent "<", etc.

3) Enfin, il a fallu éliminer toutes les coquilles dans l'encodage en entité HTML du signe "apostrophe". Pour cela tout les `&#039;` (qui devait s'écrire alors comme `&#39;`) ont été remplacés par le singe d'apostrophe (').

## Comment utiliser le module

Mettez l'ensemble du dossier "Decoding HTML entities" sur votre serveur ou votre site web. À l'intérieur de ce dossier principal, mettez tous les fichiers JSON que vous souhaitez encoder dans le dossier "json/originals". Par le biais de votre serveur ou de votre website, faites charger le fichier index.php (il suffit de "aller" sur la page index.php sur votre navigateur internet). Les fichiers décodés apparaîtront dans le dossier "json/decoded" avec les mêmes noms que les fichiers d'origines et avec le suffixe "-decoded".

Pour plus d'information sur ce point, voir également ma question ici: https://stackoverflow.com/questions/70117478/convert-html-entities-in-json-back-to-characters?noredirect=1#comment123949878_70117478

# English version

## Encoding HTML entities in JSON datasets 

The data in the TELMA database does not have a standardized encoding system. That is, in the same record we can have a data encoded with “HTML entity” (for example `&amp;eacute;`) and data which is not (for example “é”, “à”, etc.). 

This problem seems to be the most obvious in the “Cartulaires wallons” dataset. In fact, the data in this corpus could be encoded with two or three different encoding systems and could even contain encoding errors. For example, in the same record the "analysis" field may contain the special character "é" and the "description" field may contain the sign `&amp;eacute;`. This last sign seems to be a result of a double encoding. That is, `&amp;` is the character reference for the sign "&" while `&eacute;` is an HTML entity for the special character "é". In other words, the special character "é" was first encoded as an HTML entity `&eacute;` where, after that, the sign "&" was replaced by the reference character `&amp;`. In addition, the same record may contain the entity `&#039;` which is just a misprint of the HTML entity `&#39;` for the apostrophe sign (').

To solve this type of problem, it was necessary to standardize the encoding system.

1) First, we need to replace all character references `&amp;` by "&". As a result, all the "complex" references like this `&amp;eacute;` will be make back to the standard HTML entities like `&eacute;`.

2) Second step will convert all HTML entities to their corresponding characters. (That is, HTML entities `&eacute;`, for exemple, becomes the French language special sign “é”). Also note that during this conversion, all entities that represent HTML tags will be transformed too; for example, entities `&lt;` become "<", and so on.

3) Finally, we have to eliminate all typos in the HTML entity encoding. It is particularly about the `&#039;` (this should be correctly written as `&#39;` and converted during the previous step). So all `&#039;` will be replaced by the apostrophe (').

## How to use this module

Put the whole "Decoding HTML entities" folder on your server or website. Inside this main folder, put all JSON files you want to encode in the "json/originals" folder. Through your server or your website, load the index.php file (just "go" to the index.php page on your internet browser). The decoded files will appear in the "json/decoded" folder with the same names as the original files and with the "-decoded" suffix.

For more information on this point, see also my question here: https://stackoverflow.com/questions/70117478/convert-html-entities-in-json-back-to-characters?noredirect=1#comment123949878_70117478