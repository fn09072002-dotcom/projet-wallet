<?php
function afficherMenu() {
    echo "\n** Menu Distributeur **\n";
    echo "1 - Créer Wallet\n";
    echo "2 - Faire Dépôt\n";
    echo "3 - Faire Retrait\n";
    echo "4 - Lister les Transactions\n";
    echo "0 - Quitter\n";
}

function traiterChoix($choix) {
    switch ($choix) {
        case "1": break;
        case "2": break;
        case "3": break;
        case "4": break;
        case "0": echo "Au revoir !\n"; break;
        default: echo "Choix invalide, veuillez réessayer\n";
    }
}