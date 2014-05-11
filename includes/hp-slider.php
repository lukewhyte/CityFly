<?php 
$sliderContent = array(
  array(
    'title' => 'Welcome To HowSpot',
    'text' => 'Enjoy the vast database of curated tutorials that can help you find solutions and hacks to common & complex tech problems.',
    'img' => 'assets/welcome_homepage_slider.gif'
  ),
  array(
    'title' => 'Do It Yourself Solutions',
    'text' => 'Empower yourself with knowledge! Learn how to fix common computer & software issues on your own with easy-to-use tools.',
    'img' => 'assets/how-to_sublevel_slider_compsecurity.jpg'
  ),
  array(
    'title' => 'Expert Advice',
    'text' => 'HowSpot’s experts have tested, experimented & simplified the solutions we offer to make sure users get the results they want.',
    'img' => 'assets/how-to_sublevel_slider_officeapps.gif'
  ),
  array(
    'title' => 'Top-Quality Products',
    'text' => 'HowSpot offers a variety of FREE software & apps to help you solve your tech-related problems. View our Products now >',
    'img' => 'assets/how-to_sublevel_slider_software.jpg'
  ),
  array(
    'title' => 'User Guides & Resources',
    'text' => 'HowSpot features a knowledgebase of user guides, glossaries & helpful tips to help you learn more. Visit HowSpot’s Resources >',
    'img' => 'assets/userguides_resources_homepage_slider.jpg'
  ),
  array(
    'title' => 'Join The Discussion',
    'text' => 'We rely on users’ collaboration & feedback to keep our database relevant and useful. Want to add a tutorial, or have a question for us? Contact Us >',
    'img' => 'assets/jointhediscussion_homepage_slider.gif'
  )
);
?>

<div class="slideWrap">
  <?php 
  $i = 0;
  foreach ($sliderContent as $slide) { ?>
    <div class="slide <?php if($i>0)echo'hide';?>">
      <div class="slider-content">
        <h4><?= $slide['title']; ?></h4><?= $slide['text']; ?>
      </div>
      <img src="<?= $slide['img'] ?>" />
    </div>
  <?php 
  $i++;
  } ?>
</div>