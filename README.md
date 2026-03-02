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

### ⚡ Special Features

#### 🔍 Search Product

```http
GET /api/products/search?name=asus&category_id=1
```

#### 📊 Update Stock

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

#### 💰 Inventory Total Value

```http
GET /api/inventory/value
```

---

#### 🏷️ Apply Discount

```http
POST /api/products/{id}/discount
```

Body:

```json
{
  "discount": 50
}
```

---

## 🧠 Business Logic

* Harga produk tidak diubah langsung saat diskon diterapkan
* Harga akhir dihitung menggunakan accessor:

```php
final_price = price - (price * discount / 100)
```

---

## 🧪 API Testing

Gunakan Postman untuk testing API.

Import file collection:

```
/docs/postman_collection.json
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
