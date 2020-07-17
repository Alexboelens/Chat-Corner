const first = document.getElementById("first");
const second = document.getElementById("second");

const register = document.getElementById("register");
const login = document.getElementById("login");

register.onclick = () => {
    first.style.display = "none";
    second.style.display = "block";
}

login.onclick = () => {
    first.style.display = "block";
    second.style.display = "none";
}
