// "use strict";

///////////////////////////////////////////////////// index ////////////////////////////////////////////////////////////////

function index() {
  // alert("Index");

  // Close Alert
  document.getElementById("close").onclick = function () {
    document.getElementById("alertDiv").classList.toggle("d-none");
  };
  document.getElementById("v_close").onclick = function () {
    document.getElementById("v_alertDiv").classList.toggle("d-none");
  };
  // Close Alert
}

function showPassword() {
  // alert("Show Password");

  var password = document.getElementById("password");
  var show = document.getElementById("btn");

  if (password.type == "password") {
    password.type = "text";
    show.innerHTML = "<i class='bi bi-eye-fill'></i>";
  } else {
    password.type = "password";
    show.innerHTML = "<i class='bi bi-eye-slash-fill'></i>";
  }
}

//////////////////////////////////////////////////////////// User /////////////////////////////////////////////////////////////

var verifyModal;

function sign_in(user) {
  // alert("Log In");
  // alert(user);

  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  var remember = document.getElementById("remember").checked;
  //   alert(username + " : " + password + " : " + remember + " " + user);

  var form = new FormData();

  form.append("username", username);
  form.append("password", password);
  form.append("remember", remember);
  form.append("user", user);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert(response);
      document.getElementById("alertDiv").classList.add("d-none");
      if (response == "success") {
        // alert(response);
        window.location = "home.php";
      } else if (response == "unverified") {
        // alert(response);
        alert(
          "Looks like you haven't been verified yet. Please continue for verification"
        );
        var modal = document.getElementById("verifyModal");
        verifyModal = new bootstrap.Modal(modal);
        verifyModal.show();
      } else {
        document.getElementById("alertDiv").classList.remove("d-none");
        document.getElementById("alert").innerHTML = response;
      }
    }
  };

  request.open("POST", "modules/signInProcess.php", true);
  request.send(form);
}

function verify(user) {
  // alert("Verify");

  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  var vcode = document.getElementById("vcode").value;
  var remember = document.getElementById("remember").checked;

  //   alert(username+" : "+password+" : "+vcode+" : "+user);

  var form = new FormData();

  form.append("vcode", vcode);
  form.append("user", user);
  form.append("username", username);
  form.append("password", password);
  form.append("remember", remember);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      // if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert(response);
      console.log(response);
      document.getElementById("v_alertDiv").classList.add("d-none");
      if (response == "success") {
        // alert(response);
        verifyModal.hide();
        alert("Verified");
        window.location = "home.php";
      } else {
        // alert(response);
        document.getElementById("v_alertDiv").classList.remove("d-none");
        document.getElementById("v_msgDiv").innerHTML = response;
      }
    }
  };

  request.open("POST", "modules/verifyUserProcess.php", true);
  request.send(form);
}

function request(user) {
  // alert("Request Verify Code");

  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;

  //   alert(username+" : "+password+" : "+user);

  var form = new FormData();

  form.append("user", user);
  form.append("username", username);
  form.append("password", password);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // console.log(response);
      document.getElementById("v_alertDiv").classList.add("d-none");
      if (response == "success") {
        alert(
          "New code send has been send successfully. Check your inbox for new Code."
        );
      } else {
        // console.log(response);
        document.getElementById("v_alertDiv").classList.remove("d-none");
        document.getElementById("v_msgDiv").innerHTML = response;
      }
    }
  };

  request.open("POST", "modules/requestCodeProcess.php", true);
  request.send(form);
}

/////////////////////////////////////////////////////////// admin /////////////////////////////////////////////////////////////

