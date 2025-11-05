<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirme seu e-mail</title>
</head>
<body>
    <h2>Olá, {{ $user->name }}!</h2>
    <p>Obrigado por se registrar. Clique no link abaixo para confirmar seu e-mail:</p>

    <p>
        <a href="http://localhost:8000/dashboard" style="background:#4f46e5; color:white; padding:10px 20px; text-decoration:none; border-radius:5px;">
            Confirmar e-mail
        </a>
    </p>

    <p>Se você não criou esta conta, pode ignorar este e-mail.</p>
</body>
</html>
