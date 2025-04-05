
    @foreach($productlist as $product)
    <tr>
        <td>{{$product->prod_id}}</td>
        <td><a href="{{asset('admin/product/edit/'.$product->prod_id)}}">{{$product->prod_name}}</a></td>
        <td>{{number_format($product->prod_price,0,',','.')}} VND </td>
        <td>
            <img width="150px" src="{{asset('storage/avatar/'.$product->prod_img)}}" alt="">
        </td>
        <td>{{$product->cate_name}}</td>
        <td>{{$product->brand_name}}</td>
        <td>
            <a href="{{asset('admin/product/delete/'.$product->prod_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xoá ?')" class="btn btn-danger">
                <span class="glyphicon glyphicon-trash"></span> Xoá </a>
        </td>
    </tr>
    @endforeach
