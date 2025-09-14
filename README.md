# 🛍️ SimpleWear E-Commerce Platform

A Laravel-based e-commerce web application where customers can browse, search, and purchase clothing for men and women, while admins manage products and orders.

---

## 🚀 Features

### Customers
- Register/Login with Laravel Breeze authentication
- Browse **Men** and **Women** categories
- Global **search bar** for products
- Add items to **cart** and checkout securely
- View **order history** and profile (update name, password)
- Responsive layout (mobile & desktop)

### Admin
- Secure **admin login** (role-based authorization)
- Add, edit, delete products with images
- Products auto-grouped by **men/women**
- Manage orders (view details, customer info, update status)
- Dashboard with quick stats (sales, orders, pending, products)

### Common
- Fully functional **navigation bar** and **footer**
- Informative pages: About Us, Contact (with working form), Privacy Policy, Terms
- Newsletter subscription form in footer
- Logout always redirects to **Home Page**

---

## 🗄️ Database Schema

Main tables:
- `users` → authentication, role (`is_admin`)
- `products` → name, price, gender, stock, image
- `orders` → customer details, status, total
- `order_items` → product + quantity per order

---

## 🛠️ Installation Guide

### Requirements
- PHP >= 8.0
- Composer
- Node.js & NPM
- MySQL + phpMyAdmin

### Setup Steps
1. Clone repo:
   ```bash
   git clone https://github.com/your-username/simplewear.git
   cd simplewear
