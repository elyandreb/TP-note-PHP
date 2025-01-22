# TP-note-PHP
## Informations projet
- Membres du projet : Elyandre BURET; Loris GRANDCHAMP

## Installation de l'application
### Prérequis
- **PHP** (version 7.4 ou supérieure)
- **SQLite** (version 3.0 ou supérieure)

### Étape d'installation
**Cloner le dépôt** :
```bash
git clone https://github.com/elyandreb/TP-note-PHP
```
## Lancement de l'application
Dans le terminal, exécutez la commande :
```bash
php -S localhost:8080
```
Le port peut évidemment être différent si besoin.

## Fonctionnalités obligatoires implémentées
- Organisation du code dans une arborescence cohérente
- Utilisation des namespaces
- Utilisation d’un provider pour charger le fichier JSON contenant les questions et leurs réponses
- Utilisation d'un autoloader pour charger  les classes d’objets nécessaires
- Utilisation de sessions pour stocker les réponses fournies par les utilisateurs et calculer un score
- Utilisation de classes PHP pour programmer notre application orientée objet
- Utilisation d’un contrôleur dans index.php piloté par GET['action'] 
- Utilisation de PDO avec base de données sqlite pour stocker le score et le nom du joueur

## Fonctionnalités supplémentaire
- Possibilité de voir son historique de score (questions classées des plus récentes aux plus anciennes)