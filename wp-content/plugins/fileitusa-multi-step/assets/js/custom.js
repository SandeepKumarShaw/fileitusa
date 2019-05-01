jQuery(document).ready(function($){
  var form = $("#example-form");
  form.validate({
      errorPlacement: function errorPlacement(error, element) { element.before(error); },
      rules: {          
          billing_first_name:{
               required:true
          },
          billing_last_name:{
               required:true
          },
          billing_country:{
               required:true
          },
          billing_address_1:{
               required:true
          },
          billing_city:{
               required:true
          },
          billing_postcode:{
               required:true
          },
          billing_phone:{
               required:true
          },
          billing_email:{
               required:true
          },
          account_username:{
               required:true
          },
          account_password:{
               required:true
          }
      },      
    messages: {
      billing_first_name: "Billing First name is a required field.",
      billing_last_name: "Billing Last name is a required field.",
      billing_country: "Billing State / County is a required field.",
      billing_address_1: "Billing Street address is a required field.",
      billing_city: "Billing Town / City is a required field.",
      billing_postcode: "Billing Postcode / ZIP is a required field.",
      billing_phone: "Billing Phone is a required field.",
      billing_email: "Billing Email address is a required field.",
      account_username: "Account Username is a required field.",
      account_password: "Account Password is a required field."
      

    }
  });
  form.children("div").steps({
      headerTag: "h3",
      bodyTag: "section",
      transitionEffect: "slideLeft",
      onStepChanging: function (event, currentIndex, newIndex)
      {
          form.validate().settings.ignore = ":disabled,:hidden";
          return form.valid();
      },
      onFinishing: function (event, currentIndex)
      {
          form.validate().settings.ignore = ":disabled";
          return form.valid();
      },
      onFinished: function (event, currentIndex)
      {
          //alert("Submitted!");
      }
  });

  $("#clonetrigger").click(function(){
    var yourclass=".clonable"; //The class you have used in your form
    var clonecount = $(yourclass).length; //how many clones do we already have?
    var newid = Number(clonecount) + 1; //Id of the new clone

    $(yourclass+":first").fieldclone({//Clone the original elelement
        newid_: newid, //Id of the new clone, (you can pass your own if you want)
        target_: $("#formbuttons"), //where do we insert the clone? (target element)
        insert_: "before", //where do we insert the clone? (after/before/append/prepend...)
        limit_: 4 //Maximum Number of Clones
    });
    return false;
});


}); 