<?php
include 'header.php'; 
?>
 
<section class="hero">
    <div class="container">
        <h1>Browse by <span style="color: var(--primary)">Category</span></h1>
        <p style="color: var(--text-muted); font-size: 1.2rem;">Find the perfect expert for your project.</p>
    </div>
</section>
 
<section class="container" style="padding: 60px 0;">
    <div class="job-grid">
        <!-- Category Cards -->
        <a href="index.php?category=Web Development" class="card" style="text-decoration: none; color: inherit; display: block; text-align: center; cursor: pointer;">
            <i data-lucide="monitor" style="width: 40px; height: 40px; color: var(--primary); margin-bottom: 15px;"></i>
            <h3>Web Development</h3>
            <p style="color: var(--text-muted);">PHP, WordPress, React</p>
        </a>
 
        <a href="index.php?category=Design" class="card" style="text-decoration: none; color: inherit; display: block; text-align: center; cursor: pointer;">
            <i data-lucide="palette" style="width: 40px; height: 40px; color: var(--primary); margin-bottom: 15px;"></i>
            <h3>Graphic Design</h3>
            <p style="color: var(--text-muted);">Logo, Branding, UI/UX</p>
        </a>
 
        <a href="index.php?category=Mobile Apps" class="card" style="text-decoration: none; color: inherit; display: block; text-align: center; cursor: pointer;">
            <i data-lucide="smartphone" style="width: 40px; height: 40px; color: var(--primary); margin-bottom: 15px;"></i>
            <h3>Mobile Apps</h3>
            <p style="color: var(--text-muted);">iOS, Android, Flutter</p>
        </a>
 
        <a href="index.php?category=Video Editing" class="card" style="text-decoration: none; color: inherit; display: block; text-align: center; cursor: pointer;">
            <i data-lucide="film" style="width: 40px; height: 40px; color: var(--primary); margin-bottom: 15px;"></i>
            <h3>Video Editing</h3>
            <p style="color: var(--text-muted);">Premiere Pro, After Effects</p>
        </a>
 
        <a href="index.php?category=Writing" class="card" style="text-decoration: none; color: inherit; display: block; text-align: center; cursor: pointer;">
            <i data-lucide="pen-tool" style="width: 40px; height: 40px; color: var(--primary); margin-bottom: 15px;"></i>
            <h3>Content Writing</h3>
            <p style="color: var(--text-muted);">Blogs, Articles, SEO</p>
        </a>
 
        <a href="index.php?category=Marketing" class="card" style="text-decoration: none; color: inherit; display: block; text-align: center; cursor: pointer;">
            <i data-lucide="megaphone" style="width: 40px; height: 40px; color: var(--primary); margin-bottom: 15px;"></i>
            <h3>Digital Marketing</h3>
            <p style="color: var(--text-muted);">Social Media, Ads</p>
        </a>
    </div>
</section>
 
<script>lucide.createIcons();</script>
</body>
</html>
