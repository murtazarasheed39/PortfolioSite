document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("registerForm");

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    const fullName = document.getElementById("fullname").value.trim();
    const email = document.getElementById("email").value.trim();
    const dob = document.getElementById("dob").value;

    const nameRegex = /^[A-Za-z\s]+$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!nameRegex.test(fullName)) {
      alert("Please enter a valid name with only letters and spaces.");
      return;
    }

    if (!emailRegex.test(email)) {
      alert("Please enter a valid email address.");
      return;
    }

    if (dob) {
      const date = new Date(dob);
      const today = new Date();
      if (date >= today) {
        alert("Date of birth must be in the past.");
        return;
      }
    }

    alert("Form submitted successfully!");
    form.reset();
  });
});
