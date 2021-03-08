<?php
$connection = new PDO('mysql:host=localhost:3305; dbname=practice_db; charset=utf8', 'root', 'root');
$aboutData = $connection->query("SELECT * FROM about");
$aboutData = $aboutData->fetch();
$educationData = $connection->query("select * from education order by id DESC");
$languagesData = $connection->query("select * from languages");
$interestsData = $connection->query("SELECT * from interests");
$aboutCareer = $connection->query("SELECT * from aboutcareer");
$aboutCareer = $aboutCareer->fetch();
$career = $connection->query("SELECT * from career order by id DESC");
$skills = $connection->query("SELECT * FROM skills");
?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="ru"> <!--<![endif]-->
<head>
    <title>Резюме Алексей Константинов</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Резюме Алексей Константинов">
    <link rel="shortcut icon" href="favicon.ico">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,400italic,300italic,300,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">   
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">
    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head> 

<body>
    <div class="wrapper">
        <div class="sidebar-wrapper">
            <div class="profile-container">
                <img class="profile" src="assets/images/profile.png" alt="" />
                <h1 class="name"><?= $aboutData['name'] ?></h1>
                <h3 class="tagline"><?= $aboutData['post'] ?></h3>
            </div><!--//profile-container-->
            
            <div class="contact-container container-block">
                <ul class="list-unstyled contact-list">
                    <li class="email"><i class="fa fa-envelope"></i><a href="mailto: <?=$aboutData['email'] ?>"><?= $aboutData['email'] ?></a></li>
                    <li class="phone"><i class="fa fa-phone"></i><a href="<?= $aboutData['phone'] ?>"><?= $aboutData['phone'] ?></a></li>
                    <li class="website"><i class="fa fa-globe"></i><a href="https://<?= $aboutData['site'] ?>" target="_blank"><?= $aboutData['site'] ?></a></li>
                    <li class="github"><i class="fa fa-github"></i><a href="https://<?= $aboutData['github'] ?>" target="_blank"><?= $aboutData['github'] ?></a></li>
                </ul>
            </div><!--//contact-container-->
            <div class="education-container container-block">
                <h2 class="container-block-title">Образование</h2>
                <? foreach ($educationData as $education) {?>
                <div class="item">
                    <h4 class="degree"><?=$education['faculty']?></h4>
                    <h5 class="meta"><?=$education['university']?></h5>
                    <div class="time"><?=$education['yearEnd']?></div>
                </div><!--//item-->
                <? } ?>
            </div><!--//education-container-->
            
            <div class="languages-container container-block">
                <h2 class="container-block-title">Языки</h2>
                <ul class="list-unstyled interests-list">
                    <? foreach ($languagesData as $lang) {?>
                    <li><?=$lang['title']?><span class="lang-desc"></span></li>
                    <? } ?>
                </ul>
            </div><!--//interests-->
            
            <div class="interests-container container-block">
                <h2 class="container-block-title">Интересы</h2>
                <ul class="list-unstyled interests-list">
                    <? foreach ($interestsData as $inter) {?>
                    <li><?=$inter['title']?></li>
                    <? } ?>
                </ul>
            </div><!--//interests-->
            
        </div><!--//sidebar-wrapper-->
        
        <div class="main-wrapper">
            
<!--            <section class="section summary-section">-->
<!--                <h2 class="section-title"><i class="fa fa-user"></i>О карьере</h2>-->
<!--                <div class="summary">-->
<!--                    <p>--><?//=$aboutCareer['title']?><!--</p>-->
<!--                </div>-->
<!--            </section>-->
            
            <section class="section experiences-section">
                <h2 class="section-title"><i class="fa fa-briefcase"></i>Опыт работы</h2>

                <? foreach ($career as $carer) {?>
                <div class="item">
                    <div class="meta">
                        <div class="upper-row">
                            <h3 class="job-title"><?=$carer['nameOrganization']?></h3>
                        </div><!--//upper-row-->
                        <div class="time"><?=$carer['yearStart']?><br><?=$carer['yearEnd']?></div>
                        <div class="company"><?=$carer['place']?></div>
                    </div><!--//meta-->
                    <div class="details">
                        <h4><?=$carer['post']?></h4>
                        <p><?=$carer['duty']?></p>
                    </div><!--//details-->
                </div><!--//item-->
                <? } ?>
            </section><!--//section-->
            
