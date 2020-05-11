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
                <p>This project will help bring a solution to these problems, allowing users to view events and locations via a map, 
                    while also being able to create events of their own for others to see and join.</p>
                <p>Meet-N-Compete will provide an online means to help people organize pick-up games and reduce the difficulties and confusion that usually accompany.</p>
            </div>
        </section>
            
        </div>
    </main>
<?php
include 'footer.php';
?>