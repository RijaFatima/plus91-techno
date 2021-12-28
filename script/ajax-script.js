
  $('#u-date_of_brith').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy',
  });
      
 // Add or update record       

   $(function() {
            var validator = $("form[name='frm-add-member']").validate({
                focusCleanup: true,
                rules: {
                    name: {
                        required: true,
                        minlength:3
                    },
                    age: {
                        required: true,
                     },
                    city: {
                        required: true,
                    },
                    state: {
                        required: true,
                    },
                    country: {
                        required: true,
                    },
                    date_of_brith: {
                        required: true,
                    },
                    blood_group: {
                        required: true,
                    }
                },
                //validation error messages
                messages: {
                    name: {
                        required: "Please enter name.",
                        minlength:"Please enter atleast 3 charactors."
                    },
                    age: {
                        required: "Please enter age",
                    },
                    city: {
                        required: "Please enter city.",
                    },
                    state: {
                        required: "Please enter state.",
                    },
                    country: {
                        required: "Please enter country.",
                    },
                    date_of_brith: {
                        required: "Please select date of brith.",
                    },
                    blood_group: {
                        required: "Please enter blood group.",
                    }
                },
                // Specify validation rules
                submitHandler: function(form) {
                    if (typeof FormData !== 'undefined') {
                        var formData = new FormData($("#frm-add-member")[0]);
                        var type = $("#u-type").val();
                        $('#btn-add-member').prop('disabled', true);
                        $.ajax({
                            url: "script/backend-script.php?type="+type,
                            type: "POST",
                            data:formData,
                            dataType: "json",
                            cache:false,
                            contentType: false,
                            processData: false,
                            success: function(data) {
                             
                                if (data.status == true) {
                                  var message = "<div class='alert alert-success alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> " + data.message + "</div>";
                                    $("#result_message").prepend(message);
                                    $("#frm-add-member").get(0).reset();
                                    $("#frm-add-member")[0].reset();
                                    //$("#frm-add-member").ResetFormFields();
                                    $('#frm-add-member').trigger("reset");
                                    setTimeout(function() {
                                      $('#add-member').modal('toggle');
                                       $('#alert').html(data).fadeIn();
                                       loaddata();
                                    }, 500);

                                } else if (data.status == false) {
                                    $('#btn-add-task').prop('disabled', false);
                                    $(".error").html("");
                                    if (data.message) {
                                      var message = "<div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> " + data.message + "</div>";
                                      $("#result_message").prepend(message);
                                        $(".message").fadeOut(5000);
                                    }
                                }
                               
                            },
                            error: function(data) {
                                $('#btn-add-member').prop('disabled', false);
                                alert(data);
                            }
                        });
                    } else {
                        message("Your Browser Don't support FormData API! Use IE 10 or Above!");
                    }
                }
            });
        });
         $(".alert ").fadeOut(5000);

//========= update data through update form============ //
loaddata();

function loaddata(){
     $.ajax({    
        type: "GET",
        url: "script/backend-script.php/?type=get_data", 
        dataType: "html",                  
        success: function(data){ 
            $('#table_data').html(data);
        }
    });
}


// ============= delete data from database============= //
$(document).on('click','.delete',function(e){
     
     var el=$(this);
     var id=$(this).attr('id');
     var name = 'manage_patients';
             $.ajax({    
                type: "GET",
                url: "script/backend-script.php", 
                data:{deleteId:id, deleteData:name},            
                dataType: "html",                  
                success: function(data){ 
                              
                    $("#showTable").html(data); 
                    $('#alertBox').html(data).fadeIn();
                    el.parents('tr').remove();
                        
                }

            });
    })
   
    


// === display alert message within a time interval ====== //
 window.setInterval(function(){
 	 if ($('#alertBox').css("display") == "block") {
       $('#alertBox').fadeOut();
   }
   }, 3000);

$(document).on('click','#add_petients_model',function(e){
    $("#frm-add-member")[0].reset();
    //$("#frm-add-member").ResetFormFields();
    $('#frm-add-member').trigger("reset");
    var validator = $( "#frm-add-member" ).validate();
    validator.resetForm();
    $('#add-member').modal('show');
});

// ============= get Single record form db============= //
$(document).on('click','.edit',function(e){
     $("#frm-add-member")[0].reset();
     var el=$(this);
     var id=$(this).attr('id');
     $.ajax({    
        type: "GET",
        url: "script/backend-script.php?type=get_record", 
        data:{id:id},            
        dataType: "json",                  
        success: function(data){ 
             if (data.status == true) {
               result = data.result;
               $('#u-id').val(result.id);
               $('#u-name').val(result.name);
               $('#u-age').val(result.age);
               $('#u-city').val(result.city);
               $('#u-state').val(result.state);
               $('#u-country').val(result.country);
               $('#u-date_of_brith').val(result.date_of_brith);
               $('#u-blood_group').val(result.blood_group);
               $('.event-title').html('Edit Patient');
               $('#btn-add-member').html('Edit Patient');
               $('#u-type').val('update');
               $('#add-member').modal('show');
             }         
        }
    });
});