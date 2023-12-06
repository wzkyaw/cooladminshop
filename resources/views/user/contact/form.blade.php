<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    {{-- Bootstrap Link Only --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">

    {{-- Font-awesome Link Only --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- boxicons link --}}
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    {{-- Contact Css --}}
    <link rel="stylesheet" href="{{ asset('user/css/contact.css') }}">
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-4 d-none d-lg-block mt-2">
                <a href="" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">CODE LAB</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </a>
            </div>
            <div class="col-lg-8">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('user#home') }}" class="nav-item nav-link active">Home</a>
                            <a href="{{ route('user#cartList') }}" class="nav-item nav-link">My Cart</a>
                            <a href="{{ route('user#contactListPage') }}" class=" text-decoration-none"><button class="nav-item nav-link" type="button" id="contactBtn">Contact</button></a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning dropdown-toggle" style="color:#3D464D;" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                    <i class="fa-solid fa-user"></i>  {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-lg-end">
                                  <li>
                                    <a href="{{ route('user#accountChangePage') }}" class="text-decoration-none">
                                        <button class="dropdown-item" type="button"><i class="fa-solid my-3 me-3 fa-user"></i>Account</button>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="{{ route('user#changePasswordPage') }}" class=" text-decoration-none">
                                        <button class="dropdown-item" type="button"><i class="fa-solid my-3 me-2 fa-user-lock"></i>Change Password</button>
                                    </a>
                                  </li>
                                  <li>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button class="dropdown-item" type="submit"><i class="fa-solid my-3 me-2 fa-right-from-bracket ms-1 text-black"></i>Logout</button>
                                    </form>
                                </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    {{-- update category success alert --}}
    @if (session('success'))
        <div class="col-5" style="margin-left: 176px">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-check"></i>  {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    {{-- LINK TO BACK LIST PAGE --}}
    <button class="btn mb-3" style="background-color:rgba(208, 201, 16, 0.933); margin-left: 190px;">
        <a class=" text-decoration-none text-white" href="{{ route('user#home') }}"><i class="fa-solid fa-circle-arrow-left me-2"></i>Back</a>
    </button>

    {{-- Contact Section --}}
    <form action="{{ route('user#contactList') }}" method="post">
        @csrf
        <div class="container" id="contactContainer">
            {{-- <input type="hidden" name="userId" id="userId" value="{{ Auth::user()->id }}"> --}}
            <h2>Contact Us</h2>
            <div class="row100">
                <div class="col">
                    <div class="inputBox form-group">
                        <span class="text">First Name</span>
                        <input type="text" class="form-control @error('firstName')
                            is-invalid
                        @enderror" name="firstName" id="firstName" value="{{ old('firstName') }}">

                        {{-- <span class="line"></span> --}}
                        @error('firstName')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="inputBox form-group">
                        <span class="text">Last Name</span>
                        <input type="text" class="form-control @error('lastName')
                            is-invalid
                        @enderror" name="lastName" id="lastName"  value="{{ old('lastName') }}">

                        {{-- <span class="line"></span> --}}
                        @error('lastName')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row100">
                <div class="col">
                    <div class="inputBox form-group">
                        <span class="text">Email</span>
                        <input type="text" class="form-control @error('email')
                            is-invalid
                        @enderror" name="email" id="email"  value="{{ old('email') }}">

                        {{-- <span class="line"></span> --}}
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="inputBox form-group">
                        <span class="text">Subject</span>
                        <input type="text" class="form-control @error('subject')
                            is-invalid
                        @enderror" name="subject" id="subject"  value="{{ old('subject') }}">

                        {{-- <span class="line"></span> --}}
                        @error('subject')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row100">
                <div class="col">
                    <div class="inputBox form-group textarea">
                        <span class="text">Type your message here...</span>
                        <textarea class="form-control @error('message')
                            is-invalid
                        @enderror" name="message" id="message">{{ old('message') }}</textarea>

                        {{-- <span class="line"></span> --}}
                        @error('message')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row100">
                <div class="col">
                    {{-- <input type="submit" id="sendBtn" value="Send Message"> --}}

                    <button type="submit" id="sendBtn">
                        <div class="svg-wrapper-1">
                          <div class="svg-wrapper">
                            <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                              <path d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z" fill="currentColor"></path>
                            </svg>
                          </div>
                        </div>
                        <span>Send</span>
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor. Rebum tempor no vero est magna amet no</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Email Address">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
                    by
                    <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            {{-- <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div> --}}
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    {{-- <script src="{{ asset('user/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('user/mail/contact.js') }}"></script> --}}

    <!-- Template Javascript -->
    <script src="{{ asset('user/js/main.js') }}"></script>

    {{-- Bootstrap Link Only --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    {{-- Jquery Link Only --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

{{-- <script>
    $(document).ready(function () {

        // CONTACT TOGGLE BUTTON
        $('#contactBtn').click(function () {
            $('#contactContainer').toggle(1000);
        });
    });
</script> --}}

</html>
