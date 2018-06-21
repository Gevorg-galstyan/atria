<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        {{--<h4 class="modal-title">(IMAGE SIZE 1920 x 1080)</h4>--}}
    </div>
    <div class="modal-body">
        <div class="modal-body">
            <div class="box-header with-border text-center">
                <h3 class="box-title">Update Category</h3>
            </div>
            <div class="box box-primary">

                <div class="box-body">
                    <form action="{{route('updateProduct', ['prod' => $product->link])}}" method="post"
                          class="productMulty"
                          enctype="multipart/form-data">
                        {{csrf_field()}}

                        {{--=======================================  Name  =======================================--}}

                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="text-center">Name</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="panel panel-danger">
                                <div class=" panel-body">
                                    <div class="col-xs-4">
                                        <div class="form-group text-center">
                                            <label>Հայերեն *</label>
                                            <input type="text" name="hy_name" class="form-control"
                                                   placeholder="Հայերեն *"
                                                   value="{{$product->translate('hy')->name}}" required>

                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group text-center">
                                            <label>English *</label>
                                            <input type="text" name="en_name" class="form-control"
                                                   placeholder="English *"
                                                   value="{{$product->translate('en')->name}}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group text-center">
                                            <label>Русский *</label>
                                            <input type="text" name="ru_name" class="form-control"
                                                   placeholder="Русский *"
                                                   value="{{$product->translate('hy')->name}}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--=======================================  Image  =======================================--}}

                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="text-center"><i class="fa fa-picture-o" aria-hidden="true"></i> Images
                                </h3>
                            </div>
                        </div>
                        <div class="row">
                            <h4 class="text-center">Old Images</h4>
                            <div class="col-md-12">
                                <div id="multiple-file-preview">

                                    <div class="clear-both">
                                        <ul id="sortable1" class="sort text-center">
                                            @php($img = 0)
                                            @foreach($product->images->sortBy('id') as $image)
                                                <li class="ui-state-default" data-order="0"
                                                    data-target="image{{$img}}"
                                                    data-prod="{{$image->id}}"
                                                    data-key="image"
                                                    data-href_delete="{{route('deleteProduct')}}">
                                                    <img src="{{asset('images/products/'.$image->image_name)}}"
                                                         style="width:100%;"/>
                                                    <span class="delete_update_image iconDelete"
                                                          data-status="image{{$img}}">
                                                                <i class="fa fa-trash fa-2x"></i>
                                                            </span>
                                                    <input type="hidden" name="image_name[]"
                                                           value="{{$image->image_name}}">
                                                </li>
                                                @php($img ++)
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="panel panel-danger">
                                <div class="panel panel-body">
                                    <h4 class="text-center">Choose New Images</h4>

                                    <div class="col-sm-12">
                                        <div class="block">
                                            <input type="file" name="img" data-name="updateImage"
                                                   class="image"
                                                   multiple="multiple"/>

                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="image_container" data-xname="updateImage">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{--=======================================  COLOR  =======================================--}}
                        <div class="row">
                            <div class="text-center">
                                <h3>
                                    Color
                                    <button type="button"
                                            class="btn btn-primary add_color"
                                            title="Add"
                                            data-color="add">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </h3>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-danger">
                                    <div class="panel-body">
                                        <div class="color_container" data-color_container="add">
                                            @php($j = 1)
                                            @foreach($product->colors as $color)
                                                <div class="col-sm-1" data-status="oldColor_{{$j}}">
                                                    <span class="delete_color cursor_pointer"
                                                          data-target="oldColor_{{$j}}">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </span>
                                                    <input type="color" name="color[]" value="{{$color->color}}">
                                                </div>
                                                @php($j++)
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--=======================================  Silder  ================================--}}
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="text-center"> Sliders
                                </h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="panel panel-danger">
                                <div class="panel panel-body">
                                    <div class="col-sm-6 col-sm-offset-3 text-center">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>New</label>
                                                <input type="checkbox" name="new"
                                                       value="new" {{$product->slider_new ? 'checked' : ''}}>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Sale</label>
                                                <input type="checkbox" name="saleSlider"
                                                       value="sale" {{$product->slider_sale ? 'checked' : ''}}>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{--=======================================  Filters  =======================================--}}
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="text-center"><i class="fa fa-filter"></i> Filters</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="panel panel-danger">
                                <div class="panel-body">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <div class="col-sm-12">
                                            <h4 class="text-center">
                                                Please choose filter or enter a price
                                            </h4>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group text-center">
                                                <label>Price</label>
                                                <input type="number" name="firstPrice"
                                                       class="form-control firstPrice"
                                                       placeholder="Price"
                                                       value="{{$product->price}}"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group text-center">
                                                <label>Sale</label>
                                                <input type="number" name="firstSale" class="form-control"
                                                       placeholder="Sale"
                                                       value="{{$product->sale}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @php($i = 0)
                            @php($j = 0)
                            @foreach($filters->sortBy('id') as $filter)
                                <div class="col-sm-4">
                                    <div class="panel panel-danger">
                                        <div class=" panel-heading">
                                            <div class="text-center">
                                                <h4 class="red">
                                                    {{$filter->translate(session('locale'))->name}}
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="panel-body text-center">
                                            @foreach($filter->subs->sortBy('id') as  $subs)

                                                @if(count($subs->values) < 1)
                                                    @php
                                                        $res = $product
                                                        ->filters->where('filter_value', $subs->code)
                                                        ->first();
                                                    @endphp
                                                    <div class="row">
                                                        <p>
                                                            <input type="checkbox"
                                                                   class="filter_checkbox"
                                                                   name="filter_checkbox[]"
                                                                   value="{{$subs->code}}"
                                                                   data-target="filter_{{$i}}"
                                                                    {{$res?'checked':''}}>
                                                            {{$subs->translate(session('locale'))->name}}</p>
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <select name="plusMinus[]"
                                                                            class="form-control"
                                                                            data-status_sale="filter_{{$i}}"
                                                                            {{$res?'':'disabled'}}>
                                                                        <option {{$res && $res->plusMinus == '+' ? 'selected' :''}} value="+">
                                                                            +
                                                                        </option>
                                                                        <option {{$res && $res->plusMinus == '-' ? 'selected' :''}} value="-">
                                                                            -
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group ">
                                                                        <input type="number"
                                                                               class="form-control filter_price"
                                                                               name="price[]"
                                                                               placeholder="Price"
                                                                               data-status="filter_{{$i}}"
                                                                               value="{{$res?$res->price:''}}"
                                                                                {{$res?'':'disabled'}}>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                    </div>

                                                @else

                                                    <div class="panel panel-danger">
                                                        <div class="panel-body text-center">
                                                            <div>
                                                                <h3 class="green">{{$subs->translate(session('locale'))->name}}</h3>
                                                            </div>

                                                            @foreach($subs->values  as $value)
                                                                @php
                                                                    $res = $product
                                                                    ->filters->where('filter_value', $value->code)
                                                                    ->first();
                                                                @endphp
                                                                <div class="row">
                                                                    <div class="col-sm-11 col-sm-offset-1">

                                                                        <p>
                                                                            <input type="checkbox"
                                                                                   class="filter_checkbox"
                                                                                   name="filter_checkbox_value[{{$j}}]"
                                                                                   data-target="filter_{{$i.$j}}"
                                                                                   value="{{$value->code}}"
                                                                                    {{$res?'checked':''}}>
                                                                            {{$value->translate(session('locale'))->name}}
                                                                        </p>

                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <select name="plusMinus_value[{{$j}}]"
                                                                                        class="form-control"
                                                                                        data-status_sale="filter_{{$i.$j}}"
                                                                                        {{$res?'':'disabled'}}>
                                                                                    <option {{$res && $res->plusMinus == '+' ? 'selected' :''}} value="+">
                                                                                        +
                                                                                    </option>
                                                                                    <option {{$res && $res->plusMinus == '-' ? 'selected' :''}} value="-">
                                                                                        -
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <input type="number"
                                                                                       class="form-control filter_price"
                                                                                       name="price_value[{{$j}}]"
                                                                                       placeholder="Price *"
                                                                                       data-status="filter_{{$i.$j}}"
                                                                                       value="{{$res?$res->price:''}}"
                                                                                        {{$res?'':'disabled'}}>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                    </div>
                                                                </div>
                                                                @php($j++)
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                                @php($i++)
                                                <input type="hidden" name="filter_name[]" value="{{$filter->id}}">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        {{--=======================================  Desctiption  =======================================--}}

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h3>Description</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-center">
                                    <label for="hy_description">Նկարագրություն</label>
                                    <textarea name="hy_description1" rows="10" cols="80">
                                        {{$product->translate('hy')->description}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-center">
                                    <label for="en_description">Description</label>
                                    <textarea name="en_description1" rows="10" cols="80">
                                        {{$product->translate('en')->description}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-center">
                                    <label for="ru_description">Описание</label>
                                    <textarea name="ru_description1" rows="10" cols="80">
                                       {{$product->translate('ru')->description}}
                                    </textarea>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                </button>
                            </div>
                        </div>

                        <div class="imageContainer">

                        </div>

                    </form>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
<script>
    prodImageW = 1000;
    prodImageH = 650;
    $(function () {
        CKEDITOR.replace('hy_description1');
        CKEDITOR.replace('en_description1');
        CKEDITOR.replace('ru_description1');
    });
</script>