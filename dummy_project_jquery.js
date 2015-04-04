$(document).ready(function(){

  /* upon click of sign up button sign up form will show up and login form will hide */
  $(".signup-button").click(function(){

   $(".login-page").hide();
   $(".signup-page").show();

 })

  /* upon click of sign up button focus will come over that button */ 
  $(".signup-button").focus(function(){
    $(this).css("background-color", "#4CC39D");
    $(".login-button").css("background-color", "#413838");

  })

  /* upon click of Get Started button Validation of form take place */
  $(".get-in").click(function(){                               
    var fname=$(".fname").val();                                /* validate first name */
    if(fname == null || fname == ""){
      alert("Please insert your first name");
      return false;
    }
    var lname=$(".lname").val();                                 /* validate last name */
    if(lname == null || lname == ""){
      alert("Please insert your last name");
      return false;
    }
    var email=$(".email-entry-s").val();                         /* validate email entry */
    if(email == null || email == ""){
      alert("Please insert a valid Email Address");
      return false;
    }      
    if(!validateEmail(email)){
      alert("Please Enter a Valid Email Address");
      return false;
    }
    var psw=$(".psw-entry-s").val();                              /* validate password */
    if(psw == null || psw == ""){
      alert("Password required");
      return true;
    }
    if(psw.length < 8){
      alert("Password length must be greater than 8");
    }

  })

/* on clicking LOG IN button validation of log in form will take place */
$(".get-in-log").click(function(){                                
  var email=$(".email-entry").val();                                   /* validate email entry */
  if(email == null || email == ""){
    alert("Please enter a valid Email Address");
    return false;
  }
  if(!validateEmail(email)){
    alert("Please Enter a Valid Email Address");
    return false;
  }
  var psw=$(".psw-entry").val();                                       /* validate password entry */
  if(psw == null || psw == ""){
    alert("Password required");
    return false;
  }

})

/*  on cliking login button sign up form will hide and login form will show up */
$(".login-button").click(function(){
  $(".signup-page").hide();
  $(".login-page").show();

})
$(".login-button").focus(function(){
  $(this).css("background-color", "#4CC39D");
  $(".signup-button").css("background-color", "#413838");
})

})


function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if( !emailReg.test( $email ) ) {
    return false;
  } else {
    return true;
  }
}
