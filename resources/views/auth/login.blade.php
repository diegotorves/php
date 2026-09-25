<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Entrar | DCD Condomínios</title>
    <style>
        *{box-sizing:border-box}body{margin:0;min-height:100vh;font-family:Inter,ui-sans-serif,system-ui;background:#f4f7fb;color:#172033;display:grid;place-items:center;padding:24px}.card{width:min(430px,100%);background:#fff;border:1px solid #e5eaf1;border-radius:20px;padding:40px;box-shadow:0 18px 50px #1d355712}.brand{display:flex;align-items:center;gap:12px;margin-bottom:30px}.brand-mark{width:42px;height:42px;border-radius:12px;background:#2563eb;color:#fff;display:grid;place-items:center;font-weight:800;font-size:20px}.eyebrow{color:#2563eb;font-size:12px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;margin:0 0 5px}.brand h1{font-size:20px;margin:0}.subtitle{color:#64748b;font-size:14px;margin:0 0 28px}label{display:block;font-size:13px;font-weight:600;margin:18px 0 8px}input{width:100%;border:1px solid #d7dee9;border-radius:10px;padding:13px 14px;font-size:15px;outline:none}input:focus{border-color:#2563eb;box-shadow:0 0 0 3px #2563eb1a}.button{width:100%;border:0;border-radius:10px;background:#2563eb;color:#fff;padding:14px;font-size:15px;font-weight:700;cursor:pointer;margin-top:25px}.button:disabled{opacity:.65;cursor:wait}.error{display:none;border-radius:9px;background:#fef2f2;color:#b91c1c;padding:11px 13px;font-size:13px;margin-top:18px}.footer{text-align:center;color:#94a3b8;font-size:12px;margin-top:28px}
    </style>
</head>
<body>
<main class="card">
    <div class="brand"><div class="brand-mark">D</div><div><p class="eyebrow">Gestão condominial</p><h1>DCD Condomínios</h1></div></div>
    <p class="subtitle">Entre para gerenciar manutenções, orçamentos e fornecedores.</p>
    <form id="login-form">
        <label for="email">E-mail</label><input id="email" name="email" type="email" autocomplete="username" placeholder="seu@email.com" required>
        <label for="password">Senha</label><input id="password" name="password" type="password" autocomplete="current-password" placeholder="Digite sua senha" required>
        <div id="error" class="error" role="alert"></div>
        <button class="button" type="submit">Entrar</button>
    </form>
    <div class="footer">Acesso seguro para administradores, síndicos e fornecedores</div>
</main>
<script>
document.getElementById('login-form').addEventListener('submit', async (event) => {
    event.preventDefault();
    const form = event.currentTarget, button = form.querySelector('button'), error = document.getElementById('error');
    error.style.display = 'none'; button.disabled = true; button.textContent = 'Entrando...';
    try {
        const response = await fetch('/api/auth/login', {method:'POST', headers:{'Accept':'application/json','Content-Type':'application/json'}, body:JSON.stringify({email:form.email.value,password:form.password.value})});
        const data = await response.json();
        if (!response.ok) throw new Error(data.message || 'Não foi possível entrar.');
        localStorage.setItem('auth_token', data.token); localStorage.setItem('auth_user', JSON.stringify(data.user));
        window.location.href = '/';
    } catch (exception) { error.textContent = exception.message; error.style.display = 'block'; }
    finally { button.disabled = false; button.textContent = 'Entrar'; }
});
</script>
</body>
</html>
