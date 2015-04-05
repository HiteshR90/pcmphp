<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta description="mustical talentent by san francisco's peter chung" />
        <title>Peter Chung | Music</title>
        <link rel="icon" type="image/x-icon" href="img/pcm.ico"/>
		<link href="js/jplayer/dist/skin/blue.monday/css/jplayer.blue.monday.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="css/foundation.min.css">
        <link rel="stylesheet" type="text/css" href="css/slick.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="css/normalizer">
        
		<style>
			.button-player{
				padding:0 !important;
			}
		
        #playa{
            text-indent: -9999px;
            float:right;width:auto;margin-top:25.5%;margin-right:15.5%;height:55px;width:38px;

        }
          #playa:hover{
            background-image:url("img/player.png");
            background-repeat: no-repeat;
            background-size: 40px; 
          }
  
        </style>
    </head>
    <body>
	<?php
		include("database.php");
	?>
 
	<div class="main-container">
            <section id="home">
                <div>
                    <div class="row" id="logo-container"> 
                        <div class="large-12 medium-12 small-12 columns">
                            <img src="img/LogoLg.png"/>
                        </div>
                    </div>
                    <div class="row" style="" id="nav-container"> 
                       <ul class="large-block-grid-5 medium-block-grid-5 small-block-grid-5">
                            <li>
                                <a href="#about">
                                <img class="navIconz show-for-medium-up" data-alt-src="img/MenuAbout.1.png" src="img/MenuAbout.png">
                                <img class="navIconz show-for-small-only" data-alt-src="img/MenuAboutSm.1.png" src="img/MenuAboutSm.png">
                                </a>
                            </li>
                            <li>
                                <a href="#lyrics">
                                <img class="navIconz show-for-medium-up" data-alt-src="img/MenuLyrics.1.png" src="img/MenuLyrics.png">
                                <img class="navIconz show-for-small-only" data-alt-src="img/MenuLyricsSm.1.png" src="img/MenuLyricsSm.png">
                                </a>
                            </li>
                            <li>
                                <a href="#videos">
                                <img class="navIconz show-for-medium-up" data-alt-src="img/MenuPhotos.1.png" src="img/MenuPhotos.png">
                                <img class="navIconz show-for-small-only" data-alt-src="img/MenuPhotosSm.1.png" src="img/MenuPhotosSm.png">
                                </a>
                            </li>
                            <li>
                                <a href="#events">
                                <img class="navIconz show-for-medium-up" data-alt-src="img/MenuShows.1.png" src="img/MenuShows.png">
                                <img class="navIconz show-for-small-only" data-alt-src="img/MenuShowsSm.1.png" src="img/MenuShowsSm.png">
                                </a>
                            </li>
                            <li>
                                <a href="#contact">
                                <img class="navIconz show-for-medium-up" data-alt-src="img/MenuContact.1.png" src="img/MenuContact.png">
                                <img class="navIconz show-for-small-only" data-alt-src="img/MenuContactSm.1.png" src="img/MenuContactSm.png">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="row socialmedia-container" > 
                        <div class="large-12 medium-12 small-12 columns">
                            <ul id="social-nav">
                              <li><a href="#contact">newsletter &#124;</a></li>
                              <li><a href="https://www.facebook.com/peterchungmusic" target="_blank">facebook &#124;</a></li>
                              <li><a href="https://itunes.apple.com/us/album/i-write-we-sing/id789865670" target="_blank">itunes |</a></li>
                              <li><a href="https://twitter.com/peterchungmusic" target="_blank">twitter &#124;</a></li>
                              <li><a href="https://instagram.com/peterchungmusic" target="_blank">instagram &#124;</a></li>
                              <li><a href="https://www.youtube.com/channel/UCfHxSn_8YE5lwshPGcNbpYQ" target="_blank">youtube</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <div class="sidescroll hide">
                <a href="#home"><img class="navIconz"  src="img/SideMenuHome.png"></a>
                <a href="#about"><img class="navIconz"  src="img/SideMenuAbout.png"></a>
                <a href="#lyrics"><img class="navIconz"  src="img/SideMenuLyrics.png"></a>
                <a href="#videos"><img class="navIconz"  src="img/SideMenuPhotos.png"></a>
                <a href="#events"><img class="navIconz"  src="img/SideMenuShows.png"></a>
                <a href="#contact"><img class="navIconz"  src="img/SideMenuContact.png"></a>
            </div>
            <section id="about" class="main-sections">
                
                    <div class="row">
                        <div class="large-12 medium-12 small-12 columns title right">
                            <h1>about</h1>
                        </div>        
                
                    <div class="row" > 
                        <div class="large-12 medium-12 small-12 columns content-container">
                            
                            <div class="content">
							<?php
									$sth = $conn->prepare("SELECT content FROM pcm_about");
									$sth->execute();
									$result = $sth->fetchColumn();
									echo $result;
							?>
                          </div> 
                        </div>
                    </div>
                </div>
            </section>   
            <section id="lyrics" class="lyrics-title">
                <div class="row" style="margin:0px;">
                    <div class="large-12 medium-12 small-12 columns left" style="margin:0px;">
                        <h1>lyrics</h1>
                    </div>
                </div>
                <div class="show-for-large-up trackNameBox">
                    <div style="height:650px;">
                        <ul class="songList">
						
								<?php
									$query = $conn->prepare("SELECT id,title FROM pcm_lyrics order by id");
									$query->execute();
									for($i=0; $row = $query->fetch(); $i++){
									echo "<li><a href='#lyric".$row['id']."' >'".$row['title']."'</a></li>";
									}
								?>
					
                  <!--          <li><a href="#lyric1">a song of sadness</a></li>
                            <li><a href="#lyric2">back</a></li>
                            <li><a href="#lyric3">between truth &amp; Lies</a></li>
                            <li><a href="#lyric4">coming home</a></li>
                            <li><a href="#lyric5">counting down the days</a></li>
                            <li><a href="#lyric6">estelle</a></li>
                            <li><a href="#lyric7">eventually</a></li>
                            <li><a href="#lyric8">forever means forever</a></li>
                            <li><a href="#lyric9">hesitation</a></li>
                            <li><a href="#lyric10">if you</a></li>
                            <li><a href="#lyric11">lovers or alchemists</a></li>
                            <li><a href="#lyric12">melting with you</a></li>
                            <li><a href="#lyric13">people</a></li>
                            <li><a href="#lyric14">sand</a></li>
                            <li><a href="#lyric15">somewhere</a></li>
                            <li><a href="#lyric16">the lyft song</a></li>
                            <li><a href="#lyric17">waiting</a></li>
                            <li><a href="#lyric18">we can go wherever we want</a></li>
                            <li><a href="#lyric19">when we're cold</a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="containIt show-for-large-up ">
                    <div class="lyricsSection"> 
                            
							
								<?php
									$query = $conn->prepare("SELECT id,lyrics_content FROM pcm_lyrics order by id");
									$query->execute();
									for($i=0; $row = $query->fetch(); $i++){
										echo "<section class=\"left lyrics\" id='lyric".$row['id']."' >";
										echo $row['lyrics_content']."<br/>";
										echo "</section>";
									}
								?>
                        <!--
							
                                <p><strong>A SONG OF SADNESS  //</strong></p><p>I’ve been searching Searching for somebody Someone who can love me Cause I can’t love myself</p>
                                <p>Lord, Ive been begging Begging for forgiveness But how can you, oh how can you When I can’t forgive myself</p>
                                <p>…. (x2)
                                My only love, I lost my only love My only love, been years since my only love My only love, my only..</p>
                                <p>I’ve been wandering Wondering Should I have done Should I have been More of me Less of me Which side was the best of me How can I win you back How can we start again How can we start again How can we start again</p> -->
                            
                        <!--    <section class="left lyrics" id="lyric2">
                               <!-- <p><strong>BACK  //</strong></p><p>It’s been a while since I last saw you 21 days to be exact Though the road is where I lay my head All of the streetlights say come back To you my love Oh my love</p>
                                <p>How many hours have I been driving So many places I’ve lost track Though the road is where my eyes look to My minds imagining me back With you my love Oh my love</p>
                                <p>I’m coming home (I’m on my way) I’m on my way back home</p>
                                <p>How many hours have I been driving So many places I’ve lost track But you don’t have to hold your head my dear Cause very soon I will be back To you my love Oh my love</p>-->
                         <!--   </section>  
                            <section class="left lyrics" id="lyric3">
                                <p><strong>BETWEEN TRUTH AND LIES  //</strong></p>
                                <p>Everybody thinks that its something new
                                From the things they wear to the things they try to do
                                Ain’t it true?
                                But I like things that have been good to me
                                Like a clean t-shirt and a blue pair of jeans
                                Cause I ain’t in a movie scene</p>
                                <p>Now I’m not plain but I’m no crook
                                Stealing frayed pants to look your look
                                It’s not me is it you?
                                You’re trying to lose the girl that you once knew</p>
                                <p>Don’t tell me your truths
                                Don’t tell me your lies
                                Everything on your insides shows outside</p>
                                <p>Now I like talking but I can listen to
                                But I lack love cause I’m missing you
                                Everything needs someone
                                Everybody needs something</p>
                                <p>No makeup can cover who you are
                                Unhappy pretending that there’s no scars
                                It hurts just to breathe
                                You look inside your soul but you can’t leave</p>
                                <p>Don’t tell me your truths
                                Don’t tell me your lies
                                Everything on your insides shows outside
                                Through your disguise
                                I see it in your eyes
                                Between those lies</p>
                                <p>Outside people humming
                                Ain’t everybody running
                                From the truth, the hurt, the past
                                We run to fast where were we last</p>
                                <p>Don’t tell me your truths
                                Don’t tell me your lies
                                Everything on your insides shows outside
                                Through your disguise
                                I see it in your eyes
                                Between those lies</p>
                            </section> 
                            <section class="left lyrics" id="lyric4">
                                <p><strong>COMING HOME  //</strong></p>
                                <p>The road goes on for days
                                The clouds cry their tears of gray
                                It’s getting colder the days getting dark
                                But this stormy weather can’t keep me apart from you</p>
                                <p>The music on the stereo sings “You’ve got so far to go”
                                I’m on my way
                                The wind whispers I’m getting close signs with city names I know
                                I’m on my way</p>
                                <p>The road goes on for miles
                                And I’ve been thinking ’bout you for quite some time now
                                It’s getting colder the days getting dark
                                But this stormy weather can’t keep me apart from you</p>
                                <p>The music on the stereo now sings “I wish I was homeward bound”
                                I’m on my way
                                The wind whispers I’m getting close familiar buildings, shops and roads
                                I’m on my way</p>
                                </p>I’m coming home</p>
                            </section>
                            <section class="left lyrics" id="lyric5">
                                <p><strong>COUNTING DOWN THE DAYS  //</strong></p>
                                <p>The thought of you
                                Just the thought of you
                                Now the winter’s not so cold
                                I’m counting down the days
                                ’til my love comes home</p>
                                <p>When I hear your voice
                                I feel your voice
                                Vibrating through my soul
                                I’m counting down the days
                                ’til my love comes home</p>
                                <p>And I’ll sing Ooh come home</p>
                            </section> 
                            <section class="left lyrics" id="lyric6">
                                <p><strong>ESTELLE  //</strong></p>
                                <p>I don’t know you but I know if I did
                                I would find out you’re the one I would give
                                All my heart to and all, all of my time
                                And together we would be two of a kind</p>
                                <p>I don’t know you, all I know is your name
                                And France is the country from where you just came
                                And your hair looks red, glows red in the dark
                                I called you twice today to no answer, no reply</p>
                                <p>And I’ve been wondering, I’m just wondering why
                                Oh Estelle oh Estelle you make me die</p>
                            </section> 
                            <section class="left lyrics" id="lyric7">
                                <p><strong>EVENTUALLY  //</strong></p>
                                <p>Someone told me love is tragic
                                She’s more trouble than she’s worth
                                And when you think you’ve really found it
                                Let her go, set her free
                                Cause your hearts will turn, you’ll crash and burn
                                Eventually</p>
                                <p>There was a time I felt divided
                                Was I meant to be alone
                                But now I’ve met you I decided
                                I won’t let you go, or set you free
                                Cause our hearts may turn, might crash and burn, but we’ll live we’ll learn
                                Eventually</p>
                                <p>What’s further down the road
                                Is heartache so I’m told
                                But all I see is you my dear our smiles, no tears,
                                Your touch, your lips, a ring, 2 kids,
                                A house down south, where the moon comes out
                                Love…</p>
                                <p>Someone told me love is tragic
                                Maybe so, I don’t agree
                                When people ask me me how I found it
                                I tell ‘em trust is what you need,
                                Cause your heart may turn, might crash might burn, but you’ll live you’ll learn
                                Eventually</p>
                            </section>
                            <section class="left lyrics" id="lyric8">
                                <p><strong>FOREVER MEANS FOREVER  //</strong></p>
                                <p>I love you so much
                                I’ll love you forever
                                I mean forever</p>
                                <p>I love you so much
                                I’ll kiss you forever
                                I’ll hold you forever</p>
                                <p>When our hearts grow tired
                                I’ll be sure to sing you this song
                                When we lose control
                                I’ll give in
                                I’ll be wrong
                                Cause forever means forever</p>
                                <p>I love you so much
                                I’ll be yours forever
                                I am yours forever</p>
                                <p>When our hearts grow tired
                                I’ll be sure to sing you this song
                                When we lose control
                                I’ll give in
                                I’ll be wrong
                                Cause forever means forever</p>
                                <p>Forever means forever</p>
                            </section>
                            <section class="left lyrics" id="lyric9">
                                <p><strong>HESITATION  //</strong></p>
                                <p>What does this hesitation mean
                                If I try harder I’ll make scene
                                But when the prize is worth the risk
                                I’ll take a chance and go for it</p>
                                <p>What are her eyes telling me
                                If I look harder I might blink
                                But when her lips are worth my wait
                                I can’t I won’t hesitate</p>
                                <p>She’s so beautifully dressed
                                My stomach’s in a mess
                                Can I pull this off
                                Pull of these butterflies</p>
                                <p>What does this conversation mean
                                If I keep quiet she might think
                                I’m just here to waste her time
                                But I’m just lost in her eyes</p>
                                <p>She’s so beautifully dressed
                                My stomach’s in a mess
                                Can I pull this off
                                Pull of these butterflies</p>
                                <p>My hands in my pockets
                                My eyes on the table
                                She wants me she wants me
                                I know I am capable
                                Eyes switch to dress
                                Down to shoes down to floor
                                She wants me she wants me
                                But I want her more</p>
                                <p>What does this conversation mean
                                If I keep quiet she might think
                                That I’m just here to waste her time
                                But I’m just lost in her eyes</p>
                            </section>
                            <section class="left lyrics" id="lyric10">
                                <p><strong>IF YOU  //</strong></p>
                                <p>If you take some of your time
                                And you mix it in with mine
                                Our chemicals create a potion that works quick
                                Even though our hearts and hands work opposite</p>
                                <p>If you take some of your plans
                                And you make them our plans
                                We’ll crash, collide, create constellations in the sky
                                To Mars and Venus no divide</p>
                                <p>If you take some of your smiles
                                And you press them onto mine our lips will close connect
                                Your skin will blend with mine
                                We’ll have forever but we’ll take our love seconds at a time</p>
                                <p>Blue to green to grey
                                Don’t close your eyes
                                I’m afraid our love will fade away…</p>
                            </section>
                            <section class="left lyrics" id="lyric11">
                                <p><strong>Lovers Or Alchemists  //</strong></p>
                                <p>If our love is love and this gold is gold
                                If fortune favors brave and bold
                                Then how’d we fail when Cupid’s arrows hit
                                Are we lovers or alchemists</p>
                                <p>Your touch of Midas felt so warm
                                Coupled my heart of stone
                                Can we live on hope that’s almost gone
                                Are we lovers or alchemists</p>
                                <p>We try we try</p>
                                <p>My eyes see what my heart can’t feel
                                Are we lovers or alchemists</p>
                            </section>
                            <section class="left lyrics" id="lyric12">
                               <p><strong>Melting With You  //</strong></p>
                                <p>No words could fully describe
                                The way you look tonight
                                Everyone’s eyes are on you
                                I am breathless…
                                You’re so beautiful</p>
                                <p>Angel that dances with me
                                The closest to heaven I’ve been
                                Feel this moment last forever
                                I’m melting in</p>
                                <p>My heart beats with yours
                                My skin on your skin
                                I’m melting in
                                I’m melting in</p>
                                <p>Light breaks through
                                My world comes crashing down
                                I only see you and that’s all I need
                                You’re all I need
                                I’m melting with you</p>
                            </section>
                            <section class="left lyrics" id="lyric13">
                                <p><strong>PEOPLE  //</strong></p>
                                <p>People always say you’re happy
                                People always say you smile
                                But what’s it gonna take to show ‘em that it’s fake
                                Your smile ain’t gonna last tonight
                                Your smile ain’t gonna last tonight</p>
                                <p>People always say you’re laughing
                                They’ve never seen you cry
                                But I’ve seen it once before you fall to the floor
                                When people leave and say goodbye
                                When people leave and say goodbye</p>
                                <p>And there’s a lesson to learn from this
                                You gotta cry when you need to cry
                                Let everybody know let your secrets go
                                And you’ll feel lighter in your soul
                                You’ll feel lighter in your soul</p>
                                <p>They only see your outsides
                                Please let somebody in
                                But once inside they’ll find your not too kind
                                Ain’t nothing gonna save you then
                                Not even love can save you then</p>
                                <p>And there’s a lesson to learn from this
                                You gotta cry when you need to cry
                                Let everybody know let your secrets go
                                And you’ll feel lighter in your soul
                                You’ll feel lighter in your soul</p>
                            </section>
                            <section class="left lyrics" id="lyric14">
                                <p><strong>SAND  //</strong></p>
                                <p>I tried
                                I tried my best to hold on
                                Hold on tight to you
                                All in vain
                                You slipped through my hands like a fistful of sand
                                Drifting with the tides of the sea</p>
                                <p>I’m trying to find some of my mind
                                By fixing my faults from the past
                                But it’s all in my head and the love that I bled
                                Has shriveled and died in the cold
                                You slipped through my hands like a fistful of sand
                                Drifting with the tides of the sea</p>
                                <p>You were in my hands…</p>
                            </section>
                            <section class="left lyrics" id="lyric15">
                                <p><strong>SOMEWHERE  //</strong></p>
                                <p>I’ve read the stars that light the sky
                                I’ve heard the waves that crash
                                And I know you’re out here somewhere</p>
                                <p>I feel a burning down my spine
                                Electric charging rush and I
                                Know you’re out here somewhere</p>
                                <p>I’ll climb the clouds to reach you
                                Search the sky to hold you
                                You and I will never be alone</p>
                            </section>
                            <section class="left lyrics" id="lyric16">
                                <p><strong>The Lyft Song  //</strong></p>
                                <p>The day was sunny when it started
                                Now its windy and there’s rain
                                You walked and didn’t drive
                                Now you’re looking for a ride
                                How about one from a friend</p>
                                <p>You’ve been working all day
                                And you lost track of time
                                It’s 5:45 your reservations are at 6
                                No time to look for parking
                                Well then how about a Lyft</p>
                                <p>I’m on my way I’ll pick you up
                                I’m on my way I’ll Lyft you up</p>
                                <p>We’re in Boston and Chicago to Seattle and the Bay
                                And we’re trying to get our drivers back and active in LA
                                I’m on my way I’ll pick you up
                                I’m on my way I’ll Lyft you up</p>
                                <p>Do you wanna start the night having fun on a drive
                                Well don’t wait
                                You’ve got a mustachioed ride might be
                                Disco Yoga Davis Highway
                                Hip Hop PK Cat or Bat or Cookie Wars inside
                                I’m on my way I’ll pick you up
                                I’m on my way I’ll Lyft you up</p>
                                <p>We’re on your way
                                We’ll Lyft you up</p>
                            </section>   
                            <section class="left lyrics" id="lyric17">
                                <p><strong>WAITING  //</strong></p>
                                <p>Waiting for someone
                                Waiting for something to be done
                                I’ve been waiting for a while now
                                For that good love to come</p>
                                <p>Watching the sunrise
                                Watching the clouds to blue to gray
                                I’ve been waiting for the wind to blow
                                Good love my way</p>
                                <p>What good’s a heart
                                What good’s a heart with no one to love?
                                Will I be waiting for forever
                                I’ll find out soon enough</p>
                                <p>Always analyzing
                                What and when did I do wrong
                                Cause I held love in my hands once
                                And in a second it was gone</p>
                                <p>What good’s a heart
                                What good’s a heart with no one to love
                                Will I be waiting for forever darling
                                We’ll find out soon enough</p>
                                <p>Maybe love will take a while
                                Maybe love might find me soon
                                Maybe waiting slows me down
                                And I can change my blues to our maroons
                                I’ll find my way
                                I’ll find your way</p>
                                <p>Watching the sunrise
                                Watching the clouds turn blue and gray
                                You’ve been waiting for too long but don’t worry
                                I’m on my way</p>
                            </section>   
                            <section class="left lyrics" id="lyric18">
                                <p><strong>WE CAN GO WHEREVER WE WANT  //</strong></p>
                                <p>We can go wherever we want
                                Let’s go to the city
                                Wander museums
                                and stare at Picassos</p>
                                <p>We can go wherever we want
                                Let’s go to the country
                                And hike in the valleys
                                And I’ll bring the wine</p>
                                <p>I’ve been thinking of places that we’ve never been
                                And things we could do that you would enjoy
                                And I’d hold you
                                And you’d hold me</p>
                                <p>We can go wherever we want
                                Let’s drive to Los Angeles
                                Hold hands in the car
                                Find out who we are
                                Let’s buy things we don’t need</p>
                                <p>We can go wherever we want
                                Let’s fly to Boston
                                Let’s get lost in the subways and snow</p>
                                <p>I’ve been thinking of places that we’ve never been
                                And things we could do that you would enjoy
                                And I’d hold you
                                And you’d hold me</p>
                                <p>I’ve been thinking of places that we’ve never been
                                And things we could do and how I could kiss you
                                And hold you
                                And you’d hold me</p>
                                <p>We can go wherever we want
                                But you say let’s stay here
                                Baby just lay here
                                We’ll stay here
                                My love</p>
                            </section>
                            <section class="left lyrics"  id="lyric19">
                                <p><strong>WHEN WE’RE COLD  //</strong></p>
                                <p>When we’re cold
                                We can light a fire with the sparks that fly
                                When you’re hand touches mine
                                Touches mine</p>
                                <p>Lyrics by Matt Amick</p>
                            </section>                         
							-->
                    </div>    
                </div>
                <div class="songs-container show-for-large-up">
                        <div id="listen-container">
                            <div id="click-listen">
                                <a><div id="playa" class="show-for-large-up">listen</div></a>
                            </div>
                            <div id="player-container" class="hide">
                                <div id="jquery_jplayer_1" class="jp-jplayer"></div>
                                <div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
                                    <div class="jp-type-playlist">
                                        <div class="jp-gui jp-interface">
                                            <div class="jp-controls">
                                                <button class="jp-previous button-player" role="button" tabindex="0">previous</button>
                                                <button class="jp-play button-player" role="button" tabindex="0">play</button>
                                                <button class="jp-next button-player" role="button" tabindex="0">next</button>
                                                <button class="jp-stop button-player" role="button" tabindex="0">stop</button>
                                            </div>
                                            <div class="jp-progress">
                                                <div class="jp-seek-bar">
                                                    <div class="jp-play-bar  button-player"></div>
                                                </div>
                                            </div>
                                            <div class="jp-volume-controls">
                                                <button class="jp-mute button-player" role="button" tabindex="0">mute</button>
                                                <button class="jp-volume-max button-player" role="button" tabindex="0">max volume</button>
                                                <div class="jp-volume-bar">
                                                    <div class="jp-volume-bar-value"></div>
                                                </div>
                                            </div>
                                            <div class="jp-time-holder">
                                                <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                                                <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                                            </div>
                                            <div id="current-track"></div>
                                            <div class="jp-toggles" style="display:none;">
                                                <button class="jp-repeat" role="button" tabindex="0">repeat</button>
                                                <button class="jp-shuffle" role="button" tabindex="0">shuffle</button>
                                            </div>
                                        </div>
                                        <div class="jp-playlist" style="display:none;">
                                            <ul>
                                                <li>&nbsp;</li>
                                            </ul>
                                        </div>
                                        <div class="jp-no-solution">
                                            <span>Update Required</span>
                                            To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div> 

                <div class="row  hide-for-large-up " style="margin-right:0px">
                        <div class="small-12 medium-12 columns hide-for-large-up ">
                            <ul class="small-block-grid-1 medium-block-grid-2" id="small-Lyrics">
                                <li>
                                    <p><strong>BACK  //</strong>It’s been a while since I last saw you/ 21 days to be exact/ Though the road is where I lay my head/All of the streetlights say come back/ To you my love/ Oh my love/ How many hours have I been driving/ So many places I’ve lost track/ Though the road is where my eyes look to/ My minds imagining me back/ With you my love/ Oh my love/ I’m coming home (I’m on my way)/ I’m on my way back home/  How many hours have I been driving/ So many places I’ve lost track/ But you don’t have to hold your head my dear/ Cause very soon I will be back/ To you my love/ Oh my love</p>
                                </li>
                                <li>
                                   <p><strong>COMING HOME  //</strong>The road goes on for days/ The clouds cry their tears of gray/ It’s getting colder the days getting dark/ But this stormy weather can’t keep me apart from you/ The music on the stereo sings “You’ve got so far to go”/ I’m on my way/ The wind whispers I’m getting close signs with city names I know/ I’m on my way/ The road goes on for miles/ And I’ve been thinking ’bout you for quite some time now/ It’s getting colder the days getting dark/ But this stormy weather can’t keep me apart from you/ The music on the stereo now sings “I wish I was homeward bound”/ I’m on my way/ The wind whispers I’m getting close familiar buildings, shops and roads/ I’m on my way/ I’m coming home</p>
                                </li>
                                <li>
                                   <p><strong>SAND  //</strong>I tried/ I tried my best to hold on/ Hold on tight to you/ All in vain/ You slipped through my hands like a fistful of sand/ Drifting with the tides of the sea/ I’m trying to find some of my mind/ By fixing my faults from the past/ But it’s all in my head and the love that I bled/ Has shriveled and died in the cold/ You slipped through my hands like a fistful of sand/ Drifting with the tides of the sea/ You were in my hands…</p>
                                </li>
                                <li>
                                    <p><strong>WAITING  //</strong>Waiting for someone/ Waiting for something to be done/ I’ve been waiting for a while now/ For that good love to come/ Watching the sunrise/ Watching the clouds to blue to gray/ I’ve been waiting for the wind to blow/ Good love my way/ What good’s a heart/ What good’s a heart with no one to love?/ Will I be waiting for forever/ I’ll find out soon enough/ Always analyzing/ What and when did I do wrong/ Cause I held love in my hands once/ And in a second it was gone/ What good’s a heart/ What good’s a heart with no one to love/ Will I be waiting for forever darling/ We’ll find out soon enough/ Maybe love will take a while/ Maybe love might find me soon/ Maybe waiting slows me down/ And I can change my blues to our maroons/ I’ll find my way/ I’ll find your way/ Watching the sunrise/ Watching the clouds turn blue and gray/ You’ve been waiting for too long but don’t worry/ I’m on my way</p></li>
                                <li>
                                    <p><strong>WE CAN GO WHEREVER WE WANT  //</strong>We can go wherever we want/ Let’s go to the city/ Wander museums/ and stare at Picassos/ We can go wherever we want/ Let’s go to the country/ And hike in the valleys/ And I’ll bring the wine/  I’ve been thinking of places that we’ve never been/ And things we could do that you would enjoy/ And I’d hold you/ And you’d hold me/ We can go wherever we want/ Let’s drive to Los Angeles/ Hold hands in the car/ Find out who we are/ Let’s buy things we don’t need/ We can go wherever we want/ Let’s fly to Boston/ Let’s get lost in the subways and snow/ I’ve been thinking of places that we’ve never been/ And things we could do that you would enjoy/ And I’d hold you/ And you’d hold me/ I’ve been thinking of places that we’ve never been/ And things we could do and how I could kiss you/ And hold you/ And you’d hold me/ We can go wherever we want/ But you say let’s stay here/ Baby just lay here/ We’ll stay here/ My love</p>
                                </li>
                                <li>
                                   <p><strong>COUNTING DOWN THE DAYS  //</strong>The thought of you/ Just the thought of you/ Now the winter’s not so cold/ I’m counting down the days/ / ’til my love comes home/ When I hear your voice/ I feel your voice/ Vibrating through my soul/ I’m counting down the days/ ’til my love comes home</p>
                                </li>
                                <li>
                                  <p><strong>FOREVER MEANS FOREVER  //</strong>I love you so much/ I’ll love you forever/ I mean forever/ I love you so much/ I’ll kiss you forever/ I’ll hold you forever/ When our hearts grow tired/ I’ll be sure to sing you this song/ When we lose control/ I’ll give in/ I’ll be wrong/ Cause forever means forever/ I love you so much/ I’ll be yours forever/ I am yours forever/ When our hearts grow tired/ I’ll be sure to sing you this song/ When we lose control/ I’ll give in/ I’ll be wrong/ Cause forever means forever/ Forever means forever</p>
                                </li>
                                <li>
                                  <p><strong>HESITATION  //</strong>The thought of you/ Just the thought of you/ Now the winter’s not so cold/ I’m counting down the days/ ’til my love comes home/ When I hear your voice/ I feel your voice/ Vibrating through my soul/ I’m counting down the days/ ’til my love comes home/ And I’ll sing Ooh come home/ What does this hesitation mean/ If I try harder I’ll make scene/ But when the prize is worth the risk/ I’ll take a chance and go for it/ What are her eyes telling me/ If I look harder I might blink/ But when her lips are worth my wait/ I can’t I won’t hesitate/ She’s so beautifully dressed/ My stomach’s in a mess/ Can I pull this off/ Pull of these butterflies/ What does this conversation mean/ If I keep quiet she might think/ I’m just here to waste her time/ But I’m just lost in her eyes/ She’s so beautifully dressed/ My stomach’s in a mess/ Can I pull this off/ Pull of these butterflies/ My hands in my pockets/ My eyes on the table/ She wants me she wants me/ I know I am capable/ Eyes switch to dress/ Down to shoes down to floor/ She wants me she wants me/ But I want her more/ What does this conversation mean/ If I keep quiet she might think/ That I’m just here to waste her time/ But I’m just lost in her eyes</p></li>
                            </ul>
                        </div>
                </div>
            </section>
			<section id="videos" class="main-sections">
              
                    <div class="row">
                        <div class="large-12 medium-12 small-12 columns title right">
                            <h1>photos &amp; videos</h1>
                        </div>        
                    </div>
                     <div class="row video-container">
                        <div class="large-12 medium-12 small-12 columns" style="margin:0px;float:right">
                            <div class="show-slider">
                              <?php
									$query="select name from pcm_image";
									$result = $conn->prepare($query);
									$result->execute();
									$rows = $result->fetchAll(PDO::FETCH_ASSOC);
									if($rows>0){
										foreach ($rows as $row) {
											echo "<div class='slide-Container'>";
											echo "<img src='resources/images/".$row['name']."'>";
											echo "</div>";
										}
									}					
								?>
								<?php
									$query="select link from pcm_video";
									$result = $conn->prepare($query);
									$result->execute();
									$rows = $result->fetchAll(PDO::FETCH_ASSOC);
									if($rows>0){
										foreach ($rows as $row) {
											echo "<div class='slide-Container'>";
											echo "<iframe width='100%' height='100%' src='".$row['link']."' frameborder='0' allowfullscreen></iframe>";
											echo "</div>";
										}
									}					
								?>
                            </div>
                        </div>        
                    </div>
                
            </section>
            <section id="events" class="main-sections">
                     <div class="row">
                        <div class="large-12 medium-12 small-12 columns left">
                            <h1>UpComing Shows</h1>
                        </div>        
                    </div>
                    <div class="row">
                       <!-- <div class="large-6 medium-6 small-12 columns left">
                           <div style="text-align:right"> 
                           <div class="show-slider">
                              <div class="slide-Container">
                                <img src="http://placehold.it/200x200">
                              </div>
                              <div class="slide-Container">
                                <img src="http://placehold.it/200x200">
                              </div>
                              <div class="slide-Container">
                              </div>
                            </div>
                            </div>
                        </div>-->
                        <div class="large-12  medium-12 small-12 columns left" style="text-align:left;">
                            <ul id="show-listings">
							
								<?php
									$query="select show0_.city,DATE_FORMAT(CONVERT_TZ(show0_.show_date, '+00:00', timezone1_.zone),'%h:%i %p') as time, show0_.cost, show0_.link_to_buy, show0_.venue, show0_.detail, DATE_FORMAT(CONVERT_TZ(show0_.show_date, '+00:00', timezone1_.zone),'%b %D') as date,CONVERT_TZ(show0_.show_date, '+00:00', timezone1_.zone) as dateTime ,show0_.contact_venue,show0_.address from pcm_show show0_ inner join pcm_time_zone timezone1_ on show0_.time_zone=timezone1_.id where CONVERT_TZ(show0_.show_date, '+00:00', timezone1_.zone)>CONVERT_TZ(utc_timestamp(), '+00:00', timezone1_.zone) ORDER BY CONVERT_TZ(show0_.show_date, '+00:00', timezone1_.zone)";
									$result = $conn->prepare($query);
									$result->execute();
									$rows = $result->fetchAll(PDO::FETCH_ASSOC);
									
									foreach ($rows as $row) {
										echo "<li class='show modal' attr-name='".$row['venue']."' attr-time='".$row['time']."' attr-detail='".$row['detail']."' attr-date='".$row['date']."' attr-cost='".$row['cost']."' attr-link='".$row['link_to_buy']."' attr-address='".$row['address']."' attr-contact='".$row['contact_venue']."'' attr-date-time='".$row['dateTime']."'><a><span>".$row['venue']."</span>,<span>".$row['city']."</span>,<span>".$row['date']."</span> </a></li>";
									}
								?>
							<!--	<li class="show modal"><a><span>venue,</span><span>city</span><span> date</span><span> time</span></a></li>
                                <li class="show modal"><a>Lorem ipsum dolor sit amet, consectetur adipitetur ameitetura dolor sit</a></li>
                                <li class="show modal"><a>Lorem ipsum dolor sit amet, consectetur adipitetur ameitetura dolor sit</a></li> -->
                            </ul>
                        </div>
                    </div>
            </section>
            <section id="contact" class="main-sections">
                <div>
                    <div class="row" style="text-align:center;">
                        <div class="large-12 medium-12 small-12 columns">
                            <h1>get in touch</h1>
                        </div>        
                    </div>
                    <div class="row" style="text-align:center">
                        <div class="large-12 medium-12 small-12 columns">
                        <div id="contact-form">
                            <h5>
                                <span><a id="newsletter">newsletter  &#124;</a></span>
                                <span><a id="bookme">Book Me  &#124;</a></span>
                                <span><a id="questions">questions</a></span>
                            </h5>
                            <br>
                              <input class="input-form" type="text" id="name" placeholder="name">
                              <br>
                              <input class="input-form" type="text" id="email" placeholder="email">
                              <br>
                              <textarea class="input-form" placeholder="message" id="message"></textarea>
                              <button class="send right contact-send" value="SEND">Send</button>
                        </div> 
                        </div>
                        <div class="large-6 medium-12 small-12 columns">  
                        </div>
                    </div>
                </div>
            </section>
        </div> 
