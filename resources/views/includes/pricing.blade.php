@if($prod->price)
    @php
        $plusMinus = $prod->filters->where('plusMinus', '-')->max('price');
    @endphp
    @if($plusMinus)
        @php
            $plusMinus = $prod->price - $plusMinus;
        @endphp
        @if($prod->sale)
            <del class="regular">{{$plusMinus}} AMD</del>
            @if($prod->sale >= 100 )
                <small class="regular">{{$prod->sale}} AMD</small>
            @else
                @php
                    $sale = $plusMinus / 100;
                    $sale = $sale * $prod->sale;
                    $sale = $plusMinus - $sale;
                @endphp
                <small class="regular">{{$sale}} AMD</small>
            @endif
        @else
            <small class="regular">{{$plusMinus}} AMD</small>
        @endif
    @else
        @if($prod->sale)

            <del class="regular">{{$prod->price}} AMD</del>

            @if($prod->sale >= 100 )

                <small class="regular">{{$prod->sale}} AMD</small>

            @else

                @php
                    $sale = $prod->price / 100;
                    $sale = $sale * $prod->sale;
                    $sale = $prod->price - $sale;
                @endphp

                <small class="regular">{{$sale}} AMD</small>
            @endif
        @else
            <small class="regular">{{$prod->price}} AMD</small>
        @endif
    @endif
@endif
