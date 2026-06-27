# Projet Wallet PHP Console

## Description
Application de gestion de portefeuille électronique (E-Wallet) en PHP procédural, exécutée en console.

## Architecture

projet-wallet/

├── index.php        → Point d'entrée, boucle principale

├── controller.php   → Saisies et affichage résultats

├── services.php     → Logique métier

├── repository.php   → Gestion des données

└── validator.php    → Validations

## Fonctionnalités
- Créer un wallet
- Faire un dépôt
- Faire un retrait (avec frais par paliers)
- Lister les transactions

## Frais de retrait
| Montant | Frais |
|---|---|
| 0 - 10 000 CFA | 200 CFA |
| 10 001 - 100 000 CFA | 500 CFA |
| + 100 000 CFA | 1% plafonné à 5000 CFA |

## Installation
```bash
git clone https://github.com/fn09072002-dotcom/projet-wallet.git
cd projet-wallet
php index.php
```

## Versions
- **v1.0.0** : Partie A (procédural, sans fonctions natives)
- **v2.0.0** : Partie B (fonctions natives + namespaces)