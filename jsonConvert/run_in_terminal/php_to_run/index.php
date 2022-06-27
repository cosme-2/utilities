<?php
require 'vendor/autoload.php';

/*
to run this file in mac os terminal:
1) - create folders "json", "jsonOriginal" and "templates" in path "Users/YOUR_CURRENT_USER/"
2) - put in "jsonOriginal" yours json file wich you would like to transforme;
3) - put in "templates" your twig templates used to transformation;
4) - open mac os terminal and run this:
    php -f /Applications/MAMP/htdocs/1.Work/COSMpaquet_local_cosmeConvert/index1.php
5) - your transformed json file will appear in "json" folder;
*/

// load twig templates
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, ['cache' => false, 'debug' => true, ]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

/* utiliser lors du travail en local */
$project = "json_file_name_here";
$testfile = "jsonOriginal/{$project}.json";
$destfile = "jsonConverted/{$project}.json"; // utile? le fichier se crée à nouveau à chaque fois, non?

//get json
$str = file_get_contents($testfile);
ini_set('memory_limit', '9000M'); // this setting is neccaissary to run this php file in terminal and overpass memory limit for large json files
$data = json_decode($str, true); // decode the JSON into an associative array

//met en forme le json après récupération du twig
function prettyPrint( $json )
{
    $result = '';
    $level = 0;
    $in_quotes = false;
    $in_escape = false;
    $ends_line_level = NULL;
    $json_length = strlen( $json );

    for( $i = 0; $i < $json_length; $i++ ) {
        $char = $json[$i];
        $new_line_level = NULL;
        $post = "";
        if( $ends_line_level !== NULL ) {
            $new_line_level = $ends_line_level;
            $ends_line_level = NULL;
        }
        if ( $in_escape ) {
            $in_escape = false;
        } else if( $char === '"' ) {
            $in_quotes = !$in_quotes;
        } else if( ! $in_quotes ) {
            switch( $char ) {
                case '}': case ']':
                    $level--;
                    $ends_line_level = NULL;
                    $new_line_level = $level;
                    break;

                case '{': case '[':
                    $level++;
                case ',':
                    $ends_line_level = $level;
                    break;

                case ':':
                    $post = " ";
                    break;

                case " ": case "\t": case "\n": case "\r":
                    $char = "";
                    $ends_line_level = $new_line_level;
                    $new_line_level = NULL;
                    break;
            }
        } else if ( $char === '\\' ) {
            $in_escape = true;
        }
        if( $new_line_level !== NULL ) {
            $result .= "\n".str_repeat( "\t", $new_line_level );
        }
        $result .= $char.$post;
    }

    return $result;
}


    $content = $twig->render('results-json.html.twig', ['dataset' => $data]); // $data est injectée avec 'dataset' => $data dans le twig

    // on encode le contenu json obtenu pour "prettifier" le resultat final (en pratique, le contenu n'est plus minifié en une seule ligne, mais formaté de façon lisible)
    //$info = str_replace(array("\t","\n", "\r"), "", $content);
    //$contentEncoded = json_encode($info, JSON_PRETTY_PRINT);


    // on crée un nouveau fichier et on y ajoute le contenu encodé
    $fichier = fopen($destfile, 'w');
    fwrite($fichier, prettyPrint($content));
    echo "Le fichier JSON a été transformé avec succès.";

  ?>