<!-- event modal -->
    <div id="eventModal" class="reveal-modal small" data-reveal> 
        <div class="center">
        <div class="row">
            <div class="large-12 medium-12 small-12 columns"> 
                  <h2 class="show-model-name">event / venue name</h2>
            </div>
        </div>
        <div class="row">
            <div class="large-12 medium-12 small-12 columns">
                <p class="show-model-detail">blurb  or anything peter wants to write about the event</p>
            </div>
        </div>
        <div class="row">
            <div class="large-6 medium-6 small-12 columns">
                <p class="show-model-time">Time</p>
            </div>
            <div class="large-6 medium-6 small-12 columns">
                <p class="show-model-date">date</p>
            </div>
        </div>
        <div class="row">
            <div class="large-6 medium-6 small-12 columns">
                <p class="show-model-cost">Cost if any </p>
            </div>
            <div class="large-6 medium-6 small-12 columns">
                <p><a class="show-model-link">Buy Ticket</a></p>
            </div>
        </div>
         <div class="row">
            <div class="large-6 medium-6 small-12 columns">
                <p class="show-model-address">address to venue</p>
            </div>
            <div class="large-6 medium-6 small-12 columns">
                <p class="show-model-contact">contact number for venue</p>
            </div>
        </div> 
        <button class="send"><a href="" class="add-to-calender" target="_blank">add to Calendar +</a></button>
		</div> 
      <a class="close-reveal-modal">X</a>
    </div>

