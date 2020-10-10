# Puppeteer-Bing-Scraper (Simple scraper Bing avec Puppeteer + PHP)
Petit script pour scraper les résultats de Bing Search avec Puppeteer et un rendu avec un bout de php.

## Prérequis
- NodeJS (https://nodejs.org/en/)

## Installation

```bash
npm install
composer install
```

## Utilisation
- Le fichier ***bing.php*** affiche une liste du classement sur une requête de Bing avec une capture de la SERP.
Pour changer de requête, il faut modifier le fichier ***bing.js***
```javascript
page.keyboard.type('seo');
```
- Lancer la commande suivante pour scraper.
```bash 
node bing.js
```
## Note
Depot pour un usage de présentation sommaire de Puppeteer.

