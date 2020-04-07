<?php
// Sanitize data coming in or outside the database for security

function escape($string)
{
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