function sendVerification() {
  //   alert("Send Verification Admin");

  var username = document.getElementById("username");
  var password = document.getElementById("password");
  // alert(email);

  var field_box = document.getElementById("field_box");
  var vcode_box = document.getElementById("vcode_box");
  var btn = document.getElementById("ad_log_in");
  var vcode = document.getElementById("ad_vcode");
  var send = document.getElementById("send_btn");
  var alertDiv = document.getElementById("alertDiv");

  var resend = document.getElementById("re_send_btn");
  resend.onclick = function () {
    alert("Sending");
    sendVerification();
  };

  var form = new FormData();
  form.append("username", username.value);
  form.append("password", password.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert(response);
      if (response == "success") {
        var msg = "Verification Code Send Successfully. Check your inbox.";

        username.disabled = true;
        password.disabled = true;
        resend.disabled = false;

        field_box.classList.add("d-none");
        send.classList.add("d-none");

        vcode_box.classList.remove("d-none");
        vcode.disabled = false;
        vcode.placeholder = msg;
        vcode.value = "";

        alertDiv.classList.add("d-none");

        btn.classList.remove("d-none");
        btn.onclick = function () {
          ad_sign_in(vcode.value);
        };
      } else {
        // alert(response);
        btn.classList.add("d-none");
        field_box.classList.remove("d-none");
        alertDiv.classList.remove("d-none");
        document.getElementById("ad_alert").innerHTML = response;
      }
    }
  };

  request.open("POST", "modules/sendVerificationProcess.php", true);
  request.send(form);
}

function ad_sign_in(code) {
  // alert("Admin Log In");
  // alert(code);

  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  var remember = document.getElementById("remember").checked;
  // alert(username + " : " + password + " : " + remember);

  var form = new FormData();

  form.append("username", username);
  form.append("password", password);
  form.append("remember", remember);
  form.append("vcode", code);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert(response);
      document.getElementById("alertDiv").classList.add("d-none");
      if (response == "success") {
        window.location = "adminPanel.php";
        // alert(response);
      } else {
        document.getElementById("alertDiv").classList.remove("d-none");
        document.getElementById("ad_alert").innerHTML = response;
      }
    }
  };

  request.open("POST", "modules/adLogInProcess.php", true);
  request.send(form);
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var indexModal;
function forgotPass(user) {
  // alert("Forgot Password");

  var email = document.getElementById("username").value;
  // alert(email);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert(response);
      if (response == "success") {
        alert(
          "Verification code has sent to your email. Please check your inbox"
        );
        var modal = document.getElementById("forgotPasswordModal");
        indexModal = new bootstrap.Modal(modal);
        indexModal.show();
      } else {
        alert(response);
      }
    }
  };

  request.open(
    "GET",
    "modules/forgotPasswordProcess.php?e=" + email + "&u=" + user,
    true
  );
  request.send();
}

function showPassN() {
  // alert("Show New Password User")

  var password = document.getElementById("unpi");
  var show = document.getElementById("unpb");

  if (password.type == "password") {
    password.type = "text";
    show.innerHTML = "<i class='bi bi-eye-fill'></i>";
  } else {
    password.type = "password";
    show.innerHTML = "<i class='bi bi-eye-slash-fill'></i>";
  }
}

function showPassR() {
  // alert("Show Re-Type Password User")

  var password = document.getElementById("urnpi");
  var show = document.getElementById("urnpb");

  if (password.type == "password") {
    password.type = "text";
    show.innerHTML = "<i class='bi bi-eye-fill'></i>";
  } else {
    password.type = "password";
    show.innerHTML = "<i class='bi bi-eye-slash-fill'></i>";
  }
}

function checkPass() {
  // alert("Check Password");

  var password1 = document.getElementById("unpi");
  var password2 = document.getElementById("urnpi");

  var alertDiv = document.getElementById("alertBox");
  var msgDiv = document.getElementById("msgBox");

  if (password1.value.length > 3 && password2.value.length < 31) {
    if (password1.value == password2.value) {
      password1.disabled = true;
      password2.disabled = true;
      alertDiv.classList.remove("d-none");
      msgDiv.innerHTML =
        '<i class="bi bi-check fs-4"></i> Passwords are matching successfully. Enter your Verification Code or <span onclick="editUser();" class="link-light fs-5 cursor-pointer">Edit Passwords</span>';
    }
  }
}

function editUser() {
  // alert("Edit Passwords");

  document.getElementById("alertBox").classList.add("d-none");
  document.getElementById("unpi").disabled = false;
  document.getElementById("urnpi").disabled = false;
}

