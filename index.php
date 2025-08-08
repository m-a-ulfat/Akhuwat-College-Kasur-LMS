<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Akhuwat Pearl’s of Wisdom Library Management System</title>
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<meta content="" name="keywords">
		<meta content="" name="description">
		<!-- Icon Font -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
		<link href="fylib/css/bootstrap.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
	</head>
	<body>
	<!-- Topbar Start -->
<div style="background-color: #f8f9fa; padding: 0;">
    <div class="row gx-0 d-none d-lg-flex" style="margin: 0;">
        <div class="col-lg-7" style="padding-left: 30px; padding-right: 30px; text-align: left; display: flex; align-items: center; justify-content: flex-start;">
            <div style="display: inline-flex; align-items: center; padding-top: 15px; padding-bottom: 15px; margin-right: 20px;">
                <small class="fa fa-map-marker-alt" style="color: #007bff; margin-right: 10px;"></small>
                <small style="font-size: 14px; color: #555;">Akhuwat College University</small>
            </div>
            <div style="display: inline-flex; align-items: center; padding-top: 15px; padding-bottom: 15px;">
                <small class="far fa-clock" style="color: #007bff; margin-right: 10px;"></small>
                <small style="font-size: 14px; color: #555;">Mon to Sat | 9 AM to 5 PM</small>
            </div>
        </div>
        <div class="col-lg-5" style="padding-left: 30px; padding-right: 30px; text-align: right; display: flex; justify-content: flex-end;">
            <div style="display: inline-flex; align-items: center; padding-top: 15px; padding-bottom: 15px;">
                <small class="fa fa-phone-alt" style="color: #007bff; margin-right: 10px;"></small>
                <small style="font-size: 14px; color: #555;">+92 (049) 2450515 | 0313-7337377</small>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-light navbar-light" style="background-color: #f8f9fa;">
    <a href="index.php" class="navbar-brand d-flex align-items-center px-lg-3" style="padding-left: 20px; padding-right: 20px;">
        <h4 class="m-0" style="font-size: 24px; color: #2c3e50;">Library Management System</h4>
    </a>
    <button type="button" class="navbar-toggler me-2" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" style="border: 1px solid #ddd; border-radius: 5px; background-color: #ecf0f1;">
        <span class="navbar-toggler-icon" style="color: #2c3e50;"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0" style="margin-left: 20px; margin-right: 20px;">
            <a href="index.php" class="nav-item nav-link" style="font-size: 16px; padding-left: 20px; padding-right: 20px; color: #34495e; transition: all 0.3s;">Home</a>
            <a href="https://akhuwat.org.pk/about/" class="nav-item nav-link" style="font-size: 16px; padding-left: 20px; padding-right: 20px; color: #34495e; transition: all 0.3s;">About</a>
            <a href="https://www.hec.gov.pk/english/services/students/DL/Pages/default.aspx" class="nav-item nav-link" style="font-size: 16px; padding-left: 20px; padding-right: 20px; color: #34495e; transition: all 0.3s;">Digital library</a>
            <a href="user/index.php" class="nav-item nav-link" style="font-size: 16px; padding-left: 20px; padding-right: 20px; color: #34495e; transition: all 0.3s;">User login</a>
            <a href="staff/index.php" class="nav-item nav-link" style="font-size: 16px; padding-left: 20px; padding-right: 20px; color: #34495e; transition: all 0.3s;">Librarian login</a>
        </div>
        <a href="admin/index.php" class="btn btn-primary py-3 px-lg-5 d-none d-lg-block" style="font-size: 16px; padding-left: 30px; padding-right: 30px; margin-top: 5px; border-radius: 25px; background-color: #2980b9; color: #fff; transition: all 0.3s;">
            Admin login <i class="fa fa-arrow-right ms-3"></i>
        </a>
    </div>
</nav>
<!-- Navbar End -->


