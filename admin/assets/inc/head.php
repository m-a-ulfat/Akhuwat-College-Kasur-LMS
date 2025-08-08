<head>
    <title>Digital Library Management System</title>
<head>
<title>Libray An Automated Digital Library Management System</title>
 <!-- <link rel="stylesheet" href="assets/fylib/mix/weather-icons/css/weather-icons.min.css" media="all"> -->
<!-- <link rel="stylesheet" href="assets/fylib/mix/metrics-graphics/dist/metricsgraphics.css"> -->
<!-- <link rel="stylesheet" href="assets/fylib/mix/chartist/chartist.min.css"> -->
<!-- <link rel="stylesheet" href="assets/fylib/css/themes.css" media="all"> -->
<!-- <link rel="stylesheet" href="assets/fylib/mix/icons/flags/flags.min.css" media="all"> -->
<!-- <link rel="stylesheet" href="assets/fylib/css/switcher.css" media="all"> -->
 
<link rel="stylesheet" href="assets/fylib/css/main.css" media="all"> 
<link rel="stylesheet" href="assets/fylib/mix/uikit/css/uikit.almost-flat.min.css" media="all">
 <link rel="stylesheet" href="assets/css/icons.css" />
<script src="assets/fylib/js/swal.js"></script>
       <?php if (isset($success)) { ?>
               <script>
                           setTimeout(function () 
                           { 
                               swal("Success","<?php echo $success; ?>","success");
                           },
                               100);
                          
               </script>

       <?php } ?>

       <?php if (isset($err)) { ?>
               <script>
                           setTimeout(function () 
                           { 
                               swal("Failed","<?php echo $err; ?>","error");
                           },
                               100);
               </script>

       <?php } ?>
       <?php if (isset($info)) { ?>
               <script>
                           setTimeout(function () 
                           { 
                               swal("Success","<?php echo $info; ?>","warning");
                           },
                               100);
               </script>
       <?php } ?>
</head>