function resetPassword(user) {
  // alert("Reset Password");

  var email = document.getElementById("username").value;
  var password1 = document.getElementById("unpi").value;
  var password2 = document.getElementById("urnpi").value;
  var vcode = document.getElementById("fvcode").value;
  var password = document.getElementById("password").value;
  // alert(email+" : "+password1+" : "+password2+" : "+vcode+" : "+password);

  var form = new FormData();

  form.append("email", email);
  form.append("password", password1);
  form.append("check", password2);
  form.append("vcode", vcode);
  form.append("user", user);

  var alertDiv = document.getElementById("alertDiv2");
  var msgDiv = document.getElementById("msgDiv2");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert(response);
      if (response == "success") {
        indexModal.hide();
        password.value = "";
        password.placeholder = "Enter your New Password";
        alertDiv.classList.add("d-none");
        alert("Password reseted successfully");
      } else {
        // alert (response);
        alertDiv.classList.remove("d-none");
        msgDiv.innerHTML = response;
      }
    }
  };

  request.open("POST", "modules/resetPasswordProcess.php", true);
  request.send(form);
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function log_in() {
  // alert("Back to index.php");
  window.location = "index.php?student";
}

function sign_out() {
  // alert("Sign Out");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert(response);
      if (response == "student") {
        window.location = "index.php?student";
      } else if (response == "teacher") {
        window.location = "index.php?teacher";
      } else if (response == "academic_officer") {
        window.location = "index.php?academic_officer";
      } else if (response == "admin") {
        window.location = "index.php?admin";
      } else {
        alert(response);
      }
    }
  };

  request.open("GET", "modules/signOutProcess.php", true);
  request.send();
}

////////////////////////////////////////////////////// Profile ////////////////////////////////////////////////////////////////

function viewProfile() {
  // alert("View Profile");
  window.location = "profile.php";
}

