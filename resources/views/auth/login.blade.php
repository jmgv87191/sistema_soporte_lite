<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        $left-color:  #242e4d;
$right-color: #897e79;
$green-dark:  #35c3c1;
$green-light: #00d6b7;
$gray:        #8f8f8f;
$gray-light:  #f5f6f8;

* {
    -webkit-font-smoothing: antialiased;
    text-rendering: optimizeLegibility;
}

html, body { height: 100%; }
body {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    position: relative;
    
    background: linear-gradient(
        135deg,
        rgba($left-color, .9),
        rgba($right-color, .9)
    );
    font-family: 'Roboto', helvetica, arial, sans-serif;
    font-size: 1.5em;
    
    &:before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        height: 100%; width: 100%;
        
        // Noise effect
        background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAMAAAAp4XiDAAAAUVBMVEWFhYWDg4N3d3dtbW17e3t1dXWBgYGHh4d5eXlzc3OLi4ubm5uVlZWPj4+NjY19fX2JiYl/f39ra2uRkZGZmZlpaWmXl5dvb29xcXGTk5NnZ2c8TV1mAAAAG3RSTlNAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEAvEOwtAAAFVklEQVR4XpWWB67c2BUFb3g557T/hRo9/WUMZHlgr4Bg8Z4qQgQJlHI4A8SzFVrapvmTF9O7dmYRFZ60YiBhJRCgh1FYhiLAmdvX0CzTOpNE77ME0Zty/nWWzchDtiqrmQDeuv3powQ5ta2eN0FY0InkqDD73lT9c9lEzwUNqgFHs9VQce3TVClFCQrSTfOiYkVJQBmpbq2L6iZavPnAPcoU0dSw0SUTqz/GtrGuXfbyyBniKykOWQWGqwwMA7QiYAxi+IlPdqo+hYHnUt5ZPfnsHJyNiDtnpJyayNBkF6cWoYGAMY92U2hXHF/C1M8uP/ZtYdiuj26UdAdQQSXQErwSOMzt/XWRWAz5GuSBIkwG1H3FabJ2OsUOUhGC6tK4EMtJO0ttC6IBD3kM0ve0tJwMdSfjZo+EEISaeTr9P3wYrGjXqyC1krcKdhMpxEnt5JetoulscpyzhXN5FRpuPHvbeQaKxFAEB6EN+cYN6xD7RYGpXpNndMmZgM5Dcs3YSNFDHUo2LGfZuukSWyUYirJAdYbF3MfqEKmjM+I2EfhA94iG3L7uKrR+GdWD73ydlIB+6hgref1QTlmgmbM3/LeX5GI1Ux1RWpgxpLuZ2+I+IjzZ8wqE4nilvQdkUdfhzI5QDWy+kw5Wgg2pGpeEVeCCA7b85BO3F9DzxB3cdqvBzWcmzbyMiqhzuYqtHRVG2y4x+KOlnyqla8AoWWpuBoYRxzXrfKuILl6SfiWCbjxoZJUaCBj1CjH7GIaDbc9kqBY3W/Rgjda1iqQcOJu2WW+76pZC9QG7M00dffe9hNnseupFL53r8F7YHSwJWUKP2q+k7RdsxyOB11n0xtOvnW4irMMFNV4H0uqwS5ExsmP9AxbDTc9JwgneAT5vTiUSm1E7BSflSt3bfa1tv8Di3R8n3Af7MNWzs49hmauE2wP+ttrq+AsWpFG2awvsuOqbipWHgtuvuaAE+A1Z/7gC9hesnr+7wqCwG8c5yAg3AL1fm8T9AZtp/bbJGwl1pNrE7RuOX7PeMRUERVaPpEs+yqeoSmuOlokqw49pgomjLeh7icHNlG19yjs6XXOMedYm5xH2YxpV2tc0Ro2jJfxC50ApuxGob7lMsxfTbeUv07TyYxpeLucEH1gNd4IKH2LAg5TdVhlCafZvpskfncCfx8pOhJzd76bJWeYFnFciwcYfubRc12Ip/ppIhA1/mSZ/RxjFDrJC5xifFjJpY2Xl5zXdguFqYyTR1zSp1Y9p+tktDYYSNflcxI0iyO4TPBdlRcpeqjK/piF5bklq77VSEaA+z8qmJTFzIWiitbnzR794USKBUaT0NTEsVjZqLaFVqJoPN9ODG70IPbfBHKK+/q/AWR0tJzYHRULOa4MP+W/HfGadZUbfw177G7j/OGbIs8TahLyynl4X4RinF793Oz+BU0saXtUHrVBFT/DnA3ctNPoGbs4hRIjTok8i+algT1lTHi4SxFvONKNrgQFAq2/gFnWMXgwffgYMJpiKYkmW3tTg3ZQ9Jq+f8XN+A5eeUKHWvJWJ2sgJ1Sop+wwhqFVijqWaJhwtD8MNlSBeWNNWTa5Z5kPZw5+LbVT99wqTdx29lMUH4OIG/D86ruKEauBjvH5xy6um/Sfj7ei6UUVk4AIl3MyD4MSSTOFgSwsH/QJWaQ5as7ZcmgBZkzjjU1UrQ74ci1gWBCSGHtuV1H2mhSnO3Wp/3fEV5a+4wz//6qy8JxjZsmxxy5+4w9CDNJY09T072iKG0EnOS0arEYgXqYnXcYHwjTtUNAcMelOd4xpkoqiTYICWFq0JSiPfPDQdnt+4/wuqcXY47QILbgAAAABJRU5ErkJggg==);
        opacity: .3;
    }
}

