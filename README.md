# Product Catalog API
This is a RESTful API built with Laravel for managing a product catalog. The API provides endpoints for managing products and categories, supports API versioning, implements caching for performance optimization, and applies rate limiting for security.
# Features
CRUD operations for Products and Categories
Repository Pattern for clean architecture
API Versioning (e.g., /api/v1/products)
Caching (for product/category lists)
Rate Limiting (prevents abuse)

# Installation
1️⃣ Clone the Repository
git clone https://github.com/anushkaaddenki/ProductCatalogAPi.git
cd product-catalog-api
2️⃣ Install Dependencies
composer install
3️⃣ Set Up Environment
Rename .env.example to .env and update the database credentials:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=product_catalog
DB_USERNAME=root
DB_PASSWORD=

4️⃣Generate Application Key
php artisan key:generate

5️⃣ Run Migrations & Seed Database
php artisan migrate --seed


 # Running the API
Start the development server:
php artisan serve

# The API will be accessible at:
 🔗 http://127.0.0.1:8000/api/v1/products

# API Endpoints
# Products
GET
# /api/v1/products
Get paginated products (10 per page)
GET
# /api/v1/products/{id}
Get a specific product
POST
# /api/v1/products
Create a new product
PUT
# /api/v1/products/{id}
Update an existing product
DELETE
# /api/v1/products/{id}
Delete a product

# Categories
GET
# /api/v1/categories
Get all categories with parent-child structure



# Repository Pattern
The API uses the repository pattern for better maintainability. The repositories are located in app/Repositories.
ProductRepositoryInterface defines methods for accessing product data.
ProductRepository implements the interface and interacts with the database.


# API Versioning
API routes are prefixed with /api/v1/
  routes/api.php


 # Caching
Laravel's caching mechanism is used for frequently accessed data. The products list is cached for 60 minutes to reduce database queries.


# Rate Limiting
Rate limiting is configured using Laravel's built-in throttling middleware. The default limit is set to 60 requests per minute.



