<?php
require 'controller.php';

do {
    afficherMenu();
    $choix = trim(readline("Votre choix : "));
    traiterChoix($choix, $wallets, $transactions);
} while ($choix !== "0");