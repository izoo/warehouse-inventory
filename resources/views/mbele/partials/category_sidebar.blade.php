<div class="widget">
    <h2 class="widget--title h4 bg--overlay">Brands</h2>
    <div class="categories--widget">
        <ul>
            @foreach($brands as $brand)
            <li><a href="{{route('spares-brands',$brand->slug)}}">{{$brand->name}}</a><span>({{ $brand->products_count }})</span></li>
            @endforeach

        </ul>
    </div>
</div>
<div class="widget">
    <h2 class="widget--title h4 bg--overlay">Catagories</h2>
    <div class="categories--widget">
        <ul>
            @foreach($categories as $category)
            <li><a href="{{route('spares-categories',$category->slug)}}">{{$category->name}}</a><span>({{$category->products_count}})</span></li>
            @endforeach
        </ul>
    </div>
</div>