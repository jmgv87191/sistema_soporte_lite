<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <p id="error" style="color:red;"></p>

    <form id="loginForm">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>

    <script>
        const form = document.getElementById('loginForm');
        const errorEl = document.getElementById('error');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            try {
                const res = await 
fetch("{{ url('/login') }}", {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": "{{ csrf_token() }}"
    },
    body: JSON.stringify(data)
});

                const result = await res.json();

                if(res.ok){
                    // Guardar token en localStorage
                    localStorage.setItem('auth_token', result.data.token);

                    // Redirigir según rol
                    if(result.data.user.role === 'admin'){
                        window.location.href = "/ticketspinoy/public/admin/dashboard";
                    } else if(result.data.user.role === 'user'){
                        window.location.href = "/ticketspinoy/public/user/dashboard";
                    }
                } else {
                    errorEl.textContent = result.message;
                }

            } catch(err){
                errorEl.textContent = "Ocurrió un error en el login.";
                console.error(err);
            }
        });
    </script>
</body>
</html>
