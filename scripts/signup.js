var form = document.getElementById("form");
var loginBtn = document.getElementById("loginBtn");

form.addEventListener("submit", event => {
  event.preventDefault();
});

loginBtn.addEventListener("click", event => {
  location.href = "login.html";
});