<script src="js/jquery.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/foundation.js"></script> 
<script src="js/foundation.reveal.js"></script>
<script src="js/foundation.equalizer.js"></script>
<script type="text/javascript" src="js/jplayer/dist/jplayer/jquery.jplayer.js"></script>
<script type="text/javascript" src="js/jplayer/dist/add-on/jplayer.playlist.min.js"></script>


<script>
$(document).foundation();

//smooth scrolling 
$(function() {
    $(document).on("scroll", onScroll);
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      console.log(target);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});
// side nav menu 
function onScroll(event){
    var scrollPos = $(document).scrollTop();
    var homePos =$("#home").height();
    if(scrollPos>homePos-25){
        $(".sidescroll").removeClass('hide');
        //$( ".sidescroll" ).animate({ "right": "50px" }, "slow" );
    }else{
        $(".sidescroll").addClass('hide');
        //$( ".sidescroll" ).animate({ "left": "50px" }, "slow" );
    }
}


//smoothscroll lyrics
//get index of clicked anchor tag and scroll by 595px * index
//using jQuery offset() and position() to determine the scrollable pixel amount
//doesn't scroll to the proper place on the page.
$(function() {
    $('ul.songList a').bind('click',function(event){
        var $anchor = $(this);
        var index = $('ul.songList a').index(this);
        var containerWidth = 595; // 555px container width, 20px margin on each side (555+20+20=595)

        $('.containIt').stop().animate({
            scrollLeft: containerWidth*index
        }, 800); // speed of scroll
        event.preventDefault();
    });
});



