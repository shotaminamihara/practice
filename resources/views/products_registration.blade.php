<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>商品新規登録画面</title>
        <link rel="stylesheet" href="{{ asset('/css/products_registration.css') }}">
	</head>
	<body>
        <h1>商品新規登録画面</h1>
        <form action="{{route('products_registration')}}" method="POST" enctype='multipart/form-data'>
            @csrf
            <div class="form">
                <div>
                    <label for="text1">商品名</label>
                    <input type="text" name="product_name">
                </div>
                <div>
                <label for="text2">メーカー名</label>
                    <select name="company_name">
                        <option value="">メーカー名</option>
                        @foreach($companies as $company)
                            <option value="{{$company->id}}">{{$company->company_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                <label for="text3">価格</label>
                    <input type="number" name="price">
                </div>
                <div>
                <label for="text4">在庫数</label>
                    <input type="number" name="stock">
                </div>
                <div>
                    <label for="text5">コメント</label>
                    <textarea name="comment"></textarea>
                </div>
                <div>
                    <label for="text6">商品画像</label>
                    <input type="file" name="image">
                </div>
                <div class="container">
                    <div class="button1">    
                        <input id="reg" type="submit" value="新規登録">
                    </div>                    
                    <div class="button2">
                        <a href="{{route('products_list')}}">
                            <input id="re" type="button" value="戻る" >
                        </a>
                    </div>  
                </div>
            </div>
        </form>
    </body>
</html>