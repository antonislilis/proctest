<?php

// Use an autoloader!

require 'public/dust-php-master/src/Dust/Dust.php';
require 'config/paths.php';
require 'config/database.php';
require 'libs/Database.php';
require 'libs/Bootstrap.php';
require 'libs/Controller.php';
require 'libs/Model.php';

// library

//require 'libs/Session.php';
require 'models/general_model.php';



$app = new Bootstrap();

// kanw include ola ta libs kai ola ta config