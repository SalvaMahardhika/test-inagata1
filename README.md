#Inventory API (Laravel 11)

RESTful API untuk manajemen inventory produk berbasis Laravel 11.
Project ini dibuat untuk memenuhi technical test magang inagata (Backend Developer).

---

## 📌 Features

* 🔐 JWT Authentication (Login & Register)
* 👤 Role-based Access (Admin & User)
* 📦 CRUD Products
* 🗂️ CRUD Categories
* 🔍 Search Product (by name & category)
* 📊 Update Stock
* 💰 Inventory Total Value
* 🏷️ Discount System (per product)

---

## 🛠️ Tech Stack

* Laravel 11
* MySQL
* JWT Auth (tymon/jwt-auth)
* Postman (API Testing)

---

## ⚙️ Installation

1. Clone repository

```bash
git clone https://github.com/SalvaMahardhika/test-inagata1.git
cd test-inagata1
```

2. Install dependencies

```bash
composer install
```

3. Copy file .env

```bash
cp .env.example .env
```

4. Setup database

```env
DB_DATABASE=inventory_db
DB_USERNAME=root
DB_PASSWORD=
```

5. Generate key

```bash
php artisan key:generate
```

6. Generate JWT secret

```bash
php artisan jwt:secret
```

7. Migrate database

```bash
php artisan migrate
```

8. Run server

```bash
php artisan serve
```

---

## 🔐 Authentication

Gunakan JWT Token untuk mengakses endpoint tertentu.

### Login

```http
POST /api/login
```

Response:

```json
{
  "access_token": "your_token",
  "token_type": "Bearer"
}
```

Gunakan token di header:

```http
Authorization: Bearer your_token
```

---

## 📚 API Endpoints

### 🔑 Auth

| Method | Endpoint      | Description   |
| ------ | ------------- | ------------- |
| POST   | /api/register | Register user |
| POST   | /api/login    | Login user    |

---

### 📦 Products

| Method | Endpoint           | Access |
| ------ | ------------------ | ------ |
| GET    | /api/products      | Auth   |
| GET    | /api/products/{id} | Auth   |
| POST   | /api/products      | Admin  |
| PUT    | /api/products/{id} | Admin  |
| DELETE | /api/products/{id} | Admin  |

---

### 🗂️ Categories

| Method | Endpoint        | Access |
| ------ | --------------- | ------ |
| GET    | /api/categories | Auth   |
| POST   | /api/categories | Admin  |

---

# API Testing Guide (Postman)

Base URL:

```http
http://127.0.0.1:8000/api
```

---

# 1. AUTHENTICATION

## 🔹 Register

```http
POST /api/register
```

Body:

```json
{
  "name": "Admin",
  "email": "admin@gmail.com",
  "password": "123456"
}
```

---

## Login

```http
POST /api/login
```

Body:

```json
{
  "email": "admin@gmail.com",
  "password": "123456"
}
```

Response:

```json
{
  "access_token": "your_token"
}
```

 Gunakan token ini untuk endpoint protected:

```http
Authorization: Bearer your_token
```

---

#  2. CATEGORY

## Create Category (Admin)

```http
POST /api/categories
```

Body:

```json
{
  "name": "Electronics"
}
```

---

##Get All Categories

```http
GET /api/categories
```

---

# 3. PRODUCTS

## Create Product (Admin)

```http
POST /api/products
```

Body:

```json
{
  "name": "Asus TUF A14",
  "price": 20000000,
  "stock_quantity": 10,
  "category_id": 1
}
```

---

## Get All Products

```http
GET /api/products
```

---

## Get Product by ID

```http
GET /api/products/1
```

---

## Update Product (Admin)

```http
PUT /api/products/1
```

Body:

```json
{
  "name": "Asus TUF Updated",
  "price": 21000000,
  "stock_quantity": 15,
  "category_id": 1
}
```

---

## Delete Product (Admin)

```http
DELETE /api/products/1
```

---

# 4. SEARCH PRODUCT

```http
GET /api/products/search?name=asus&category_id=1
```

 Bisa juga:

```http
GET /api/products/search?name=asus
```

---

# 5. UPDATE STOCK

```http
POST /api/products/update-stock
```

Body:

```json
{
  "product_id": 1,
  "stock_quantity": 50
}
```

---

# 6. INVENTORY TOTAL VALUE

```http
GET /api/inventory/value
```

Response:

```json
{
  "total_value": 100000000
}
```

---

# 7. DISCOUNT SYSTEM

## Apply Discount (Admin)

```http
POST /api/products/set-discount
```

Body:

```json
{
  "product_id": 1,
  "discount": 50
}
```

---

## Remove Discount (Admin)

```http
POST /api/products/remove-discount
```

Body:

```json
{
  "product_id": 1
}
```

---

## Check Final Price

```http
GET /api/products/1
```

Response:

```json
{
  "price": 20000000,
  "discount": 50,
  "final_price": 10000000
}
```

---

# NOTES

* Endpoint tertentu membutuhkan login (JWT)
* Gunakan header:

```http
Authorization: Bearer token
```

* Endpoint admin hanya bisa diakses oleh user dengan role admin

---

# TEST FLOW RECOMMENDED

1. Register
2. Login
3. Create Category
4. Create Product
5. Get Products
6. Update Product
7. Search Product
8. Update Stock
9. Apply Discount
10. Check Inventory Value
11. Delete Product

---

# STATUS

All endpoints tested and working ✔️


## Business Logic

* Harga produk tidak diubah langsung saat diskon diterapkan
* Harga akhir dihitung menggunakan accessor:

```php
final_price = price - (price * discount / 100)
```

---


## 📌 Notes

* Endpoint tertentu hanya bisa diakses oleh admin
* Gunakan JWT Token untuk autentikasi
* Project ini fokus pada backend API (tanpa frontend)

---

## 👨‍💻 Author

**Salva Mahardhika Pratama**
Backend Developer (Laravel Enthusiast)

---

## 🎯 Status

✅ Completed
🚀 Ready for submission
