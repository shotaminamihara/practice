<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>商品一覧画面</title>
        <link rel="stylesheet" href="{{ asset('/css/products_list.css') }}">
    </head>
	<body>
        <h1>商品一覧画面</h1>
        <form action="{{route('products_list')}}" method="POST">
            @csrf
            <input type="text" class="searchbox" id="searchbox" name="searchbox" placeholder="検索キーワード">
            <select id="selectbox" class="selectbox" name="selectbox">
                <option value="">メーカー名</option>
                @foreach($companies as $company)
                 <option value="{{$company->company_name}}">{{$company->company_name}}</option>
                @endforeach
            </select>
            <input class="search" type="submit" value="検索">
        </form>
        <table id="productTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>商品画像</th>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>在庫数</th>
                    <th>メーカー名</th>
                    <th colspan="2">
                        <a href="{{route('products_registration')}}">
                            <input class="registration" id="registration" type="button" value="新規登録">
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}.</td>
                    <td>{{$product->img_path}}</td>
                    <td>{{$product->product_name}}</td>
                    <td>¥{{$product->price}}</td>
                    <td>{{$product->stock}}</td>
                    <td>{{$product->company_name}}</td>
                    <td>
                        <form action="{{route('products_detail',['id'=> $product->id]) }}" method="GET">
                            <input id="detail" class="details" type="submit" value="詳細">
                        </form>
                    </td>
                    <td>
                        <form action="{{route('products_delete',['id' => $product->id])}}" method="POST" >
                            @method('DELETE')
                            @csrf
                            <input class="delete" type="submit" value="削除" >
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <script src="{{ asset('/js/products_list.js') }}"></script>
    </body>
</html>