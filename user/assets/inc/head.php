<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no"/>

    <title>Digital Library Management System</title>
    <link rel="stylesheet" href="assets/css/main.css" media="all">
    <link rel="stylesheet" href="assets/css/uikit.css" media="all">
     <script src="assets/fylib/js/swal.js"></script>
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