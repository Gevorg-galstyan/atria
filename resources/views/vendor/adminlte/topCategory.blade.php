<section class="section">
    aaaaaaa
    <div class="container">
        <div class="section-title text-center clearfix">
            <h4>Top Categories</h4>
            <p>Listed below our top categories, campaings, promotions and offers for you!</p>
            <hr>
        </div><!-- end title -->


        @if(count($topCategories) <= 6)
            <div class="row">
                <div class="col-sm-4">
                        <span class="add_top_icon" title="Add Top Category">
                            <i class="fa fa-plus fa-2x" aria-hidden="true"></i>
                        </span>
                    <div class="add_top_div">
                        <div class="btn-group">
                            <select id="disabledSelect sub_categories" class="form-control add_top_select"
                                    data-href="{{route('addTopCategory')}}">
                                <option value="">Choose Category</option>
                                @foreach($subCategories as $subCategory)
                                    <option value="{{$subCategory->id}}">
                                        {{$subCategory->translate(session('locale'))->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary add_top_save">Save</button>
                    </div>

                </div>
            </div>
        @endif

        <div class="banner-masonry row">
            @foreach($topCategories->sortBy('top') as $topCategorie)

                <div class="banner-item item-w1 item-h1">
                    <a href="#"><img src="{{asset('upload/banner_01.png')}}" alt="" class="img-responsive"></a>
                    <div class="banner-button">
                        <a href="#" class="button button--aylen btn">GARDEN SUPPLIES</a>
                    </div>
                </div><!-- end banner-item -->

            @endforeach
        </div>


    </div><!-- end container -->
</section><!-- end section -->