<section class="main swiper mySwiper">
    <style>

      /* Google Fonts - Poppins */
  @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");
  
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
  }
  .main {
    height: 100vh;
    width: 100%;
  }
  .wrapper,
  .slide {
    position: relative;
    width: 100%;
    height: 100%;
  }
  .slide {
    overflow: hidden;
  }
  .slide::before {
    content: "";
    position: absolute;
    height: 100%;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 10;
  }
  .slide .image {
    height: 100%;
    width: 100%;
    object-fit: cover;
  }
  .slide .image-data {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    width: 100%;
    z-index: 100;
  }
  .image-data span.text {
    font-size: 14px;
    font-weight: 400;
    color: #fff;
  }
  .image-data h2 {
    font-size: 45px;
    font-weight: 600;
    color: #fff;
  }
  a.button {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 25px;
    color: #333;
    background: #fff;
    text-decoration: none;
    margin-top: 25px;
    transition: all 0.3s ease;
  }
  a.button:hover {
    color: #fff;
    background-color: #c87e4f;
  }
  
  /* swiper button css */
  .nav-btn {
    height: 50px;
    width: 50px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
  }
  .nav-btn:hover {
    background: rgba(255, 255, 255, 0.4);
  }
  .swiper-button-next {
    right: 50px;
  }
  .swiper-button-prev {
    left: 50px;
  }
  .nav-btn::before,
  .nav-btn::after {
    font-size: 25px;
    color: #fff;
  }
  .swiper-pagination-bullet {
    opacity: 1;
    height: 12px;
    width: 12px;
    background-color: #fff;
    visibility: hidden;
  }
  .swiper-pagination-bullet-active {
    border: 2px solid #fff;
    background-color: #c87e4f;
  }
  
  @media screen and (max-width: 768px) {
    .nav-btn {
      visibility: hidden;
    }
    .swiper-pagination-bullet {
      visibility: visible;
    }
  }
  
    </style>
   <div class="wrapper swiper-wrapper">
    <div class="slide swiper-slide">
     <img src="fylib/img/1.jpg" alt="" class="image" />
     <div class="image-data">
   
     <h2>
          Akhuwat College Kasur Vision <br>
          <span class="text" style="font-size:1.8vw">
    Empowering students with critical thinking, global perspectives, and values like integrity and compassion <br> to build a progressive, poverty-free society.
</span><br>
      <a href="#" class="button">About Us</a>
     </div>
    </div>
    <div class="slide swiper-slide">
     <img src="fylib/img/2.jpg" alt="" class="image" />
     <div class="image-data">
      
     <h2>
          Akhuwat College Kasur Mission <br>
            </h2>
            <span class="text" style="font-size:1.8vw">
            Akhuwat Education Services delivers quality, culturally relevant education to <br> promote excellence and benefit society.
</span>
          
      <a href="#" class="button">About Us</a>
     </div>
    </div>
    <div class="slide swiper-slide">
     <img src="fylib/img/4.jpg" alt="" class="image" />
     <div class="image-data">
    
     <h2>
          Akhuwat College Kasur Goal <br>
            </h2>
            <span class="text" style="font-size:1.8vw">
           
We embody Akhuwat's core values—Determination, Respect, <br> Integrity—striving for excellence and guided by <br> Dr. Amjad Saqib's DRIVE philosophy towards a transformative future.
        </span>
            <br>
      <a href="#" class="button">About Us</a>
     </div>
    </div>
   </div>
   <div class="swiper-button-next nav-btn"></div>
   <div class="swiper-button-prev nav-btn"></div>
   <div class="swiper-pagination"></div>
  </section>
  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <!-- Initialize Swiper -->
  <script>
   var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    loop: true,
    pagination: {
     el: ".swiper-pagination",
     clickable: true,
    },
    navigation: {
     nextEl: ".swiper-button-next",
     prevEl: ".swiper-button-prev",
    },
   });
  </script>

