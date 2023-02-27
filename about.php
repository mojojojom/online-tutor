<?php
    include('connection/connect.php');
    error_reporting(0);
    session_start();
    include('header.php');
?>

        <!-- BANNER -->
        <section class="h_banner-wrap" id="home">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-lg-6 d-flex align-items-center">
                        <div class="h_banner-content text-center text-lg-start">
                            <p class="h_banner-content-heading">Discover The Power Of Knowledge</p>
                            <p class="h_banner-content-subheading">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quidem nostrum alias obcaecati ratione ducimus nemo eligendi itaque maxime sapiente error quam, suscipit expedita in qui veniam molestiae mollitia! Consequatur, animi.</p>
                            <div class="h_banner-content-btn-wrap d-flex align-items-center justify-content-center justify-content-lg-start gap-2">
                                <button class="c-btn c-btn-primary">Get Started</button>
                                <button class="c-btn c-btn-primary-outline">Learn More</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 d-none d-lg-flex"></div>
                </div>
            </div>
        </section>

        <!-- ABOUT SECTION -->
        <section class="h_about-wrap sec-pad" id="about">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 mb-4">
                        <div class="h_about-img-wrap">
                            <img src="images/about-sec.jpg" alt="About Us Image">
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4 d-flex align-items-end">
                        <div class="h_about-desc-wrap text-center text-lg-start">
                            <p class="d-inline-block border rounded t-primary fw-semi-bold py-1 px-3">About Us</p>
                            <h1 class="fw-bold display-5 mb-3">We Help The Students Expand Their Knowledge</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto itaque maiores nostrum porro ipsum maxime ipsa quos! Eaque rem sunt odio. Corporis aspernatur ad esse officia incidunt nesciunt assumenda consequuntur?</p>
                            <div class="card">
                                <div class="card-body">

                                <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="mission-tab" data-bs-toggle="tab" data-bs-target="#mission-tab-pane" type="button" role="tab" aria-controls="mission-tab-pane" aria-selected="true">Mission</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="vission-tab" data-bs-toggle="tab" data-bs-target="#vission-tab-pane" type="button" role="tab" aria-controls="vission-tab-pane" aria-selected="false">Vission</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="mission-tab-pane" role="tabpanel" aria-labelledby="mission-tab" tabindex="0">
                                        <p class="mb-0 text-start">
                                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem ratione, sed earum nihil quibusdam cum amet harum dignissimos perferendis eum quo id, temporibus esse voluptatibus vitae alias voluptates! Repellat, ea.
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="vission-tab-pane" role="tabpanel" aria-labelledby="vission-tab" tabindex="0">
                                        <p class="mb-0 text-start">
                                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem ratione, sed earum nihil quibusdam cum amet harum dignissimos perferendis eum quo id, temporibus esse voluptatibus vitae alias voluptates! Repellat, ea.
                                        </p>
                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-12 card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h1>Hello</h1>
                                </div>
                                <div class="col-md-4">
                                    <h1>Hello</h1>
                                </div>
                                <div class="col-md-4">
                                    <h1>Hello</h1>
                                </div>
                            </div>
                        </div>
                    </div> -->

                </div>
            </div>
        </section>

        <!-- COURSES SECTION -->
        <section class="h_courses-wrap sec-pad" id="courses">
            <div class="container">
                <div class="h_courses-heading-wrap text-center mb-4">
                    <p class="d-inline-block border rounded t-primary fw-semi-bold py-1 px-3">Courses</p>
                    <h1 class="fw-bold display-5">What Are The Courses We Offer?</h1>
                </div>
                <div class="h_courses-slider-wrap">
                    <div class="h_courses-slider">

                        <!-- SLIDER ITEMS -->
                        <div class="h_courses-slider-inner-wrap">
                            <div class="h_courses-item">
                                <div class="h_courses-inner-slider pe-5 pb-5">

                                    <div class="h_courses-img-wrap mb-3">
                                        <img src="images/banner-bg.jpg" class="img-fluid rounded" alt="">
                                        <a href="#">
                                            <i class="fa-solid fa-link"></i>
                                        </a>
                                    </div>
                                    <div class="h_courses-title-wrap">
                                        <h4 class="mb-0">Science</h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="h_courses-slider-inner-wrap">
                            <div class="h_courses-item">
                                <div class="h_courses-inner-slider pe-5 pb-5">

                                    <div class="h_courses-img-wrap mb-3">
                                        <img src="images/banner-bg.jpg" class="img-fluid rounded" alt="">
                                        <a href="#">
                                            <i class="fa-solid fa-link"></i>
                                        </a>
                                    </div>
                                    <div class="h_courses-title-wrap">
                                        <h4 class="mb-0">Science</h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="h_courses-slider-inner-wrap">
                            <div class="h_courses-item">
                                <div class="h_courses-inner-slider pe-5 pb-5">

                                    <div class="h_courses-img-wrap mb-3">
                                        <img src="images/banner-bg.jpg" class="img-fluid rounded" alt="">
                                        <a href="#">
                                            <i class="fa-solid fa-link"></i>
                                        </a>
                                    </div>
                                    <div class="h_courses-title-wrap">
                                        <h4 class="mb-0">Science</h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="h_courses-slider-inner-wrap">
                            <div class="h_courses-item">
                                <div class="h_courses-inner-slider pe-5 pb-5">

                                    <div class="h_courses-img-wrap mb-3">
                                        <img src="images/banner-bg.jpg" class="img-fluid rounded" alt="">
                                        <a href="#">
                                            <i class="fa-solid fa-link"></i>
                                        </a>
                                    </div>
                                    <div class="h_courses-title-wrap">
                                        <h4 class="mb-0">Science</h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="h_courses-slider-inner-wrap">
                            <div class="h_courses-item">
                                <div class="h_courses-inner-slider pe-5 pb-5">

                                    <div class="h_courses-img-wrap mb-3">
                                        <img src="images/banner-bg.jpg" class="img-fluid rounded" alt="">
                                        <a href="#">
                                            <i class="fa-solid fa-link"></i>
                                        </a>
                                    </div>
                                    <div class="h_courses-title-wrap">
                                        <h4 class="mb-0">Science</h4>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="h_courses-slider-arrows d-flex align-items-center justify-content-center gap-3">
                        <i class="fa-solid fa-chevron-left h_courses-slider-custom-left"></i>
                        <i class="fa-solid fa-chevron-right h_courses-slider-custom-right"></i>
                    </div>
                </div>
            </div>
        </section>

        <!-- TUTOR SECTION -->
        <section class="h_tutors-wrap sec-pad" id="tutors">
            <div class="container">
                <div class="h_tutors-heading-wrap text-center mb-4">
                    <p class="d-inline-block border rounded t-primary fw-semi-bold py-1 px-3">Tutors</p>
                    <h1 class="fw-bold display-5">These Are Our Excellent Tutors </h1>
                </div>
                <div class="h_tutors-slider-wrap">

                    <div class="h_tutors-slider">

                        <!-- SLIDER ITEMS -->
                        <div class="h_tutors-slider-inner-wrap">
                            <div class="h_tutors-item">
                                <a href="#" class="img-link">
                                    <i class="fa-solid fa-link"></i>
                                    <div class="overlay rounded"></div>
                                    <img src="images/about-sec.jpg" class="img-fluid rounded" alt="">
                                </a>
                                <div class="h_tutors-desc-wrap">
                                    <h4 class="mb-0">Sample Name</h4>
                                    <div class="h_tutors-socials">
                                        <a href="#" class="btn btn-square rounded-circle mx-1"><i class="fa-brands fa-facebook-f"></i></a>
                                        <a href="#" class="btn btn-square rounded-circle mx-1"><i class="fa-brands fa-instagram"></i></a>
                                        <a href="#" class="btn btn-square rounded-circle mx-1"><i class="fa-brands fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h_tutors-slider-inner-wrap">
                            <div class="h_tutors-item">
                                <a href="#" class="img-link">
                                    <i class="fa-solid fa-link"></i>
                                    <div class="overlay rounded"></div>
                                    <img src="images/about-sec.jpg" class="img-fluid rounded" alt="">
                                </a>
                                <div class="h_tutors-desc-wrap">
                                    <h4 class="mb-0">Sample Name</h4>
                                    <div class="h_tutors-socials">
                                        <a href="#" class="btn btn-square rounded-circle mx-1"><i class="fa-brands fa-facebook-f"></i></a>
                                        <a href="#" class="btn btn-square rounded-circle mx-1"><i class="fa-brands fa-instagram"></i></a>
                                        <a href="#" class="btn btn-square rounded-circle mx-1"><i class="fa-brands fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h_tutors-slider-inner-wrap">
                            <div class="h_tutors-item">
                                <a href="#" class="img-link">
                                    <i class="fa-solid fa-link"></i>
                                    <div class="overlay rounded"></div>
                                    <img src="images/about-sec.jpg" class="img-fluid rounded" alt="">
                                </a>
                                <div class="h_tutors-desc-wrap">
                                    <h4 class="mb-0">Sample Name</h4>
                                    <div class="h_tutors-socials">
                                        <a href="#" class="btn btn-square rounded-circle mx-1"><i class="fa-brands fa-facebook-f"></i></a>
                                        <a href="#" class="btn btn-square rounded-circle mx-1"><i class="fa-brands fa-instagram"></i></a>
                                        <a href="#" class="btn btn-square rounded-circle mx-1"><i class="fa-brands fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h_tutors-slider-inner-wrap">
                            <div class="h_tutors-item">
                                <a href="#" class="img-link">
                                    <i class="fa-solid fa-link"></i>
                                    <div class="overlay rounded"></div>
                                    <img src="images/about-sec.jpg" class="img-fluid rounded" alt="">
                                </a>
                                <div class="h_tutors-desc-wrap">
                                    <h4 class="mb-0">Sample Name</h4>
                                    <div class="h_tutors-socials">
                                        <a href="#" class="btn btn-square rounded-circle mx-1"><i class="fa-brands fa-facebook-f"></i></a>
                                        <a href="#" class="btn btn-square rounded-circle mx-1"><i class="fa-brands fa-instagram"></i></a>
                                        <a href="#" class="btn btn-square rounded-circle mx-1"><i class="fa-brands fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h_tutors-slider-inner-wrap">
                            <div class="h_tutors-item">
                                <a href="#" class="img-link">
                                    <i class="fa-solid fa-link"></i>
                                    <div class="overlay rounded"></div>
                                    <img src="images/about-sec.jpg" class="img-fluid rounded" alt="">
                                </a>
                                <div class="h_tutors-desc-wrap">
                                    <h4 class="mb-0">Sample Name</h4>
                                    <div class="h_tutors-socials">
                                        <a href="#" class="btn btn-square rounded-circle mx-1"><i class="fa-brands fa-facebook-f"></i></a>
                                        <a href="#" class="btn btn-square rounded-circle mx-1"><i class="fa-brands fa-instagram"></i></a>
                                        <a href="#" class="btn btn-square rounded-circle mx-1"><i class="fa-brands fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- ARROWS -->
                    <div class="h_tutors-slider-arrows d-flex align-items-center justify-content-center gap-3">
                        <i class="fa-solid fa-chevron-left h_tutors-slider-custom-left"></i>
                        <i class="fa-solid fa-chevron-right h_tutors-slider-custom-right"></i>
                    </div>

                </div>
            </div>
        </section>

        <!-- TESTIMONIAL SECTION -->
        <section class="h_testi-wrap sec-pad" id="testimonials">
            <div class="container">
                <div class="h_testi-heading-wrap text-center mb-4">
                    <p class="d-inline-block border rounded t-primary fw-semi-bold py-1 px-3">Testimonials</p>
                    <h1 class="fw-bold display-5">What Our Clients Say!</h1>
                </div>

                <div class="h_testi-slide-wrap">

                    <div class="h_testi-slider">

                        <!-- SLIDES -->
                        <div class="h_testi-slider-inner-wrap">
                            <div class="h_testi-item">
                                <div class="h_testi-text-wrap border rounded p-4 pt-5 mb-2">
                                    <div class="btn-square bg-white border rounded-circle"><i class="fa fa-quote-right fa-2x text-primary"></i></div>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum ducimus facere suscipit nesciunt distinctio iste. Delectus aut quae, nihil doloribus numquam qui! Ratione autem pariatur quos velit at tempora hic?
                                </div>

                                <img class="rounded-circle mb-3 border" src="images/about-sec.jpg" alt="">
                                <h4>Client Name</h4>
                                <span>Student</span>
                            </div>
                        </div>
                        <div class="h_testi-slider-inner-wrap">
                            <div class="h_testi-item">
                                <div class="h_testi-text-wrap border rounded p-4 pt-5 mb-2">
                                    <div class="btn-square bg-white border rounded-circle"><i class="fa fa-quote-right fa-2x text-primary"></i></div>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum ducimus facere suscipit nesciunt distinctio iste. Delectus aut quae, nihil doloribus numquam qui! Ratione autem pariatur quos velit at tempora hic?
                                </div>

                                <img class="rounded-circle mb-3 border" src="images/about-sec.jpg" alt="">
                                <h4>Client Name</h4>
                                <span>Student</span>
                            </div>
                        </div>
                        <div class="h_testi-slider-inner-wrap">
                            <div class="h_testi-item">
                                <div class="h_testi-text-wrap border rounded p-4 pt-5 mb-2">
                                    <div class="btn-square bg-white border rounded-circle"><i class="fa fa-quote-right fa-2x text-primary"></i></div>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum ducimus facere suscipit nesciunt distinctio iste. Delectus aut quae, nihil doloribus numquam qui! Ratione autem pariatur quos velit at tempora hic?
                                </div>

                                <img class="rounded-circle mb-3 border" src="images/about-sec.jpg" alt="">
                                <h4>Client Name</h4>
                                <span>Student</span>
                            </div>
                        </div>
                        <div class="h_testi-slider-inner-wrap">
                            <div class="h_testi-item">
                                <div class="h_testi-text-wrap border rounded p-4 pt-5 mb-2">
                                    <div class="btn-square bg-white border rounded-circle"><i class="fa fa-quote-right fa-2x text-primary"></i></div>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum ducimus facere suscipit nesciunt distinctio iste. Delectus aut quae, nihil doloribus numquam qui! Ratione autem pariatur quos velit at tempora hic?
                                </div>

                                <img class="rounded-circle mb-3 border" src="images/about-sec.jpg" alt="">
                                <h4>Client Name</h4>
                                <span>Student</span>
                            </div>
                        </div>
                        <div class="h_testi-slider-inner-wrap">
                            <div class="h_testi-item">
                                <div class="h_testi-text-wrap border rounded p-4 pt-5 mb-2">
                                    <div class="btn-square bg-white border rounded-circle"><i class="fa fa-quote-right fa-2x text-primary"></i></div>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum ducimus facere suscipit nesciunt distinctio iste. Delectus aut quae, nihil doloribus numquam qui! Ratione autem pariatur quos velit at tempora hic?
                                </div>

                                <img class="rounded-circle mb-3 border" src="images/about-sec.jpg" alt="">
                                <h4>Client Name</h4>
                                <span>Student</span>
                            </div>
                        </div>

                    </div>
                    <!-- ARROWS -->
                    <div class="h_tutors-slider-arrows d-flex align-items-center justify-content-center gap-3">
                        <i class="fa-solid fa-chevron-left h_testi-slider-custom-left"></i>
                        <i class="fa-solid fa-chevron-right h_testi-slider-custom-right"></i>
                    </div>
                </div>


            </div>
        </section>

<?php
    include('footer.php');
?>