<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>商品新規登録画面</title>
        <link rel="stylesheet" href="{{ asset('/css/products_detail.css') }}">
	</head>
	<body>
        <h1>商品情報詳細画面</h1>
        <div href="{{route('products_detail',['id'=>$product->id])}}">
            @csrf
            <div class="form">
                <div>
                    <label for="text1">ID</label>
                    <td>{{$product->id}}.</td>
                </div>
                <div>
                    <label for="text2">商品画像</label>
                    <td>{{$product->img_path}}</td>                </div>
                <div>
                    <label for="text3">商品名</label>
                    <td>{{$product->product_name}}</td>                </div>
                <div>
                    <label for="text4">メーカー</label>
                    <td>{{$product->company->company_name}}</td>                </div>
                <div>
                    <label for="text5">価格</label>
                    <td>￥{{$product->price}}</td>                </div>
                <div>
                    <label for="text6">在庫数</label>
                    <td>{{$product->stock}}</td>                </div>
                <div>
                    <label for="text7">コメント</label>
                    <textarea>{{$product->comment}}</textarea>
                </div>
                <div class="container">
                    <form action="{{route('products_update',['id' => $product->id])}}" method="GET">
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
        </div>
    </body>
</html>