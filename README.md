# LnT BE Final Project 🏢

Welcome to the **LnT BE Final Project**! This application includes various features such as CRUD, product catalog, dashboard, invoices, user authentication, and more. All core functionalities are accessible to users and admins based on their roles.

<br>

## 🛠️ Key Features

- **Authentication**: Users can log in, register, and log out.
- **Product Catalog**: Users can view the available product catalog.
- **Shopping Cart**: Users can add, update, and remove products in their cart.
- **Checkout and Invoices**: Users can proceed to checkout and generate invoices.
- **Admin Dashboard**: Admins can manage products by adding, editing, and deleting them.
- **Database Seeder**: The application comes with a seeder to help populate the database with initial data.

## 💻 Technologies Used

- **Backend**: Laravel
- **Database**: MySQL
- **Authentication**: Laravel Authentication
- **Seeding**: Laravel Database Seeder

## 🎯 How to Use

- Run the Laravel server on your local machine.
- Access the application via `http://localhost:8000`.
- Users can log in and register to access features like the product catalog, shopping cart, and invoices.
- Admins can manage products via the admin dashboard.

## 🔧 Installation

Follow these steps to set up the project on your local machine:

1. Clone the repository:
   ```bash
   git clone https://github.com/Kezota/LnT_FinalProject_BE.git
   ```
2. Navigate to the project directory:
   ```bash
   cd LnT_FinalProject_BE
   ```
3. Install necessary dependencies:
   ```bash
   composer install
   ```
4. Copy `.env.example` to `.env`:
   ```bash
   cp .env.example .env
   ```
5. Generate the application key:
   ```bash
   php artisan key:generate
   ```
6. Run the migrations: If you need to create the database tables, run the migration command:
   ```bash
   php artisan migrate
   ```
7. Seed the database (optional, to add initial data):
   ```bash
   php artisan db:seed
   ```
8. Create a symbolic link for storage:
   ```bash
   php artisan storage:link
   ```
9. Run the Laravel server:
   ```bash
   php artisan serve
   ```
10. Access the application at `http://localhost:8000` in your browser.


## 🔒 Application Routes

### Authentication Routes
- **Login**: `/login` (POST)
- **Register**: `/register` (POST)
- **Logout**: `/logout` (POST)

### User Routes
- **Product Catalog**: `/user/catalog`  
- **Invoice History**: `/user/history`
- **Checkout**: `/user/checkout`
- **Shopping Cart**: `/user/cart`  
  - Add to Cart: `/cart/add` (POST)  
  - Update Cart: `/cart/update` (POST)
- **Invoice Management**: 
  - View Invoice: `/user/invoice`  
  - View Specific Invoice: `/user/invoice/{invoiceNumber}`  
  - Generate Invoice: `/user/generate-invoice` (POST)

### Admin Routes
- **Admin Dashboard**: `/admin/dashboard`
- **Product Management**:
  - Add Product: `/admin/add-product` (GET & POST)
  - Edit Product: `/admin/edit-product/{id}` (GET & POST)
  - Update Product: `/admin/update-product/{id}` (POST)
  - Delete Product: `/admin/delete-product/{id}` (DELETE)


## 👏 Credits

This project was built was crafted with care by [Kezota](https://github.com/kezota).

## 🤝 Contributing

If you'd like to contribute to the development of this project, feel free to fork the repository and submit a pull request. Contributions are always welcome!
