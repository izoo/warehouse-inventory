<div class="products--section">
    <div class="container">
    <div class="section--title">
        @if(count($products)>0)
            <h2 class="h2">Similar Mobile Phone Spares</h2>
        @endif
            
          </div>
        <div class="row AdjustRow">

            @foreach($products as $prod)

            <div class="col-md-3 col-lg-3 col-xs-3 col-xxs-3">
                <div class="product--item" style="min-height:300px;max-height:300px;">
                    <div class="product--item-img" style="max-height:250px;max-height:250px;">
                        @if (count($prod->images)>0)
                        <img src="{{ asset('uploads/thumbnail/products/'.$prod->images[0]->image_name.'.webp') }}"
                            alt="{{$prod->product_name}}" data-rjs="2">
                        @else
                        <img src="{{ asset('frontend/img/shop-img/index.webp') }}" alt="{{$prod->product_name}}"
                            data-rjs="2">
                        @endif
                        <div class="product--item-img-info bg--overlay">
                            <div class="vc--parent">
                                <div class="vc--child">
                                    <div class="btn-groups">
                                    @if (count($prod->images)>0)
                                        <input type="hidden"
                                            value="{{'uploads/thumbnail/products/'.$prod->images[0]->image_name.'.webp'}}"
                                            class="cart_path">
                                             @else
                                              <input type="hidden"
                                            value="{{'frontend/img/shop-img/index.webp'}}"
                                            class="cart_path">
                                               @endif
                                        <input type="hidden" value="{{$prod->selling_cost}}" class="cart_price">
                                        <input type="hidden" value="{{$prod->product_name}}" class="cart_name">
                                       
                                        <a href="{{route('shop.show',$prod->slug)}}" class="btn btn-default"
                                            title="View Details" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>{{$prod->product_name}}
                    <div class="product--item-info">
                        <h2 class="h5"><a href="shop-details.html"></a></h2>
                        <div class="clearfix">
                            <div class="rating">
                                <ul class="nav">
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                            </div>
                            <div class="price">
                                <p>Kshs {{$prod->selling_cost}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
      
    </div>
</div>