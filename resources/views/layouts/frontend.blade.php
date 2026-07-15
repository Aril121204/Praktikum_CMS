<!DOCTYPE html>

<html class="dark" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ASIAPHONE</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&amp;family=Inter:wght@400;600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container-low": "#1c1b1b",
                        "surface-container": "#201f1f",
                        "primary-container": "#0a0a0c",
                        "surface-container-highest": "#353434",
                        "on-error-container": "#ffdad6",
                        "on-tertiary-fixed-variant": "#4a4642",
                        "on-primary-container": "#7a797b",
                        "inverse-surface": "#e5e2e1",
                        "on-tertiary-fixed": "#1e1b17",
                        "surface-tint": "#c8c6c8",
                        "surface-container-high": "#2b2a2a",
                        "surface-container-lowest": "#0e0e0e",
                        "on-tertiary-container": "#7d7973",
                        "on-secondary": "#2f3131",
                        "on-primary-fixed-variant": "#474649",
                        "on-surface-variant": "#c8c5ca",
                        "surface-variant": "#353434",
                        "primary-fixed-dim": "#c8c6c8",
                        "on-error": "#690005",
                        "error-container": "#93000a",
                        "primary": "#c8c6c8",
                        "on-tertiary": "#33302c",
                        "surface": "#141313",
                        "outline": "#919095",
                        "secondary-fixed": "#e2e2e2",
                        "primary-fixed": "#e5e1e4",
                        "on-surface": "#e5e2e1",
                        "on-primary-fixed": "#1c1b1d",
                        "on-primary": "#313032",
                        "tertiary-fixed": "#e8e1db",
                        "tertiary-container": "#0c0a07",
                        "on-secondary-container": "#b5b5b5",
                        "background": "#141313",
                        "on-secondary-fixed": "#1a1c1c",
                        "on-background": "#e5e2e1",
                        "surface-bright": "#3a3939",
                        "tertiary": "#ccc5bf",
                        "tertiary-fixed-dim": "#ccc5bf",
                        "on-secondary-fixed-variant": "#454747",
                        "secondary-fixed-dim": "#c6c6c6",
                        "inverse-on-surface": "#313030",
                        "secondary-container": "#454747",
                        "inverse-primary": "#5f5e60",
                        "secondary": "#c6c6c6",
                        "outline-variant": "#47464a",
                        "surface-dim": "#141313",
                        "error": "#ffb4ab"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "gutter": "24px",
                        "container-max-width": "1280px",
                        "unit": "8px",
                        "margin-mobile": "20px",
                        "margin-desktop": "64px"
                    },
                    "fontFamily": {
                        "h1": ["Montserrat"],
                        "body-md": ["Inter"],
                        "h2": ["Montserrat"],
                        "label-caps": ["Inter"],
                        "h1-mobile": ["Montserrat"],
                        "body-lg": ["Inter"],
                        "h3": ["Montserrat"]
                    },
                    "fontSize": {
                        "h1": ["64px", {
                            "lineHeight": "1.1",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "body-md": ["16px", {
                            "lineHeight": "1.6",
                            "fontWeight": "400"
                        }],
                        "h2": ["48px", {
                            "lineHeight": "1.2",
                            "fontWeight": "600"
                        }],
                        "label-caps": ["12px", {
                            "lineHeight": "1",
                            "letterSpacing": "0.1em",
                            "fontWeight": "600"
                        }],
                        "h1-mobile": ["40px", {
                            "lineHeight": "1.1",
                            "fontWeight": "700"
                        }],
                        "body-lg": ["18px", {
                            "lineHeight": "1.6",
                            "fontWeight": "400"
                        }],
                        "h3": ["32px", {
                            "lineHeight": "1.3",
                            "fontWeight": "600"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            background-color: #141313;
            color: #e5e2e1;
            overflow-x: hidden;
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .glass-panel-heavy {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(40px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .titanium-glow:hover {
            box-shadow: 0 0 20px rgba(200, 198, 200, 0.3);
        }

        .blue-radial-glow {
            background: radial-gradient(circle at center, rgba(0, 122, 255, 0.15) 0%, transparent 70%);
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #0e0e0e;
        }

        ::-webkit-scrollbar-thumb {
            background: #353434;
            border-radius: 10px;
        }
    </style>
</head>

<body class="font-body-md text-body-md antialiased">
    @include('partials.navbar')


    @yield('content')

    @include('partials.footer')

    <script>
        // WEBGL STELLAR SHADER
        (function() {
            const canvas = document.getElementById('shader-canvas-stellar');

            function syncSize() {
                const w = window.innerWidth;
                const h = window.innerHeight;
                if (canvas.width !== w || canvas.height !== h) {
                    canvas.width = w;
                    canvas.height = h;
                }
            }
            window.addEventListener('resize', syncSize);
            syncSize();

            const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
            if (!gl) return;

            const vs = `attribute vec2 a_position;
    varying vec2 v_texCoord;
    void main() {
      v_texCoord = a_position * 0.5 + 0.5;
      gl_Position = vec4(a_position, 0.0, 1.0);
    }`;

            const fs = `precision highp float;
    varying vec2 v_texCoord;
    uniform float u_time;
    uniform vec2 u_resolution;
    uniform vec2 u_mouse;

    float hash(vec2 p) {
        p = fract(p * vec2(123.34, 456.21));
        p += dot(p, p + 45.32);
        return fract(p.x * p.y);
    }

    void main() {
        vec2 uv = v_texCoord;
        vec2 p = (gl_FragCoord.xy * 2.0 - u_resolution.xy) / min(u_resolution.x, u_resolution.y);
        
        vec3 color = vec3(0.04, 0.04, 0.06); 
        color += vec3(0.01, 0.02, 0.04) * (1.0 - length(uv - 0.5));
        
        vec2 mouse = u_mouse / u_resolution;
        float dist = length(uv - mouse);
        color += vec3(0.1, 0.15, 0.25) * (1.0 - smoothstep(0.0, 0.7, dist)) * 0.2;

        for(float i = 0.0; i < 3.0; i++) {
            float size = 500.0 / (i + 1.0);
            vec2 grid = floor(uv * size);
            vec2 subuv = fract(uv * size) - 0.5;
            
            float h = hash(grid);
            if(h > 0.985) {
                float blink = 0.4 + 0.6 * sin(u_time * 1.5 + h * 10.0);
                float star = 1.0 - smoothstep(0.0, 0.4, length(subuv));
                star *= blink * (h - 0.9) * 12.0;
                
                vec3 starColor = vec3(0.85, 0.92, 1.0);
                if(h > 0.996) starColor = vec3(1.0, 0.98, 0.85);
                
                color += starColor * star;
            }
        }
        
        float noise = hash(uv + u_time * 0.005);
        color += vec3(0.01, 0.005, 0.03) * sin(uv.x * 3.0 + u_time * 0.2) * cos(uv.y * 4.0 + u_time * 0.1);

        gl_FragColor = vec4(color, 1.0);
    }`;

            function cs(type, src) {
                const s = gl.createShader(type);
                gl.shaderSource(s, src);
                gl.compileShader(s);
                return s;
            }
            const prog = gl.createProgram();
            gl.attachShader(prog, cs(gl.VERTEX_SHADER, vs));
            gl.attachShader(prog, cs(gl.FRAGMENT_SHADER, fs));
            gl.linkProgram(prog);
            gl.useProgram(prog);
            const buf = gl.createBuffer();
            gl.bindBuffer(gl.ARRAY_BUFFER, buf);
            gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1, -1, 1, -1, -1, 1, 1, 1]), gl.STATIC_DRAW);
            const pos = gl.getAttribLocation(prog, 'a_position');
            gl.enableVertexAttribArray(pos);
            gl.vertexAttribPointer(pos, 2, gl.FLOAT, false, 0, 0);
            const uTime = gl.getUniformLocation(prog, 'u_time');
            const uRes = gl.getUniformLocation(prog, 'u_resolution');
            const uMouse = gl.getUniformLocation(prog, 'u_mouse');

            let mouse = {
                x: canvas.width / 2,
                y: canvas.height / 2
            };
            window.addEventListener('mousemove', (event) => {
                mouse.x = event.clientX;
                mouse.y = canvas.height - event.clientY;
            });

            function render(t) {
                gl.viewport(0, 0, canvas.width, canvas.height);
                if (uTime) gl.uniform1f(uTime, t * 0.001);
                if (uRes) gl.uniform2f(uRes, canvas.width, canvas.height);
                if (uMouse) gl.uniform2f(uMouse, mouse.x, mouse.y);
                gl.drawArrays(gl.TRIANGLE_STRIP, 0, 4);
                requestAnimationFrame(render);
            }
            render(0);
        })();

        // Micro-interactions for smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Hover effect for cards to add more depth
        document.querySelectorAll('.glass-panel').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                card.style.background = `radial-gradient(500px circle at ${x}px ${y}px, rgba(200, 198, 200, 0.08), transparent 40%), rgba(255, 255, 255, 0.03)`;
            });
            card.addEventListener('mouseleave', () => {
                card.style.background = `rgba(255, 255, 255, 0.03)`;
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('py-3', 'bg-surface-container/40', 'w-full', 'rounded-none', 'top-0');
                header.classList.remove('top-6', 'w-[calc(100%-48px)]', 'rounded-full');
            } else {
                header.classList.remove('py-3', 'bg-surface-container/40', 'w-full', 'rounded-none', 'top-0');
                header.classList.add('top-6', 'w-[calc(100%-48px)]', 'rounded-full');
            }
        });
    </script>
</body>

</html>