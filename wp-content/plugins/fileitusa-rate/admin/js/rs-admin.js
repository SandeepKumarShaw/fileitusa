(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	  $(function() {


	  	

    	$(".edit_btn").click(function(){
    		 var id = $(this).attr('data-id');
    		 $(".modal-title").html("Edit row");
    		 $("#submit_tbn").html('Update');
    		 //alert($("#rsservice-"+id).attr('data-id'));
    		  $('#rs-frm')
    		    .find('[name="rs_id"]').val(id).end()
    		    .find('[name="mode"]').val('editfrm').end()
                .find('[name="rs_serviceid"]').val($("#rsservice-"+id).attr('data-id')).end()
                .find('[name="rs_state"]').val($("#rsstate-"+id).attr("data-state")).end()
                .find('[name="rs_price"]').val($("#rsprice-"+id).html()).end();
               

    	});

    	$(".add_btn").click(function(){
    		
    		 $(".modal-title").html("Add row");
    		  $("#submit_tbn").html('Submit');
    		 //alert(id);
    		  $('#rs-frm')
    		    .find('[name="rs_id"]').val('').end()
    		    .find('[name="mode"]').val('addfrm').end()
    		    .find('[name="attachid"]').val('').end()
                .find('[name="rs_serviceid"]').val('').end()
                .find('[name="rs_state"]').val('').end()
                .find('#imgshow').html('').end()
                .find('[name="rs_url"]').val('').end();
                tinyMCE.activeEditor.setContent('');

    	});
    	$(".del_btn").click(function(){
    		var x = confirm("Are you sure you want to delete?");
			  if (x)
			      return true;
			  else
			    return false;
    	});

    	// service

    	$(".edit_btn_service").click(function(){
    		 var id = $(this).attr('data-id');
    		 $(".modal-title").html("Edit Service");
    		 $("#submit_tbn").html('Update');
    		
    		  $('#rs-frm-service')
    		    .find('[name="service_id"]').val(id).end()
    		    .find('[name="mode"]').val('editfrm_service').end()
                .find('[name="service_name"]').val($("#servicename-"+id).html()).end()
                .find('[name="service_status"]').val($("#servicestatus-"+id).attr('data-id')).end();
               

    	});

    	$(".add_btn_service").click(function(){
    		
    		 $(".modal-title").html("Add Service");
    		  $("#submit_tbn").html('Submit');
    		
    		  $('#rs-frm-service')
    		    .find('[name="service_id"]').val('').end()
    		    .find('[name="mode"]').val('addfrm_service').end()
                .find('[name="service_name"]').val('').end()
                .find('[name="service_status"]').val('1').attr('disabled','disabled').end();

    	});
    	$(".del_btn_service").click(function(){
    		var x = confirm("Are you sure you want to delete?");
			  if (x)
			      return true;
			  else
			    return false;
    	});


    	// expedite
    	

    	$(".edit_btn_expedite").click(function(){
    		 var id = $(this).attr('data-id');
    		 $(".modal-title").html("Edit Expedite");
    		 $("#submit_btn_expedite").html('Update');
    		//alert($("#exservice-"+id).attr('data-id'));
    		  $('#ex-frm')
    		    .find('[name="ex_id"]').val(id).end()
    		    .find('[name="mode"]').val('editfrm_expedite').end()
                .find('[name="ex_serviceid"]').val($("#exservice-"+id).attr('data-id')).end()
                .find('[name="ex_state"]').val($("#exstate-"+id).attr('data-state')).end()
                .find('[name="ex_time"]').val($("#extime-"+id).html()).end()
                .find('[name="ex_price"]').val($("#exprice-"+id).html()).end();

                
                
               

    	});

    	$(".add_btn_expedite").click(function(){
    		
    		 $(".modal-title").html("Add Expedite");
    		  $("#submit_btn_expedite").html('Submit');
    		
    		  $('#ex-frm')
    		    .find('[name="ex_id"]').val('').end()
    		    .find('[name="mode"]').val('addfrm_expedite').end()
                .find('[name="ex_serviceid"]').val('').end()
                .find('[name="ex_state"]').val('').end()
                .find('[name="ex_time"]').val('').end()
                .find('[name="ex_price"]').val('').end();


    	});
    	$(".del_btn_expedite").click(function(){
    		var x = confirm("Are you sure you want to delete?");
			  if (x)
			      return true;
			  else
			    return false;
    	});

    	// 4 COLUMNS with custom placeholder text
    	
    	// product addon


    	$('#upload-btn').click(function(e) {

	        e.preventDefault();
	        var image = wp.media({ 
	            title: 'Upload Image',
	            // mutiple: true if you want to upload multiple files at once
	            multiple: false
	        }).open()
	        .on('select', function(e){
	            // This will return the selected image from the Media Uploader, the result is an object
	            var uploaded_image = image.state().get('selection').first();
	            // We convert uploaded_image to a JSON object to make accessing it easier
	            // Output to the console uploaded_image
	            //console.log(uploaded_image);
	            var image_id = uploaded_image.toJSON().id;
	            var image_url = uploaded_image.toJSON().url;

	            // Let's assign the url value to the input field
	            $('#uploadimgid').val(image_id);
	            $('#addon_img').val(image_url);
	            $("#showimg img").attr("src",image_url).show();

	        });
    	});


    	$(".edit_btn_addon").click(function(){
    		 var id = $(this).attr('data-id');
    		 $(".modal-title").html("Edit Addon");
    		 $("#submit_btn_expedite").html('Update');
    		//alert($("#exservice-"+id).attr('data-id'));
    		  $('#addon-frm')
    		    .find('[name="addon_id"]').val(id).end()
    		    .find('[name="mode"]').val('editfrm_addon').end()
                .find('[name="addon_title"]').val($("#addontitle-"+id).html()).end()
                .find('[name="addon_desc"]').val($("#addondesc-"+id).html()).end()
                .find('[name="addon_img"]').val($("#addonimg-"+id+" img").attr('src')).end();
                var data=$("#addonservice-"+id).attr('data-id');
                var dataarray=data.split(",");
                $("#addon_service").val(dataarray);
				$("#addon_service").multiselect("refresh");
                
                if($("#addonimg-"+id).val()!=''){
                    $("#showimg img").attr("src",$("#addonimg-"+id+" img").attr('src')).show();
                }else{
                    $("#showimg img").hide();
                }
                
                tinyMCE.activeEditor.setContent($("#addondesc-"+id).html());

                var jsonproduct = $.parseJSON($("#addonprice-"+id+" #productjson").val());
				$(jsonproduct).each(function (i, val) {
				 	
				 	$("#pro-"+val.productid).val(val.price);
				    
				}); 
                
                
               

    	});

    	$(".add_btn_addon").click(function(){
    		
    		 $(".modal-title").html("Add Addon");
    		  $("#submit_btn_expedite").html('Submit');
    		
    		  $('#addon-frm')
    		    .find('[name="addon_id"]').val('').end()
    		    .find('[name="mode"]').val('addfrm_addon').end()
                .find('[name="addon_title"]').val('').end()
                .find('[name="addon_desc"]').val('').end()
                .find('[name="addon_img"]').val('').end();
                $("#addon_service").val('');
				$("#addon_service").multiselect("refresh");
                tinyMCE.activeEditor.setContent("");
                $("#showimg img").hide();

    	});
    	$(".del_btn_addon").click(function(){
    		var x = confirm("Are you sure you want to delete?");
			  if (x)
			      return true;
			  else
			    return false;
    	});
		
	 
	  });



})( jQuery );

