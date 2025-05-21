@extends('layouts.master-without-nav')

@section('title')
    Contact Us - Amigos
@endsection

@section('body')

    <body>
    @endsection

    @section('content')
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">
                        <div class="card overflow-hidden">
                            <div class="bg-primary-subtle">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h4 class="text-primary fw-bold">Contact Us</h4>
                                            <p>We'd love to hear from you!</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ URL::asset('build/images/profile-img.png') }}" alt=""
                                            class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <!-- Contact Info Section -->
                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <div class="contact-info mb-4">
                                            <h5 class="text-primary">Our Information</h5>

                                            <div class="mt-4">
                                                <div class="d-flex mb-3">
                                                    <div class="flex-shrink-0">
                                                        <i class="mdi mdi-map-marker text-primary fs-4"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fw-semibold mb-1">Address</h6>
                                                        <p class="text-muted mb-0">1 West View, Dudley, NE23 7AD</p>
                                                    </div>
                                                </div>

                                                <div class="d-flex mb-3">
                                                    <div class="flex-shrink-0">
                                                        <i class="mdi mdi-phone text-primary fs-4"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fw-semibold mb-1">Phone</h6>
                                                        <p class="text-muted mb-0">0191 250 2226</p>
                                                    </div>
                                                </div>

                                                <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <i class="mdi mdi-email-outline text-primary fs-4"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fw-semibold mb-1">Email</h6>
                                                        <p class="text-muted mb-0">amigospizza23@gmail.com</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="hours-info">
                                            <h5 class="text-primary">Opening Hours</h5>

                                            <div class="mt-4">
                                                <div class="d-flex mb-3 align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="mdi mdi-calendar-clock text-primary fs-4"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fw-semibold mb-1">Monday - Thursday</h6>
                                                        <p class="text-muted mb-0">12:00 PM - 10:00 PM</p>
                                                    </div>
                                                </div>

                                                <div class="d-flex mb-3 align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="mdi mdi-calendar-clock text-primary fs-4"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fw-semibold mb-1">Friday - Saturday</h6>
                                                        <p class="text-muted mb-0">12:00 PM - 11:00 PM</p>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="mdi mdi-calendar-clock text-primary fs-4"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fw-semibold mb-1">Sunday</h6>
                                                        <p class="text-muted mb-0">12:00 PM - 10:00 PM</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Form Section -->
                                {{-- <div class="contact-form mt-4">
                                    <h5 class="text-primary mb-4">Send Us a Message</h5>

                                    <form>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label">Your Name</label>
                                                <input type="text" class="form-control" id="name"
                                                    placeholder="Enter your name">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label">Your Email</label>
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="Enter your email">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="subject" class="form-label">Subject</label>
                                            <input type="text" class="form-control" id="subject"
                                                placeholder="Enter subject">
                                        </div>

                                        <div class="mb-3">
                                            <label for="message" class="form-label">Message</label>
                                            <textarea class="form-control" id="message" rows="5" placeholder="Enter your message"></textarea>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Submit Message</button>
                                        </div>
                                    </form>
                                </div> --}}

                                <!-- Special Note Section -->
                                <div class="mt-5 pt-3 border-top">
                                    <h5 class="text-primary">Allergen Information</h5>
                                    <p>If you have a severe food allergy or intolerance, please contact us directly before
                                        placing your order to ensure it is safe for your consumption. We're happy to provide
                                        detailed allergen information and accommodate your dietary needs when possible.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            {{-- <p>
                                <a href="index" class="fw-medium text-primary"> Return to Home </a>
                            </p> --}}
                            <p>
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Amigos. Made with
                                <i class="mdi mdi-heart text-danger"></i> by Amigos Team
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
