const toggleForms = (formType) => {
  const elements = {
    left: document.getElementById("modalLeft"),
    right: document.getElementById("modalRight"),
    leftTitle: document.getElementById("modalLeftTitle"),
    rightTitle: document.getElementById("modalRightTitle"),
    signupForm: document.getElementById("signupForm"),
    loginForm: document.getElementById("loginForm"),
    toggleButton: document.getElementById("toggleButton")
  };

  const isSignup = formType === "signup";
  elements.left.classList.toggle("slide-right", !isSignup);
  elements.right.classList.toggle("slide-left", !isSignup);
  elements.leftTitle.textContent = isSignup ? "Welcome!" : "Welcome Back!";
  elements.rightTitle.textContent = isSignup ? "Sign up" : "Log in";
  elements.signupForm.style.display = isSignup ? "block" : "none";
  elements.loginForm.style.display = isSignup ? "none" : "block";
  elements.toggleButton.textContent = isSignup ? "LOG IN" : "SIGN UP";
  elements.toggleButton.onclick = () => toggleForms(isSignup ? "login" : "signup");
};

document.addEventListener("DOMContentLoaded", () => {

  document.getElementById("authModal").addEventListener("show.bs.modal", (event) => {
    toggleForms(event.relatedTarget.getAttribute("data-form"));
  });

  const toasts = document.querySelectorAll('.toast');
  toasts.forEach(toast => {
    const bsToast = new bootstrap.Toast(toast, {
      delay: 5000
    });
    bsToast.show();
  });
});

window.addEventListener("load", () => {
  const authBtn = document.getElementById('AuthBtn');
  if (authBtn) {
    authBtn.removeAttribute('disabled');
  }
});
