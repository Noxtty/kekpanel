<?php 
ob_start();
	include 'core/init.php';
	protected_page();
	admin_protect();
	include 'includes/overall/header.php';
	include_once('includes/widgets/article.php');

	$article = new Article;


if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$data = $article->fetch_data($id);


	?>

		<h4>
			<?php echo $data['article_title']; ?>
		</h4>

	<?php
} else {
	header('Location:panel.php');
	exit();
}

	include 'includes/overall/footer.php';
?>