<?php 
include 'core/init.php';
protected_page();
admin_protect();
include 'includes/overall/header.php';
include_once('includes/widgets/article.php');

$article = new Article;
$articles = $article->fetch_all();

?>

<h1>Admin</h1>

	<ol>
		<?php foreach ($articles as $article) { ?>		
		<li>
			<a href="article.php?id=<?php echo $article['article_id']; ?>">
				<?php echo $article['article_title']; ?>
			</a>

			 -  <small>
			 		<?php echo date('l jS', $article['article_timestamp']); ?>
			 	</small>
			</li>
		<?php } ?>
	</ol>

<?php
include 'includes/overall/footer.php';
?>
