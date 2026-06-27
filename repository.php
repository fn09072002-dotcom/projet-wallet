<?php
namespace Wallet\Repository;

$wallets = [];
$transactions = [];

function ajouterWallet(&$wallets, $wallet) {
    array_push($wallets, $wallet);
}

function trouverWallet(&$wallets, $telephone) {
    $telephones = array_column($wallets, 1);
    $index = array_search($telephone, $telephones);
    return $index !== false ? $index : -1;
}

function mettreAJourSolde(&$wallets, $index, $montant) {
    $wallets[$index][3] += $montant;
}

function ajouterTransaction(&$transactions, $transaction) {
    array_push($transactions, $transaction);
}