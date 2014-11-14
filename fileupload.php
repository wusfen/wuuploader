<?php 
if ($_FILES){
	var_dump($_FILES);
	foreach ($_FILES as $key => $value) {
		if (is_uploaded_file($value['tmp_name'])){

			move_uploaded_file($value['tmp_name'], "./test/".$value['name']);
		}
	}

	echo '{"success": true}';
	return;
}

?>

<html>
<meta charset="utf-8">
<body>

<script type="text/javascript">
	function fileSelected() {
            var file = document.getElementById('fileToUpload').files[0];
            if (file) {
                var fileSize = 0;
                if (file.size > 1024 * 1024)
                    fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
                else
                    fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
 
                document.getElementById('fileName').innerHTML = 'Name: ' + file.name;
                document.getElementById('fileSize').innerHTML = 'Size: ' + fileSize;
                document.getElementById('fileType').innerHTML = 'Type: ' + file.type;
            }
        }
 
        function uploadFile() {
            var fd = new FormData();
            fd.append("fileToUpload", document.getElementById('fileToUpload').files[0]);
            var xhr = new XMLHttpRequest();
            xhr.upload.addEventListener("progress", uploadProgress, false);
            xhr.addEventListener("load", uploadComplete, false);
            xhr.addEventListener("error", uploadFailed, false);
            xhr.addEventListener("abort", uploadCanceled, false);
            xhr.open("POST", "Home/Upload");
            xhr.send(fd);
        }
 
        function uploadProgress(evt) {
            if (evt.lengthComputable) {
                var percentComplete = Math.round(evt.loaded * 100 / evt.total);
                document.getElementById('progressNumber').innerHTML = percentComplete.toString() + '%';
            }
            else {
                document.getElementById('progressNumber').innerHTML = 'unable to compute';
            }
        }
 
        function uploadComplete(evt) {
            /* This event is raised when the server send back a response */
            alert(evt.target.responseText);
        }
 
        function uploadFailed(evt) {
            alert("There was an error attempting to upload the file.");
        }
 
        function uploadCanceled(evt) {
            alert("The upload has been canceled by the user or the browser dropped the connection.");
        }

</script>

<form action="" enctype="multipart/form-data" method="post">

<input type="file" name="upfile"/>
<input type="submit" value="上传"/>

</form>

<form action="">
<input type="submit" value="下载" name="down">

        <div class="row">
            <label for="file">
                Upload Image:</label>
            <input type="file" name="fileToUpload" id="fileToUpload"  multiple="multiple" onchange="fileSelected();" />
        </div>
        
        <div id="fileName">
        </div>
        <div id="fileSize">
        </div>
        <div id="fileType">
        </div> 
        <div class="row">
            <input type="button" onclick="uploadFile()" value="Upload Image" />
        </div>
        <div id="progressNumber">
        </div>

</form>
<?php 
if (isset($_GET['down'])) {
	header('location:文件下载.php');
}
?>

</body>
</html>
