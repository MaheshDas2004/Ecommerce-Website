<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VEYRA.co - Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }
        
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');
        
        body {
            background-color: #fff;
            color: #333;
            line-height: 1.6;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .logo {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 1px;
            color: #000;
            text-decoration: none;
        }
        
        .logo span {
            font-size: 16px;
            vertical-align: middle;
        }
        
        .nav-menu {
            display: flex;
            gap: 30px;
        }
        
        .nav-menu a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 15px;
            letter-spacing: 0.5px;
            transition: color 0.3s ease;
        }
        
        .nav-menu a:hover {
            color: #999;
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .login-btn {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 15px;
            letter-spacing: 0.5px;
        }
        
        .cart-icon {
            position: relative;
        }
        
        .cart-count {
            background-color: transparent;
            border: 1px solid #333;
            color: #333;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 500;
        }
        
        .search-icon {
            font-size: 18px;
            cursor: pointer;
        }
        
        .hero-section {
            background-color: #FFE4E1;
            padding: 60px 20px;
            text-align: center;
        }
        
        .hero-title {
            font-size: 42px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #000;
        }
        
        .hero-description {
            max-width: 800px;
            margin: 0 auto;
            color: #555;
            line-height: 1.8;
            font-size: 16px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        .section-title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
            color: #000;
        }
        
        .profile-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-bottom: 50px;
        }
        
        .profile-sidebar {
            flex: 1;
            min-width: 280px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            padding: 30px;
            height: fit-content;
        }
        
        .profile-content {
            flex: 3;
            min-width: 300px;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: #f5f5f5;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .avatar-placeholder {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-color: #ddd;
            position: relative;
        }
        
        .avatar-placeholder::after {
            content: "";
            position: absolute;
            width: 60%;
            height: 40%;
            border-radius: 50%;
            background-color: #ddd;
            top: -25%;
            left: 20%;
        }
        
        .profile-name {
            font-size: 20px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .nav-list {
            list-style: none;
        }
        
        .nav-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .nav-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: #999;
        }
        
        .chevron {
            font-size: 14px;
            transition: transform 0.3s ease;
        }
        
        .nav-link:hover .chevron {
            transform: translateX(5px);
        }
        
        .info-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .card-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #000;
            position: relative;
            padding-bottom: 10px;
        }
        
        .card-title::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background-color: #FFE4E1;
        }
        
        .info-row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }
        
        .info-label {
            width: 150px;
            font-weight: 500;
            color: #666;
            margin-right: 20px;
        }
        
        .info-value {
            flex: 1;
            min-width: 200px;
            color: #333;
        }
        
        .edit-link {
            text-decoration: none;
            color: #999;
            font-size: 14px;
            margin-left: 10px;
            transition: color 0.3s ease;
        }
        
        .edit-link:hover {
            color: #555;
        }
        
        .password-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #333;
            font-size: 14px;
            transition: color 0.3s ease;
        }
        
        .password-link:hover {
            color: #999;
        }
        
        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .orders-table th {
            text-align: left;
            padding: 15px 10px;
            font-weight: 500;
            color: #666;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .orders-table td {
            padding: 15px 10px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .orders-table tr:last-child td {
            border-bottom: none;
        }
        
        .order-id {
            font-weight: 500;
            color: #333;
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            background-color: #FFE4E1;
            color: #333;
            font-size: 12px;
            font-weight: 500;
        }
        
        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 5px;
            background-color: transparent;
            border: 1px solid #333;
            color: #333;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            background-color: #333;
            color: #fff;
        }
        
        .empty-message {
            text-align: center;
            padding: 40px 20px;
            color: #999;
        }
        
        .footer {
            background-color: #FFE4E1;
            padding: 30px 20px;
            text-align: center;
            margin-top: 50px;
        }
        
        .footer-text {
            color: #666;
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }
            
            .nav-menu {
                display: none;
            }
            
            .hero-title {
                font-size: 32px;
            }
            
            .hero-description {
                font-size: 14px;
            }
            
            .profile-container {
                flex-direction: column;
            }
            
            .profile-sidebar {
                min-width: 100%;
            }
            
            .info-label, .info-value {
                width: 100%;
                margin-bottom: 5px;
            }
            
            .orders-table th:nth-child(3),
            .orders-table td:nth-child(3) {
                display: none;
            }
        }
        
        @media (max-width: 480px) {
            .header-right {
                gap: 10px;
            }
            
            .hero-title {
                font-size: 28px;
            }
            
            .section-title {
                font-size: 24px;
            }
            
            .orders-table th:nth-child(2),
            .orders-table td:nth-child(2) {
                display: none;
            }
            
            .info-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="#" class="logo">VEYRA<span>.co</span></a>
        
        <nav class="nav-menu">
            <a href="#">HOME</a>
            <a href="#">SHOP</a>
            <a href="#">BLOG</a>
            <a href="#">CONTACT</a>
        </nav>
        
        <div class="header-right">
            <a href="#" class="login-btn">LOGIN</a>
            <div class="cart-icon">
                <div class="cart-count">(0)</div>
            </div>
            <div class="search-icon">⌕</div>
        </div>
    </header>
    
    <section class="hero-section">
        <h1 class="hero-title">My Account</h1>
        <p class="hero-description">Manage your account details, view your orders, and update your preferences all in one place.</p>
    </section>
    
    <div class="container">
        <div class="profile-container">
            <aside class="profile-sidebar">
                <div class="profile-avatar">
                    <div class="avatar-placeholder"></div>
                </div>
                
                <h2 class="profile-name">John Doe</h2>
                
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span>Account Overview</span>
                            <span class="chevron">›</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span>Orders</span>
                            <span class="chevron">›</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span>Address Book</span>
                            <span class="chevron">›</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span>Payment Methods</span>
                            <span class="chevron">›</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span>Wishlist</span>
                            <span class="chevron">›</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span>Account Settings</span>
                            <span class="chevron">›</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span>Coupons</span>
                            <span class="chevron">›</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span>Reviews & Ratings</span>
                            <span class="chevron">›</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span>Help & Support</span>
                            <span class="chevron">›</span>
                        </a>
                    </li>
                </ul>
            </aside>
            
            <main class="profile-content">
                <div class="info-card">
                    <h3 class="card-title">Profile Information</h3>
                    
                    <div class="info-row">
                        <div class="info-label">Email</div>
                        <div class="info-value">
                            john.doe@example.com
                            <a href="#" class="edit-link">Edit</a>
                        </div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Phone Number</div>
                        <div class="info-value">+1 234 567 8901</div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Date of Birth</div>
                        <div class="info-value">January 1, 1980</div>
                    </div>
                    
                    <a href="#" class="password-link">Change password</a>
                </div>
                
                <div class="info-card">
                    <h3 class="card-title">Recent Orders</h3>
                    
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="order-id">Order #12345</td>
                                <td>April 20, 2024</td>
                                <td><span class="status-badge">Processing</span></td>
                                <td><a href="#" class="btn">View Order</a></td>
                            </tr>
                            <tr>
                                <td class="order-id">Order #12345</td>
                                <td>April 20, 2024</td>
                                <td><span class="status-badge">Processing</span></td>
                                <td><a href="#" class="btn">View Order</a></td>
                            </tr>
                            <tr>
                                <td class="order-id">Order #12345</td>
                                <td>April 20, 2024</td>
                                <td><span class="status-badge">Processing</span></td>
                                <td><a href="#" class="btn">View Order</a></td>
                            </tr>
                            <tr>
                                <td class="order-id">Order #12345</td>
                                <td>April 20, 2024</td>
                                <td><span class="status-badge">Processing</span></td>
                                <td><a href="#" class="btn">View Order</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    
    <footer class="footer">
        <p class="footer-text">© 2025 VEYRA.co All Rights Reserved.</p>
    </footer>
    
    <script>
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                console.log('Navigating to:', link.querySelector('span').textContent);
            });
        });
        
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                console.log('Button clicked:', e.target.textContent);
            });
        });
        
        document.querySelector('.edit-link').addEventListener('click', (e) => {
            e.preventDefault();
            console.log('Editing profile information');
        });
        
        document.querySelector('.password-link').addEventListener('click', (e) => {
            e.preventDefault();
            console.log('Changing password');
        });
        
        // Mobile responsive menu toggle functionality could be added here
    </script>
</body>
</html>