function update_profile() {
  // alert("Update Profile");

  // Personal
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mname = document.getElementById("mname");
  var sname = document.getElementById("sname");
  var id = document.getElementById("id");
  var bday = document.getElementById("bday");
  var gender = document.getElementById("gender");

  //Contact
  var mobile = document.getElementById("mobile");
  var line1 = document.getElementById("line1");
  var line2 = document.getElementById("line2");
  var country = document.getElementById("country");
  var province = document.getElementById("province");
  var district = document.getElementById("district");
  var city = document.getElementById("city");
  var pcode = document.getElementById("pcode");

  // alert(fname.value+" : "+lname.value+" : "+mname.value+" : "+sname.value+" : "+id.value+" : "+bday.value+" : "+gender.value+" : "
  // +mobile.value+" : "+line1.value+" : "+line2.value+" : "+country.value+" : "+province.value+" : "+district.value+" : "+city.value+" : "+pcode.value)
  // alert(`${fname.value} ${lname.value} ${mname.value} ${sname.value} ${id.value} ${bday.value} ${gender.value} ${mobile.value} ${line1.value} ${line2.value} ${country.value} ${province.value} ${district.value} ${city.value} ${pcode.value}`)

  var form = new FormData();

  form.append("fname", fname.value);
  form.append("lname", lname.value);
  form.append("mname", mname.value);
  form.append("sname", sname.value);
  form.append("id", id.value);
  form.append("bday", bday.value);
  form.append("gender", gender.value);

  form.append("mobile", mobile.value);
  form.append("line1", line1.value);
  form.append("line2", line2.value);
  form.append("country", country.value);
  form.append("province", province.value);
  form.append("district", district.value);
  form.append("city", city.value);
  form.append("pcode", pcode.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert (response);
      if (response == "Profile Update Success") {
        alert("Profile has been updated");
        window.location.reload();
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "modules/updateProfile.php", true);
  request.send(form);
}

function update_profile_st() {
  // alert("Update Profile");

  // Personal
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mname = document.getElementById("mname");
  var sname = document.getElementById("sname");
  var id = document.getElementById("id");
  var bday = document.getElementById("bday");
  var gender = document.getElementById("gender");

  // Guardian
  var gfname = document.getElementById("gfname");
  var glname = document.getElementById("glname");
  var gmname = document.getElementById("gmname");
  var gsname = document.getElementById("gsname");
  var gnic = document.getElementById("gnic");
  var relation = document.getElementById("relation");
  var gmobile = document.getElementById("gmobile");

  //Contact
  var mobile = document.getElementById("mobile");
  var line1 = document.getElementById("line1");
  var line2 = document.getElementById("line2");
  var country = document.getElementById("country");
  var province = document.getElementById("province");
  var district = document.getElementById("district");
  var city = document.getElementById("city");
  var pcode = document.getElementById("pcode");

  // alert(fname.value+" : "+lname.value+" : "+mname.value+" : "+sname.value+" : "+id.value+" : "+bday.value+" : "+gender.value+" : "
  // +gfname.value+" : "+glname.value+" : "+gmname.value+" : "+gsname.value+" : "+gnic.value+" : "+relation.value+" : "+gmobile.value+" : "
  // +mobile.value+" : "+line1.value+" : "+line2.value+" : "+country.value+" : "+province.value+" : "+district.value+" : "+city.value+" : "+pcode.value)
  // alert(`${fname.value} ${lname.value} ${mname.value} ${sname.value} ${id.value} ${bday.value} ${gender.value} ${gfname.value} ${glname.value} ${gmname.value} ${gsname.valu} ${gnic.value} ${relation.value} ${gmobile.value} ${mobile.value} ${line1.value} ${line2.value} ${country.value} ${province.value} ${district.value} ${city.value} ${pcode.value}`)

  var form = new FormData();

  form.append("fname", fname.value);
  form.append("lname", lname.value);
  form.append("mname", mname.value);
  form.append("sname", sname.value);
  form.append("id", id.value);
  form.append("bday", bday.value);
  form.append("gender", gender.value);

  form.append("gfname", gfname.value);
  form.append("glname", glname.value);
  form.append("gmname", gmname.value);
  form.append("gsname", gsname.value);
  form.append("gnic", gnic.value);
  form.append("relation", relation.value);
  form.append("gmobile", gmobile.value);

  form.append("mobile", mobile.value);
  form.append("line1", line1.value);
  form.append("line2", line2.value);
  form.append("country", country.value);
  form.append("province", province.value);
  form.append("district", district.value);
  form.append("city", city.value);
  form.append("pcode", pcode.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert (response);
      if (response == "Profile Update Success") {
        alert("Profile has been updated");
        window.location.reload();
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "modules/updateProfileST.php", true);
  request.send(form);
}

var cpModal;
function change_password() {
  // alert ("Change Password");
  var changePassModal = document.getElementById("changePassModal");
  cpModal = new bootstrap.Modal(changePassModal);
  cpModal.show();
}

function n_show_password() {
  var password = document.getElementById("npass");
  var show = document.getElementById("nbtn");

  if (password.type == "password") {
    password.type = "text";
    show.innerHTML = "<i class='bi bi-eye-fill'></i>";
  } else {
    password.type = "password";
    show.innerHTML = "<i class='bi bi-eye-slash-fill'></i>";
  }
}

function rn_show_password() {
  var password = document.getElementById("rnpass");
  var show = document.getElementById("rnbtn");

  if (password.type == "password") {
    password.type = "text";
    show.innerHTML = "<i class='bi bi-eye-fill'></i>";
  } else {
    password.type = "password";
    show.innerHTML = "<i class='bi bi-eye-slash-fill'></i>";
  }
}

function update_password() {
  // alert ("Update Password");

  var cpass = document.getElementById("password").value;
  var npass = document.getElementById("npass");
  var rpass = document.getElementById("rnpass");
  var email = document.getElementById("umail").value;

  if (npass.value == rpass.value) {
    var confirmation = confirm(
      "Are you sure, You want to Change your password?"
    );

    if (!confirmation) {
      cpModal.hide();
      alert("Password Change Request Cancelled by the User");
      document.getElementById("password").value = "";
      document.getElementById("npass").value = "";
      document.getElementById("rnpass").value = "";
    }

    if (confirmation) {
      var form = new FormData();

      form.append("cpass", cpass);
      form.append("email", email);
      form.append("npass", npass.value);

      var request = new XMLHttpRequest();

      request.onreadystatechange = function () {
        // if (request.readyState == 4) {
        if ((request.readyState == 4) & (request.status == 200)) {
          var response = request.responseText;
          // alert(response);
          if (response == "success") {
            alert("Password changed successfully");
            cpModal.hide();
          } else {
            // alert(response);
            document.getElementById("alertDiv").classList.remove("d-none");
            document.getElementById("alert").innerHTML = response;
          }
        }
      };

      request.open("POST", "modules/changePass.php", true);
      request.send(form);
    }
  } else {
    alert("New passwords doesn't match");
  }
}

///////////////////////////////////////////////////////////// Register /////////////////////////////////////////////////////////

function load_subject() {
  // alert ("Load Subject");

  var grade = document.getElementById("grade").value;
  // alert(grade);
  var subject = document.getElementById("sub_area");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert (response);
      subject.innerHTML = response;
    }
  };

  request.open("GET", "modules/loadSubject.php?grade=" + grade, true);
  request.send();
}

