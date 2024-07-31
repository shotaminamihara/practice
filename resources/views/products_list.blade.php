<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>商品一覧画面</title>
        <link rel="stylesheet" href="{{ asset('/css/products_list.css') }}">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>
        <script src="{{ asset('/js/products_list.js') }}"></script>
    </head>
	<body>
        <h1>商品一覧画面</h1>
        <form id="search_form" action="{{route('products_list')}}" method="POST" enctype='multipart/form-data'>
            @csrf
            <input type="text" class="searchbox" id="searchbox" name="searchbox" placeholder="検索キーワード">
            <select id="selectbox" class="selectbox" name="selectbox">
                <option value="">メーカー名</option>
                @foreach($companies as $company)
                 <option value="{{$company->company_name}}">{{$company->company_name}}</option>
                @endforeach
            </select>
            <input class="search" type="submit" value="検索">

            <input type="number" class="range_search" id="priceMin" name="priceMin" placeholder="価格(下限)">
            <label>〜</label>
            <input type="number" id="priceMax" class="range_search" name="priceMax" placeholder="価格(上限)">
            <input type="number" id="stockMin" class="range_search" name="stockMin" placeholder="在庫数(下限)">
            <label>〜</label>
            <input type="number" id="stockMax" class="range_search" name="stockMax" placeholder="在庫数(上限)">
        </form>
        <table id="productTable">
            <thead>
                <tr>
                    <th class="sortable">ID</th>
                    <th>商品画像</th>
                    <th class="sortable">商品名</th>
                    <th class="sortable">価格</th>
                    <th class="sortable">在庫数</th>
                    <th class="sortable">メーカー名</th>
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
                    <td><img src="{{asset($product->img_path)}}" class="product_image"></td>
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
    </body>
</html>