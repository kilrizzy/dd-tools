<h1>A new user has registered on BizLender:</h1>
<table>
	@foreach($fields as $k=>$v)
	<tr>
		<td><strong>{{$k}}</strong></td>
		<td>{{$v}}</td>
	</tr>
	@endforeach
</table>