function register_tec() {
  // alert ("Register Teachers");

  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var mobile = document.getElementById("mobile").value;
  var gender = document.getElementById("gender").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var subject = document.getElementById("subject1").value;

  // alert (fname+" : "+lname+" : "+mobile+" : "+gender+" : "+email+" : "+password+" : "+subject);

  var form = new FormData();

  form.append("fname", fname);
  form.append("lname", lname);
  form.append("mobile", mobile);
  form.append("gender", gender);
  form.append("email", email);
  form.append("password", password);
  form.append("subject", subject);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert (response);
      if (response == "success") {
        window.location = "register.php";
        alert("Teacher Registration Successfully Completed");
      } else {
        // alert(response);
        document.getElementById("alertDiv").classList.remove("d-none");
        document.getElementById("alert").innerHTML = response;
      }
    }
  };

  request.open("POST", "modules/registerProcess.php?tec", true);
  request.send(form);
}

function update_tec(email) {
  // alert("Update Teacher's Grade & Subject");

  var subject = document.getElementById("subject1").value;

  var form = new FormData();

  form.append("subject", subject);
  form.append("email", email);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert (response);
      if (response == "success") {
        window.location.reload();
        alert("Teacher Update Successfully Completed");
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "modules/updateTecProcess.php", true);
  request.send(form);
}

function register_ao(count) {
  // alert ("Register Teachers");
  // alert (count);

  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var mobile = document.getElementById("mobile").value;
  var gender = document.getElementById("gender").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;

  // alert (fname+" : "+lname+" : "+mobile+" : "+gender+" : "+email+" : "+password);

  var form = new FormData();

  var gcount = 0;
  for (var x = 0; x < count; x++) {
    // alert(document.getElementById("grade"+x).checked);
    if (document.getElementById("grade" + x).checked) {
      var grade = document.getElementById("grade" + x).value;
      gcount++;
      form.append("grade" + gcount, grade);
    }
  }

  // alert(gcount);
  form.append("count", gcount);

  form.append("fname", fname);
  form.append("lname", lname);
  form.append("mobile", mobile);
  form.append("gender", gender);
  form.append("email", email);
  form.append("password", password);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert (response);
      if (response == "success") {
        window.location = "register.php";
        alert("Academic Officer Registration Successfully Completed");
      } else {
        // alert(response);
        document.getElementById("alertDiv").classList.remove("d-none");
        document.getElementById("alert").innerHTML = response;
      }
    }
  };

  request.open("POST", "modules/registerProcess.php?ao", true);
  request.send(form);
}

function register_st() {
  // alert ("Register Students");

  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var mobile = document.getElementById("mobile").value;
  var index = document.getElementById("index").value;
  var gender = document.getElementById("gender").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var grade = document.getElementById("grade").value;
  var count = document.getElementById("scount").value;

  // alert (fname+" : "+lname+" : "+mobile+" : "+gender+" : "+email+" : "+password+" : "+index+" : "+grade+" : "+count);

  var form = new FormData();

  var scount = 0;
  for (var x = 0; x < count; x++) {
    // alert(document.getElementById("subject"+x).checked);
    if (document.getElementById("subject" + x).checked) {
      var subject = document.getElementById("subject" + x).value;
      scount++;
      form.append("subject" + scount, subject);
    }
  }

  // alert(scount);
  form.append("count", scount);

  form.append("fname", fname);
  form.append("lname", lname);
  form.append("mobile", mobile);
  form.append("gender", gender);
  form.append("email", email);
  form.append("password", password);
  form.append("index", index);
  form.append("grade", grade);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert (response);
      if (response == "success") {
        window.location = "register.php";
        alert("Student Registration Successfully Completed");
      } else {
        // alert(response);
        document.getElementById("alertDiv").classList.remove("d-none");
        document.getElementById("alert").innerHTML = response;
      }
    }
  };

  request.open("POST", "modules/registerProcess.php?st", true);
  request.send(form);
}

