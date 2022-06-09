<?php 

require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('templates');

$twig = new Twig_Environment($loader, [

    'cache' => false,
    'debug' => true,

]);
$twig->addExtension(new \Twig\Extension\DebugExtension());


$project = "loj22";

$testfile = "jsonOriginal/{$project}.json";
$destfile = "json/{$project}.json";
//var_dump($destfile);
//exit;

//récupere le json
$listener = new \JsonStreamingParser\Listener\CorruptedJsonListener();
$stream = fopen($testfile, 'r');
try {
    $parser = new \JsonStreamingParser\Parser($stream, $listener);
    $parser->parse();
    fclose($stream);
} catch (\Exception $e) {
    fclose($stream);
    throw $e;
}
$listener->forceEndDocument();
//get json
$data = $listener->getJson();
//var_dump($data);
//exit;

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

//calcule la longeur du fichier
$serialized = serialize($data);

$size = mb_strlen($serialized, '8bit');
//var_dump($size);
//exit;

//effectue la partition si le fichier est trop long

if ($size > 45000000) {
    $partition = true;
    $nbItems = sizeof($data);
    $chunkNb = round($nbItems / 2);
    //var_dump($nbItems);
    //var_dump($chunkNb);
    //exit;
    $chunkedArray = array_chunk($data, $chunkNb, true);
    echo "partition effectuée";
    //exit;

    for($i = 0; $i < count($chunkedArray); ++$i) {
    $content = $twig->render('results-json.html.twig', ['dataset' => $chunkedArray[$i], 'nbItems' => $nbItems, 'partition' => $partition, 'key' => $i]);
        echo "twig prêt";
        
        $fichier = fopen("json/{$project}{$i}.json", 'w');
        fwrite($fichier, prettyPrint($content));
        echo 'fichier chargé';
}

}
//si il n'y a pas de partition
else {
    $partition = false;
    $content = $twig->render('results-json.html.twig', ['dataset' => $data]);
    //var_dump($content);
    //exit;
    //header('Content-Type: application/json');
    //header('Content-Disposition: attachment; filename="'.$destfile.'"');
    $fichier = fopen($destfile, 'w');
    fwrite($fichier, prettyPrint($content));
    echo "fichier chargé";
}
  ?>