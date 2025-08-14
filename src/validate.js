$(document).ready(function () {
  $('#loginForm').on('submit', function (e) {
    e.preventDefault(); $('#loginbtn').html('loading...').add("fw-bold");


setTimeout(() => {
const email = $('#email').val().trim();
const password = $('#password').val().trim();

if (!email || !password) { $('#err').html('password field Empty!');
      return;
    }


const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
if (!emailPattern.test(email)) {
$('#err').html('Provide a valid Email Address');
      return;
    }


    // Send AJAX request
    $.ajax({
      url: 'src/login',
      type: 'POST',
      data: { email, password },
      beforeSend: function () {
        // Optionally, display a loading indicator
      },
      success: function (response) {
           $('#err').html(response);
          $('#loginbtn').html('Log In');
      },
      error: function () {
        $('#err').html('An error occurred. Please try again later');
        $('#loginbtn').html('Log In');
      }
    });
}, 3000);

  });




});


