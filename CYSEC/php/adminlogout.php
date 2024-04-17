<?php

session_start();

$_SESSION = array();

session_destroy();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires:".time()."");
echo '<script>
        window.onload = function() {
            if (window.history && window.history.pushState) {
                window.history.pushState("backward", null, "");
                window.onpopstate = function() {
                    window.history.pushState("backward", null, "");
                };
            }
        }
      </script>';

header("Location: ../adminlog.php?timestamp=" .time());

exit();
?>