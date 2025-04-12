<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VEYRA.co - Fashion Blog</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #fafafa;
            color: #333;
            line-height: 1.6;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }
        .logo {
            font-size: 2rem;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .logo span {
            font-size: 1rem;
            opacity: 0.8;
            vertical-align: super;
        }
        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .cart-icon {
            position: relative;
        }
        .cart-count {
            background-color: #333;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            position: absolute;
            top: -5px;
            right: -5px;
        }
        .hero {
            background-color: #fce4e4;
            padding: 60px 0;
            text-align: center;
            margin-bottom: 60px;
        }
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #222;
        }
        .hero p {
            max-width: 700px;
            margin: 0 auto;
            color: #555;
            font-size: 1.1rem;
        }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }
        .feature {
            text-align: center;
            padding: 30px 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }
        .feature:hover {
            transform: translateY(-5px);
        }
        .feature-icon {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }
        .feature h3 {
            margin-bottom: 15px;
            font-size: 1.3rem;
        }
        .feature p {
            color: #666;
            font-size: 0.95rem;
        }
        .blog-section {
            margin-bottom: 80px;
        }
        .section-title {
            text-align: center;
            margin-bottom: 40px;
            font-size: 2rem;
            position: relative;
        }
        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background-color: #fce4e4;
            margin: 15px auto 0;
        }
        .blog-posts {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 40px;
        }
        .blog-post {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s;
        }
        .blog-post:hover {
            transform: translateY(-8px);
        }
        .blog-image {
            height: 250px;
            overflow: hidden;
        }
        .blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .blog-post:hover .blog-image img {
            transform: scale(1.05);
        }
        .blog-content {
            padding: 25px;
        }
        .blog-meta {
            display: flex;
            gap: 15px;
            color: #888;
            font-size: 0.85rem;
            margin-bottom: 10px;
        }
        .blog-title {
            font-size: 1.3rem;
            margin-bottom: 12px;
            line-height: 1.4;
        }
        .blog-excerpt {
            color: #666;
            margin-bottom: 20px;
            font-size: 0.95rem;
        }
        .read-more {
            display: inline-block;
            padding: 8px 0;
            color: #333;
            font-weight: 500;
            position: relative;
        }
        .read-more::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #333;
            transition: width 0.3s;
        }
        .blog-post:hover .read-more::after {
            width: 100%;
        }
        .newsletter {
            background-color: #fce4e4;
            padding: 60px 0;
            text-align: center;
            margin-bottom: 60px;
        }
        .newsletter h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .newsletter p {
            max-width: 600px;
            margin: 0 auto 30px;
            color: #555;
        }
        .newsletter-form {
            display: flex;
            max-width: 500px;
            margin: 0 auto;
        }
        .newsletter-form input {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 4px 0 0 4px;
            font-size: 1rem;
        }
        .newsletter-form button {
            background-color: #333;
            color: white;
            border: none;
            padding: 0 25px;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        .newsletter-form button:hover {
            background-color: #222;
        }
        .categories {
            margin-bottom: 80px;
        }
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
        }
        .category-card {
            position: relative;
            height: 200px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .category-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .category-card:hover img {
            transform: scale(1.1);
        }
        .category-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
            display: flex;
            align-items: flex-end;
            padding: 20px;
        }
        .category-title {
            color: white;
            font-size: 1.3rem;
            font-weight: 500;
        }
        @media (max-width: 1024px) {
            .blog-posts {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }
        }
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            .features {
                grid-template-columns: 1fr;
            }
            .blog-posts {
                grid-template-columns: 1fr;
            }
            .newsletter-form {
                flex-direction: column;
            }
            .newsletter-form input,
            .newsletter-form button {
                width: 100%;
                border-radius: 4px;
            }
            .newsletter-form button {
                margin-top: 10px;
                padding: 15px;
            }
        }
        @media (max-width: 480px) {
            .header-content {
                padding: 15px 0;
            }
            .logo {
                font-size: 1.5rem;
            }
            .hero h1 {
                font-size: 2rem;
            }
            .hero p {
                font-size: 1rem;
            }
            .section-title {
                font-size: 1.8rem;
            }
            .blog-image {
                height: 200px;
            }
        }
    </style>
