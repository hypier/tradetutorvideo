<?php ob_start(); ?>
<?php include_once('includes/header.php'); ?>

<?php
	
	if (isset($_GET['id'])) {
		$ID = clean($_GET['id']);
	} else {
		$ID = clean('');
	}

	// get image file from table
	$sql = "SELECT video_type, video_thumbnail, video_url FROM tbl_gallery WHERE id = '$ID'";
	$result = $connect->query($sql);
	$row = $result->fetch_assoc();

	$video_type = $row['video_type'];
	$video_thumbnail = $row['video_thumbnail'];
	$video_url = $row['video_url'];

	// delete data from menu table
	$sql_delete = "DELETE FROM tbl_gallery WHERE id = '$ID'";
	$delete = $connect->query($sql_delete);

	// if delete data success
	if ($delete) {

		if ($video_type == 'Upload') {
			unlink('upload/'.$video_thumbnail);
			unlink('upload/video/'.$video_url);
		} else if ($video_type == 'Url') {
			unlink('upload/'.$video_thumbnail);
		} else if ($video_type == 'youtube') {
			if ($video_thumbnail != '') {
				unlink('upload/'.$video_thumbnail);
			}
		}

		$_SESSION['msg'] = "视频删除成功...";
	    header( "Location: video.php");
	     exit;
	}

?>

<?php include_once('includes/footer.php'); ?>