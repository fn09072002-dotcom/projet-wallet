<?php
require 'validator.php';
require 'repository.php';

function creerWallet(&$wallets, $client, $telephone, $code, $solde) {
    
    // Vérifier champs obligatoires
    if (empty($client) || empty($telephone) || empty($code)) {
        return "Tous les champs sont obligatoires !";
    }

    // Vérifier longueur téléphone
    if (!validerLongueur($telephone, 9)) {
        return "Le téléphone doit avoir exactement 9 chiffres !";
    }

    // Vérifier préfixe
    if (!validerPrefixe($telephone)) {
        return "Format téléphone invalide !";
    }

    // Vérifier longueur code
    if (!validerLongueur($code, 4)) {
        return "Le code doit avoir exactement 4 caractères !";
    }

    // Vérifier solde
    if (!validerSolde($solde)) {
        return "Le solde initial doit être positif ou nul !";
    }

    // Vérifier unicité
    $unicite = validerUnicite($wallets, $telephone, $code);
    if ($unicite === 2) return "Ce numéro existe déjà !";
    if ($unicite === 3) return "Ce code existe déjà !";

    // Ajouter le wallet
    ajouterWallet($wallets, [$client, $telephone, $code, $solde]);

    return "Wallet créé avec succès pour $client !";
}

function calculerFrais($montant) {
    if ($montant <= 10000) {
        return 200;
    } elseif ($montant <= 100000) {
        return 500;
    } else {
        $frais = $montant * 0.01;
        return $frais > 5000 ? 5000 : $frais;
    }
}

function faireDepot(&$wallets, &$transactions, $telephone, $montant) {

    // Vérifier existence wallet
    $index = trouverWallet($wallets, $telephone);
    if ($index === -1) {
        return "Aucun wallet trouvé pour ce numéro !";
    }

    // Vérifier montant
    if (!validerMontant($montant)) {
        return "Le montant doit être strictement positif !";
    }

    // Mettre à jour solde
    mettreAJourSolde($wallets, $index, $montant);

    // Enregistrer transaction
    ajouterTransaction($transactions, ["Dépôt", $telephone, $montant, 0]);

    return "Dépôt de {$montant} CFA effectué !\nNouveau solde : {$wallets[$index][3]} CFA";
}

function faireRetrait(&$wallets, &$transactions, $telephone, $montant) {

    // Vérifier existence wallet
    $index = trouverWallet($wallets, $telephone);
    if ($index === -1) {
        return "Aucun wallet trouvé pour ce numéro !";
    }

    // Vérifier montant
    if (!validerMontant($montant)) {
        return "Le montant doit être strictement positif !";
    }

    // Calculer frais
    $frais = calculerFrais($montant);
    $totalDebite = $montant + $frais;

    // Vérifier solde suffisant
   
    if (!validerSoldeDisponible($wallets[$index][3], $totalDebite)) {
        return "Solde insuffisant !\nSolde actuel : {$wallets[$index][3]} CFA\nTotal à débiter : {$totalDebite} CFA";
    }

    // Mettre à jour solde
    mettreAJourSolde($wallets, $index, -$totalDebite);

    // Enregistrer transaction
    ajouterTransaction($transactions, ["Retrait", $telephone, $montant, $frais]);

    return "Retrait de {$montant} CFA effectué !\nFrais : {$frais} CFA\nTotal débité : {$totalDebite} CFA\nNouveau solde : {$wallets[$index][3]} CFA";
}
function listerTransactions($transactions, $telephone = null) {
    if (empty($transactions)) {
        return "Aucune transaction enregistrée !";
    }

    $affichage = "\n=== Historique des Transactions ===\n";
    foreach ($transactions as $i => $transaction) {
        // Si téléphone spécifié, filtrer
        if ($telephone !== null && $transaction[1] !== $telephone) {
            continue;
        }
        $affichage .= "\n-- Transaction " . ($i + 1) . " --\n";
        $affichage .= "Type      : {$transaction[0]}\n";
        $affichage .= "Téléphone : {$transaction[1]}\n";
        $affichage .= "Montant   : {$transaction[2]} CFA\n";
        $affichage .= "Frais     : {$transaction[3]} CFA\n";
    }
    return $affichage;
}