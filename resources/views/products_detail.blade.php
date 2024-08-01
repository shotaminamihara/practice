<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>商品新規登録画面</title>
        <link rel="stylesheet" href="{{ asset('/css/products_detail.css') }}">
	</head>
	<body>
        <h1>商品情報詳細画面</h1>
        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form">
            <form action="{{route('products_detail',['id'=>$product->id])}}" class="form1"  method="POST" enctype='multipart/form-data'>
                @csrf
                <div>
                    <label for="text1">ID</label>
                    <span>{{$product->id}}.</span>
                </div>
                <div>
                    <label for="text2">商品画像</label>
                    <span><img src="{{asset($product->img_path)}}" class="product_image"></span>
                </div>
                <div>
                    <label for="text3">商品名</label>
                    <span>{{$product->product_name}}</span>                
                </div>
                <div>
                    <label for="text4">メーカー</label>
                    <span>{{$product->company->company_name}}</span>                
                </div>
                <div>
                    <label for="text5">価格</label>
                    <span>￥{{$product->price}}</span>                
                </div>
                <div>
                    <label for="text6">在庫数</label>
                    <span>{{$product->stock}}</span>                
                </div>
                <div>
                    <label for="text7">コメント</label>
                    <span>{{$product->comment}}</tspand>
                </div>
            </form>
            <div class="container">
                <form action="{{route('products_edit',['id' => $product->id])}}" method="POST">
                    @csrf
                    <div class="button1">
                        <input id="reg" type="submit" value="編集">
                    </div>
                </form>
                <a href="{{route('products_list')}}">
                    <input class="re" id="re" type="button" value="戻る">
                </a>
            </div>
        </div>
    </body>
</html>