<!--            <section class="section projects-section">-->
<!--                <h2 class="section-title"><i class="fa fa-archive"></i>Проекты</h2>-->
<!--                <div class="intro">-->
<!--                    <p>You can list your side projects or open source libraries in this section. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et ligula in nunc bibendum fringilla a eu lectus.</p>-->
<!--                </div>
<!--                <div class="item">-->
<!--                    <span class="project-title"><a href="#hook">Velocity</a></span> - <span class="project-tagline">A responsive website template designed to help startups promote, market and sell their products.</span>-->
<!--                    -->
<!--                </div>
<!--                <div class="item">-->
<!--                    <span class="project-title"><a href="http://themes.3rdwavemedia.com/website-templates/responsive-bootstrap-theme-web-development-agencies-devstudio/" target="_blank">DevStudio</a></span> - -->
<!--                    <span class="project-tagline">A responsive website template designed to help web developers/designers market their services. </span>-->
<!--                </div>
<!--                <div class="item">-->
<!--                    <span class="project-title"><a href="http://themes.3rdwavemedia.com/website-templates/responsive-bootstrap-theme-for-startups-tempo/" target="_blank">Tempo</a></span> - <span class="project-tagline">A responsive website template designed to help startups promote their products or services and to attract users &amp; investors</span>-->
<!--                </div>
<!--                <div class="item">-->
<!--                    <span class="project-title"><a href="hhttp://themes.3rdwavemedia.com/website-templates/responsive-bootstrap-theme-mobile-apps-atom/" target="_blank">Atom</a></span> - <span class="project-tagline">A comprehensive website template solution for startups/developers to market their mobile apps. </span>-->
<!--                </div>
<!--                <div class="item">-->
<!--                    <span class="project-title"><a href="http://themes.3rdwavemedia.com/website-templates/responsive-bootstrap-theme-for-mobile-apps-delta/" target="_blank">Delta</a></span> - <span class="project-tagline">A responsive Bootstrap one page theme designed to help app developers promote their mobile apps</span>-->
<!--                </div>
<!--            </section>-->
            
            <section class="skills-section section">
                <h2 class="section-title"><i class="fa fa-rocket"></i>Ключевые навыки</h2>
                <div class="skillset">
                    <? foreach ($skills as $skill) {?>
                    <div class="item">
                        <h3 class="level-title"><?=$skill['title_skils']?></h3>
                        <div class="level-bar">
                            <div class="level-bar-inner" data-level="<?=$skill['proccent']?>%">
                            </div>
                        </div><!--//level-bar-->
                    </div><!--//item-->
                    <? } ?>
                </div>
            </section><!--//skills-section-->

            <section>
                <h2 class="section-title"><i class="fa fa-rocket"></i>Отзывы</h2>
                <form action="" method="POST">
                    <input type="text" name="comment" required>
                    <input type="submit">
                </form>

                <?
                if ($_POST['comment']) {
                    echo $_POST['comment'];
                    $newComment = $_POST['comment'];


                                    }

                $allComments = $connection->query("SELECT * FROM comments ORDER BY id DESC");
                foreach ($allComments as $comment){
                    echo "<div>" . $comment['comment'] . "  " . $comment['data'] . "</div>";
                }
                ?>
            </section>


        </div><!--//main-body-->
    </div>
 
    <footer class="footer">
        <div class="text-center">
                <!--/* This template is released under the Creative Commons Attribution 3.0 License. Please keep the attribution link below when using for your own project. Thank you for your support. :) If you'd like to use the template without the attribution, you can check out other license options via our website: themes.3rdwavemedia.com *
                <small class="copyright">Designed with <i class="fa fa-heart"></i> by <a href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>/-->
        </div><!--//container-->
    </footer><!--//footer-->
 
    <!-- Javascript 41--> 011
    <script type="text/javascript" src="assets/plugins/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>    
    <!-- custom js -->
    <script type="text/javascript" src="assets/js/main.js"></script>            
</body>
</html> 

