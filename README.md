# EKBANA API Project

## Description
A Laravel-based API service for managing companies and categories. Features include:

- CRUD operations for **categories** and **companies**  
- Image upload support for companies  
- Search categories using keyword  
- Pagination (10 records per page)  
- API key authentication middleware  
- Proper handling of relationships (companies linked to categories)  

---

## Setup Instructions

1. Clone the repository:
```bash
git clone <YOUR_GITHUB_LINK>
cd <PROJECT_FOLDER>

2. Install dependencies: 
composer install

3. Copy .env.example to .env and configure database:
cp .env.example .env

4. Set the API key in .env:
API_KEY=BA673A414C3B44C98478BB5CF10A0F832574090C

5. Run migrations:
php artisan migrate

6. Serve the project:
php artisan serve

##  API Endpoints
Headers
All API requests require the header:
API_KEY: BA673A414C3B44C98478BB5CF10A0F832574090C

Category API
Method	URL	Description
GET	/api/category	List all categories (paginated 10)
GET	/api/category/{id}	Get category details + related companies
POST	/api/category	Create category
PUT	/api/category/{id}	Update category
DELETE	/api/category/{id}	Delete category
GET	/api/category?keyword=	Search categories by keyword

Company API
Method	URL	Description
GET	/api/company	List all companies (paginated 10) with category info
GET	/api/company/{id}	Get company details with category info
POST	/api/company	Create company (support image upload)
PUT	/api/company/{id}	Update company (update image if provided)
DELETE	/api/company/{id}	Delete company (image deleted if exists)


Features / Extras
Resource Responses: Used CategoryResource and CompanyResource for controlled API responses.
Category-Company Relationship: nullOnDelete() ensures companies remain even if their category is deleted.
Keyword Search: Optional query parameter for category search.
Pagination: 10 records per page; can be configured in controllers.
Middleware: API key validation for all endpoints.
Image Upload: Supports storing images in storage/app/public/companies and updating/deleting them automatically.
