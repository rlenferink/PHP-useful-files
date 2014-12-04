<?php

$path = "../uploads/file.docx"; //chance this to your file path

//function to get mimeType of file
function getMimeType($filename){
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	$ext = strtolower($ext);

	$mime_types=array(
		'txt' => 'text/plain',
		'htm' => 'text/html',
		'html' => 'text/html',
		'php' => 'text/html',
		'css' => 'text/css',
		'js' => 'application/javascript',
		'json' => 'application/json',
		'xml' => 'application/xml',
		'swf' => 'application/x-shockwave-flash',
		'flv' => 'video/x-flv',

		// images
		'png' => 'image/png',
		'jpe' => 'image/jpeg',
		'jpeg' => 'image/jpeg',
		'jpg' => 'image/jpeg',
		'gif' => 'image/gif',
		'bmp' => 'image/bmp',
		'ico' => 'image/vnd.microsoft.icon',
		'tiff' => 'image/tiff',
		'tif' => 'image/tiff',
		'svg' => 'image/svg+xml',
		'svgz' => 'image/svg+xml',

		// archives
		'zip' => 'application/zip',
		'rar' => 'application/x-rar-compressed',
		'exe' => 'application/x-msdownload',
		'msi' => 'application/x-msdownload',
		'cab' => 'application/vnd.ms-cab-compressed',

		// audio/video
		'mp3' => 'audio/mpeg',
		'qt' => 'video/quicktime',
		'mov' => 'video/quicktime',

		// adobe
		'pdf' => 'application/pdf',
		'psd' => 'image/vnd.adobe.photoshop',
		'ai' => 'application/postscript',
		'eps' => 'application/postscript',
		'ps' => 'application/postscript',

		// ms office
		'doc' => 'application/msword',
		'rtf' => 'application/rtf',
		'xls' => 'application/vnd.ms-excel',
		'ppt' => 'application/vnd.ms-powerpoint',
		"xlsx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
		"pptx" => "application/vnd.openxmlformats-officedocument.presentationml.presentation",
		"docx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",

		// open office
		'odt' => 'application/vnd.oasis.opendocument.text',
		'ods' => 'application/vnd.oasis.opendocument.spreadsheet'
	);

	if(isset($mime_types[$ext])){
		return $mime_types[$ext];
	} else {
		return 'application/octet-stream';
	}
}// end function getMimeType


if (is_file($path)){
	// check file is readable or not exists
	if (!is_readable($path)){
		die('File doesn\'t exist or is not readable!');
	}

	$filename = pathinfo($path, PATHINFO_BASENAME);
	$file_ext = pathinfo($path, PATHINFO_EXTENSION);
	$downloadFileName = $filename . "." . $file_ext;

	// get mime type of file by extension
	$mime_type = getMimeType($filename);

	// set headers
	header('Pragma: public');
	header('Expires: -1');
	header('Cache-Control: public, must-revalidate, post-check=0, pre-check=0');
	header('Content-Transfer-Encoding: binary');
	header("Content-Disposition: attachment; filename=\"$downloadFileName\"");
	header("Content-Length: " . filesize($path));
	header("Content-Type: $mime_type");
	header("Content-Description: File Transfer");

	// read file as chunk
	if ( $fp = fopen($path, 'rb') ) {
		ob_end_clean();

		while( !feof($fp) and (connection_status()==0) ) {
			print(fread($fp, 8192));
			flush();
		}

		@fclose($fp);
		exit;
	}
}else{
	//if file doesn't exist redirect to this location/url
	header('Location: /');
}
?>