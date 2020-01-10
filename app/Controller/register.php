<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: plogin");
}

include "../resource/register.html";