//modal 
		$( '.modal' ).click(function(){
				$('.show-model-time').text($(this).attr('attr-time'));
				$('.show-model-date').text($(this).attr('attr-date'));
				$('.show-model-name').text($(this).attr('attr-name'));
				$('.show-model-detail').text($(this).attr('attr-detail'));
				$('.show-model-cost').text($(this).attr('attr-cost'));
				$('.show-model-link').attr("href",($(this).attr('attr-link')));
				$('.show-model-address').text($(this).attr('attr-address'));
				$('.show-model-contact').text($(this).attr('attr-contact'));
				var calenderHref="https://www.google.com/calendar/render?action=TEMPLATE&text=";
				calenderHref=calenderHref+$(this).attr('attr-name');
				calenderHref=calenderHref+"&date="+$(this).attr('attr-date-time')+"/";
				calenderHref=calenderHref+"&details="+$(this).attr('attr-detail');
				calenderHref=calenderHref+"&location="+$(this).attr('attr-address');
				
				$('.add-to-calender').attr("href",calenderHref);
				$('#eventModal').foundation('reveal', 'open'); 
		});


//top nav img hover
var sourceSwap = function () {
        var $this = $(this);
        var newSource = $this.data('alt-src');
        $this.data('alt-src', $this.attr('src'));
        $this.attr('src', newSource);
    }
    $(function () {
        $('img.navIconz').hover(sourceSwap, sourceSwap);
    });


