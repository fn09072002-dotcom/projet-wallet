<?php
require 'controller.php';

do {
    afficherMenu();
    $choix = trim(readline("Votre choix : "));
    traiterChoix($choix);
} while ($choix !== "0");