</head>
<body>
    <section class="hero">
        <div class="container">
            <h1>Fashion & Lifestyle Blog</h1>
            <p>Discover the latest trends, style tips, and fashion inspiration. From runway to everyday wear, we've got you covered with expert advice and curated collections.</p>
        </div>
    </section>
    <section class="container features">
        <div class="feature">
            <div class="feature-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
            </div>
            <h3>Weekly Updates</h3>
            <p>Get fresh content every week with our latest fashion trends, style guides, and lifestyle tips.</p>
        </div>
        <div class="feature">
            <div class="feature-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <h3>Expert Contributors</h3>
            <p>Our articles are written by fashion industry professionals with years of experience.</p>
        </div>
        <div class="feature">
            <div class="feature-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
            </div>
            <h3>Community Discussions</h3>
            <p>Join our community of fashion enthusiasts to share ideas and get inspired.</p>
        </div>
        <div class="feature">
            <div class="feature-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                    <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                </svg>
            </div>
            <h3>Trend Analytics</h3>
            <p>Stay ahead with our data-driven insights on upcoming fashion and lifestyle trends.</p>
        </div>
    </section>
    <section class="container blog-section">
        <h2 class="section-title">Latest Articles</h2>
        <div class="blog-posts">
            <div class="blog-post">
                <div class="blog-image">
                    <img src="https://images.unsplash.com/photo-1557776639-0208033c9112?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Fashion Week Highlights">
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span>April 10, 2025</span>
                        <span>Fashion</span>
                    </div>
                    <h3 class="blog-title">Spring 2025 Fashion Week Highlights: Colors and Patterns</h3>
                    <p class="blog-excerpt">Explore the standout trends from this season's runway shows, with a focus on bold color palettes and innovative pattern combinations.</p>
                    <a href="#" class="read-more">Read More</a>
                </div>
            </div>
            <div class="blog-post">
                <div class="blog-image">
                    <img src="https://plus.unsplash.com/premium_photo-1713586580802-854a58542159?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Sustainable Fashion">
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span>April 8, 2025</span>
                        <span>Sustainability</span>
                    </div>
                    <h3 class="blog-title">The Rise of Eco-Conscious Fashion Brands in 2025</h3>
                    <p class="blog-excerpt">Discover the innovative brands leading the charge in sustainable fashion with ethical practices and eco-friendly materials.</p>
                    <a href="#" class="read-more">Read More</a>
                </div>
            </div>
            <div class="blog-post">
                <div class="blog-image">
                    <img src="https://images.unsplash.com/photo-1511556820780-d912e42b4980?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Accessory Trends">
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span>April 5, 2025</span>
                        <span>Accessories</span>
                    </div>
                    <h3 class="blog-title">Statement Accessories That Will Transform Your Wardrobe</h3>
                    <p class="blog-excerpt">Learn how the right accessories can elevate even the simplest outfit, from bold jewelry to designer bags.</p>
                    <a href="#" class="read-more">Read More</a>
                </div>
            </div>
        </div>
    </section>
    <section class="newsletter">
        <div class="container">
            <h2>Subscribe to Our Newsletter</h2>
            <p>Stay updated with our latest fashion insights, exclusive content, and special offers delivered straight to your inbox.</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Your email address" required>
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </section>
    <section class="container categories">
        <h2 class="section-title">Explore Categories</h2>
        <div class="category-grid">
            <div class="category-card">
                <img src="https://images.unsplash.com/photo-1584998316204-3b1e3b1895ae?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Women's Fashion">
                <div class="category-overlay">
                    <h3 class="category-title">Women's Fashion</h3>
                </div>
            </div>
            <div class="category-card">
                <img src="https://images.unsplash.com/photo-1635944201335-f9165880a0b6?q=80&w=3164&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Men's Style">
                <div class="category-overlay">
                    <h3 class="category-title">Men's Style</h3>
                </div>
            </div>
            <div class="category-card">
                <img src="https://images.unsplash.com/photo-1723150512429-bfa92988d845?q=80&w=2944&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Beauty & Makeup">
                <div class="category-overlay">
                    <h3 class="category-title">Beauty & Makeup</h3>
                </div>
            </div>
            <div class="category-card">
                <img src="https://images.unsplash.com/photo-1631050165089-6311e0d6c5f3?q=80&w=2888&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Sustainable Fashion">
                <div class="category-overlay">
                    <h3 class="category-title">Sustainable Fashion</h3>
                </div>
            </div>
        </div>
    </section>
    <script>
        const newsletterForm = document.querySelector('.newsletter-form');
        newsletterForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = newsletterForm.querySelector('input').value;
            if (email) {
                alert('Thank you for subscribing! You will receive our newsletter soon.');
                newsletterForm.reset();
            }
        });
    </script>
</body>
</html>
