<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Ajax</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
  </head>
  <body>
    <div class="container">
            <h1 class="text-center">Ajax Form</h1>

            <form action="#">
                <input type="hidden" id="editId" >

                <div class="row">

                    <div class="col">
                        <div class="mb-3">
                            <label for="Firstname" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstNm" >
                            <div id="fnameError" style="color: red;"></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="Lastname" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastNm" >
                            <div id="lnameError" style="color: red;"></div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="emailAddress" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="emailD" >
                            <div id="emailError" style="color: red;"></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password">
                            <div id="passwordError" style="color: red;"></div>
                        </div>
                    </div>

                </div>
                
                <div class="row">
                    <div class="mb-3">
                            <label for="MObileno" class="form-label">Mobileno</label>
                            <input type="number" class="form-control" id="phno" >
                            <div id="phnoError" style="color: red;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3">
                            <label for="Address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="Address" >
                            <div id="addressError" style="color: red;"></div>
                    </div>
                </div>

                <button type="button" class="btn btn-primary" id="submitBtn" onclick="DataSubmit()" >Submit</button>
                <button type="button" class="btn btn-warning" id="editBtn"  onclick="EditDataSave()" >Edit data</button>

            </form>

    </div>

    <div class="container">

    <h2 class="text-dark text-center"><u>Displaying Data Here</u></h2>

    <table class="table table-striped table-bordered border-primary">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Email ID</th>
            <th scope="col">Mobile no</th>
            <th scope="col">Address</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="bindData"></tbody>
    </table>
      
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function(){
            fetchRecord();
        });

       function fetchRecord()
       {
        $('#editBtn').css('display','none');
            $.ajax({
                    url: 'fetch-record', // Replace with your server endpoint
                    method: 'GET',
                    success: function(response) {
                        $('#bindData').empty();
                        response = JSON.parse(response); // Parse the JSON string to JavaScript object
                        response.forEach(function(record, index) { 
                            var newRow = '<tr>' + '<td>' + (index + 1) + '</td>' + '<td>' + record.firstname + '</td>' + '<td>' + record.lastname + '</td>' + '<td>' + record.email + '</td>' + '<td>' + record.mobileno + '</td>' + '<td>' + record.address + '</td>' + '<td><button class="btn btn-primary" onclick="editdatafetched('+record.id+')">edit</button>&nbsp;<button type="button" class="btn btn-danger" onclick="deleteRecord('+record.id+')">Delete</button></td>' + '</tr>'; 
                            $('#bindData').append(newRow);
                        }); 
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
       }

        function DataSubmit() 
        {
            var firstNm = document.getElementById("firstNm").value;
            var lastNm = document.getElementById("lastNm").value;
            var emailID = document.getElementById("emailD").value;
            var password = document.getElementById("password").value;
            var phno = document.getElementById("phno").value;
            var Address = document.getElementById("Address").value;

            
            var fnameError = document.getElementById("fnameError");
            var lnameError = document.getElementById("lnameError");
            
            var emailError = document.getElementById("emailError");
            var passwordError = document.getElementById("passwordError");

            var phnoError = document.getElementById("phnoError");
            var addressError = document.getElementById("addressError");
            
            // Clear previous error messages
            
            fnameError.textContent = "";
            lnameError.textContent = "";
            emailError.textContent = "";
            passwordError.textContent = "";
            phnoError.textContent = "";
            addressError.textContent = "";
            
            var isValid = true;

            if (firstNm === "") {
                fnameError.textContent = "First name field cannot be blank";
                isValid = false;
            }
            
            if (lastNm === "") {
                lnameError.textContent = "Last name field cannot be blank";
                isValid = false;
            }
            
            if (emailID === "") {
                emailError.textContent = "Email field cannot be blank";
                isValid = false;
            }
            
            if (password === "") {
                passwordError.textContent = "Password field cannot be blank";
                isValid = false;
            }

            if (phno === "") {
                phnoError.textContent = "Phno field cannot be blank";
                isValid = false;
            }

            if (Address === "") {
                addressError.textContent = "Address field cannot be blank";
                isValid = false;
            }
            
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
            
            if (!emailPattern.test(emailID)) {
                emailError.textContent = "Invalid email format";
                isValid = false;
            }
            
            if (!passwordPattern.test(password)) {
                passwordError.textContent = "Invalid password format. Example: 'Passw0rd1'";
                isValid = false;
            }
            
            if (isValid) {
              var csrfToken = '{{csrf_token()}}';
                $.ajax({
                    url: 'create-record', // Replace with your server endpoint
                    method: 'POST',
                    headers:{
                      'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        firstNm: firstNm,
                        lastNm: lastNm,
                        email: emailID,
                        password: password,
                        phno: phno,
                        Address: Address
                    },
                    success: function(response) {
                        alert("Data submitted successfully!");
                        fetchRecord();
                        console.log(response);
                        $("#firstNm").val('');
                        $("#lastNm").val('');
                        $("#emailD").val('');
                        $("#password").val('');
                        $("#phno").val('');
                        $("#Address").val('');
                    },
                    error: function(error) {
                        alert("Error submitting data");
                        fetchRecord();
                        console.log(error);
                    }
                });
            }
        }

        // For deleting the record

        function deleteRecord(id)
        {
            var csrfToken = '{{csrf_token()}}';
                $.ajax({
                    url: 'delete-record', // Replace with your server endpoint
                    method: 'POST',
                    headers:{
                      'X-CSRF-TOKEN': csrfToken
                    },
                    data: {id:id},
                    success: function(response) {
                        alert("Record Deleted");
                        fetchRecord();
                    },
                    error: function(error) {
                        alert("Record not deleted");
                        fetchRecord();
                        console.log(error);
                    }
                });
        }

        // For editing the record

        function editdatafetched(id)
        {
            $.ajax({
                    url: 'fetch-single-record/' + id, // Replace with your server endpoint
                    method: 'GET',
                    success: function(response) {
                        // alert("Record fetched");
                        response = JSON.parse(response);
                        console.log(response.id);

                        $('#editId').val(response.id);
                        $('#firstNm').val(response.firstname);
                        $('#lastNm').val(response.lastname);
                        $('#emailD').val(response.email);
                        // $('#password').val(response.password);
                        $('#phno').val(response.mobileno);
                        $('#Address').val(response.address);
                        $('#submitBtn').css('display','none');
                        $('#editBtn').css('display','block');
                    },
                    error: function(error) {
                        alert("Record not fetched");
                        console.log(error);
                    }
                });
        }

        function EditDataSave()
        {
            var editId = document.getElementById("editId").value
            var firstNm = document.getElementById("firstNm").value;
            var lastNm = document.getElementById("lastNm").value;
            var emailID = document.getElementById("emailD").value;
            var password = document.getElementById("password").value;
            var phno = document.getElementById("phno").value;
            var Address = document.getElementById("Address").value;

            
            var fnameError = document.getElementById("fnameError");
            var lnameError = document.getElementById("lnameError");
            
            var emailError = document.getElementById("emailError");
            var passwordError = document.getElementById("passwordError");

            var phnoError = document.getElementById("phnoError");
            var addressError = document.getElementById("addressError");
            
            // Clear previous error messages
            
            fnameError.textContent = "";
            lnameError.textContent = "";
            emailError.textContent = "";
            passwordError.textContent = "";
            phnoError.textContent = "";
            addressError.textContent = "";
            
            var isValid = true;

            if (firstNm === "") {
                fnameError.textContent = "First name field cannot be blank";
                isValid = false;
            }
            
            if (lastNm === "") {
                lnameError.textContent = "Last name field cannot be blank";
                isValid = false;
            }
            
            if (emailID === "") {
                emailError.textContent = "Email field cannot be blank";
                isValid = false;
            }
            
            if (password === "") {
                passwordError.textContent = "Password field cannot be blank";
                isValid = false;
            }

            if (phno === "") {
                phnoError.textContent = "Phno field cannot be blank";
                isValid = false;
            }

            if (Address === "") {
                addressError.textContent = "Address field cannot be blank";
                isValid = false;
            }
            
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
            
            if (!emailPattern.test(emailID)) {
                emailError.textContent = "Invalid email format";
                isValid = false;
            }
            
            if (!passwordPattern.test(password)) {
                passwordError.textContent = "Invalid password format. Example: 'Passw0rd1'";
                isValid = false;
            }
            
            if (isValid) {
              var csrfToken = '{{csrf_token()}}';
                $.ajax({
                    url: 'save-edit-data', // Replace with your server endpoint
                    method: 'PUT',
                    headers:{
                      'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        editId:editId,
                        firstNm: firstNm,
                        lastNm: lastNm,
                        email: emailID,
                        password: password,
                        phno: phno,
                        Address: Address
                    },
                    success: function(response) {
                        alert("Data Edited successfully!");
                        fetchRecord();
                        console.log(response);
                        $("#firstNm").val('');
                        $("#lastNm").val('');
                        $("#emailD").val('');
                        $("#password").val('');
                        $("#phno").val('');
                        $("#Address").val('');
                    },
                    error: function(error) {
                        alert("Error in editing data");
                        fetchRecord();
                        console.log(error);
                    }
                });
            }
        }

      



    </script>
  </body>
</html>