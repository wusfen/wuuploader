+function () {
	
	// 构造
	var wuuploader = function (options) {


	};

	// 添加文件
	wuuploader.addFile = function() {
		var fileInput = document.createElement('input');
		fileInput.setAttribute('type', 'file');
		fileInput.setAttribute('id', 'wuuploader1');
		document.body.appendChild(fileInput);

		fileInput.click();

		var file = document.getElementById('wuuploader1').files[0];
		
		return file;
	}

	window.wuuploader = wuuploader;

}();



/*wuuploader({
	el: ,
	url: ,
	onprogress: function(id, a, b){

	}
})*/