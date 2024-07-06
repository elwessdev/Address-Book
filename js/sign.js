const loginSection = document.querySelector('.login-section');
const signupSection = document.querySelector('.signup-section');

function showLogin() {
  loginSection.style.display = 'block';
  signupSection.style.display = 'none';
}
showLogin();

function showSignup() {
  loginSection.style.display = 'none';
  signupSection.style.display = 'block';
}

const loginButton = document.querySelector('.login-button');
const signupButton = document.querySelector('.signup-button');
loginButton.addEventListener('click', showLogin);
signupButton.addEventListener('click', showSignup);