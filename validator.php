<?php
namespace Wallet\Validator;

function validerLongueur($valeur, $longueur) {
    return strlen($valeur) === $longueur;
}

function validerPrefixe($telephone) {
    $prefixes = ["77", "78", "76", "70", "75"];
    foreach ($prefixes as $prefix) {
        if (substr($telephone, 0, 2) === $prefix) {
            return true;
        }
    }
    return false;
}

function validerUnicite(&$wallets, $telephone, $code) {
    foreach ($wallets as $wallet) {
        if ($wallet[1] === $telephone) return 2;
        if ($wallet[2] === $code) return 3;
    }
    return -1;
}

function validerMontant($montant) {
    return $montant > 0;
}

function validerSolde($solde) {
    return $solde >= 0;
}
function validerSoldeDisponible($solde, $totalDebite) {
    return $solde >= $totalDebite;
}