<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>商品情報編集画面</title>
        <link rel="stylesheet" href="{{ asset('/css/products_update.css') }}">
	</head>
	<body>
        <h1>商品情報編集画面</h1>
        <form href="{{route('products_update',['id'=>$product->id])}}" method="POST">
            @csrf
            <div class="form">
                <div>
                    <label for="text1">ID</label>
                    <td>{{$product->id}}.</td>
                </div>
                <div>
                    <label for="text3">商品名</label>
                    <input type="text" name="product_name" value="{{$product->product_name}}">                
                </div>
                <div>
                    <label for="text4">メーカー</label>
                    <input type="text" name="company_name" value="{{$product->company->company_name}}">               
                </div>
                <div>
                    <label for="text5">価格</label>
                    <input type="number" name="price" value="{{$product->price}}">                
                </div>
                <div>
                    <label for="text6">在庫数</label>
                    <input type="number" name="stock" value="{{$product->stock}}">                
                </div>
                <div>
                    <label for="text7">コメント</label>
                    <textarea type="text" value="{{$product->comment}}">{{$product->comment}}</textarea>
                </div>
                <div>
                    <label for="text2">商品画像</label>
                    <input type="file" name="img_path" value="{{$product->img_path}}">                
                </div>
                <div class="container">
                    <div class="button1">
                        <input id="update" type="submit" value="更新">
                    </div>
                    <div class="button2">
                        <a href="{{route('products_list')}}">
                            <input id="re" type="button" value="戻る">
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>