function load_subject_st() {
  // alert ("Load Subject");

  var grade = document.getElementById("grade").value;
  // alert(grade);
  var subject = document.getElementById("sub_area");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert (response);
      subject.innerHTML = response;
    }
  };

  request.open("GET", "modules/loadSubjectSt.php?grade=" + grade, true);
  request.send();
}

function update_st(email) {
  // alert("Update Student's Grade & Subjects");

  var grade = document.getElementById("grade").value;
  var count = document.getElementById("scount").value;
  var subject = document.getElementById("subject1").value;

  var form = new FormData();

  var scount = 0;
  for (var x = 0; x < count; x++) {
    // alert(document.getElementById("subject"+x).checked);
    if (document.getElementById("subject" + x).checked) {
      var subject = document.getElementById("subject" + x).value;
      scount++;
      form.append("subject" + scount, subject);
    }
  }

  form.append("grade", grade);
  form.append("count", scount);
  form.append("email", email);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert (response);
      if (response == "success") {
        window.location.reload();
        alert("Student Update Successfully Completed");
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "modules/updateStProcess.php", true);
  request.send(form);
}

function close_alert() {
  document.getElementById("alertDiv").classList.toggle("d-none");
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function view() {
  // alert("View Notes");

  var view = document.getElementById("frame");
  var upload = document.getElementById("upload");

  upload.onchange = function () {
    var file = this.files[0];
    var url = window.URL.createObjectURL(file);
    view.src = url;
    view.style.width = "100%";
    view.style.height = "600px";
    // view.src = "https://docs.google.com/gview?url="+url+"&embedded=true";
    // view.src = "https://view.officeapps.live.com/op/embed.aspx?src="+url;
  };
}

function release_note() {
  // alert("Release Note");

  var upload = document.getElementById("upload");
  var grade = document.getElementById("grade").value;
  var subject = document.getElementById("subj").value;
  var title = document.getElementById("txt").value;

  if (upload.files.length == 0) {
    alert("Cannot detect the file. Upload the note and try again");
  } else {
    // alert (grade+" : "+subject+" : "+title+" : "+upload.files.length);

    var form = new FormData();

    form.append("title", title);
    form.append("grade", grade);
    form.append("subject", subject);
    form.append("count", upload.files.length); // count is always 1

    for (var x = 0; x < upload.files.length; x++) {
      form.append("file" + x, upload.files[x]);
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
      // if (request.readyState == 4) {
      if ((request.readyState == 4) & (request.status == 200)) {
        var response = request.responseText;
        // alert(response);
        if (response == "success") {
          alert("Note has been released successfully.");
          window.location = "home.php";
        } else if (response == "Mail sending failed") {
          alert(
            "Note has been released successfully. But mail anousement failed."
          );
          window.location = "home.php";
        } else {
          alert(response);
        }
      }
    };

    request.open("POST", "modules/addNotesProcess.php", true);
    request.send(form);
  }
}

function release_assignment() {
  // alert("Release Note");

  var upload = document.getElementById("upload");
  var grade = document.getElementById("grade").value;
  var subject = document.getElementById("subj").value;
  var title = document.getElementById("txt").value;
  var deadline = document.getElementById("deadline").value;

  if (upload.files.length == 0) {
    alert("Cannot detect the file. Upload the note and try again");
  } else {
    // alert (grade+" : "+subject+" : "+title+" : "+upload.files.length+" : "+deadline);

    var form = new FormData();

    form.append("title", title);
    form.append("grade", grade);
    form.append("subject", subject);
    form.append("deadline", deadline);
    form.append("count", upload.files.length); // count is always 1

    for (var x = 0; x < upload.files.length; x++) {
      form.append("file" + x, upload.files[x]);
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
      // if (request.readyState == 4) {
      if ((request.readyState == 4) & (request.status == 200)) {
        var response = request.responseText;
        // alert(response);
        if (response == "success") {
          alert("Assignment has been released successfully.");
          window.location = "home.php";
        } else if (response == "Mail sending failed") {
          alert(
            "Assignment has been released successfully. But mail anousement failed"
          );
          window.location = "home.php";
        } else {
          alert(response);
        }
      }
    };

    request.open("POST", "modules/addAssignmentsProcess.php", true);
    request.send(form);
  }
}

function upload_assignment(id, email) {
  // alert("Upload Assignment");

  var upload = document.getElementById("upload" + id);

  upload.onchange = function () {
    if (upload.files.length == 0) {
      alert("Cannot detect the file. Upload the note and try again");
    } else {
      var form = new FormData();

      form.append("id", id);
      form.append("email", email);
      form.append("count", upload.files.length);
      for (var x = 0; x < upload.files.length; x++) {
        form.append("file" + x, upload.files[x]);
      }

      var request = new XMLHttpRequest();

      request.onreadystatechange = function () {
        // if (request.readyState == 4) {
        if ((request.readyState == 4) & (request.status == 200)) {
          var response = request.responseText;
          // alert(response);
          if (response == "success") {
            alert("Assignment has been uploaded successfully.");
            window.location = "home.php";
          } else {
            alert(response);
          }
        }
      };

      request.open("POST", "modules/uploadAssignmentsProcess.php", true);
      request.send(form);
    }
  };
}

function submit_marks(count, id) {
  // alert ("Submit Marks");
  // alert(count+" : "+id);

  var form = new FormData();

  var x;
  for (x = 0; x < count; x++) {
    var email = document.getElementById("email" + x).value;
    var mark = document.getElementById("mark" + x).value;
    // alert (email+" : "+mark);

    if (mark > 100) {
      document.getElementById("mark" + x).value = 100;
      mark = 100;
    } else if (mark < 0) {
      document.getElementById("mark" + x).value = 0;
      mark = 0;
    }

    form.append("email" + x, email);
    form.append("mark" + x, mark);
    form.append("count", count);
    form.append("id", id);
  }

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert(response);
      // var t = "success";
      // if (response == (t.repeat(count))) {
      if (response == "success") {
        alert("Marks has been submitted successfully");
        window.location.reload();
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "modules/submitMarksProcess.php", true);
  request.send(form);
}

function release_marks(count, id) {
  // alert ("Submit Marks");
  // alert(count+" : "+id);

  var extra_marks = document.getElementById("extra").value;
  if (extra_marks > 5) {
    document.getElementById("extra").value = 100;
    extra_marks = 5;
  } else if (extra_marks < 0) {
    document.getElementById("extra").value = 0;
    extra_marks = 0;
  }

  var form = new FormData();

  var x;
  for (x = 0; x < count; x++) {
    var email = document.getElementById("email" + x).value;
    var mark = document.getElementById("mark" + x).value;
    // alert (email+" : "+mark);

    if (mark > 100) {
      document.getElementById("mark" + x).value = 100;
      mark = 100;
    } else if (mark < 0) {
      document.getElementById("mark" + x).value = 0;
      mark = 0;
    }

    var total = parseFloat(mark) + parseFloat(extra_marks);
    if (total > 100) {
      total = 100;
    } else if (total == extra_marks) {
      total = 0;
    }

    form.append("email" + x, email);
    form.append("mark" + x, total);
    form.append("count", count);
    form.append("id", id);
  }

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert(response);
      if (response == "success") {
        alert("Marks has been released successfully");
        window.location.reload();
      } else if (response == "Mail sending failed") {
        alert(
          "Marks has been released successfully. But mail anousement failed."
        );
        window.location = "home.php";
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "modules/releaseMarksProcess.php", true);
  request.send(form);
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function manage(email) {
  var modal = document.getElementById("manageModal" + email);
  var mtModal = new bootstrap.Modal(modal);
  mtModal.show();
}

function search_result() {
  // alert ("Search Result");

  var grade = document.getElementById("grade").value;
  var email = document.getElementById("email").value;

  var form = new FormData();

  form.append("grade", grade);
  form.append("email", email);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert(response);
      document.getElementById("result").innerHTML = response;
    }
  };

  request.open("POST", "modules/search_result_process.php", true);
  request.send(form);
}

