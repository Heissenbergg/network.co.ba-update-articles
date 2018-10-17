<?php
require_once 'class/db.php';
session_destroy();

Redirect::to('index.php');
