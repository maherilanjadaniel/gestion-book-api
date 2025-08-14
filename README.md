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

