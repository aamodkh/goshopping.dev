<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Sentiment Analyser</title>
  <meta name="description" content="Sentiment Analyser">
  <meta name="author" content="Aamod">

  <link rel="stylesheet" href="<?php echo CSS_URL;?>style1.css?v=1.0">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>

	<div class='wrapper'>
<form action='sentiment.php' method='POST' name='sent_data_form'>
			<textarea name='sent_data' id='sent_data'><?php if (isset($_POST['sent_data'])) { echo $_POST['sent_data']; } ?></textarea>
			<input type='submit' name='submit_data' value='Analyse' />
		</form>
	</div>

	</body>
</html>