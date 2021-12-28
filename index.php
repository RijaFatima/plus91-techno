<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Manage Patients</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="script/assets/bootstrap-datepicker.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script src="script/assets/bootstrap-datepicker.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
      <script src="script/ajax-script.js"></script>
      <style>
         .form-outline {
         padding: 1%;
         }
         .p-3{
         padding: 2%;
         }
         .card-registration .select-input.form-control[readonly]:not([disabled]) {
         font-size: 1rem;
         line-height: 2.15;
         padding-left: .75em;
         padding-right: .75em;
         }
         .card-registration .select-arrow {
         top: 13px;
         }
         .error {
            color: red;
         }
      </style>
   </head>
   <body>
      <div class="container">
         <div class="row">
            <div class="col-sm-8">
               <h2>Manage Patients</h2>
            </div>
            <div class="col-sm-4 p-3"> 
              <button type="button" class="btn btn-info pull-right" id="add_petients_model" >Add Patients</button>
            </div>
         </div>


         <table class="table table-bordered">
            <thead>
               <tr>
                  <th>Name</th>
                  <th>Age</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Country</th>
                  <th>Date of birth</th>
                  <th>Blood Group</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody id="table_data">
               
            </tbody>
         </table>
      </div>

      <!-- Begin Modal -->
      <div id="add-member" class="modal fade calendar-modal">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title event-title">Add Patient</h4>
                  <button type="button" class="close" data-dismiss="modal">
                  <span aria-hidden="true">×</span>
                  <span class="sr-only">close</span>
                  </button>
               </div>
               <form method="post" id="frm-add-member" name="frm-add-member">
                  <div class="modal-body">
                    <span id="result_message"></span>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group all-bor">
                              <label class="form-control-label"> Name</label>
                              <input name="name" id="u-name" type="text" placeholder=" Name" class="form-control charactors">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group all-bor">
                              <label class="form-control-label">Age</label>
                              <input name="age" id="u-age" type="text" placeholder="Age" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group all-bor">
                              <label class="form-control-label">City</label>
                              <input name="city" id="u-city" type="text" placeholder="City" class="form-control">
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group all-bor">
                              <label class="form-control-label">State</label>
                              <input name="state" id="u-state" type="text" placeholder="State" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group all-bor">
                              <label class="form-control-label">County</label>
                              <input name="country" id="u-country" type="text" placeholder="County" class="form-control">
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group all-bor">
                              <label class="form-control-label">Date of birth</label>
                              <input name="date_of_brith" id="u-date_of_brith" type="text" placeholder="Date of birth" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group all-bor">
                              <label class="form-control-label">Blood Group</label>
                              <input name="blood_group" id="u-blood_group" type="text" placeholder="Blood Group" class="form-control">
                           </div>
                        </div>
                       <input name="id" id="u-id" type="hidden" value="">
                       <input name="type" id="u-type" type="hidden" value="add">
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" id="btn-add-member" class="btn btn-blue-gradi">Add Patient</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </body>
</html>


