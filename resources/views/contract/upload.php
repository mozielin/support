
<!DOCTYPE html>
<html>
	<head>
		<title>upload</title>
	</head>
	<body>
		<form class="form-horizontal" method="post" action="{{ route('contract_iconUpload') }}" accept-charset="UTF-8" enctype="multipart/form-data">  
	    <input type="file" class="form-control" id="contract_file" name="contract_file" placeholder="上傳圖片" value="">

	    <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
		</form>  
	</body>
</html>>
	