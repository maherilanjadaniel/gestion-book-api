# 📚 API de gestion de livres en Laravel 10 

Une API REST construite avec **Laravel 10**, appliquant les bonnes pratiques :
- **FormRequest** pour la validation
- **Resource** pour un formatage JSON propre
- **Service Layer** pour isoler la logique métier
- **Docker** pour un déploiement facile

---

## 🚀 Lancer le projet avec Docker

### 1️⃣ Prérequis

Docker installé

Docker Compose installé

### 2️⃣ Lancer les containers
```bash
docker-compose up -d --build

```
### 3️⃣ Installer les dépendances dans le container
```bash
docker-compose exec app composer install
docker-compose exec app cp .env.exemple .env
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate

```

## 📌 Endpoints de l'API Books

| Méthode | URL               | Corps de requête (JSON)                                                                 | Réponse attendue |
|---------|-------------------|----------------------------------------------------------------------------------------|------------------|
| GET     | `/api/books`      | *(aucun)*                                                                              | Liste tous les livres |
| POST    | `/api/books`      | `{ "title": "Nom", "author": "Auteur", "summary": "Texte", "published_year": 2024 }`| Crée un nouveau livre |
| GET     | `/api/books/{id}` | *(aucun)*                                                                              | Détails d’un livre |
| PUT     | `/api/books/{id}` | `{ "title": "Nom modifié" }`                                                            | Met à jour un livre |
| DELETE  | `/api/books/{id}` | *(aucun)*                                                                              | Supprime un livre |

---

### 📍 Exemple création d'un livre
**Requête**
```http
POST /api/books
Content-Type: application/json

{
    "title": "Le Petit Prince",
    "author": "Antoine de Saint-Exupéry",
    "description": "Conte poétique et philosophique",
    "published_year": 1943
}
```