<!-- Feature Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Feature 1: Iman (Faith) -->
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                <div class="d-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 220px; height: 220px; margin: 0 auto; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                    <img src="fylib/img/iman.jpeg" alt="Iman" width="180px" height="180px" style="object-fit: cover; border-radius: 50%;">
                </div>
                <br>
                <h5 style="text-align: center; font-weight: 600; font-size: 1.3rem;">Iman (Faith)</h5>
                <p style="text-align: center; font-size: 1rem; color: #6c757d;">Iman is the foundation of a believer's life, representing faith in the oneness of God and in the teachings of the Prophet Muhammad (PBUH). It inspires a deep trust in the divine wisdom and guides individuals toward righteousness, love, and compassion.</p>
            </div>

            <!-- Feature 2: Iklas (Purity) -->
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                <div class="d-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 220px; height: 220px; margin: 0 auto; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                    <img src="fylib/img/Iklas (Purity).jpeg" alt="Iklas" width="180px" height="180px" style="object-fit: cover; border-radius: 50%;">
                </div>
                <br>
                <h5 style="text-align: center; font-weight: 600; font-size: 1.3rem;">Iklas (Purity)</h5>
                <p style="text-align: center; font-size: 1rem; color: #6c757d;">Iklas signifies sincerity and purity of heart, focusing on performing actions with a clear and sincere intention for the sake of God. It encourages honesty and the rejection of hypocrisy, leading to a more authentic and virtuous life.</p>
            </div>

            <!-- Feature 3: Infaq (Giving) -->
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                <div class="d-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 220px; height: 220px; margin: 0 auto; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                    <img src="fylib/img/Infaq (Giving).jpeg" alt="Infaq" width="180px" height="180px" style="object-fit: cover; border-radius: 50%;">
                </div>
                <br>
                <h5 style="text-align: center; font-weight: 600; font-size: 1.3rem;">Infaq (Giving)</h5>
                <p style="text-align: center; font-size: 1rem; color: #6c757d;">Infaq emphasizes the importance of charity and giving for the welfare of others. It encourages individuals to share their wealth, time, and resources with those in need, promoting social justice, equality, and compassion within the community.</p>
            </div>

            <!-- Feature 4: Ihsan (Excellence) -->
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                <div class="d-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 220px; height: 220px; margin: 0 auto; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                    <img src="fylib/img/Ihsan (Excellence).jpeg" alt="Ihsan" width="180px" height="180px" style="object-fit: cover; border-radius: 50%;">
                </div>
                <br>
                <h5 style="text-align: center; font-weight: 600; font-size: 1.3rem;">Ihsan (Excellence)</h5>
                <p style="text-align: center; font-size: 1rem; color: #6c757d;">Ihsan refers to striving for excellence in all aspects of life, both in acts of worship and in interactions with others. It encourages individuals to seek perfection in their deeds, aiming to please God with their actions, kindness, and moral integrity.</p>
            </div>
        </div>
    </div>
