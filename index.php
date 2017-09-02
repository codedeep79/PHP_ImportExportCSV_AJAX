<?php  
 $connect = mysqli_connect("localhost", "root", "", "employee");  
 $query = "SELECT * FROM employee ORDER BY id desc";  
 $result = mysqli_query($connect, $query);  
 mysqli_query($connect, "set names 'utf8'");
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Import CSV File Data into MySQL Database using PHP & Ajax</title>  
           <script src="asset/js/jquery.min.js"></script>  
           <link rel="stylesheet" href="asset/css/bootstrap.min.css" />  
           <script src="asset/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:900px;">  
                <h2 align="center">Import CSV File Data into MySQL Database using PHP & Ajax</h2>  
                <h3 align="center">Employee Data</h3><br />  
                <form id="upload_csv" method="post" enctype="multipart/form-data">  
                     <div class="col-md-3">  
                          <br />  
                          <label>Add More Data</label>  
                     </div>  
                     <div class="col-md-4">  
                          <input type="file" name="employee_file" style="margin-top:15px;" />  
                     </div>  
                     <div class="col-md-5">  
                          <input type="submit" name="upload" id="upload" value="Upload" style="margin-top:10px;" class="btn btn-danger" />  
                     </div>  
                     <div style="clear:both"></div>  
                </form>  
                <br /><br /><br />  
                <div class="table-responsive" id="employee_table">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="5%">ID</th>  
                               <th width="25%">Name</th>  
                               <th width="35%">Address</th>  
                               <th width="10%">Gender</th>  
                               <th width="20%">Designation</th>  
                               <th width="5%">Age</th>  
                          </tr>  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                          ?>  
                          <tr>  
                               <td><?php echo $row["id"]; ?></td>  
                               <td><?php echo $row["name"]; ?></td>  
                               <td><?php echo $row["address"]; ?></td>  
                               <td><?php echo $row["gender"]; ?></td>  
                               <td><?php echo $row["designation"]; ?></td>  
                               <td><?php echo $row["age"]; ?></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
      $(document).ready(function(){  
           $('#upload_csv').on("submit", function(e){  
                e.preventDefault(); 
                $.ajax({  
                     url:"import.php",  
                     method:"POST",  
                     data:new FormData(this),  
                     contentType:false,          // The content type used when sending data to the server.  
                     cache:false,                // To unable request pages to be cached  
                     processData:false,          // To send DOMDocument or non processed data file it is set to false  
                     success: function(data){  
                          if(data=='Error1')  
                          {  
                               alert("Invalid File");  
                          }  
                          else if(data == "Error2")  
                          {  
                               alert("Please Select File");  
                          }  
                          else  
                          {  
                               $('#employee_table').html(data);  
                          }  
                     }  
                })  
           });  
      });  
 </script>  