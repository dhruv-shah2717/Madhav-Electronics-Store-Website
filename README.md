<<<<<<< HEAD
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
=======
<h1>About the Project</h1>
<p>
This is a web-based eCommerce application developed using modern web technologies.
The system supports three types of users: <strong>Admin</strong>, <strong>Normal User</strong>, and <strong>First-Time User</strong>.
Users can register, log in, manage their profiles, browse products, add items to the cart, and purchase products online.
This version of the project uses <strong>MongoDB</strong> as the database and includes additional features such as
<strong>order invoice download</strong> and <strong>advanced product searching and sorting</strong>.
The Admin panel allows complete control over products, users, orders, and website management.
</p>

<h1>User Types</h1>
<ul>
    <li><strong>Admin:</strong> Manages the entire system including products, users, orders, discounts, and invoices.</li>
    <li><strong>Normal User:</strong> Registered users who can purchase products, manage carts, download invoices, and track orders.</li>
    <li><strong>First-Time User:</strong> New visitors who can browse products and register to make purchases.</li>
</ul>

<h1>Project Functionality</h1>

<h2>User Features</h2>
<ul>
    <li>User Registration and Login</li>
    <li>Edit and Manage User Profile</li>
    <li>Search Products</li>
    <li>Sort Products by Price, Name, or Category</li>
    <li>View Product Details</li>
    <li>Add Products to Cart</li>
    <li>Buy Products (Buy Now Option)</li>
    <li>Apply Discount Coupons</li>
    <li>View Order History</li>
    <li>Download Order Invoice (PDF)</li>
    <li>Add Product Reviews and Ratings</li>
</ul>

<h2>Admin Panel Features</h2>
<ul>
    <li>Admin Login</li>
    <li>Dashboard Overview</li>
    <li>Add, Edit, and Delete Products</li>
    <li>Manage Product Categories</li>
    <li>Manage Users</li>
    <li>View and Manage Orders</li>
    <li>Generate and Manage Order Invoices</li>
    <li>Manage Discount Coupons</li>
    <li>Manage Product Reviews</li>
</ul>

<h1>Technologies Used</h1>
<ul>
    <li><strong>Frontend:</strong> HTML, CSS, JavaScript, Bootstrap</li>
    <li><strong>Backend:</strong> PHP, Laravel Framework</li>
    <li><strong>Database:</strong> MongoDB</li>
    <li><strong>Tools:</strong> Composer, XAMPP / Laragon</li>
</ul>

<h1>What Changes Have Been Made</h1>
<ul>
    <li>Integrated <strong>MongoDB</strong> as the primary database.</li>
    <li>Updated environment configuration for MongoDB connection.</li>
    <li>Renamed <strong>.env.example</strong> to <strong>.env</strong> and add the email credentials, Razorpay Key, and Secret Key.</li>
    <li>Installed Laravel dependencies using <strong>composer install</strong>.</li>
    <li>Generated the application key using <strong>php artisan key:generate</strong>.</li>
</ul>

<h1>How to Run the Project</h1>
<ul>
    <li>Install <strong>XAMPP</strong> or <strong>Laragon</strong>.</li>
    <li>Install and start <strong>MongoDB</strong> service.</li>
    <li>Place the project folder inside:
        <ul>
            <li>XAMPP: <strong>C:\xampp\htdocs\</strong></li>
            <li>Laragon: <strong>C:\Laragon\www\</strong></li>
        </ul>
    </li>
    <li>Start <strong>Apache</strong>.</li>
    <li>Open browser and visit:
        <strong>http://localhost/project-folder</strong>
    </li>
</ul>

<h1>Database Setup</h1>
<ul>
    <li>Ensure <strong>MongoDB</strong> service is running.</li>
    <li>Configure MongoDB connection details in the <strong>.env</strong> file.</li>
    <li>Collections will be created automatically when the application runs.</li>
</ul>

<h1>Requirements</h1>
<ul>
    <li>PHP 8.x</li>
    <li>Composer</li>
    <li>MongoDB</li>
    <li>XAMPP or Laragon</li>
</ul>
>>>>>>> b111020f510b9963d974f0bdd3e8da6a3a2a601a