function payNow(email, grade, type) {
  // alert("Pay Now");
  // alert(email);
  // alert(grade);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert (response);

      var obj = JSON.parse(response);

      var mail = obj["mail"];
      var amount = obj["amount"];
      if (response == "1") {
        alert("Please Login or Sign Up");
        window.location = "index.php";
      } else if (response == "2") {
        alert("Something went wrong");
        window.location.reload();
      } else if (response == "3") {
        alert(
          "Couldn't find the User Address. Please update your adress details"
        );
        window.location = "profile.php";
      } else if (response == "4") {
        alert("You have been already Paid.");
        window.location.reload();
      } else {
        // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
          payComplete(mail, type);
          console.log("Payment completed.");
          // Note: validate the payment and show success or failure page to the customer
        };

        // Payment window closed
        payhere.onDismissed = function onDismissed() {
          // Note: Prompt user to pay again or show an error page
          console.log("Payment dismissed");
        };

        // Error occurred
        payhere.onError = function onError(error) {
          // Note: show an error page
          console.log("Error:" + error);
        };

        // Put the payment variables here
        var payment = {
          sandbox: true,
          merchant_id: "1221502", // Replace your Merchant ID
          return_url: "http://localhost/LMS/profile.php", // Important
          cancel_url: "http://localhost/LMS/profile.php", // Important
          notify_url: "http://sample.com/notify",
          order_id: obj["id"],
          items: obj["item"],
          amount: amount,
          currency: "LKR",
          first_name: obj["fname"],
          last_name: obj["lanme"],
          email: mail,
          phone: obj["mobile"],
          address: obj["address"],
          city: obj["city"],
          country: "Sri Lanka",
          custom_1: "",
          custom_2: "",
        };

        // Show the payhere.js popup, when "PayHere Pay" is clicked
        // document.getElementById("payhere-payment").onclick = function (e) {
        payhere.startPayment(payment);
        // };
      }
    }
  };

  if (type == "enrollment_fee") {
    request.open(
      "GET",
      "modules/payNowProcess.php?e=" +
        email +
        "&grd=" +
        grade +
        "&type=" +
        type,
      true
    );
  } else if (type == "subscription") {
    request.open(
      "GET",
      "modules/payNowProcess.php?e=" + email + "&type=" + type,
      true
    );
  } else {
    alert("Invalid type");
  }
  request.send();
}

