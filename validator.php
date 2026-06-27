<?php
namespace Wallet\Validator;

function validerLongueur($valeur, $longueur) {
    return strlen($valeur) === $longueur;
}

function validerPrefixe($telephone) {
    $prefixes = ["77", "78", "76", "70", "75"];
    return in_array(substr($telephone, 0, 2), $prefixes);
}

function validerUnicite(&$wallets, $telephone, $code) {
    $telephones = array_column($wallets, 1);
    $codes = array_column($wallets, 2);
    if (array_search($telephone, $telephones) !== false) return 2;
    if (array_search($code, $codes) !== false) return 3;
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