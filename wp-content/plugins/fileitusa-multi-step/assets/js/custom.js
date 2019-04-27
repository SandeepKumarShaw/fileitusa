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
      billing_email: "Billing Email address is a required field."
      

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
          alert("Submitted!");
      }
  });
}); 