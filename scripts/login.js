var form = document.getElementById("form");
var signUpBtn = document.getElementById("signUpBtn");

form.addEventListener("submit", event => {
  event.preventDefault();
});

signUpBtn.addEventListener("click", event => {
  location.href = "sign-up.html";
});
