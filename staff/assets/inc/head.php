<head>
<title>iLibray An Automated Digital Library Management System</title>
<link rel="stylesheet" href="assets/css/login.css" />
<link rel="stylesheet" href="assets/css/main.css" media="all">
<link rel="stylesheet" href="assets/css/uikit.css" media="all">  
<link rel="stylesheet" href="assets/css/main.css" media="all">
<script src="assets/js/swal.js"></script>
       <?php if(isset($success)) {?>
               <script>
                           setTimeout(function () 
                           { 
                               swal("Success","<?php echo $success;?>","success");
                           },
                               100);
               </script>
       <?php } ?>
       <?php if(isset($err)) {?>
               <script>
                           setTimeout(function () 
                           { 
                               swal("Failed","<?php echo $err;?>","error");
                           },
                               100);
               </script>
       <?php } ?>
       <?php if(isset($info)) {?>
               <script>
                           setTimeout(function () 
                           { 
                               swal("Success","<?php echo $info;?>","warning");
                           },
                               100);
               </script>
       <?php } ?>
</head>