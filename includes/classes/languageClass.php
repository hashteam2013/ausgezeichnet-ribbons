<?php
function getAllActiveLangauges(){
    $query = new query('languages');
    $query->Where = " where is_active = '1'";
    return $query->ListOfAllRecords('object');
}

function createGlobalLangaugeCode(){
    $language_code = array();
    foreach(getAllActiveLangauges() as $language){
        $language_code[$language->code] = array();
        $language_file_name = DIR_FS_LANGUAGES.$language->code.'.txt';
        $language_cache_file_name = DIR_FS_LANGUAGES.$language->code.'_cache.txt';
        
        // Check if cache file exists and if source file is newer than cache
        $use_cache = false;
        if(file_exists($language_cache_file_name) && is_readable($language_cache_file_name)){
            if(file_exists($language_file_name)){
                // Check if source file is newer than cache file
                $source_mtime = filemtime($language_file_name);
                $cache_mtime = filemtime($language_cache_file_name);
                if($source_mtime <= $cache_mtime){
                    // Cache is up to date, use it
                    $cached_data = json_decode(file_get_contents($language_cache_file_name), true);
                    if(is_array($cached_data)){
                        $language_code[$language->code] = $cached_data;
                        $use_cache = true;
                    }
                }
                // If source is newer, fall through to regenerate cache
            }
        }
        
        if(!$use_cache){
            // Cache doesn't exist, is invalid, or source file is newer - regenerate from source
            if(file_exists($language_file_name)){
                $language_arr = array();
                $specific_language_file_arr = file($language_file_name, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach($specific_language_file_arr as $key => $string){
                    $string_arr = explode("~~", $string);
                    if(isset($string_arr[0]) && trim($string_arr[0])!='' && isset($string_arr[1])){
                        $language_arr[trim($string_arr[0])] = trim($string_arr[1]);
                    }
                }
                $language_code[$language->code] = $language_arr;
                // Try to create cache file, but don't die if it fails
                if(is_writable(DIR_FS_LANGUAGES)){
                    $language_cache_file_handle = @fopen($language_cache_file_name, "w");
                    if($language_cache_file_handle){
                        fwrite($language_cache_file_handle, json_encode($language_arr));
                        fclose($language_cache_file_handle);
                    }
                }
            } else{
                die($language->name ." language file missing");
            }
        }
    }
    return $language_code;
}

function getDefaultLanguageCode(){
    $query = new query('languages');
    $query->Field = "code";
    $query->Where = " where is_default = '1'";
    $object = $query->DisplayOne();
    if(is_object($object)){
        return $object->code;
    } else{
        return 'en';
    }
}

function _e($key, $return = false) {
    global $language_code,$app;
    $key = trim($key);
    $output = $key;
    if(isset($language_code[$app['language']][$key])){
        $output = $language_code[$app['language']][$key];
    } else if(isset($language_code[$app['default_language']][$key])){
        $output = $language_code[$app['default_language']][$key];
    }
    if ($return) {
        return $output;
    } else {
        echo $output;
        return "";
    }
}