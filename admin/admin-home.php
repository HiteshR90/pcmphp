<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta description="" />
    <title>Peter Chung | Log In</title>
    <link rel="stylesheet" href="//normalize-css.googlecode.com/svn/trunk/normalize.css">
    <link rel="icon" type="image/x-icon" href="../img/pcm.ico"/>
    <link rel="stylesheet" type="text/css" href="../css/foundation.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
  </head>
  <body class="admin">
    <header>
      <nav class="top-bar" data-topbar role="navigation">
        <ul class="title-area">
          <li class="name">
            <img  src="../img/LogoLg.a.png"></a>
          </li>
           <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
          <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
        </ul>

        <section class="top-bar-section">
          <!-- Right Nav Section -->
          <ul>
            <li><a href="#">about</a></li>
            <li><a href="#">audio</a></li>
            <li><a href="#">lyrics</a></li>
            <li><a href="#">video</a></li>
            <li><a href="#">photos</a></li>
            <li><a href="#">shows</a></li>
            <li><a href="#">Newsletter</a></li>
            <li class="has-dropdown"><a href="#">Settings</a>
              <ul class="dropdown">
                <li><a href="#">Account</a></li>
               <li class="active"><a href="#">Logout</a></li>
              </ul>
            </li>
          </ul>
          <!-- Left Nav Section -->
        </section>
      </nav>
    </header>
    <div class="content">
      <section class="about-tab tabs">  
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h2 class="left">
              Edit About
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <div class="edit-box"> edit about here</div><br>
            <button type="submit" class="send right" value="SUBMIT">Submit</button>
          </div>
        </div>
      </section>
      <section class="audio-tab hide tabs">  
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h2 class="left">
              Edit Audio
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <button class="right send modal"> add +</button>
            <div><table>
              <thead>
                <tr>
                  <th>file</th>
                  <th>Track name</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>file goes here</td>
                  <td>name goes here.</td>
                  <td> <button class="radius delete">x</button></td>
                </tr>

                <tr>
                  <td>file goes here</td>
                  <td>name goes here.</td>
                  <td> <button class="radius delete">X</button></td>
                </tr>

                <tr>
                  <td>file goes here</td>
                  <td>name goes here.</td>
                  <td> <button class="radius delete"> X </button></td>
                </tr>
              </tbody>
            </table></div>
           
          </div>
        </div>
      </section>
 <!--   <section class="hide lyric-tab">  
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h3 class="left">
              Edit lyrics
            </h3>
          </div>
        </div>
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <div class="edit-box"> edit about here</div><br>
            <button class="right radius login">Submit</button>
          </div>
        </div>
     </section> -->
      <section class="video-tab hide tabs">  
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h2 class="left">
              Edit Video
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="large-7 medium-12 small-12 columns">
          <form class=""> 
            <div><input type="text" name="youtube">
            </div>
               <button type="submit" class="send right" value="SUBMIT">Submit</button>
          </form>
          </div>
          <div class="large-5 medium-12 small-12 columns" style="text-align:center;">
            <h2></h2>
          </div>  
         
        </div>
       </section>
      <section class="photo-tab hide tabs">  
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h2 class="left">
              Edit photo
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <button class="right send modal"> add +</button>
            <div>
            <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-5 admin-photos">
              <li><img src="http://placehold.it/350x350"><br><button class="radius delete">delete</button></li>
              <li><img src="http://placehold.it/350x350"><br><button class="radius delete">delete</button></li>
              <li><img src="http://placehold.it/350x350"><br><button class="radius delete">delete</button></li>
              <li><img src="http://placehold.it/350x350"><br><button class="radius delete">delete</button></li>
              <li><img src="http://placehold.it/350x350"><br><button class="radius delete">delete</button></li>
              <li><img src="http://placehold.it/350x350"><br><button class="radius delete">delete</button></li>
              <li><img src="http://placehold.it/350x350"><br><button class="radius delete">delete</button></li>
              <li><img src="http://placehold.it/350x350"><br><button class="radius delete">delete</button></li>
              <li><img src="http://placehold.it/350x350"><br><button class="radius delete">delete</button></li>
              <li><img src="http://placehold.it/350x350"><br><button class="radius delete">delete</button></li>
            <ul>
            <div>  
          </div>
        </div>
      </section>
      <section class="event-tab hide tabs">  
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h3 class="left">
              Edit Shows
            </h3>
          </div>
        </div>
        <div class="row">
          <div class="large-12 medium-12 small-12 columns table">
             <button class="right send modal"> add +</button>
            <table>
              <thead>
                <tr>
                  <th>Date</th>
                  <th>City</th>
                  <th>Venue</th>
                  <th>Description</th>
                  <th>edit</th>
                  <th>delete</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Content Goes Here</td>
                  <td>Content Goes Here</td>
                  <td>Content Goes Here</td>
                  <td>Content Goes Here</td>
                  <td><button class="radius delete modal">+</button></td>
                  <td><button class="radius delete edit">x</button></td>
                </tr>
                <tr>
                  <td>Content Goes Here</td>
                  <td>Content Goes Here</td>
                  <td>Content Goes Here</td>
                  <td>Content Goes Here</td>
                  <td><button class="radius delete  modal">+</button></td>
                  <td><button class="radius delete edit">x</button></td>
                </tr>
                <tr>
                  <td>Content Goes Here</td>
                  <td>Content Goes Here</td>
                  <td>Content Goes Here</td>
                  <td>Content Goes Here</td>
                  <td><button class="radius delete modal">+</button></td>
                  <td><button class="radius delete edit">x</button></td>
                </tr>
              </tbody>
            </table>
             <button class="right send">Submit</button>
          </div>
        </div>
      </section>
      <section class="newsletter-tab hide tabs">  
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h3 class="left">
              Newsletter Subscribers
            </h3>
          </div>
        </div>
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <div class="right"># of subscribers</div>
            <table>
              <thead>
                <tr>
                  <th>name</th>
                  <th>email</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>john doe</td>
                  <td>jon@gmail.com</td>
                </tr>
                <tr>
                  <td>john doe</td>
                  <td>jon@gmail.com</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h3>Send a Newsletter</h3>
          </div>
        </div>
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <div class="edit-box"> edit about here</div><br>
            <button type="submit" class="send right" value="SEND">send</button>
          </div>
        </div>
      </section>
      <section class="settings-tab  tabs">  
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h3>change my password</h3>
            <form class="settings-form">
            <input type="password" palceholder="current password">
            <input type="password" palceholder="new password">
            <input type="password" palceholder="confirm password">
            <button class="right send">update</button>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h3>add a new email</h3>
            <form class="settings-form">
            <input type="text" palceholder="email">
            <button class="right send">update</button>
            </form>
          </div>
        </div>
       </section>
    </div>
    <footer>
   <div class="row">
    <div class="large-6 medium-6 small-6 columns footer-content">
      <p><a href="#" target="_blank">go to my site. </a></p>
    </div>
      <div class="large-6 medium-6 small-6 columns footer-content" style="border-left:1px solid #fff;">
      <p> <a href="#" target="_blank"> Logout.</a></p>
    </div>
    </div>
   </div>
    </footer>
    <!-- modal shells -->
    <div id="audiModal" class="reveal-modal small" data-reveal>
      <h3> add a New Track</h3>
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
          <div><input type="file"></div>
          <div><input type="text" name="song-name" placeholder="track name"></div>
             <button class="right send">Submit</button>
          </div>
      </div>
      <a class="close-reveal-modal">X</a>
    </div>
    <div id="imageModal" class="reveal-modal small" data-reveal>
      <h3> add a image</h3>
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
          <div><input type="file"></div>
            <button class="right send">Submit</button>
        </div>
      </div>
       <a class="close-reveal-modal">X</a>
    </div>
    <div id="eventModal" class="reveal-modal small" data-reveal>
      <h3>add an event</h3>
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
          <ul class="small-block-grid-2 medium-block-grid-2 large-block-grid-3">
            <li><input type="text"></li>
            <li><input type="text"></li>
            <li><input type="text"></li>
            <li><input type="text"></li>
            <li><input type="text"></li>
            <li><input type="text"></li>
            <li><input type="text"></li>
            <li><input type="text"></li>
            <li><select></li>
          <ul>
             <button class="right send">Submit</button>
          </div>
      </div>
      <a class="close-reveal-modal">X</a>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/sticky-footer.js"></script>
    <script src="../js/foundation.js"></script>
    <script src="../js/foundation.topbar.js"></script>
    <script src="../js/foundation.reveal.js"></script>
    <script src="../js/foundation.dropdown.js"></script>
    <script>
    $(document).foundation();
 $( '.modal' ).click(function(){
      $('#audiModal').foundation('reveal', 'open'); 
    });
   

    </script>

  </body>