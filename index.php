
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kevin Tolentino - Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark-navy': '#1e1b4b',
                        'emerald': '#6366f1',
                        'sage': '#818cf8',
                        'forest': '#4338ca',
                        'mint': '#e0e7ff',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 30px rgba(99, 102, 241, 0.4); }
            50% { box-shadow: 0 0 50px rgba(99, 102, 241, 0.7); }
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .floating { animation: float 3s ease-in-out infinite; }
        .glowing { animation: glow 2s ease-in-out infinite; }
        .slide-in { animation: slideIn 0.6s ease forwards; }
        html { scroll-behavior: smooth; }
        .glass-effect {
            background: rgba(30, 27, 75, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(99, 102, 241, 0.2);
        }

        /* Bento Grid Styles */
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }

        .project-card {
            position: relative;
            border-radius: 1rem;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .project-card:hover {
            transform: translateY(-8px);
        }

        .project-preview {
            position: relative;
            height: 300px;
            overflow: hidden;
        }

        .preview-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .project-card:hover .preview-image {
            transform: scale(1.05);
        }

        /* Expanded Card Overlay */
        .expanded-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(30, 27, 75, 0.95);
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .expanded-overlay.active {
            display: flex;
            opacity: 1;
        }

        .expanded-card {
            background: white;
            border-radius: 1.5rem;
            max-width: 1200px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            transform: scale(0.9);
            transition: transform 0.3s ease;
            position: relative;
        }

        .expanded-overlay.active .expanded-card {
            transform: scale(1);
        }

        .slideshow-container {
            position: relative;
            width: 100%;
            height: 500px;
            overflow: hidden;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .slide.active {
            opacity: 1;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .slide-controls {
            position: absolute;
            bottom: 1rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 0.5rem;
            z-index: 10;
        }

        .slide-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slide-dot.active {
            width: 30px;
            border-radius: 5px;
            background: white;
        }

        .nav-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
            background: rgba(255, 255, 255, 0.9);
        }

        .nav-arrow:hover {
            transform: translateY(-50%) scale(1.1);
        }

        .nav-arrow.prev { left: 1rem; }
        .nav-arrow.next { right: 1rem; }

        .close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 20;
            transition: all 0.3s ease;
        }

        .close-btn:hover {
            transform: rotate(90deg) scale(1.1);
        }

        .fullscreen-btn {
            position: absolute;
            top: 1rem;
            right: 5rem;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 20;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .fullscreen-btn:hover {
            transform: scale(1.1);
        }

        /* Fullscreen Mode */
        .fullscreen-mode {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(30, 27, 75, 0.98);
            z-index: 2000;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .fullscreen-mode.active {
            display: flex;
        }

        .fullscreen-image {
            max-width: 90%;
            max-height: 80vh;
            object-fit: contain;
            border-radius: 1rem;
        }

        .alert-toast {
            position: fixed;
            top: 100px;
            right: 20px;
            min-width: 300px;
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            z-index: 9999;
            display: none;
            animation: slideInRight 0.3s ease;
        }

        @keyframes slideInRight {
            from { 
                transform: translateX(400px); 
                opacity: 0; 
            }
            to { 
                transform: translateX(0); 
                opacity: 1; 
            }
        }

        .alert-toast.show {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .alert-toast.success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .alert-toast.error {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .alert-toast i {
            font-size: 1.5rem;
        }

        /* 2. Loading State for Submit Button */
        .btn-loading {
            position: relative;
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { 
                transform: rotate(360deg); 
            }
        }

        @media (max-width: 768px) {
            .bento-grid {
                grid-template-columns: 1fr;
            }
            
            .slideshow-container {
                height: 300px;
            }
            
            .expanded-card {
                max-height: 85vh;
            }
        }
    </style>
</head>
<body class="bg-dark-navy text-white">
    <div id="alertToast" class="alert-toast">
        <i class="bi" id="alertIcon"></i>
        <div>
            <div class="font-bold" id="alertTitle"></div>
            <div class="text-sm" id="alertMessage"></div>
        </div>
    </div>
    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass-effect transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <a href="#home" class="text-3xl font-bold text-emerald hover:text-sage transition-colors">
                    Kevin<span class="text-sage">T</span>
                </a>
                
                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="nav-link text-lg hover:text-emerald transition-all duration-300 relative group">
                        Home
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#about" class="nav-link text-lg hover:text-emerald transition-all duration-300 relative group">
                        About
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#projects" class="nav-link text-lg hover:text-emerald transition-all duration-300 relative group">
                        Projects
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#contact" class="nav-link text-lg hover:text-emerald transition-all duration-300 relative group">
                        Contact
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald group-hover:w-full transition-all duration-300"></span>
                    </a>
                </div>
                
                <button id="mobile-menu-btn" class="md:hidden text-emerald text-3xl">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden glass-effect border-t border-emerald/20">
            <div class="px-4 pt-2 pb-3 space-y-1">
                <a href="#home" class="block px-4 py-3 hover:bg-emerald/10 rounded-lg transition text-lg">Home</a>
                <a href="#about" class="block px-4 py-3 hover:bg-emerald/10 rounded-lg transition text-lg">About</a>
                <a href="#projects" class="block px-4 py-3 hover:bg-emerald/10 rounded-lg transition text-lg">Projects</a>
                <a href="#contact" class="block px-4 py-3 hover:bg-emerald/10 rounded-lg transition text-lg">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center justify-center pt-20 px-4 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl top-20 -left-20 floating"></div>
            <div class="absolute w-96 h-96 bg-indigo-400/20 rounded-full blur-3xl bottom-20 -right-20 floating" style="animation-delay: 1s;"></div>
            <div class="absolute w-64 h-64 bg-indigo-600/20 rounded-full blur-3xl top-1/2 left-1/2 floating" style="animation-delay: 2s;"></div>
        </div>
        
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center relative z-10">
            <div class="text-center md:text-left space-y-8 slide-in">
                <div class="space-y-4">
                    <p class="text-sage text-xl font-semibold">Hi, I'm</p>
                    <h1 class="text-6xl md:text-8xl font-bold leading-tight">
                        <span class="text-white">Kevin</span><br/>
                        <span class="text-emerald">Tolentino</span>
                    </h1>
                    <p class="text-2xl text-sage font-medium">Junior Developer | UI/UX Enthusiast | Critical Thinking</p>
                </div>
                
                <p class="text-gray-300 text-lg max-w-lg leading-relaxed">
                    Passionate about creating beautiful, functional, and user-friendly digital experiences with modern web technologies
                </p>
                
                <div class="flex flex-wrap gap-4 justify-center md:justify-start pt-4">
                    <a href="#contact" class="px-8 py-4 bg-gradient-to-r from-emerald to-sage rounded-full font-bold text-white text-lg hover:scale-105 transition-transform shadow-lg glowing">
                        Get In Touch
                    </a>
                    <a href="#projects" class="px-8 py-4 glass-effect rounded-full font-bold text-lg hover:scale-105 transition-transform border-2 border-sage">
                        View Projects
                    </a>
                    <a href="ResumeCV.pdf" download class="px-8 py-4 bg-forest hover:bg-emerald text-white rounded-full font-bold text-lg hover:scale-105 transition-all flex items-center gap-2">
                        <i class="bi bi-download"></i> Resume
                    </a>
                </div>
            </div>
            
            <div class="flex justify-center slide-in" style="animation-delay: 0.3s;">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 via-indigo-400 to-indigo-600 rounded-full blur-2xl opacity-40 animate-pulse"></div>
                    <img src="profile.jpg" alt="Kevin Tolentino" class="relative w-80 h-80 md:w-96 md:h-96 rounded-full object-cover border-4 border-indigo-500 shadow-2xl hover:scale-105 transition-transform duration-500">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 px-4 bg-gradient-to-b from-dark-navy to-dark-navy/50">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-5xl md:text-6xl font-bold text-center mb-20">
                <span class="text-emerald">About</span> <span class="text-sage">Me</span>
            </h2>
            
            <div class="grid md:grid-cols-2 gap-12">
                <div class="space-y-8">
                    <div class="glass-effect p-8 rounded-2xl hover:scale-105 transition-transform duration-300 border-2 border-emerald/30">
                        <h3 class="text-3xl font-bold mb-6 text-emerald flex items-center gap-3">
                            <i class="bi bi-person-circle"></i> Who I Am
                        </h3>
                        <p class="text-gray-300 leading-relaxed mb-4 text-lg">
                            I'm a passionate web developer with a love for creating beautiful, functional, and user-friendly websites. With expertise in modern web technologies, I transform ideas into digital experiences that make a difference.
                        </p>
                        <p class="text-gray-300 leading-relaxed text-lg">
                            When I'm not coding, you'll find me exploring new technologies, contributing to open-source projects, or enjoying outdoor activities like hiking and photography.
                        </p>
                    </div>
                    
                    <div class="glass-effect p-8 rounded-2xl hover:scale-105 transition-transform duration-300 border-2 border-sage/30">
                        <h3 class="text-3xl font-bold mb-8 text-sage flex items-center gap-3">
                            <i class="bi bi-book"></i> Education
                        </h3>
                        <div class="space-y-6">
                            <div class="border-l-4 border-emerald pl-6 hover:border-sage transition-colors">
                                <h4 class="font-bold text-xl text-sage">BS Information Technology</h4>
                                <p class="text-gray-300 text-lg">College of Our Lady Mercy</p>
                                <p class="text-sm text-emerald font-semibold mt-1">2023 - Present</p>
                            </div>
                            <div class="border-l-4 border-forest pl-6 hover:border-sage transition-colors">
                                <h4 class="font-bold text-xl text-sage">Senior High School Graduate</h4>
                                <p class="text-gray-300 text-lg">Our Lady Fatima University</p>
                                <p class="text-sm text-emerald font-semibold mt-1">2020 - 2022</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-8">
                    <div class="glass-effect p-8 rounded-2xl hover:scale-105 transition-transform duration-300 border-2 border-forest/30">
                        <h3 class="text-3xl font-bold mb-8 text-forest flex items-center gap-3">
                            <i class="bi bi-code-slash"></i> Skills
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-emerald/10 p-4 rounded-xl border border-emerald/30 hover:bg-emerald/20 transition-all">
                                <h4 class="font-bold text-emerald mb-2">Frontend</h4>
                                <p class="text-sm text-gray-300">HTML, CSS, JavaScript, Tailwind</p>
                            </div>
                            <div class="bg-forest/10 p-4 rounded-xl border border-forest/30 hover:bg-forest/20 transition-all">
                                <h4 class="font-bold text-forest mb-2">Backend</h4>
                                <p class="text-sm text-gray-300">MySQL, PHP</p>
                            </div>
                            <div class="bg-sage/10 p-4 rounded-xl border border-sage/30 hover:bg-sage/20 transition-all">
                                <h4 class="font-bold text-sage mb-2">Tools</h4>
                                <p class="text-sm text-gray-300">VS Code</p>
                            </div>
                            <div class="bg-mint/10 p-4 rounded-xl border border-mint/30 hover:bg-mint/20 transition-all">
                                <h4 class="font-bold text-emerald mb-2">Design</h4>
                                <p class="text-sm text-gray-300">Responsive Design, UI/UX</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="glass-effect p-8 rounded-2xl hover:scale-105 transition-transform duration-300 border-2 border-sage/30">
                        <h3 class="text-3xl font-bold mb-8 text-sage flex items-center gap-3">
                            <i class="bi bi-heart"></i> Hobbies
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center gap-3 p-4 bg-emerald/10 rounded-xl border border-emerald/30 hover:bg-emerald/20 transition-all">
                                <i class="bi bi-camera text-3xl text-emerald"></i>
                                <span class="font-semibold">Photography</span>
                            </div>
                            <div class="flex items-center gap-3 p-4 bg-sage/10 rounded-xl border border-sage/30 hover:bg-sage/20 transition-all">
                                <i class="bi bi-book text-3xl text-sage"></i>
                                <span class="font-semibold">Reading</span>
                            </div>
                            <div class="flex items-center gap-3 p-4 bg-forest/10 rounded-xl border border-forest/30 hover:bg-forest/20 transition-all">
                                <i class="bi bi-controller text-3xl text-forest"></i>
                                <span class="font-semibold">Gaming</span>
                            </div>
                            <div class="flex items-center gap-3 p-4 bg-mint/10 rounded-xl border border-mint/30 hover:bg-mint/20 transition-all">
                                <i class="bi bi-music-note text-3xl text-emerald"></i>
                                <span class="font-semibold">Music</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-24 px-4">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-5xl md:text-6xl font-bold text-center mb-20">
                <span class="text-emerald">Featured</span> <span class="text-sage">Projects</span>
            </h2>
            
            <div class="bento-grid">
                <!-- Project 1: Date Proposal -->
                <div class="project-card" style="background: linear-gradient(135deg, #fef5f9 0%, #fde9f2 100%); border: 2px solid #ffc3e1;" data-project="date">
                    <div class="project-preview">
                        <img src="images/date/date1.png" alt="Date Proposal" class="preview-image">
                        <div class="absolute top-4 left-4 px-4 py-2 rounded-full font-bold text-sm text-white" style="background: #ff6b9d;">
                            Interactive Web App
                        </div>
                    </div>
                    <div class="p-6 space-y-4" style="background: rgba(255, 255, 255, 0.95);">
                        <h3 class="text-2xl font-bold" style="color: #ff4d6d;">Interactive Date Proposal</h3>
                        <p class="leading-relaxed" style="color: #666;">
                            An interactive dating invitation platform with multi-step confirmation and animated UI elements.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold" style="background: #ffc3e1; color: #ff4d6d;">HTML</span>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold" style="background: #ffc3e1; color: #ff4d6d;">Tailwind</span>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold" style="background: #ffc3e1; color: #ff4d6d;">JavaScript</span>
                        </div>
                    </div>
                </div>

                <!-- Project 2: Tourism Platform -->
                <div class="project-card" style="background: linear-gradient(135deg, #f0f8ff 0%, #e6f7ff 100%); border: 2px solid #40e0d0;" data-project="tourism">
                    <div class="project-preview">
                        <img src="images/map/map1.png" alt="Tourism Platform" class="preview-image">
                        <div class="absolute top-4 left-4 px-4 py-2 rounded-full font-bold text-sm text-white" style="background: #0077be;">
                            Full-Stack Platform
                        </div>
                    </div>
                    <div class="p-6 space-y-4" style="background: rgba(255, 255, 255, 0.95);">
                        <h3 class="text-2xl font-bold" style="color: #0077be;">Interactive Tourism Platform</h3>
                        <p class="leading-relaxed" style="color: #666;">
                            A comprehensive travel guide with interactive maps and destination filtering.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold" style="background: #e6f7ff; color: #0077be;">HTML</span>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold" style="background: #e6f7ff; color: #0077be;">PHP</span>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold" style="background: #e6f7ff; color: #0077be;">Leaflet API</span>
                        </div>
                    </div>
                </div>

                <!-- Project 3: Fashion Outfit -->
                <div class="project-card" style="background: linear-gradient(135deg, #fef5f9 0%, #fde9f2 100%); border: 2px solid #F3CCDE;" data-project="fashion">
                    <div class="project-preview">
                        <img src="images/outfit/outfit1.png" alt="Fashion Outfit" class="preview-image">
                        <div class="absolute top-4 left-4 px-4 py-2 rounded-full font-bold text-sm text-white" style="background: #D6A8C4;">
                            Virtual Dressing Room
                        </div>
                    </div>
                    <div class="p-6 space-y-4" style="background: rgba(255, 255, 255, 0.95);">
                        <h3 class="text-2xl font-bold" style="color: #9E6899;">Fashion Outfit Builder</h3>
                        <p class="leading-relaxed" style="color: #666;">
                            Interactive virtual dressing room with real-time outfit preview system.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold" style="background: #fbd4e6; color: #9E6899;">HTML</span>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold" style="background: #fbd4e6; color: #9E6899;">JavaScript</span>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold" style="background: #fbd4e6; color: #9E6899;">MySQL</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Expanded Card Overlay -->
    <div class="expanded-overlay" id="expandedOverlay">
        <div class="expanded-card">
            <button class="close-btn" id="closeExpanded">
                <i class="bi bi-x-lg text-2xl"></i>
            </button>
            <button class="fullscreen-btn" id="fullscreenBtn">
                <i class="bi bi-arrows-fullscreen text-xl"></i>
            </button>
            
            <div class="slideshow-container" id="slideshowContainer">
                <!-- Slides will be inserted here dynamically -->
            </div>
            
            <div class="p-8" id="expandedContent">
                <!-- Content will be inserted here dynamically -->
            </div>
        </div>
    </div>

    <!-- Fullscreen Mode -->
    <div class="fullscreen-mode" id="fullscreenMode">
        <button class="close-btn" id="closeFullscreen">
            <i class="bi bi-x-lg text-2xl"></i>
        </button>
        <div class="nav-arrow prev" id="fullscreenPrev">
            <i class="bi bi-chevron-left text-2xl"></i>
        </div>
        <div class="flex flex-col items-center">
            <div class="px-6 py-3 rounded-full font-bold text-lg mb-6 shadow-lg text-white" id="fullscreenStep">
                Image 1
            </div>
            <img src="" alt="Fullscreen" class="fullscreen-image" id="fullscreenImage">
        </div>
        <div class="nav-arrow next" id="fullscreenNext">
            <i class="bi bi-chevron-right text-2xl"></i>
        </div>
    </div>

    <!-- Contact Section -->
    <section id="contact" class="py-24 px-4 bg-gradient-to-t from-dark-navy to-dark-navy/50">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-5xl md:text-6xl font-bold text-center mb-20">
                <span class="text-emerald">Get In</span> <span class="text-sage">Touch</span>
            </h2>
            
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="glass-effect p-8 rounded-2xl border-2 border-emerald/30">
                    <form id="contactForm" class="space-y-6">
                        <div>
                            <label class="block mb-2 font-bold text-lg text-emerald">Name *</label>
                            <input type="text" name="name" required 
                                class="w-full px-4 py-3 bg-white/5 border-2 border-emerald/30 rounded-lg focus:outline-none focus:border-emerald transition-all text-white placeholder-gray-500"
                                placeholder="Your full name">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold text-lg text-emerald">Email *</label>
                            <input type="email" name="email" required 
                                class="w-full px-4 py-3 bg-white/5 border-2 border-emerald/30 rounded-lg focus:outline-none focus:border-emerald transition-all text-white placeholder-gray-500"
                                placeholder="your.email@example.com">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold text-lg text-emerald">Subject *</label>
                            <input type="text" name="subject" required 
                                class="w-full px-4 py-3 bg-white/5 border-2 border-emerald/30 rounded-lg focus:outline-none focus:border-emerald transition-all text-white placeholder-gray-500"
                                placeholder="What is this about?">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold text-lg text-emerald">Message *</label>
                            <textarea rows="5" name="message" required 
                                class="w-full px-4 py-3 bg-white/5 border-2 border-emerald/30 rounded-lg focus:outline-none focus:border-emerald transition-all text-white placeholder-gray-500 resize-none"
                                placeholder="Your message here..."></textarea>
                        </div>
                        
                        <!-- ✨ UPDATED BUTTON WITH IDs -->
                        <button type="submit" id="submitBtn" class="w-full py-4 bg-gradient-to-r from-emerald to-sage rounded-lg font-bold text-white text-lg hover:scale-105 transition-transform glowing">
                            <i class="bi bi-send-fill mr-2"></i> 
                            <span id="btnText">Send Message</span>
                        </button>
                    </form>
                </div>

                <div class="space-y-6">
                    <div class="glass-effect p-6 rounded-2xl border-2 border-sage/30 hover:scale-105 transition-transform duration-300">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-emerald to-sage rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="bi bi-envelope-fill text-2xl text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl text-sage mb-1">Email</h4>
                                <p class="text-gray-300">Kevintolentino1821@gmail.com</p>
                            </div>
                        </div>
                    </div>

                    <div class="glass-effect p-6 rounded-2xl border-2 border-forest/30 hover:scale-105 transition-transform duration-300">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-sage to-mint rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="bi bi-telephone-fill text-2xl text-dark-navy"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl text-sage mb-1">Phone</h4>
                                <p class="text-gray-300">09495427966</p>
                            </div>
                        </div>
                    </div>

                    <div class="glass-effect p-6 rounded-2xl border-2 border-sage/30 hover:scale-105 transition-transform duration-300">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-forest to-emerald rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="bi bi-geo-alt-fill text-2xl text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl text-sage mb-1">Location</h4>
                                <p class="text-gray-300">San Miguel Calumpit Bulacan</p>
                            </div>
                        </div>
                    </div>

                    <div class="glass-effect p-6 rounded-2xl border-2 border-emerald/30">
                        <h4 class="font-bold text-xl text-emerald mb-4">Connect With Me</h4>
                        <div class="flex gap-4">
                            <a href="https://github.com/Kevvsuu?tab=repositories" class="w-14 h-14 bg-gradient-to-br from-emerald to-sage rounded-full flex items-center justify-center hover:scale-110 transition-transform text-white">
                                <i class="bi bi-github text-2xl"></i>
                            </a>
                            <a href="https://www.facebook.com/kevin.tolentino.188" class="w-14 h-14 bg-gradient-to-br from-mint to-sage rounded-full flex items-center justify-center hover:scale-110 transition-transform text-dark-navy">
                                <i class="bi bi-facebook text-2xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 px-4 border-t border-emerald/20">
        <div class="max-w-7xl mx-auto text-center">
            <p class="text-gray-400">
                &copy; 2024 Kevin Tolentino. Built with <span class="text-emerald">❤</span> and <span class="text-sage">code</span>
            </p>
        </div>
    </footer>

    <script>

        function showAlert(type, title, message) {
            const toast = document.getElementById('alertToast');
            const icon = document.getElementById('alertIcon');
            const titleEl = document.getElementById('alertTitle');
            const messageEl = document.getElementById('alertMessage');
            
            toast.className = `alert-toast ${type} show`;
            icon.className = type === 'success' ? 'bi bi-check-circle-fill' : 'bi bi-exclamation-circle-fill';
            titleEl.textContent = title;
            messageEl.textContent = message;
            
            setTimeout(() => {
                toast.classList.remove('show');
            }, 5000);
        }

        // ========================================
        // NEW: Contact Form Handler with AJAX
        // ========================================
// Contact Form Handler with Better Error Handling
const contactForm = document.getElementById('contactForm');
const submitBtn = document.getElementById('submitBtn');
const btnText = document.getElementById('btnText');

contactForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    // Disable button and show loading
    submitBtn.disabled = true;
    submitBtn.classList.add('btn-loading');
    btnText.textContent = 'Sending...';
    
    // Get form data
    const formData = new FormData(contactForm);
    
    try {
        const response = await fetch('contact_handler.php', {
            method: 'POST',
            body: formData
        });
        
        // Get the response as text first
        const text = await response.text();
        console.log('Raw response:', text); // Debug: see what we're getting
        
        // Try to parse as JSON
        let result;
        try {
            result = JSON.parse(text);
        } catch (parseError) {
            console.error('Parse error:', parseError);
            console.error('Response text:', text);
            throw new Error('Server returned invalid response. Check contact_handler.php for PHP errors.');
        }
        
        if (result.success) {
            showAlert('success', 'Success!', result.message);
            contactForm.reset();
        } else {
            showAlert('error', 'Error', result.message);
        }
        
    } catch (error) {
        console.error('Full error:', error);
        showAlert('error', 'Error', 'Something went wrong. Please check the console for details.');
    } finally {
        // Re-enable button
        submitBtn.disabled = false;
        submitBtn.classList.remove('btn-loading');
        btnText.textContent = 'Send Message';
    }
});
        // Mobile menu
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(30, 27, 75, 0.95)';
            } else {
                navbar.style.background = 'rgba(30, 27, 75, 0.7)';
            }
        });

        // Active nav link
        const sections = document.querySelectorAll('section');
        const navLinks = document.querySelectorAll('.nav-link');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (window.pageYOffset >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('text-emerald');
                if (link.getAttribute('href').slice(1) === current) {
                    link.classList.add('text-emerald');
                }
            });
        });

        // Project data with images
        const projectsData = {
            date: {
                title: 'Interactive Date Proposal',
                description: 'An interactive dating invitation platform with multi-step confirmation, animated UI elements, and date planning functionality with restaurant selection.',
                color: {
                    primary: '#ff6b9d',
                    secondary: '#ff4d6d',
                    bg: '#ffc3e1',
                    light: '#fef5f9'
                },
                technologies: ['HTML', 'Tailwind', 'JavaScript', 'Leaflet API'],
                liveDemo: 'https://ashleydate.ct.ws/',
                github: 'https://github.com/Kevvsuu/Date-Interactive/tree/main/ashleydate',
                images: [
                    'images/date/date1.png',
                    'images/date/date2.png',
                    'images/date/date3.png',
                    'images/date/date4.png',
                    'images/date/date5.png',
                    'images/date/date6.png',
                    'images/date/date7.png'
                ]
            },
            tourism: {
                title: 'Interactive Tourism Platform',
                description: 'A comprehensive travel guide application featuring an interactive Philippines map with destination filtering, user reviews, and route planning capabilities.',
                color: {
                    primary: '#0077be',
                    secondary: '#00a8cc',
                    bg: '#e6f7ff',
                    light: '#f0f8ff'
                },
                technologies: ['HTML', 'PHP', 'Leaflet API', 'PHPMailer'],
                liveDemo: 'https://lakbay-gabay.page.gd/',
                github: 'https://github.com/Kevvsuu/Lakbay-Gabay',
                images: [
                    'images/map/map1.png',
                    'images/map/map2.png',
                    'images/map/map3.png',
                    'images/map/map4.png',
                    'images/map/map5.png',
                    'images/map/map6.png',
                    'images/map/map7.png',
                    'images/map/map8.png'
                ]
            },
            fashion: {
                title: 'Fashion Outfit Builder',
                description: 'An interactive virtual dressing room featuring gender-based clothing selection, real-time outfit preview, and user favorites system with seamless UI interactions.',
                color: {
                    primary: '#D6A8C4',
                    secondary: '#9E6899',
                    bg: '#fbd4e6',
                    light: '#fef5f9'
                },
                technologies: ['HTML', 'JavaScript', 'Tailwind', 'MySQL'],
                liveDemo: 'https://outfitchicfashion.ct.ws/',
                github: 'https://github.com/Kevvsuu/Fasion-Fusion',
                images: [
                    'images/outfit/outfit1.png',
                    'images/outfit/outfit2.png',
                    'images/outfit/outfit3.png',
                    'images/outfit/outfit4.png',
                    'images/outfit/outfit5.png',
                    'images/outfit/outfit6.png'
                ]
            }
        };

        // Slideshow state
        let currentProject = null;
        let currentSlideIndex = 0;
        let slideshowInterval = null;

        // Open expanded card
        document.querySelectorAll('.project-card').forEach(card => {
            card.addEventListener('click', () => {
                const projectType = card.getAttribute('data-project');
                currentProject = projectsData[projectType];
                openExpandedCard();
            });
        });

        function openExpandedCard() {
            const overlay = document.getElementById('expandedOverlay');
            const container = document.getElementById('slideshowContainer');
            const content = document.getElementById('expandedContent');
            
            // Clear previous content
            container.innerHTML = '';
            
            // Create slides
            currentProject.images.forEach((img, index) => {
                const slide = document.createElement('div');
                slide.className = 'slide' + (index === 0 ? ' active' : '');
                slide.innerHTML = `
                    <img src="${img}" alt="${currentProject.title} - Image ${index + 1}">
                `;
                container.appendChild(slide);
            });
            
            // Add navigation arrows
            const prevArrow = document.createElement('div');
            prevArrow.className = 'nav-arrow prev';
            prevArrow.style.color = currentProject.color.primary;
            prevArrow.innerHTML = '<i class="bi bi-chevron-left text-2xl"></i>';
            prevArrow.addEventListener('click', () => changeSlide(-1));
            container.appendChild(prevArrow);
            
            const nextArrow = document.createElement('div');
            nextArrow.className = 'nav-arrow next';
            nextArrow.style.color = currentProject.color.primary;
            nextArrow.innerHTML = '<i class="bi bi-chevron-right text-2xl"></i>';
            nextArrow.addEventListener('click', () => changeSlide(1));
            container.appendChild(nextArrow);
            
            // Add slide indicators
            const indicators = document.createElement('div');
            indicators.className = 'slide-controls';
            currentProject.images.forEach((_, index) => {
                const dot = document.createElement('div');
                dot.className = 'slide-dot' + (index === 0 ? ' active' : '');
                dot.addEventListener('click', () => goToSlide(index));
                indicators.appendChild(dot);
            });
            container.appendChild(indicators);
            
            // Update content
            content.innerHTML = `
                <h2 class="text-4xl font-bold mb-4" style="color: ${currentProject.color.secondary};">${currentProject.title}</h2>
                <p class="text-gray-600 text-lg mb-6 leading-relaxed">${currentProject.description}</p>
                <div class="flex flex-wrap gap-3 mb-6">
                    ${currentProject.technologies.map(tech => 
                        `<span class="px-4 py-2 rounded-full text-sm font-semibold border-2" style="background: ${currentProject.color.bg}; color: ${currentProject.color.secondary}; border-color: ${currentProject.color.primary};">${tech}</span>`
                    ).join('')}
                </div>
                <div class="flex gap-4">
                    <a href="${currentProject.liveDemo}" target="_blank" class="flex-1 py-4 rounded-xl text-center font-bold hover:scale-105 transition-all flex items-center justify-center gap-2 text-white text-lg" style="background: ${currentProject.color.primary};">
                        <i class="bi bi-box-arrow-up-right"></i> Live Demo
                    </a>
                    <a href="${currentProject.github}" class="flex-1 py-4 rounded-xl text-center font-bold hover:scale-105 transition-all flex items-center justify-center gap-2 border-2 text-lg" style="color: ${currentProject.color.secondary}; border-color: ${currentProject.color.primary};">
                        <i class="bi bi-github"></i> View Code
                    </a>
                </div>
            `;
            
            // Update button colors
            document.getElementById('closeExpanded').style.background = currentProject.color.primary;
            document.getElementById('closeExpanded').style.color = 'white';
            document.getElementById('fullscreenBtn').style.color = currentProject.color.primary;
            
            // Show overlay
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Start autoplay
            currentSlideIndex = 0;
            startSlideshow();
        }

        function changeSlide(direction) {
            stopSlideshow();
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.slide-dot');
            
            slides[currentSlideIndex].classList.remove('active');
            dots[currentSlideIndex].classList.remove('active');
            
            currentSlideIndex = (currentSlideIndex + direction + slides.length) % slides.length;
            
            slides[currentSlideIndex].classList.add('active');
            dots[currentSlideIndex].classList.add('active');
            
            startSlideshow();
        }

        function goToSlide(index) {
            stopSlideshow();
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.slide-dot');
            
            slides[currentSlideIndex].classList.remove('active');
            dots[currentSlideIndex].classList.remove('active');
            
            currentSlideIndex = index;
            
            slides[currentSlideIndex].classList.add('active');
            dots[currentSlideIndex].classList.add('active');
            
            startSlideshow();
        }

        function startSlideshow() {
            stopSlideshow();
            slideshowInterval = setInterval(() => {
                changeSlide(1);
            }, 3000);
        }

        function stopSlideshow() {
            if (slideshowInterval) {
                clearInterval(slideshowInterval);
                slideshowInterval = null;
            }
        }

        // Close expanded card
        document.getElementById('closeExpanded').addEventListener('click', () => {
            stopSlideshow();
            document.getElementById('expandedOverlay').classList.remove('active');
            document.body.style.overflow = '';
            currentProject = null;
            currentSlideIndex = 0;
        });

        // Open fullscreen
        document.getElementById('fullscreenBtn').addEventListener('click', () => {
            stopSlideshow();
            document.getElementById('fullscreenMode').classList.add('active');
            document.getElementById('fullscreenImage').src = currentProject.images[currentSlideIndex];
            document.getElementById('fullscreenStep').textContent = `Image ${currentSlideIndex + 1} of ${currentProject.images.length}`;
            document.getElementById('fullscreenStep').style.background = currentProject.color.primary;
            document.getElementById('closeFullscreen').style.background = currentProject.color.primary;
            document.getElementById('closeFullscreen').style.color = 'white';
            document.getElementById('fullscreenPrev').style.color = currentProject.color.primary;
            document.getElementById('fullscreenNext').style.color = currentProject.color.primary;
        });

        // Close fullscreen
        document.getElementById('closeFullscreen').addEventListener('click', () => {
            document.getElementById('fullscreenMode').classList.remove('active');
            startSlideshow();
        });

        // Fullscreen navigation
        document.getElementById('fullscreenPrev').addEventListener('click', () => {
            currentSlideIndex = (currentSlideIndex - 1 + currentProject.images.length) % currentProject.images.length;
            document.getElementById('fullscreenImage').src = currentProject.images[currentSlideIndex];
            document.getElementById('fullscreenStep').textContent = `Image ${currentSlideIndex + 1} of ${currentProject.images.length}`;
        });

        document.getElementById('fullscreenNext').addEventListener('click', () => {
            currentSlideIndex = (currentSlideIndex + 1) % currentProject.images.length;
            document.getElementById('fullscreenImage').src = currentProject.images[currentSlideIndex];
            document.getElementById('fullscreenStep').textContent = `Image ${currentSlideIndex + 1} of ${currentProject.images.length}`;
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (document.getElementById('expandedOverlay').classList.contains('active')) {
                if (e.key === 'Escape') {
                    document.getElementById('closeExpanded').click();
                } else if (e.key === 'ArrowLeft') {
                    changeSlide(-1);
                } else if (e.key === 'ArrowRight') {
                    changeSlide(1);
                }
            }
            
            if (document.getElementById('fullscreenMode').classList.contains('active')) {
                if (e.key === 'Escape') {
                    document.getElementById('closeFullscreen').click();
                } else if (e.key === 'ArrowLeft') {
                    document.getElementById('fullscreenPrev').click();
                } else if (e.key === 'ArrowRight') {
                    document.getElementById('fullscreenNext').click();
                }
            }
        });

        // Close on outside click
        document.getElementById('expandedOverlay').addEventListener('click', (e) => {
            if (e.target.id === 'expandedOverlay') {
                document.getElementById('closeExpanded').click();
            }
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.glass-effect, .project-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    </script>
</body>
</html>