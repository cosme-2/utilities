<?php

/* ==========================================================================
   FIND AND SHOW ALL JSON FILE NAMES FROM FOLDER "JSON/ORIGINALS" 
   ========================================================================== */

function find_json_file_names() {//0
    
    // create array where we will put all file names
    $fileNamesList = [];
    
    // BEGIN: loop through all files in "json/originals" folder
    foreach (glob("json/originals/*.json") as $jsonFile) { //1

        // get only name of file (without path and extention)
        $fileName = basename($jsonFile, ".json");

        // add file name in the array of all file names (need to add extention here)
        // (note: cannot use directly $fileName because it contain a full file path too!)
        $fileNamesList[] = $fileName.'.json';

    }//1
    // END: loop through all files in "json/originals" folder

    // convert array to string and separate each value by <br/> tag to line break
    $fileNamesListString = implode("<br/> ", $fileNamesList);

    // return a string with a liste of all file names
    return $fileNamesListString;
}//0

/* ==========================================================================
   DECODE HTML ENTITIES TO THEIR CORRESPONDING CHARACTERS
   ========================================================================== */

function json_file_decode() {//0

    // loop through all file in the "json/originals" folder
    foreach (glob("json/originals/*.json") as $jsonFile) { //1

        // Get file name (used below to create a new decoded file)
        $fileName = basename($jsonFile, ".json");

        // Get data from file
        $jsonData = file_get_contents($jsonFile);
        $data = json_decode($jsonData, true);

        // Check and validate json file
        $jsonValidation = json_validate($data);

        // Json file is not ok (show error message)
        if ($jsonValidation) { //1a      
            echo "<div class=\"error-message\">Le problème a été rencontré avec l'encodage du fichier \""  . $fileName . ".json\".<br/>Description du problème: <span style=\"font-weight: bold;\">". $jsonValidation ."</span><br/>Veuillez régler le problème pour terminer l'encodage.</div>";
            return;
        } //1a

        // Json file is ok (show list of encoded files and confirmation message )
        else { //1b

           // Fixe encoding and decode data
           array_walk_recursive($data, function (&$item, $key) { //2
               if (is_string($item)) { //3
                   $item = str_replace("&amp;", "&", $item); // 1. Replace &amp; by & (see explanation above)
                   $item = html_entity_decode($item); // 2. Convert HTML entities to their corresponding characters (see explanation above)
                   $item = str_replace("&#039;", "'", $item); // 3. Remove the typos "&#039;" (see explanation above)
               } //3
           }); //2

           // Setup a charset for new data (use it during developpement if want to show json in browser with right encoding)
           //header('Content-Type: application/json; Charset="UTF-8"');

           // Encode and prettify data
           $newJsonData = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

           // Create new file and put a new data in this file
           $newfile = fopen("json/decoded/{$fileName}-decoded.json", "w");
           fwrite($newfile, $newJsonData);
           fclose($newfile);
        } //1b

    } //1

    echo "<div class=\"confirmation-decoding-message\">Tous les fichiers json ont été décodés. Consultez le dossier \"json/decoded\".</div>";

}//0

/* ==========================================================================
   CHECK AND VALIDATE JSON FILE
   ========================================================================== */
// See full code and explanation here: https://stackoverflow.com/a/15198925/9481131

function json_validate($string) { //0

    // switch and check possible JSON errors
    switch (json_last_error()) { //1
        case JSON_ERROR_NONE:
            $error = ''; // JSON is valid // No error has occurred
            break;
        case JSON_ERROR_DEPTH:
            $error = 'The maximum stack depth has been exceeded.';
            break;
        case JSON_ERROR_STATE_MISMATCH:
            $error = 'Invalid or malformed JSON.';
            break;
        case JSON_ERROR_CTRL_CHAR:
            $error = 'Control character error, possibly incorrectly encoded.';
            break;
        case JSON_ERROR_SYNTAX:
            $error = 'Syntax error, malformed JSON.';
            break;
        // PHP >= 5.3.3
        case JSON_ERROR_UTF8:
            $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
            break;
        // PHP >= 5.5.0
        case JSON_ERROR_RECURSION:
            $error = 'One or more recursive references in the value to be encoded.';
            break;
        // PHP >= 5.5.0
        case JSON_ERROR_INF_OR_NAN:
            $error = 'One or more NAN or INF values in the value to be encoded.';
            break;
        case JSON_ERROR_UNSUPPORTED_TYPE:
            $error = 'A value of a type that cannot be encoded was given.';
            break;
        default:
            $error = 'Unknown JSON error occured.';
            break;
    } //1

    return $error;
} //0

?>
