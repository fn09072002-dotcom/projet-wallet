<?php

$wallets = [];
$transactions = [];

function ajouterWallet(&$wallets, $wallet) {
    $wallets[] = $wallet;
}

function trouverWallet(&$wallets, $telephone) {
    foreach ($wallets as $index => $wallet) {
        if ($wallet[1] === $telephone) {
            return $index;
        }
    }
    return -1;
}

function mettreAJourSolde(&$wallets, $index, $montant) {
    $wallets[$index][3] += $montant;
}

function ajouterTransaction(&$transactions, $transaction) {
    $transactions[] = $transaction;
}

function getTransactions($transactions) {
    return $transactions;
}