//slider
$('.show-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 3000,

});
                
//audio player
$(document).ready(function(){
  $("#click-listen").click(function(){
    $( "#player-container" ).toggleClass( "hide" );
  });
  });
$( '#showz' ).hover(function(){
    $('.showOverlay').toggleClass("hide");
       
});

var req_type = "";
$( '#newsletter' ).click(function(){
    $('#message').addClass("hide");
	req_type ="newsletter";
       
});
$( '#bookme' ).click(function(){
    $('#message').removeClass("hide");
	req_type ="message";
});
$( '#questions' ).click(function(){
    $('#message').removeClass("hide");
	req_type ="questions";
});

$(".contact-send").click(function(){
	
	if (req_type == "")
	{
		alert ("Please select a Type");
	}
	else
	{
		$.ajax({
			type:"post",
			data:{
				name:$("#name").val(),
				email:$("#email").val(),
				message:$("#message").val(),
				request_type:req_type
			},
			url:"newsletter-submit.php",
			success:function(response){
				$("#name").val('');
				$("#email").val('');
				$("#message").val('');
			},
			error:function(response){console.log(response)}
		});
	}
});
//lyrics music notes
$( '.a' ).hover(function(){
   $(this).children( ".b" ).toggleClass("hide");   
});
    </script>    
	<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){

	var myPlaylist = new jPlayerPlaylist({
		jPlayer: "#jquery_jplayer_1",
		cssSelectorAncestor: "#jp_container_1"
	}, [
		<?php
			$sql="SELECT track_name,file_name FROM pcm_audio";
			foreach ($conn->query($sql) as $row) {
				echo "{title:'".$row['track_name']."',mp3:'resources/audio/".$row['file_name']."'},";
			}
		?>
	], {
		swfPath: "../../dist/jplayer",
		supplied: "oga, mp3",
		wmode: "window",
		useStateClassSkin: true,
		autoBlur: false,
		smoothPlayBar: true
	});
	
	$("#jquery_jplayer_1").bind($.jPlayer.event.play, function(event) {
		console.log(myPlaylist.playlist[myPlaylist.current].title);
		$('#current-track').empty();
		$('#current-track').append(myPlaylist.playlist[myPlaylist.current].title);
	}); 
});
//]]>
</script>	
    </body>
</html>    
