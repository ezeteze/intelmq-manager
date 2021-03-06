<?php
    
    require('config.php');
    
    if (array_key_exists($_GET['file'], $FILES)) {
        $filename = $FILES[$_GET['file']];
    }
    
    $post_contents = file_get_contents("php://input");
    
    $decoded_config = json_decode($post_contents);
    
    foreach ($decoded_config as $key => $value) {
        if(preg_match($BOT_ID_REJECT_REGEX, $key)) {
            die('Invalid bot ID');
        }
    }
    
    if(preg_match_all($BOT_CONFIGS_REJECT_REGEX, $post_contents, $matches)) {
        die('Config has invalid characters');
    }
    
    file_put_contents($filename, $post_contents);
    
?>