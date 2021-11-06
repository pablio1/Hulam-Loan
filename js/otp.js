$(document).ready(function () {
  Login_Modal();
  Validate();
});
function makeid(length) {
  var result = "";
  var characters = "0123456789";
  var charactersLength = characters.length;
  for (var i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }
  return result;
}

function Login_Modal() {
  $(document).on("click", "#login-contact", function () {
    var otp = makeid(6);
    var contactMatch = /^0(9|4)\d{9}$/;
    var contact = $("#contact").val();
    if (contactMatch.test(contact)) {
      Display_Otp();
      console.log("phone");
      Session_Otp(otp);
    }
  });
}
function Display_Otp() {
  $.ajax({
    url: "./logic/displayotp.php",
    method: "post",
    success: function (data) {
      $("#otp-contact").html(data);
    },
  });
}

function Session_Otp(otp) {
  $.ajax({
    url: "./logic/sessioncontact.php",
    method: "post",
    data: { otp: otp },
    success: function (data) {
      console.log(data);
    },
  });
}

function Validate() {
  $(document).on("click", "#validate-otp", function () {
    var first = $("#first").val();
    var second = $("#second").val();
    var third = $("#third").val();
    var fourth = $("#fourth").val();
    var fifth = $("#fifth").val();
    var sixth = $("#sixth").val();
    var otp = first + second + third + fourth + fifth + sixth;

    $.ajax({
      url: "./logic/validate.php",
      method: "post",
      data: { otp: otp },
      success: function (data) {
        console.log(data);
      },
    });
  });
}

function Send_Otp() {
  //otp2
  $.ajax({
    url: "",
    method: "post",
    success: function (data) {
      console.log("send-Otp");
    },
  });
}
