<?php

    require dirname(__DIR__, 1) . '/config.php';

    $Human_ViewList_Result = $db->Human_ViewList();

    $apiResponse->ok($Human_ViewList_Result);

?>