.login-form {
    width: 100%;
    padding: 2em;
    position: relative;
    background: rgba(black, .15);
    border: 4px solid rgba(0, 0, 0, 0.466);
    border-radius: 10px;
    &:before {
        content: '';
        position: absolute;
        top: -2px; left: 0;
        height: 2px; width: 100%;
        background: linear-gradient(
            to right,
            $green-dark,
            $green-light
        );    
    }

    @media screen and (min-width: 600px) {
        width: 50vw;
        max-width: 15em;
    }
}

    .flex-row {
        display: flex;
        margin-bottom: 1em;
    }

    .lf--label {
        width: 2em;
        display: flex;
        align-items: center;
        justify-content: center;
        
        background: $gray-light;
        cursor: pointer;
    }

    .lf--input {
        flex: 1;
        padding: 1em;
        border: 0;
        color: $gray;
        font-size: 1rem;
        
        &:focus {
            outline: none;
            transition: transform .15s ease;
            transform: scale(1.1);
        }
    }

    .lf--submit {
        display: block;
        padding: 1em;
        width: 100%;
        
        background: rgb(53, 114, 68);
        border: 0;
        color: #fff;
        cursor: pointer;
        font-size: .75em;
        font-weight: 600;
        text-shadow: 0 1px 0 rgba(black, .2);

    }

    .lf--submit:hover {
            outline: none;
            transition: transform .15s ease;
            transform: scale(1.1);
        background: rgb(86, 124, 95);
        }

.lf--forgot {
  margin-top: 1em;
  color: $green-light;
  font-size: .65em;
  text-align: center;
  position: relative;
}

::placeholder { color: $gray; }
    </style>
</head>
<body>
    <p id="error" style="color:red;"></p>



    <form id="loginForm" class='login-form'>
                @csrf

        <div class="flex-row">
          <label class="lf--label" for="username">
            <svg x="0px" y="0px" width="12px" height="13px">
              <path fill="#B1B7C4" d="M8.9,7.2C9,6.9,9,6.7,9,6.5v-4C9,1.1,7.9,0,6.5,0h-1C4.1,0,3,1.1,3,2.5v4c0,0.2,0,0.4,0.1,0.7 C1.3,7.8,0,9.5,0,11.5V13h12v-1.5C12,9.5,10.7,7.8,8.9,7.2z M4,2.5C4,1.7,4.7,1,5.5,1h1C7.3,1,8,1.7,8,2.5v4c0,0.2,0,0.4-0.1,0.6 l0.1,0L7.9,7.3C7.6,7.8,7.1,8.2,6.5,8.2h-1c-0.6,0-1.1-0.4-1.4-0.9L4.1,7.1l0.1,0C4,6.9,4,6.7,4,6.5V2.5z M11,12H1v-0.5 c0-1.6,1-2.9,2.4-3.4c0.5,0.7,1.2,1.1,2.1,1.1h1c0.8,0,1.6-0.4,2.1-1.1C10,8.5,11,9.9,11,11.5V12z"/>
            </svg>
          </label>
          <input id="username" name="email" class='lf--input' placeholder='Username' type='email'>
        </div>
        <div class="flex-row">
          <label class="lf--label" for="password">
            <svg x="0px" y="0px" width="15px" height="5px">
              <g>
                <path fill="#B1B7C4" d="M6,2L6,2c0-1.1-1-2-2.1-2H2.1C1,0,0,0.9,0,2.1v0.8C0,4.1,1,5,2.1,5h1.7C5,5,6,4.1,6,2.9V3h5v1h1V3h1v2h1V3h1 V2H6z M5.1,2.9c0,0.7-0.6,1.2-1.3,1.2H2.1c-0.7,0-1.3-0.6-1.3-1.2V2.1c0-0.7,0.6-1.2,1.3-1.2h1.7c0.7,0,1.3,0.6,1.3,1.2V2.9z"/>
              </g>
            </svg>
          </label>
          <input id="password" name="password" class='lf--input' placeholder='Password' type='password'>
        </div>
        <input class='lf--submit' type='submit' value='LOGIN'>
    </form>

    

    <script>
        const form = document.getElementById('loginForm');
        const errorEl = document.getElementById('error');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            try {
                const res = await fetch("{{ url('/login') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(data)
                });

                const result = await res.json();

                if (res.ok) {
                    // 🟩 Guardar token y datos del usuario
                    localStorage.setItem('auth_token', result.data.token);
                    localStorage.setItem('user', JSON.stringify(result.data.user));

                    console.log("Usuario guardado en localStorage:", result.data.user);

                    // 🧭 Redirigir según el rol
                    const role = result.data.user.role;
                    if (role === 'admin') {
                        window.location.href = "/ticketspinoy/public/admin/dashboard";
                    } else if (role === 'user') {
                        window.location.href = "/ticketspinoy/public/user/dashboard";
                    } else {
                        window.location.href = "/ticketspinoy/public/";
                    }

                } else {
                    errorEl.textContent = result.message || "Error en las credenciales.";
                }

            } catch (err) {
                errorEl.textContent = "Ocurrió un error en el login.";
                console.error("Error en login:", err);
            }
        });
    </script>
</body>
</html>
