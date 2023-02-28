<section class="homeContact homeContact__style__two">
    <div class="container">
        <div class="homeContact__wrap">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section__title">
                        <span class="sub-title">Say hello</span>
                        <h2 class="title">Any questions? Feel free <br> to contact</h2>
                    </div>
                    <div class="homeContact__content">
                        {!!$system_settings->contuct_us_text!!}
                        <h2 class="mail"><a href="mailto:{!!$system_settings->email!!}">{!!$system_settings->email!!}</a></h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="homeContact__form">
                        <form autocomplete="off" action="{{route('frontend.send.message')}}" method="post" >
                            @csrf
                            <input type="text" id="name1" name="name1" placeholder="Enter name*" required>
                            @error('name1')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @enderror
                            <input type="hidden" id="type1" name="type1" value="1" required>
                            <input type="text" id="title1" name="title1" placeholder="Enter Subject*" required>
                            @error('title1')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @enderror
                            <input type="email" id="email1" name="email1" placeholder="Enter mail*" required>
                            @error('email1')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @enderror
                            <input type="text" id="mobile1" name="mobile1" placeholder="Enter number*" required>
                            @error('mobile1')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @enderror
                            <textarea id="message1" name="message1" placeholder="Enter Massage*" required></textarea>
                            @error('message1')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @enderror
                            <button type="submit">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>