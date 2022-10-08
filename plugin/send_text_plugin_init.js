$(document).ready(function() {
    console.log("INIT SEND TEXT);
    jQuery("#writeWrapper").sendText({serverURL : "server/missive.php"});
});