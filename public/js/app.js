const API = "http://127.0.0.1:8000/api";

const token = localStorage.getItem("token");

if (!token && 
    window.location.pathname !== "/login" && 
    window.location.pathname !== "/register"
    ) {
    window.location.href = "/login";
}


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

        const res = await fetch(`${API}/register `, {
            method : "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(data)
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

//////////////////// LOGIN ///////////////////////

const loginForm = document.getElementById('loginForm');

if (loginForm) {
    loginForm.addEventListener('submit', async(e) => {
        e.preventDefault();
        
        const data = {
            email : document.getElementById("emial").value,
            password : document.getElementById('password').value,
        };

        const res = await fetch(`${API}/login`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(data)
        });

        const result = await res.json();

        if (result.token) {
            localStorage.setItem("token", result.token);
            alert("Login successful");
            window.location.href = "/";
        } else {
            alert("Invalid credentials");
        }
    })
}

//////////////////// LOUGOUT ////////////////////

async function logout() {
    const token = localStorage.getItem("token");

    await fetch(`${API}/logout`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`,
            "Accept": "application/json"
        }
    });

    localStorage.removeItem("token");
    alert("Logged out");
    window.location.href = "/login";
}

//////////////////// GET COURSES ////////////////

const courseContainer = document.getElementById("courseContainer");

if (courseContainer) {
    fetchCourses();
}

async function fetchCourses() {
    const token = localStorage.getItem("token");

    const res = awaitfetch(`${API}/courses`, {
        headers : {
            "Authorization" : `Bearer ${token}`,
            "Accept" : "application/json"
        }
    });

    const courses = await res.json();

    window.allCourses = courses;
    displayCourses(courses);
}

function displayCourses(courses) {
    courseContainer.innerHTML = ""

    courses.forEach(course => {
        courseContainer.innerHTML += `
            <div>
                <h3>${course.title}</h3>
                <p>${course.description}</p>
                <p>Price : ${course.price}</p>
                <button onclick="viewCourse(${course.id})">View</button>
            </div>
        `;
    });
}

const searchInput = document.getElementById("search");

if (searchInput) {
    searchInput.addEventListener("input" , (e) => {
        const value = e.target.value.toLowerCase();

        const filtered = window.allCourses.filter(course => 
            course.title.toLowerCase().includes(value)
        );
        displayCourses(filtered);
    })
}

function viewCourse(id) {
    window.location.href = `/courses/${id}`;
}

