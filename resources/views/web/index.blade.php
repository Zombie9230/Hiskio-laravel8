@extends('layout.app')
@section('content')
<style>
.special-text{
    text-align: center;
    color: red;
}
.table{
    text-align: center;
}
</style>
<div class="row">
    <div class="col-4">
        <h2>商品列表</h2>
    </div>
    <div class="col-8">
        <img src="" alt="">
    </div>
</div>

<table class="table m-auto">
    <thead>
        <tr>
            <td>標題</td>
            <td>內容</td>
            <td>價格</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        @foreach ( $products as $product)
        <tr>
            @if ( $product->id === 1)
                <td class="special-text">{{ $product->title }}</td>
            @else
                <td>{{ $product->title }}</td>
            @endif

            <td>{{ $product->content }}</td>
            <td style="{{ $product->price <= 30 ? 'color:green; font-size:22px; text-align: center;'  : ''  }}">{{ $product->price }}</td>
            <td>
                <input class="check_product btn btn-success" data-id="{{ $product->id }}" type="button" value="確認商品數量">
                <input class='check_shared_url btn btn-warning' type='button' value='分享商品' data-id="{{ $product->id }}">
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    {{-- <div id="app">
        <example-component></example-component>
    </div> --}}
    <script>
        // const app = new Vue({
        //     el: '#app'
        // })

        $('.check_product').on('click',function(){
            $.ajax({
                method: 'POST',
                url: '/products/check-product',
                data: {id: $(this).data('id')}
            })
            .done(function(res){
                if(res){
                    alert('商品數量充足');
                }else{
                    alert('商品數量不足');
                }
            })
        });

        $('.check_shared_url').on('click',function(){
            var id = $(this).data('id');
            $.ajax({
            method: 'GET',
            url: `/products/${id}/shared-url`,
            })
            .done(function(msg) {
                alert('請分享此縮網址:' + msg.url)
            });
        });
        </script>
@endsection
