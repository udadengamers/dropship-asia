<x-seller.auth-layout>
    {{-- title --}}
    @section('title', 'Home')

    {{-- header serach --}}
    @if (request()->get('search'))
        @include('seller.page.search', [
            'keyword' => request()->search,
            'data' => $products,
        ])
    @endif

    {{-- body --}}
    @if ($products->count() > 0)
        <div class="row g-3" id="itemLoad">
            @include('seller.item')
        </div>
    @else
        @include('seller.page.no_result')
    @endif

    <div class="ajax-load mt-3 p-3" style="display:none; text-align:center;">
        <p>
            <img class="img-fluid" src="/img/spin.gif" width="50">
        </p>
    </div>
        
    @push('after-scripts')
        <script>
            $(document).ready(function(){
                chage_class(innerWidth);
            });
            $(window).resize((event) => {
                chage_class(innerWidth);
            });

            function chage_class(innerWidth) {
                if (innerWidth <= 335) {
                    $('.mobile-col').attr('class', function(index, attr) {
                        //Return the updated string, being sure to only replace z- at the start of a class name.
                        return attr.replace(/(^|\s)col-6/g, 'col');
                    });
                }
            }
        </script>
    @endpush
</x-seller.auth-layout>