</div>
<!-- Feature End -->

		<div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
			<div class="container about px-lg-0">
				<div class="row g-0 mx-lg-0">
					<div class="col-lg-6 ps-lg-0" style="min-height: 400px;">
						<div class="position-relative h-100">
							<img class="position-absolute img-fluid w-100 h-100" src="fylib/img/2.jpg" style="object-fit: cover;" alt="">
						</div>
					</div>
					<div class="col-lg-6 about-text py-5 wow fadeIn" data-wow-delay="0.5s">
						<div class="p-lg-5 pe-lg-0">
							<div class="">
								<h1 class="display-5 mb-4">About Us</h1>
							</div>
							<p class="mb-4 pb-2"> Akhuwat’s vision is to alleviate and eradicate poverty right from its root. This mission can only be achieved if the unprivileged community becomes educated. Education has its own undeniable significance, since at the time of need only an educated individual can create opportunities for himself. With an utmost faith in humanity, Akhuwat put its first step in providing free yet high quality education in 2015. The pillars of our character are built upon Iman (Faith), Ikhlas (Purity), Infaq (Giving), and Ihsan (Excellence). These Islamic virtues guide our actions, inspiring us to live a life of purpose, sincerity, generosity, and striving for perfection. </p>
							<a href="https://akhuwat.org.pk/about/" target="_blank" class="btn btn-primary py-3 px-5">about us</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- About End -->

		<!-- Projects Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h1 class="display-5">Resources for Books</h1>
        </div>
        <div class="row g-4 portfolio-container">
            <!-- Project 1: elibrary punjab -->
            <div class="col-lg-4 col-md-6 portfolio-item wow fadeInUp" data-wow-delay="0.1s">
                <div class="rounded overflow-hidden shadow-lg">
                    <img class="img-fluid w-100" src="fylib/img/37.jpg" alt="elibrary punjab">
                    <div class="border-top p-4">
                        <h2 class="h4 mb-3">eLibrary Punjab</h2>
                        <p>In 2017, the Punjab Information Technology Board (PITB), under the sponsorship of Youth Affairs & Sports (YAS), established 20 eLibraries across 20 districts of Punjab, including Lahore, Multan, Faisalabad, Rawalpindi, and others.</p>
                     
						<a href="https://elibrary.punjab.gov.pk/" target="_blank" class="btn btn-primary py-3 px-5">Explore More</a>
                    </div>
                </div>
            </div>

            <!-- Project 2: Public Library -->
            <div class="col-lg-4 col-md-6 portfolio-item wow fadeInUp" data-wow-delay="0.3s">
                <div class="rounded overflow-hidden shadow-lg">
                    <img class="img-fluid w-100" src="fylib/img/37.jpg" alt="Public Library">
                    <div class="border-top p-4">
                        <h2 class="h4 mb-3">Public Library</h2>
                        <p>The Govt. Punjab Public Library, located on Library Road in Lahore, is near educational institutions, Punjab University, Anarkali, and government offices, including the Civil Secretariat and TownHall. It is centrally situated in the city.</p>
                        <br>
						<a href="https://gppl.punjab.gov.pk/" target="_blank" class="btn btn-primary py-3 px-5">Explore More</a>
                    </div>
                </div>
            </div>

            <!-- Project 3: Open Library -->
            <div class="col-lg-4 col-md-6 portfolio-item wow fadeInUp" data-wow-delay="0.5s">
                <div class="rounded overflow-hidden shadow-lg">
                    <img class="img-fluid w-100" src="fylib/img/37.jpg" alt="Open Library">
                    <div class="border-top p-4">
                        <h2 class="h4 mb-3">Open Library</h2>
                        <p>Open Library aims to create a webpage for every book ever published. With over 20 million 
                      it's an open, collaborative project supported by the Internet Archive, funded by the California State Library and the Kahle/Austin Foundation.</p>
                        <br>
						<a href="https://openlibrary.org/" target="_blank" class="btn btn-primary py-3 px-5">Explore More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Projects End -->

	
			<div class="container">
				<h2 class="section-title">Project Developer</h2>
				<div class="team">
					<div class="team-member">
						<img src="fylib/kashif.jpg" alt="Team Member" class="team-photo">
						<h3 class="team-name">Kashif Mehmoood Jilani</h3>
						<p class="team-role">Website Devloper</p>
					</div>
					<div class="team-member">
						<img src="fylib/ulfat.jpg" alt="Team Member" class="team-photo">
						<h3 class="team-name">M.Asamullah Ulfat </h3>
						<p class="team-role">Website Devloper/Data Scientist</p>
					</div>
				</div>
			</div>
			<style>
				/* Global Reset */
				* {
					margin: 0;
					padding: 0;
					box-sizing: border-box;
				}

				/* Body styling */
				body {
					font-family: Arial, sans-serif;
					background-color: #f4f4f4;
					color: #333;
					line-height: 1.6;
					padding: 20px;
				}

				/* Container styling */
				.container {
					width: 80%;
					margin: 0 auto;
				}

				/* Team Section */
				.team-section {
					background-color: #fff;
					padding: 50px 0;
					border-radius: 8px;
					box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
				}

				/* Section Title */
				.section-title {
					text-align: center;
					font-size: 2.5em;
					margin-bottom: 30px;
					color: #333;
				}

				/* Team Container */
				.team {
					display: flex;
					justify-content: space-between;
					gap: 20px;
					flex-wrap: wrap;
				}

				/* Team Member Styling */
				.team-member {
					background-color: #f9f9f9;
					text-align: center;
					padding: 20px;
					border-radius: 8px;
					box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
					width: 48%;
					/* Adjusted width for 2 members */
					transition: transform 0.3s ease, box-shadow 0.3s ease;
				}

				/* Hover effect for team member */
				.team-member:hover {
					transform: translateY(-10px);
					box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
				}

				/* Team Photo */
				.team-photo {
					width: 150px;
					height: 150px;
					border-radius: 50%;
					margin-bottom: 20px;
					object-fit: cover;
				}

				/* Team Member Name */
				.team-name {
					font-size: 1.5em;
					color: #333;
					margin-bottom: 10px;
				}

				/* Team Role */
				.team-role {
					font-size: 1.2em;
					color: #777;
					margin-bottom: 10px;
				}

				/* Team Description */
				.team-description {
					font-size: 1em;
					color: #555;
					padding: 0 10px;
				}

				/* Responsive design */
				@media (max-width: 768px) {
					.team {
						flex-direction: column;
						align-items: center;
					}

					.team-member {
						width: 80%;
						margin-bottom: 20px;
					}
				}
			</style>
