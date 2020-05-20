<?php
include 'header.php';
?>
    <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselIndicators" data-slide-to="1"></li>
        <li data-target="#carouselIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img src="img/basketball.jpg" alt="#">		
            </div>
            <div class="carousel-item">
                <img src="img/soccer.jpg" alt="#">
            </div>
            <div class="carousel-item">
                <img src="img/playbasketball.jpg" alt="#">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </div>

    <main id="content">
        <section id="about-us">
            <div class="container box padding-inside">
                <div class="title-container">
                    <h1>About Us</h1>
                    <hr>
                </div>
                <p>As many people have experienced, finding people to organize pick up games with can be difficult. 
                    Often a person will head over to a local park just to find out that the park is already being used, 
                    there aren’t enough people, or the people that are there are all different ages.</p>
                <p>As founders, our number 1 goal was to find a solution to these problems by applying our programming skills.</p>
                <p>Meet-N-Compete provides an online means for people to Organize, Create, & Join pick-up games, thereby making it easier for people to get out there and compete in their favorite sports.</p>
            </div>
        </section>
            
        </div>
    </main>
<?php
include 'footer.php';
?>