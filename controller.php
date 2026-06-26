<?php
require 'services.php';

function afficherMenu() {
    echo "\n** Menu Distributeur **\n";
    echo "1 - Créer Wallet\n";
    echo "2 - Faire Dépôt\n";
    echo "3 - Faire Retrait\n";
    echo "4 - Lister les Transactions\n";
    echo "0 - Quitter\n";
}

function traiterChoix($choix, &$wallets, &$transactions) {
    switch ($choix) {
        case "1":
            $client    = readline("Nom du client : ");
            $telephone = readline("Numéro de téléphone : ");
            $code      = readline("Code secret : ");
            $solde     = (float)readline("Solde initial : ");
            echo creerWallet($wallets, $client, $telephone, $code, $solde) . "\n";
            break;

        case "2":
            $telephone = readline("Numéro de téléphone : ");
            $montant   = (float)readline("Montant : ");
            echo faireDepot($wallets, $transactions, $telephone, $montant) . "\n";
            break;

        case "3":
            $telephone = readline("Numéro de téléphone : ");
            $montant   = (float)readline("Montant : ");
            echo faireRetrait($wallets, $transactions, $telephone, $montant) . "\n";
            break;
        case "4":
            $choix = readline("Tous (T) ou numéro spécifique (N) ? ");
            if (strtoupper($choix) === "N") {
                $telephone = readline("Numéro de téléphone : ");
                echo listerTransactions($transactions, $telephone) . "\n";
            } else {
                echo listerTransactions($transactions) . "\n";
            }
            break;
        case "0":
            echo "Au revoir !\n";
            break;

        default:
            echo "Choix invalide, veuillez réessayer\n";
    }
}