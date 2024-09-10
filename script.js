$("#bt_login").click(function(){
    login();
});

function login(){
    
    if(!$("#admission_no").val()){
        alert("Please enter correct Register Number.")
        return false;
   }

   if(!$("#password").val()){
        alert("Please enter password.")
        return false;
   }

   var data_frm = new FormData($("form#login")[0]);
   $.ajax({
        url: "api/login.php",
        type: "POST",
        data: data_frm,
        processData: false,
        contentType: false,
        success: function(data) {
          //    var details = JSON.parse(data);
             if (data["status"] == 200) {
               // alert( data["message"]);
               if(data["user_type"] == "Admin"){
                    window.location.replace("admin/admin-home.php");
               }else if(data["user_type"] == "Student"){
                    window.location.replace("student/calendar.php");
               }else if(data["user_type"] == "Parent"){
                    window.location.replace("parent/calendar.php");
               }else if(data["user_type"] == "Faculty"){
                    window.location.replace("staff/calender.php");
               }
                      
             } else {
                alert( data["message"]);

             }
        },
        error: function() {
             alert("E3: Login Error.");
             return false;
        }
   });

}
