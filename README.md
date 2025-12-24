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