function payModelOpen() {
  // alert("ok");
  var m = document.getElementById("paymentGetwayModel");
  bm = new bootstrap.Modal(m);
  bm.show();
}

function payment(email, grade, type) {
  // alert("ok");

  var ch = document.getElementById("ch").value;
  var cn = document.getElementById("cn").value;
  var ed = document.getElementById("ed").value;
  var cvc = document.getElementById("cvc").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert (response);

      var obj = JSON.parse(response);

      var mail = obj["mail"];
      var amount = obj["amount"];
      if (response == "1") {
        alert("Please Login or Sign Up");
        window.location = "index.php";
      } else if (response == "2") {
        alert("Something went wrong");
        window.location.reload();
      } else if (response == "3") {
        alert(
          "Couldn't find the User Address. Please update your adress details"
        );
        window.location = "profile.php";
      } else if (response == "4") {
        alert("You have been already Paid.");
        window.location.reload();
      } else {
        payComplete(mail, type);
      }
    }
  };

  if (type == "enrollment_fee") {
    request.open(
      "GET",
      "modules/payNowProcess.php?e=" +
        email +
        "&grd=" +
        grade +
        "&type=" +
        type,
      true
    );
  } else if (type == "subscription") {
    request.open(
      "GET",
      "modules/payNowProcess.php?e=" + email + "&type=" + type,
      true
    );
  } else {
    alert("Invalid type");
  }
  request.send();
}

function payComplete(mail, type) {
  // alert("Pay Complete");
  // alert(mail);

  var form = new FormData();

  form.append("mail", mail);
  form.append("type", type);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    // if (request.readyState == 4) {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert (response);
      if (response == "1") {
        alert("Payment has been completed");
        window.location.reload();
      } else if (response == "2") {
        alert("Payment has been completed");
        window.location = "home.php";
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "modules/payCompleteProcess.php", true);
  request.send(form);
}
