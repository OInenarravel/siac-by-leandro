<?php
	require_once("../models/Sessao.php");
	
	$oSessao = new Sessao();
	
	if(!$oSessao->estaLogado()){	
		$oSessao->efetuarLogout();
		header("Location: ../models/AreaRestrita.php");
		exit();
	}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt" dir="ltr">
	<head>
		
		<title>..:::.. F&Oacute;RUM CEET VASCO COUTINHO - FAQ ..:::..</title>
		<link rel='stylesheet' href='../css/estilo_forum.css' type='text/css' media='screen' />
		<link rel="stylesheet" href="../css/menu_style.css" type="text/css" />
		<script type='text/javascript' src='../js/forum.js'></script>
	</head>
	<body>
		<div id='container'>
		
			<div id='cabecalho'>
			
				<div id='banner_superior'>
					<div id='banner_superior_figura'>
						<img src='../img/banner_texto_forum.png'/>
					</div>
				</div>
				
				<div id='menu_superior'>
					<ul>
						<li><a href="index.php" >HOME</a></li>
						<li><a href="faq.php" >FAQ</a></li>
						<?if(($_SESSION["nivelAcesso"] != "aluno") && ($_SESSION["nivelAcesso"] != "professor" && $_SESSION["nivelAcesso"] != "usuario")){?>
						<li><a href="membros.php">LISTA DE MEMBROS</a></li>
						<li>
							<a href="#">&Aacute;REA ADMINISTRATIVA</a>
							<ul>
								<li><a href="administrativoCategoria.php">CATEGORIA</a></li>
								<li><a href="administrativoSubCategoria.php">SUBCATEGORIA</a></li>
								<li><a href="administrativoModerador.php">MODERADOR</a></li>
								<li><a href="administrativoUsuario.php">USU�RIO</a></li>
							</ul>
						</li>
						<?}?>
						<li><a href='../portal/index.php'>SAIR</a></li>
					</ul>
				</div>
				
			</div>
			
			<div id='conteudo'>
				<h3>Aqui voc� encontra respostas para as perguntas sobre como o f�rum trabalha.</h3>
				<b>Forums, Threads and Posts</b><br/>

				<br/><i>What is a bulletin board?</i><br/><br/>

				A bulletin board is an online discussion site. It's sometimes also called a 'board' or 'forums'. It may contain several categories, consisting of forums, threads and individual posts.

				<br/><br/><i>How is all this structured?</i><br/><br/>

				The bulletin board as a whole contains various categories (broad subject areas), which themselves contain forums (more specific subject areas) which contain threads (conversations on a topic) which are made up of individual posts (where a user writes something).

				The board home page has a list of categories and forums, with basic statistics for each - including the number of threads and posts, and which member posted the most recent message.

				<br/><br/><i>How do I find my way around?</i><br/><br/>

				When you click on a forum's name, you are taken to the list of threads it contains. A thread is a conversation between members or guests. Each thread starts out as a single post and grows as more individual posts are added by different users. Threads can be rated (?) to show how useful or popular they are and may contain polls (?).

				To start a new thread simply click on the 'new thread' button Post New Thread (you may need the right permissions to do this).

				Threads can be ordered in many different ways. The default is to have the thread with the most recent activity at the top. But you can easily change this ordering, for example to have the thread with the most posts at the top, or the highest rating. Simply click on the appropriate column heading at the top of the list of threads (Thread, Thread Starter, Rating, Last Post, Replies or Views). You can also reverse the sorting order by clicking the arrow next to the name of the active option. (Note that 'sticky' threads will always be at the top no matter how you change the viewing options).

				Multi-page views

				When there are more threads to display than will fit on a single page, you may see the 'Page' box, which contains page numbers. This indicates that the list of threads has been split over two or more pages.

				This method of splitting lists of items over many pages is used throughout the board.

				<br/><br/><i>What are sticky threads?</i><br/><br/>

				'Sticky' threads are created by moderators or administrators (?), and remain 'stuck' to the top of the listing, even if they haven't had any posts recently. Their purpose is to keep important information visible and accessible at all times.

				<br/><br/><i>How do I read a thread?</i><br/><br/>

				To read a thread, click on its title. Each post in a thread is created by a member or a guest. You'll see some brief information about the member who created the thread above the main post message. In some cases it will be to the side of the post.

				To post a reply to an existing thread, click on the 'Post Reply' Reply to Thread button. If the 'Post Reply' button does not appear, it could mean that you are not logged in as a member, or that you do not have permission to reply, or that the thread has been closed to new replies.

				If enabled, there will also be a 'Quick Reply' box where you can quickly enter a reply without having to go to the 'Post Reply' page. You may need to click the quick reply button Quick Reply to this Message in a post to activate the quick reply box before you can type into it.

				On long threads you may want to change how the posts are ordered. For more on different ways to view and navigate threads, click (?).

				<br/><br/><i>Is there a faster way to get to forums?</i><br/><br/>

				If you know which forum you want to go to, you can use the 'Forum Jump' control, which appears at the bottom of many pages within the board.

				<br/><br/><i>How do I find out more about members?</i><br/><br/>

				To view information about a particular member, click on the user name. This will take you to their public profile page (?).

				<br/><br/><i>What is the Navigation Bar?</i><br/><br/>

				The navigation bar at the top of every page has links to help you move around. A 'breadcrumb' area at the top left shows where you are now. A form on the right allows you to quickly login. With one click you can reach areas such as: the User Control Panel (?), FAQ (which you are reading now), the Calendar (?), Search options (?) and Quick Links (?) to other useful features.

				<br/><br/><i>What is the 'What's Going On?' box on the board home page?</i><br/><br/>

				On the board home page you'll see a section at the bottom that tells you what's going on at the moment. It tells you things like the number of registered users online, the number of guests, and even things like birthdays, and forthcoming events.

				<br/><br/><i>Can I change the way the board looks?</i><br/><br/>

				You may be able to change the styling of the board by using the style changer in the bottom left of the page. This lets you choose different skins which change the color scheme and appearance of the board. If this option does not appear, the board cannot be restyled.

				<br/><br/><b>Registration</b><br/><br/>

				The administrator will probably require you to register in order to use all the features of the forum. Being registered gives you an identity on the board, a fixed username on all messages you post and an online public profile.

				Registration is free (unless otherwise specified), and offers an extended range of features, including:
				<ul>
					<li>Posting new threads</li>
					<li>Replying to other peoples' threads</li>
					<li>Editing your posts</li>
					<li>Receiving email notification of replies to posts and threads you specify</li>
					<li>Sending private messages to other members</li>
					<li>Creating albums of pictures and comment on others' pictures</li>
					<li>Adding events to the forum calendar</li>
					<li>Setting up a 'contact list' to quickly see which of your friends are online.</li>
				</ul>
				<i>How do I register?</i><br/><br/>

				You register by clicking on the 'Register' link near the top of the page. You will be asked to choose a user name, password and enter a valid email address. In addition there will be some other fields to which you will be invited to respond. Some will be mandatory while others are optional. Once this is complete you will either be fully registered, or in some cases you may have to click on a link in an 'activation email' sent to your email address. Once you have done this you will be registered.

				Note that entering your email address will not leave you open to 'spam', as you can choose to hide it from other board users. You'll probably be able to allow other registered users to contact you via email, but the system won't display your email address to them unless you give permission.

				If you are under the age of 13, the administrator may require that a parent or guardian provide consent before allowing you to complete the registration process. More information about this is available during the registration process.

				<br/><br/><b>Searching Forums and Threads</b><br/>

				<br/><i>How do I search for something?</i><br/><br/>

				To quickly find a thread or post of interest anywhere on the bulletin board, click on the 'Search' link in the navigation bar at the top of most forum pages. Then, type in the keyword or phrase you wish to search for, and select either 'Show Threads' or 'Show Posts' to view the results. By selecting posts, you will be shown only the actual post in which the search word appears.

				For more control over the search, select 'Advanced Search' from the drop-down box. The advanced search page allows you to restrict your search to individual forums, find posts or threads by user, or return results based on tags (?). There are also options to find posts from a certain date, or threads with a certain number of replies.

				How do I search a specific forum or thread?

				If you are browsing a forum, you can quickly search for a thread or post within it by clicking on the 'Search this forum' link near the top of the page (it's above the list of threads). You can also search for individual posts within a thread by clicking on the 'Search this Thread' link at the top of any thread view page.

				<br/><br/><b>Announcements</b><br/><br/>

				<i>What are announcements?</i><br/><br/>

				Announcements are special messages posted by the administrator or moderators. They are a simple one-way communication with the users and you can't reply. If you wish to discuss announcements, you will have to create a new thread in the forum.

				Announcement threads are displayed at the top of forum listing pages, above regular and sticky threads.

				<br/><br/><b>Thread Display Options</b><br/><br/>

				<i>Can I change the order of posts?</i><br/><br/>

				You have a choice over how you view threads. When you're in a thread, look at the top bar. On the right hand side you'll see 'Display Mode'. Click on this and it lets you change how posts are ordered.

				You have three choices:

				Linear Mode - posts are displayed chronologically, usually from oldest to newest. Posts are shown in a flat mode so that many posts can be viewed simultaneously. It is possible to change the ordering by changing your preferences in the User CP

				Threaded Mode - a tree is shown along with every post. This shows you the relationship each post has to the others. It's easy to see who responded to whom. Only one post is shown at a time. By clicking on a single post in the post tree, the page will show that post and all posts made in response to it.

				Hybrid Mode - This is a mixture of the linear and threaded modes. The post tree is displayed as in the threaded mode, but many posts are shown at the same time as in the linear modes.

				<br/><br/><b>Viewing New Posts or Today's Posts</b><br/><br/>

				<i>How can I see the latest posts?</i><br/><br/>

				There are two ways to quickly view recently created or updated threads.

				If you are not logged in, the 'today's posts' link will show a list of all threads that have been created or updated in the last 24 hours.

				If you are logged in, the 'Today's Posts' link will change to 'New Posts', which gives you a listing of all threads that have been created or updated since your last visit.

				The administrator can also set up the forums so that each thread you read is marked in the database. If this option is set, then new threads (or threads with new posts) will not be marked as read until you have actually read them.

				There is a built-in time limit to this, however, that will automatically mark all threads as 'read' after a set number of day, whether you really have read them or not. The default setting is 10 days, but the administrator could make this higher or lower.

				<br/><br/><b>Rating Threads</b><br/><br/>

				<i>What are ratings?</i><br/><br/>

				The forums allow you to rate threads between 1 star (terrible) and 5 stars (excellent). Once enough votes are cast for a thread, stars will appear next to its name in the listings. These show the average vote, and can be an easy way to see which threads are worth reading if you are on a busy forum.

				On the forum viewing page you can also arrange threads by rating, with either the highest or lowest at the top.

				It therefore makes sense to rate threads because it helps all users. To do this, click on the 'rate thread' link at the top of the thread viewing page. Choose the number of stars you feel best represents the quality of the thread. You may or may not be able to change your choice of rating at a later date.

				<br/><br/><b>Thread Tools</b><br/><br/>

				<i>What are thread tools?</i><br/><br/>

				At the top of each thread, there is a link called 'Thread Tools'. By clicking on this link, a menu will appear with a number of options:
				<ul>
					<li>Show Printable Version - this will show you a page with the thread post content in a reduced graphics format that is more 'printer friendly'.</li>
					<li>Email this Page - if you think the thread may be interesting to someone else, you can forward a link to it to their email address.</li>
					<li>Subscribe (or Unsubscribe) from this Thread - by subscribing to a thread, you will receive periodic email updates on recent activity within it. Click here for more information on subscriptions.</li>
					<li>Adding a Poll - if you started the thread, you can add a poll to it with this option. Click here for more information on polls.</li>
				</ul>

				<b>Tags</b><br/>

				<br/><i>What are tags?</i><br/><br/>

				Tags are a useful way to search for threads with similar subject matter and content. This complements the normal search system, which searches only for certain words or phrases and/or posts by specific users.

				To use tags, you add words or phrases to threads to help describe the content. For instance, if the subject matter is 'photography' then you can add the tag 'photography' to the tag list. But you could also add tags like 'digital image', and 'camera' (depending, of course, on the nature of the thread).

				This will categorize this thread with all other threads that have matching tags, whether or not they have the word 'photography' in them.

				<br/><br/><i>Who adds the tags?</i><br/><br/>

				Tags are initially added to threads by the user who started the thread. Other users may also be able to add and remove tags.

				<br/><br/><i>How do I use tags?</i><br/><br/>

				Tags are displayed in a box near the bottom of a thread page. Clicking on a tag will allow you to view other threads that have the same tag - and which may be related. Clicking on the word 'Tags' in the top of the box will take you to an overview page with a 'tag cloud.'

				This cloud allows you to see which tags are the most popular - the larger the word, the more times it has been used on threads within the board. There is also another tag cloud on the advanced search page that shows you the tags that have been searched for (or clicked on) the most.

				<br/><br/><b>Cookies</b><br/><br/>

				<i>What is 'Automatic Login'?</i><br/><br/>

				When you register (and also when you login using the form at the top of the screen), you will be given the option to 'Remember Me'. This will store your identity securely in a cookie on your computer. If you are using a shared computer, such as in a library, school or internet cafe, or if you have reason to not trust any other users that might use this computer, we recommend you do not enable this.

				<br/><br/><i>How do I clear cookies?</i><br/><br/>

				You can clear all your cookies set by the forum by clicking the 'logout' link at the top of the page. In some cases, if you return to the main index page via the link provided and you are still logged in, you may have to remove your cookies manually.
			</div>
			
			<!--<div id='anuncios'>
				Recomendamos<br/>
				<a href=''><image class='imagem_anuncio' src='./Imagens/anuncie_aqui.jpg'></a>
				<a href=''><image class='imagem_anuncio' src='./Imagens/anuncie_aqui.jpg'></a>
				<a href=''><image class='imagem_anuncio' src='./Imagens/anuncie_aqui.jpg'></a>
				<a href=''><image class='imagem_anuncio' src='./Imagens/anuncie_aqui.jpg'></a>
				<a href=''><image class='imagem_anuncio' src='./Imagens/anuncie_aqui.jpg'></a>
				<a href=''><image class='imagem_anuncio' src='./Imagens/anuncie_aqui.jpg'></a>
			</div>-->			
			
			<?php
				require_once("../models/rodape.php");
			?>
			
		</div>
	</body>
</html>