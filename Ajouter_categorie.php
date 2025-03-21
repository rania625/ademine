<?php include 'include/nav.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Ajouter Catégorie</title>
    <style>
        :root {
            --primary: #ff69b4;
            --background: #fff5f7;
            --text: #2d3436;
            --card-bg: #ffffff;
            --input-bg: #ffffff;
            --placeholder: #999;
        }

        .dark-mode {
            --primary: #ff69b4;
            --background: #1a1a1a;
            --text: #ffffff;
            --card-bg: #2d2d2d;
            --input-bg: #333;
            --placeholder: #666;
        }

        body {
            background: var(--background);
            color: var(--text);
            transition: all 0.3s ease;
            min-height: 100vh;
        }

        .container {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-top: 2rem;
            position: relative;
            z-index: 1;
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-control, .form-control:focus {
            background: var(--input-bg);
            border: 2px solid transparent;
            border-radius: 15px;
            padding: 1rem 1rem 1rem 3rem;
            color: var(--text);
            transition: all 0.3s;
            box-shadow: none;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(255, 105, 180, 0.25);
        }

        .form-control::placeholder {
            color: var(--placeholder);
        }

        .form-group i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 1.2rem;
            z-index: 2;
        }

        textarea.form-control {
            min-height: 120px;
            padding-top: 1rem;
        }

        .form-group textarea + i {
            top: 1.5rem;
        }

        .btn-primary {
            background: var(--primary);
            border: none;
            border-radius: 15px;
            padding: 1rem 2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255,105,180,0.3);
        }

        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--card-bg);
            border: none;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .theme-toggle i {
            color: var(--primary);
            font-size: 1.2rem;
        }

        h4 {
            color: var(--primary);
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .alert {
            border-radius: 15px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .floating-flower {
            position: fixed;
            pointer-events: none;
            animation: float linear infinite;
            opacity: 0.3;
            z-index: 0;
        }

        @keyframes float {
            0% {
                transform: translateY(-100vh) rotate(0deg);
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
            }
        }

        .form-label {
            color: var(--text);
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
  
    <div class="container">
        <h4><i class="fas fa-folder-plus me-2"></i>Ajouter catégorie</h4>
        
        <?php
        if (isset($_POST['ajouter'])) {
            $libelle = htmlspecialchars($_POST['libelle']);
            $description = htmlspecialchars($_POST['description']);

            if (!empty($libelle) && !empty($description)) {
                require_once 'include/database.php';
                $sqlstate = $pdo->prepare('INSERT INTO categorie(libelle, description) VALUES (?, ?)');
                $sqlstate->execute([$libelle, $description]);
                echo '<div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        La catégorie ' . htmlspecialchars($libelle) . ' a bien été ajoutée.
                      </div>';
            } else {
                echo '<div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Libelle et description sont obligatoires.
                      </div>';
            }
        }
        ?>

        <form method="POST" class="needs-validation" novalidate>
            <div class="form-group">
                <label class="form-label">Libelle *</label>
                <i class="fas fa-tag"></i>
                <input type="text" class="form-control" name="libelle" placeholder="Entrez le libellé" required>
            </div>

            <div class="form-group">
                <label class="form-label">Description *</label>
                <i class="fas fa-align-left"></i>
                <textarea class="form-control" name="description" placeholder="Entrez la description" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary" name="ajouter">
                <i class="fas fa-plus-circle me-2"></i>Ajouter catégorie
            </button>
        </form>
    </div>

    <button class="theme-toggle" onclick="toggleTheme()">
        <i class="fas fa-moon"></i>
    </button>

    <script>
        // Your existing toggleTheme and createFlowers functions here
        function toggleTheme() {
            document.body.classList.toggle('dark-mode');
            const icon = document.querySelector('.theme-toggle i');
            if (document.body.classList.contains('dark-mode')) {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        }

        function createFlowers() {
            const container = document.body;
            const flowerEmojis = ['🌸', '🌺', '🌹', '🌷', '💐'];
            const numberOfFlowers = 20;

            for (let i = 0; i < numberOfFlowers; i++) {
                const flower = document.createElement('div');
                flower.classList.add('floating-flower');
                flower.textContent = flowerEmojis[Math.floor(Math.random() * flowerEmojis.length)];
                
                flower.style.left = `${Math.random() * 100}vw`;
                flower.style.fontSize = `${Math.random() * 20 + 10}px`;
                flower.style.animationDuration = `${Math.random() * 5 + 5}s`;
                flower.style.animationDelay = `${Math.random() * 5}s`;

                container.appendChild(flower);
            }
        }

        createFlowers();

        // Form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>