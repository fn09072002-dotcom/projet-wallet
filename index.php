<?php
require 'controller.php';
use function Wallet\Controller\afficherMenu;
use function Wallet\Controller\traiterChoix;

do {
    afficherMenu();
    $choix = trim(readline("Votre choix : "));
    traiterChoix($choix, $wallets, $transactions);
} while ($choix !== "0");