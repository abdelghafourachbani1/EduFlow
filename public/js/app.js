const API = "http://127.0.0.1:8000/api";

const token = localStorage.getItem("token");
const userRole = localStorage.getItem("role");

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
            localStorage.setItem("role", result.user.role);
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
            localStorage.setItem("role", result.user.role);
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

    const res = await fetch(API + "courses", {
        headers: {
            "Authorization": `Bearer ${token}`,
            "Accept": "application/json"
        }
    });

    const courses = await res.json();

    displayCourses(courses);
}

function displayCourses(courses) {
    const container = document.getElementById("coursesContainer");
    container.innerHTML = "";

    const role = localStorage.getItem("role");

    courses.forEach(course => {
        let buttons = "";

        if (role === "teacher") {
            buttons = `
                <button onclick="editCourse(${course.id})">Edit </button>
                <button onclick="deleteCourse(${course.id})">Delete </button>
            `;
        }

        if (role === "student") {
            buttons = `
                <button onclick="enroll(${course.id})">Enroll </button>
                <button onclick="pay(${course.id})">Pay </button>
            `;
        }

        container.innerHTML += `
            <div class="course">
                <h3>${course.title}</h3>
                <p>${course.description}</p>
                <p>Price: ${course.price} DH</p>

                <button onclick="fetchCourse(${course.id})">View </button>

                ${buttons}
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

const courseDetails = document.getElementById("courseDetails");

if (courseDetails) {
    const id = window.location.pathname.split("/")[2];
    fetchCourses(id);
}

async function fetchCourses(id) {
    const token = localStorage.getItem("token");

    const res = await fetch(`${API}/couurses/${id}`, {
        headers: {
            "Authorization" : `Bearer ${token}`,
            "Accept" : "application/json"
        }
    });

    const course = await res.json()

    courseDetails.innerHTML = `
        <h3>${course.title}</h3>
        <p>${course.description}</p>
        <p>Price: ${course.price}</p>
        <button onclick="enroll(${course.id})">Enroll </button>
        <button onclick="pay(${course.id})">Pay </button>
        <button onclick="withdraw(${course.id})">Withdraw </button>
        <button onclick="getGroups(${course.id})">View Groups 👥</button>
        <div id="groupsContainer"></div>
    `;
}

///////////////// CREATE Logic //////////// 

const constForm = document.getElementById("createCourseForm");

if (createForm) {
    createForm.addEventListener("submit" , async (e) => {
        e.preventDefault();

        const token = localStorage.getItem("token");

        const data = {
            title : document.getElementById("title").value,
            description : document.getElementById("description").value,
            price : document.getElementById("price").value,
        };

        const res = await fetch(`${API}/courses` , {
            method : "POST",
            headers : {
                "Authorization" : `Bearer ${token}`,
                "Content-Type" : "application/json",
                "Accept" : "application/json"
            },
            body : JSON.stringify(data)
        });

        const result = await res.json();

        alert("Course created");
        fetchCourses();
    });
}

////////////// DELETE Logique /////////////// 

async function deleteCourse(id) {
    const token = localStorage.getItem("token");

    await fetch(`${API}/courses/${id}`, {
        method: "DELETE",
        headers: {
            "Authorization": `Bearer ${token}`,
            "Accept": "application/json"
        }
    });

    alert("Deleted");
    fetchCourses();
}

/////////////// Update Logique /////////////

async function updateCourse(id) {
    const title = prompt("New title:");

    const token = localStorage.getItem("token");

    await fetch(`${API}/courses/${id}`, {
        method: "PUT",
        headers: {
            "Authorization": `Bearer ${token}`,
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify({ title })
    });

    alert("Updated");
    fetchCourses();
}

///////// Add to wishlist //////////////

async function addToWishlist(courseId) {
    const token = localStorage.getItem("token");

    await fetch(`${API}/wishlist/${courseId}`, {
        method : "POST",
        headers : {
            "Authorization" : `Bearer ${token}`,
            "Accept": "application/json"
        }
    });

    alert("added to wishlist");
}

/////////// Fetch Wishlist //////////////

const wishlistContainer = document.getElementById('wishlistContainer');

if (wishlistContainer) {
    fetchCourses();
}

async function fetchWishlist() {
     const token = localStorage.getItem("token");

     const res = await fetch(`${API}/wishlist`, {
        headers : {
            "Authorization" : `Bearer ${token}`,
            "Accept" : "application/json"
        }
     });

     const courses = await res.json();

     wishlistContainer.innerHTML = "";

     courses.forEach(course => {
        wishlistContainer.innerHTML +=  
        `<div>
            <h3>${course.title}</h3>
            <button onclick="removeFromWishlist(${course.id})">Remove</button>
            </div>`;
     });
}

//////////// Remove Wishlist ////////////

async function removeFromWishlist(courseId) {
    const token = localStorage.getItem("token");

    await fetch(`${API}/wishlist/${courseId}`, {
        method : "DELETE",
        headers : {
            "Authorization" : `Bearer ${token}`,
            "Accept" : "application/json"
        }
    });
    fetchWishlist();
}

/////////////// Enroll Course ///////////////

async function enroll(courseId) {
    const token = localStorage.getItem("token");

    await fetch(`${API}/enroll/${courseId}`, {
        method : "POST",
        headers : {
            "Authorization" : `Bearer ${token}`,
            "Accept" : "application/"
        }
    });

    alert("Enrolled successfully");

}

/////////// pay logiq //////////////

async function pay(courseId) {
    const token = localStorage.getItem("token");

    const res = await fetch(`${API}/pay/${courseId}`, {
        method : "POST",
        headers : {
            "Authorization" : `Bearer ${token}`,
            "Accept" : "application/json"
        }
    });

    const data = await res.json();

    window.location.href = data.url;
}

async function getGroups(courseId) {
    const token = localStorage.getItem("token");

    const res = await fetch(`${API}/courses/${courseId}/groups`, {
        headers : {
            "Authorization" : `Bearer ${token}`,
            "Accept" : "application/json"
        }
    });

    const groups = await res.json();

    const container = document.getElementById("groupsContainer");

    container.innerHTML = "";

    groups.forEach(group => {
        container.innerHTML += `
            <div>
                <h4>Group ${group.id}</h4>
                <p>Students : ${group.students.length}</p>
            </div>
        `;
    })
}

function handleRoleUI() {
    const role = localStorage.getItem("role");
    const createBtn = document.getElementById("createCourseBtn");

    if (createBtn) {
        if (role !== "teacher") {
            createBtn.style.display = "none";
        }
    }
}
