# FrameWorkE1

Framework PHP léger développé dans le cadre des cours à Estiam Bourges.

Il repose sur une architecture **MVC** avec :
- un routage dynamique,
- une interaction automatique avec la base de données,
- des contrôleurs appelés directement via l’URL,
- des helpers pour les vues et l’intégration de templates (ex. `header`, `footer`).

---

## ⚙️ Fonctionnalités

- **Architecture MVC** : séparation claire entre les modèles, les vues et les contrôleurs.
- **Routage automatique** : les URLs appellent directement les méthodes des contrôleurs.
- **Interaction base de données** : les modèles définissent les champs, la table et les relations externes. Les requêtes SQL sont générées dynamiquement.
- **Helpers & templates** : inclusion facile de composants réutilisables dans les vues.
- **Organisation modulaire** : chargement automatique des modèles, passage de variables aux vues via `set()`.

---

## 📁 Structure
```text
FrameWorkE1/
├── core/ # Composants du framework (Controller, Model, Router...)
├── public/ # Point d’entrée (index.php)
├── src/
│ ├── controllers/ # Contrôleurs appelés via URL
│ ├── models/ # Modèles liés aux tables de la base de données
│ ├── views/ # Fichiers de vues + templates
│ └── helpers/ # Fonctions réutilisables
├── config.php # Connexion à la base de données
└── .htaccess # Réécriture d’URL pour Apache
```

## 🛠️ Utilisation

- Place le projet dans un environnement Apache avec mod_rewrite activé.
- Configure les informations de connexion dans `config.php`.
- Les routes de type `/controller/method/param` appellent automatiquement la méthode correspondante du contrôleur.

---

## 📄 Licence

Projet sous licence MIT.  
Utilisation libre à des fins pédagogiques ou personnelles.