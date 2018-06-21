<footer class="section footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="widget clearfix">
                    <div class="widget-title">
                        <h4>@lang('index.terms')</h4>
                        <hr>
                    </div>

                    <div class="link-widget">
                        <ul class="check">
                            <li><a href="{{route('home')}}">@lang('header.home')</a></li> 
                            <li><a href="{{route('about')}}">@lang('header.about')</a></li> 
                            <li><a href="{{route('delivery')}}">@lang('delivery.delivery')</a></li>
                              <li><a href="{{route('contactus')}}">@lang('header.contact')</a></li>
                            <li><a href="{{route('terms')}}">@lang('terms.terms')</a></li>
                            <li><a href="{{route('refund')}}">@lang('refund.refund')</a></li>
                        </ul>
                    </div><!-- end link -->
                </div><!-- end widget -->

              
            </div><!-- end col -->
            <div class="col-md-4 col-sm-12">
                <div class="widget clearfix">
                    <div class="widget-title">
                        <h4>@lang('header.contact')</h4>
                        <hr>
                    </div>

                    <div class="link-widget">
                        <ul class="contact-details">
                            <li class="white"><i class="fa fa-envelope-o"></i> <a href="mailto:info@atria.am"> info@atria.am</a></li>
                            <li class="white"><i class="fa fa-phone"></i>+(374)10 55-69-09</li>
                            <li class="white"><i class="fa fa-mobile"></i> +(374) 43 55-69-09</li>
                            <li class="white"><i class="fa fa-home"></i>  @lang('index.addr')</li>
                            <li class="white"><i class="fa fa-facebook"></i> <a href="https://www.facebook.com/atriahometextile/" target="_blank">@atriahometextile</a></li>
                            <li class="white"><i class="fa fa-instagram"></i> <a href="https://www.instagram.com/atria_textile/" target="_blank">atria_textile</a></li>
                        </ul>
                    </div><!-- end link -->
                </div><!-- end widget -->

              
            </div><!-- end col -->
            <!-- <div class="col-md-4 col-sm-12">
                <div class="widget clearfix">
                    
 <img src='{{asset('images/logo_footer.png')}}' class='img-responsive'  />
                </div>
            </div> 
            -->

            <div class="col-md-4 col-sm-12 text-right">
                <div class="widget clearfix">
                    <div class="widget-title">
                        <h4>@lang('index.subscribe')
                             
                        </h4>
                        <div class='text-right'>
                            <hr class='right_hr'>
                        </div>
                       
                    </div>

                    <div class="newsletter-widget">
                        <p>@lang('index.subscribe_desc')</p>
                        <form method="post" action="{{route('subscribe')}}">
                            {{csrf_field()}}
                            <input type="text" name="name" class="form-control input-lg"
                                   placeholder="@lang('contacts.name')" required/>
                            <input type="email" name="email" class="form-control input-lg"
                                   placeholder="@lang('contacts.email')" required/>
                            <button type="submit" class="button button--aylen btn" style='background-color:#fff !important;color:#555 !important;'>@lang('header.subscribe')</button>
                        </form>
                    </div><!-- end newsletter -->

                </div><!-- end widget -->

                <!--<div class="widget clearfix">-->
                <!--    <div class="row stat-wrapper">-->
                <!--        <div class="stats col-md-6">-->
                <!--            <h5>Products</h5>-->
                <!--            <p>{{$product_count}}</p>-->
                <!--        </div><!-- end stats -->
                <!--        <div class="stats col-md-6">-->
                <!--            <h5>Customers</h5>-->
                <!--            <p>{{$users_count->count()}}</p>-->
                <!--        </div><!-- end stats -->
                <!--    </div><!-- end row -->
                <!--</div><!-- end widget -->
            </div><!-- end col -->

        </div><!-- end row -->
    </div><!-- end container -->
</footer>

<!--<div class="topfooter">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-md-4 col-sm-4 col-xs-12">-->
<!--                <a class="navbar-brand" href="index.html"><img src="{{asset('images/logo.png')}}" alt=""></a>-->
<!--            </div><!-- end col -->

<!--            <div class="col-md-8 col-sm-8 col-xs-12 text-center payments">-->
<!--                <a href="#0"><i class="fa fa-paypal"></i></a>-->
<!--                <a href="#0"><i class="fa fa-credit-card"></i></a>-->
<!--                <a href="#0"><i class="fa fa-cc-amex"></i></a>-->
<!--                <a href="#0"><i class="fa fa-cc-mastercard"></i></a>-->
<!--                <a href="#0"><i class="fa fa-cc-visa"></i></a>-->
<!--                <a href="#0"><i class="fa fa-cc-diners-club"></i></a>-->
<!--                <a href="#"><i class="fa fa-cc-discover"></i></a>-->
<!--            </div><!-- end col -->

          
<!--        </div><!-- end row -->
<!--    </div><!-- end container -->
<!--</div>-->