<br><br>
		<footer>
			<div class="container">
				<div class="copyright">
					<p> &copy; 2024- <?php echo date(
             "Y"
         ); ?> Library Management System. Powered By <a target="_blank" href="Akhuwat collage kasur">Akhuwat </a>, All rights reserved.  </p>
				</div>
				<style>
					.footer-dec {
  width: 100%;
  margin-top: 160px;
}

footer {
  margin-top: -50px;
  z-index: 2;
  position: relative;
}

footer .footer-item h4 {
  font-size: 18px;
  font-weight: 700;
  color: #2a2a2a;
  margin-bottom: 30px;
}

footer .about .logo img {
  width: 89px;
  margin-bottom: 30px;
}

footer .about a {
  color: #afafaf;
  font-weight: 300;
}

footer .about ul {
  margin-top: 20px;
}

footer .about ul li {
  display: inline-block !important;
  margin-right: 5px;
}

footer .about ul li a {
  width: 32px;
  height: 32px;
  background-color: #03a4ed;
  color: #fff !important;
  border-radius: 50%;
  text-align: center;
  display: inline-block;
  line-height: 32px;
  font-size: 15px;
}

footer .about ul li a:hover {
  background-color: #ff695f;
}

footer .footer-item ul li {
  display: block;
  margin-bottom: 12px;
}

footer .footer-item ul li:last-child {
  margin-bottom: 0px;
}

footer .footer-item ul li a {
  font-size: 15px;
  color: #afafaf;
  transition: all .3s;
}

footer .footer-item ul li a:hover {
  color: #ff695f;
}

footer .footer-item p {
  font-size: 15px;
  color: #afafaf;
  margin-top: -5px;
}

footer .footer-item form {
  background-color: #03a4ed;
  height: 46px;
  border-radius: 23px;
  position: relative;
  margin-top: 15px;
}

footer .footer-item form input {
  line-height: 46px;
  background-color: transparent;
  border: none;
  font-size: 14px;
  padding: 0px 20px;
  outline: none;
}

footer .footer-item form input::placeholder {
  color: #fff;
}

footer .footer-item form button {
  position: absolute;
  right: 20px;
  top: 10px;
  color: #fff;
  background-color: transparent;
  border: none;
  outline: none;
}

footer .copyright p {
  text-align: center;
  border-top: 1px solid #eee;
  color: #afafaf;
  margin-top: 50px;
  padding: 20px 0px;
  font-weight: 300;
}

footer .copyright p a {
  color: #ff695f;
}

				</style>
		</footer>
		<!-- Footer End -->

	

		<!-- Swiper JS -->
		<script src="fylib/js/swiper.js"></script>
		<!-- Initialize Swiper -->
     
		<script>
			var swiper = new Swiper(".mySwiper", {
				slidesPerView: 1,
				loop: true,
				pagination: {
					el: ".swiper-pagination",
					clickable: true,
				},
				navigation: {
					nextEl: ".swiper-button-next",
					prevEl: ".swiper-button-prev",
				},
			});
		</script>
	</body>
</html>