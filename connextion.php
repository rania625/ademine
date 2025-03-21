<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Connexion</title>
    <style>
        :root {
            --primary: #ff69b4;
            --background: #fff;
            --text: #2d3436;
        }

        .dark-mode {
            --primary: #ff69b4;
            --background: #1a1a1a;
            --text: #ffffff;
        }

        body {
            background: var(--background);
            color: var(--text);
            transition: background 0.3s, color 0.3s;
        }

        .btn-primary {
            background: var(--primary);
            border: none;
            border-radius: 10px;
            padding: 0.8rem 2rem;
            transition: background 0.3s;
        }

        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.8);
            border: 2px solid var(--primary);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: background 0.3s, border-color 0.3s;
        }

        .theme-toggle:hover {
            background: var(--primary);
        }

        .floating-flower {
            position: absolute;
            pointer-events: none;
            animation: float linear infinite;
            opacity: 0.6;
            top: -50px;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
            }
        }

        input.form-control {
            border: 2px solid var(--primary);
            border-radius: 10px;
            padding: 0.8rem;
            transition: border-color 0.3s;
        }

        input.form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(255, 105, 180, 0.25);
        }
    </style>
</head>
<body>
    <?php include 'include/nav.php'; ?>
    <div class="container py-2">
        <h4>Connexion</h4>
        <?php
        if (isset($_POST['connexion'])) {
            $login = htmlspecialchars($_POST['login']);
            $pwd = htmlspecialchars($_POST['password']);
    
            if (!empty($login) && !empty($pwd)) {
                require_once 'include/database.php';
                try {
                    $sqlstate = $pdo->prepare('SELECT * FROM utilisateur WHERE login=? AND password=?');
                    $sqlstate->execute([$login, $pwd]);

                    if ($sqlstate->rowCount() >= 1) {
                        $_SESSION['utilisateur'] = $sqlstate->fetch();
                        header('location: admine.php');
                    } else {
                        echo '<div class="alert alert-danger">Login ou mot de passe incorrect</div>';
                    }
                } catch (PDOException $e) {
                    echo '<div class="alert alert-danger">Erreur de connexion à la base de données</div>';
                }
            } else {
                echo '<div class="alert alert-warning">Veuillez remplir tous les champs</div>';
            }
        }
        ?>
        <form method="POST">
            <label class="form-label">Login</label>
            <input type="text" class="form-control" name="login" required>
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
            <input type="submit" value="Connexion" class="btn btn-primary my-2" name="connexion">
        </form>
    </div>

    <script>
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

        const themeToggleButton = document.createElement('button');
        themeToggleButton.classList.add('theme-toggle');
        themeToggleButton.onclick = toggleTheme;
        themeToggleButton.innerHTML = '<i class="fas fa-moon"></i>';
        document.body.appendChild(themeToggleButton);

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
    </script>
</body>
</html>