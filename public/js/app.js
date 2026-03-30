const API = "http://127.0.0.1:8000/api";

//////////////////// REGISTER //////////////////////

const registerForm = document.getElementById('registerForm');

if (registerForm) {
    registerForm.addEventListener("submit" , async (e) => {
        e.preventDefault();

        const data = {
            name: document.getElementById("name").value,
            email: document.getElementById("email").value,
            password: document.getElementById("password").value,
            role: document.getElementById("role").value,
        };

        const res = await fetch('${API}/register' , {
            method : "POST",
            headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
            },
            body: stringify(data)
        });

        const result = await res.json();

        if (result.token) {
            localStorage.setItem("token", result.token);
            alert("registred successfuly");
            window.location.href = "/";
        } else {
            alert("Error");
        }
    });
}

