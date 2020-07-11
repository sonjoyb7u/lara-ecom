
<div class="search-result">
    @if($all_search_products->isEmpty())
        <h4 class="text-center" style="color: #FF4B4B; font-weight: bold;">No Product Found!</h4>
    @else
    <ul>
        @foreach($all_search_products as $all_search_product)
        <li>
            <a href="{{ route('site.product-detail', $all_search_product->slug) }}">
                <span>
                    <img width="50" height="40" src="{{ asset('uploads/images/product/images/'.$all_search_product->image) }}" alt="{{ $all_search_product->image }}">
                </span>
                <span>{{ $all_search_product->title }}</span>
                <p>&#2547;{{ $all_search_product->sales_price }}</p>
            </a>
        </li>
        @endforeach
    </ul>
    @endif
</div>





