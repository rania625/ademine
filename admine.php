<?php

include 'include/nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Admin Panel</title>
    <style>
        :root {
            --primary: #ff69b4;
            --secondary: #e0b1cb;
            --background: #fff5f7;
            --text: #2d3436;
            --card-bg: #ffffff;
        }

        .dark-mode {
            --primary: #ff69b4;
            --secondary: #9b6b9e;
            --background: #1a1a1a;
            --text: #ffffff;
            --card-bg: #2d2d2d;
        }

        body {
            background: var(--background);
            min-height: 100vh;
            overflow-x: hidden;
            transition: all 0.3s ease;
        }

        .container {
            position: relative;
            z-index: 1;
        }

        .form-container {
            background: var(--card-bg);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
            margin-top: 2rem;
        }

        h4 {
            color: var(--primary);
            font-size: 2rem;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: bold;
        }

        p {
            color: var(--text);
            text-align: center;
        }

        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--card-bg);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .theme-toggle i {
            color: var(--primary);
        }

        .floating-flower {
            position: absolute;
            pointer-events: none;
            animation: float linear infinite;
            opacity: 0.6;
        }

        @keyframes float {
            0% {
                transform: translate(0, -100vh) rotate(0deg);
            }
            100% {
                transform: translate(0, 100vh) rotate(360deg);
            }
        }
    </style>
</head>
<body>
    <button class="theme-toggle" onclick="toggleTheme()">
        <i class="fas fa-moon"></i>
    </button>

    <div id="flowers-container"></div>

    <div class="container py-2">
        <div class="form-container">
            <h4><i class="fas fa-cogs"></i> Panneau d'Administration</h4>
            <p>Bienvenue dans le panneau d'administration. Gérez vos utilisateurs et vos produits ici.</p>
        </div>
    </div>

    <script>
        function createFlowers() {
            const container = document.getElementById('flowers-container');
            const flowerEmojis = ['🌸', '🌺', '🌹', '🌷', '💐'];
            const numberOfFlowers = 20;

            for(let i = 0; i < numberOfFlowers; i++) {
                const flower = document.createElement('div');
                flower.classList.add('floating-flower');
                flower.textContent = flowerEmojis[Math.floor(Math.random() * flowerEmojis.length)];
                
                flower.style.left = `${Math.random() * 100}vw`;
                flower.style.fontSize = `${Math.random() * 20 + 10}px`;
                flower.style.animationDuration = `${Math.random() * 10 + 10}s`;
                flower.style.animationDelay = `${Math.random() * 5}s`;
                
                container.appendChild(flower);
            }
        }

        function toggleTheme() {
            document.body.classList.toggle('dark-mode');
            const icon = document.querySelector('.theme-toggle i');
            if(document.body.classList.contains('dark-mode')) {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        }

        createFlowers();
        // Recrée les fleurs toutes les 20 secondes pour maintenir l'animation
        setInterval(() => {
            const container = document.getElementById('flowers-container');
            container.innerHTML = '';
            createFlowers();
        }, 20000);
    </script>
</body>
</html>