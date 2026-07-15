<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - <?php echo e(config('app.name', 'ASIAPHONE')); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#c8c6c8',
                        'surface': '#141313',
                        'surface-dark': '#0e0e0e',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 20px rgba(200, 198, 200, 0.3)' },
                            '100%': { boxShadow: '0 0 40px rgba(200, 198, 200, 0.6), 0 0 60px rgba(200, 198, 200, 0.4)' },
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            overflow: hidden;
        }
        
        #canvas-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: linear-gradient(135deg, #0e0e10 0%, #1a1a2e 50%, #16213e 100%);
        }
        
        .glass-panel {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }
        
        .input-field {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .input-field:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(200, 198, 200, 0.5);
            box-shadow: 0 0 20px rgba(200, 198, 200, 0.2);
            outline: none;
        }
        
        .login-button {
            background: linear-gradient(135deg, rgba(200, 198, 200, 0.9) 0%, rgba(200, 198, 200, 0.7) 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 40px rgba(200, 198, 200, 0.4);
        }
        
        .login-button:active {
            transform: translateY(0);
        }
        
        .login-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }
        
        .login-button:hover::before {
            left: 100%;
        }
        
        .error-shake {
            animation: shake 0.5s ease-in-out;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .tech-grid {
            background-image: 
                linear-gradient(rgba(200, 198, 200, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(200, 198, 200, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }
    </style>
</head>
<body class="font-inter">

    <!-- Animated Background Canvas -->
    <div id="canvas-container">
        <canvas id="techCanvas"></canvas>
    </div>

    <!-- Tech Grid Overlay -->
    <div class="fixed inset-0 tech-grid pointer-events-none z-0"></div>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center px-4 relative z-10">
        <div class="w-full max-w-md">
            
            <!-- Logo & Branding -->
            <div class="text-center mb-8 animate-float">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl glass-panel mb-6 animate-glow">
                    <i class="fas fa-shield-alt text-4xl text-primary"></i>
                </div>
                <h1 class="text-4xl font-bold text-white mb-2 tracking-tight">Admin Panel</h1>
                <p class="text-gray-400 text-sm">Secure Access Control System</p>
            </div>

            <!-- Login Form -->
            <div class="glass-panel rounded-3xl p-8 md:p-10">
                
                <!-- Error Messages -->
                <?php if($errors->any()): ?>
                    <div id="errorAlert" class="mb-6 p-4 bg-red-500/10 border border-red-500/30 rounded-xl text-red-300 text-sm error-shake">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-exclamation-circle"></i>
                            <ul class="space-y-1">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div id="errorAlert" class="mb-6 p-4 bg-red-500/10 border border-red-500/30 rounded-xl text-red-300 text-sm error-shake">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-exclamation-circle"></i>
                            <span><?php echo e(session('error')); ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(session('success')): ?>
                    <div class="mb-6 p-4 bg-green-500/10 border border-green-500/30 rounded-xl text-green-300 text-sm">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle"></i>
                            <span><?php echo e(session('success')); ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('admin.login')); ?>" id="loginForm">
                    <?php echo csrf_field(); ?>
                    
                    <!-- Email Field -->
                    <div class="mb-6">
                        <label class="block text-gray-300 text-sm font-medium mb-3">
                            <i class="fas fa-envelope mr-2 text-primary"></i>
                            Email Address
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            value="<?php echo e(old('email')); ?>"
                            class="input-field w-full px-4 py-3.5 rounded-xl text-white placeholder-gray-500"
                            placeholder="admin@example.com"
                            required
                            autofocus
                        >
                    </div>

                    <!-- Password Field -->
                    <div class="mb-6">
                        <label class="block text-gray-300 text-sm font-medium mb-3">
                            <i class="fas fa-lock mr-2 text-primary"></i>
                            Password
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                name="password" 
                                id="password"
                                class="input-field w-full px-4 py-3.5 rounded-xl text-white placeholder-gray-500"
                                placeholder="••••••••"
                                required
                            >
                            <button 
                                type="button" 
                                onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-primary transition-colors"
                            >
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-8 flex items-center justify-between">
                        <label class="flex items-center cursor-pointer group">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                class="w-4 h-4 rounded border-gray-600 bg-white/5 text-primary focus:ring-primary/30 cursor-pointer"
                            >
                            <span class="ml-2 text-gray-400 text-sm group-hover:text-gray-300 transition-colors">Remember me</span>
                        </label>
                        <a href="#" class="text-primary text-sm hover:underline">Forgot password?</a>
                    </div>

                    <!-- Login Button -->
                    <button 
                        type="submit" 
                        class="login-button w-full py-4 px-6 rounded-xl text-surface-dark font-bold text-base mb-6"
                    >
                        <span class="flex items-center justify-center gap-2">
                            <i class="fas fa-sign-in-alt"></i>
                            Sign In to Dashboard
                        </span>
                    </button>

                    <!-- Back to Site -->
                    <div class="text-center">
                        <a href="<?php echo e(url('/')); ?>" class="text-gray-400 hover:text-primary text-sm transition-colors inline-flex items-center gap-2">
                            <i class="fas fa-arrow-left"></i>
                            Back to Website
                        </a>
                    </div>
                </form>
            </div>

            <!-- Security Badge -->
            <div class="mt-6 text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 glass-panel rounded-full">
                    <i class="fas fa-lock text-green-400 text-xs"></i>
                    <span class="text-gray-400 text-xs">Secured with 256-bit encryption</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle Password Visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Auto-hide error after 5 seconds
        setTimeout(() => {
            const errorAlert = document.getElementById('errorAlert');
            if (errorAlert) {
                errorAlert.style.transition = 'opacity 0.5s';
                errorAlert.style.opacity = '0';
                setTimeout(() => errorAlert.remove(), 500);
            }
        }, 5000);

        // Animated Tech Background
        const canvas = document.getElementById('techCanvas');
        const ctx = canvas.getContext('2d');

        let width, height;
        let particles = [];
        let lines = [];
        let mouse = { x: null, y: null };

        // Resize canvas
        function resize() {
            width = canvas.width = window.innerWidth;
            height = canvas.height = window.innerHeight;
        }

        window.addEventListener('resize', resize);
        resize();

        // Mouse tracking
        window.addEventListener('mousemove', (e) => {
            mouse.x = e.x;
            mouse.y = e.y;
        });

        window.addEventListener('mouseleave', () => {
            mouse.x = null;
            mouse.y = null;
        });

        // Particle Class
        class Particle {
            constructor() {
                this.x = Math.random() * width;
                this.y = Math.random() * height;
                this.vx = (Math.random() - 0.5) * 0.5;
                this.vy = (Math.random() - 0.5) * 0.5;
                this.size = Math.random() * 2 + 1;
                this.color = `rgba(200, 198, 200, ${Math.random() * 0.5 + 0.2})`;
            }

            update() {
                this.x += this.vx;
                this.y += this.vy;

                // Bounce off edges
                if (this.x < 0 || this.x > width) this.vx *= -1;
                if (this.y < 0 || this.y > height) this.vy *= -1;

                // Mouse interaction
                if (mouse.x != null) {
                    let dx = mouse.x - this.x;
                    let dy = mouse.y - this.y;
                    let distance = Math.sqrt(dx * dx + dy * dy);
                    
                    if (distance < 150) {
                        const forceDirectionX = dx / distance;
                        const forceDirectionY = dy / distance;
                        const force = (150 - distance) / 150;
                        const directionX = forceDirectionX * force * 0.6;
                        const directionY = forceDirectionY * force * 0.6;
                        
                        this.vx += directionX;
                        this.vy += directionY;
                    }
                }
            }

            draw() {
                ctx.fillStyle = this.color;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        // Initialize particles
        function init() {
            particles = [];
            const numberOfParticles = Math.min(100, (width * height) / 9000);
            
            for (let i = 0; i < numberOfParticles; i++) {
                particles.push(new Particle());
            }
        }

        // Draw connections
        function drawConnections() {
            for (let i = 0; i < particles.length; i++) {
                for (let j = i + 1; j < particles.length; j++) {
                    let dx = particles[i].x - particles[j].x;
                    let dy = particles[i].y - particles[j].y;
                    let distance = Math.sqrt(dx * dx + dy * dy);

                    if (distance < 150) {
                        let opacity = 1 - (distance / 150);
                        ctx.strokeStyle = `rgba(200, 198, 200, ${opacity * 0.2})`;
                        ctx.lineWidth = 1;
                        ctx.beginPath();
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(particles[j].x, particles[j].y);
                        ctx.stroke();
                    }
                }

                // Connect to mouse
                if (mouse.x != null) {
                    let dx = particles[i].x - mouse.x;
                    let dy = particles[i].y - mouse.y;
                    let distance = Math.sqrt(dx * dx + dy * dy);

                    if (distance < 200) {
                        let opacity = 1 - (distance / 200);
                        ctx.strokeStyle = `rgba(200, 198, 200, ${opacity * 0.3})`;
                        ctx.lineWidth = 1.5;
                        ctx.beginPath();
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(mouse.x, mouse.y);
                        ctx.stroke();
                    }
                }
            }
        }

        // Animation loop
        function animate() {
            ctx.clearRect(0, 0, width, height);
            
            // Draw gradient background
            const gradient = ctx.createRadialGradient(width/2, height/2, 0, width/2, height/2, width);
            gradient.addColorStop(0, 'rgba(14, 14, 16, 0.8)');
            gradient.addColorStop(0.5, 'rgba(26, 26, 46, 0.6)');
            gradient.addColorStop(1, 'rgba(22, 33, 62, 0.8)');
            ctx.fillStyle = gradient;
            ctx.fillRect(0, 0, width, height);

            // Update and draw particles
            particles.forEach(particle => {
                particle.update();
                particle.draw();
            });

            // Draw connections
            drawConnections();

            requestAnimationFrame(animate);
        }

        init();
        animate();

        // Form validation
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = this.querySelector('input[name="email"]').value;
            const password = this.querySelector('input[name="password"]').value;

            if (!email || !password) {
                e.preventDefault();
                this.classList.add('error-shake');
                setTimeout(() => this.classList.remove('error-shake'), 500);
            }
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\Praktikum_CMS\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>